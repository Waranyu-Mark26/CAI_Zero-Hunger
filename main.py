import pandas as pd
import numpy as np
import tensorflow as tf
from sklearn.preprocessing import MinMaxScaler
import mysql.connector
import datetime

strInput = str(input('Enter a product name to insert...'))

# Import data
data = pd.read_csv('Data_Train/' + strInput + '.csv')
# Drop date variable
data = data.drop(['Date'], 1)
# Dimensions of dataset
n = data.shape[0]
p = data.shape[1]
# Make data a numpy array
data = data.values

# Training and test data
train_start = 0
train_end = int(np.floor(0.8*n))
test_start = train_end
test_end = n
data_train = data[np.arange(train_start, train_end), :]
data_test = data[np.arange(test_start, test_end), :]

# Scale data
scaler = MinMaxScaler()
data_train = scaler.fit_transform(data_train)
data_test = scaler.transform(data_test)
# Build X and y
X_train = data_train[:, :12]
y_train = data_train[:, 12]
X_test = data_test[:, :12]
y_test = data_test[:, 12]

# Model architecture parameters
n_stocks = 12
n_neurons_1 = 32
n_neurons_2 = 16
n_neurons_3 = 8
n_neurons_4 = 4
n_target = 1

# Placeholder
X = tf.placeholder(dtype=tf.float32, shape=[None, n_stocks])
Y = tf.placeholder(dtype=tf.float32, shape=[None])

# Initializers
sigma = 1
weight_initializer = tf.variance_scaling_initializer(mode="fan_avg", distribution="uniform", scale=sigma)
bias_initializer = tf.zeros_initializer()

# Layer 1: Variables for hidden weights and biases
W_hidden_1 = tf.Variable(weight_initializer([n_stocks, n_neurons_1]))
bias_hidden_1 = tf.Variable(bias_initializer([n_neurons_1]))
# Layer 2: Variables for hidden weights and biases
W_hidden_2 = tf.Variable(weight_initializer([n_neurons_1, n_neurons_2]))
bias_hidden_2 = tf.Variable(bias_initializer([n_neurons_2]))
# Layer 3: Variables for hidden weights and biases
W_hidden_3 = tf.Variable(weight_initializer([n_neurons_2, n_neurons_3]))
bias_hidden_3 = tf.Variable(bias_initializer([n_neurons_3]))
# Layer 4: Variables for hidden weights and biases
W_hidden_4 = tf.Variable(weight_initializer([n_neurons_3, n_neurons_4]))
bias_hidden_4 = tf.Variable(bias_initializer([n_neurons_4]))

# Output layer: Variables for output weights and biases
W_out = tf.Variable(weight_initializer([n_neurons_4, n_target]))
bias_out = tf.Variable(bias_initializer([n_target]))

# Hidden layer
hidden_1 = tf.nn.relu(tf.add(tf.matmul(X, W_hidden_1), bias_hidden_1))
hidden_2 = tf.nn.relu(tf.add(tf.matmul(hidden_1, W_hidden_2), bias_hidden_2))
hidden_3 = tf.nn.relu(tf.add(tf.matmul(hidden_2, W_hidden_3), bias_hidden_3))
hidden_4 = tf.nn.relu(tf.add(tf.matmul(hidden_3, W_hidden_4), bias_hidden_4))

# Output layer (must be transposed)
out = tf.transpose(tf.add(tf.matmul(hidden_4, W_out), bias_out))

# Cost function
mse = tf.reduce_mean(tf.squared_difference(out, Y))

# Optimizer
opt = tf.train.AdamOptimizer().minimize(mse)

# Make Session
net = tf.Session()
# Run initializer
net.run(tf.global_variables_initializer())

# # Setup interactive plot
# plt.ion()
# fig = plt.figure()
# ax1 = fig.add_subplot(111)
# line1, = ax1.plot(y_test)
# line2, = ax1.plot(y_test*0.5)
# plt.show()

# Number of epochs and batch size
epochs = 100
batch_size = 10

for e in range(epochs):

    # Shuffle training data
    shuffle_indices = np.random.permutation(np.arange(len(y_train)))
    X_train = X_train[shuffle_indices]
    y_train = y_train[shuffle_indices]

    # Minibatch training
    for i in range(0, len(y_train) // batch_size):
        start = i * batch_size
        batch_x = X_train[start:start + batch_size]
        batch_y = y_train[start:start + batch_size]
        # Run optimizer with batch
        net.run(opt, feed_dict={X: batch_x, Y: batch_y})

# Print final MSE after Training
mse_final = net.run(mse, feed_dict={X: X_test, Y: y_test})

print('MSE : ' + str(mse_final))
pred = net.run(out, feed_dict={X: X_test})
scaler.inverse_transform(pred)

# print('Predicted Result : ' + str((pred[0][len(pred[0])-1])))

cnx = mysql.connector.connect(user='root', password='',
                              host='127.0.0.1',
                              database='zero_hunger')
cursor = cnx.cursor()

insertStatus = str(input('Do you want to insert this to database? (y/n)'))

if (insertStatus == 'y'):
    add_productList = ("INSERT INTO `product_list` "
                       "(`id`, `date`, `product_id`, `name`, `exp_date`, `amount`) "
                       "VALUES (NULL, CURRENT_TIMESTAMP, %(product_id)s, %(name)s, %(exp_date)s, %(amount)s);")

    product_id = input('Enter product_id : ')
    name = input("Enter product's name : ")
    date_entry = input('Enter expired date in YYYY-MM-DD format : ')
    year, month, day = map(int, date_entry.split('-'))
    exp_date = datetime.datetime(year, month, day)
    amount = input('Enter product amount : ')

    data_productList = {
        'product_id': product_id,
        'name': name,
        'exp_date': exp_date,
        'amount': amount
    }
    # result = cursor.execute("INSERT INTO `product_list` (`id`, `date`, `product_id`, `name`, `exp_date`, `amount`) VALUES (NULL, CURRENT_TIMESTAMP, '8850051017463', 'test', '2019-04-02', '1');")
    cursor.execute(add_productList, data_productList)
    cnx.commit()

cursor.close()
cnx.close()
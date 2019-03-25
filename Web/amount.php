<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Project : Zero Hunger</title>
        <link rel="stylesheet" type="text/css" href="main.css">
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        <script src="jquery-3.3.1.min.js" type="text/javascript"></script>
    </head>
    <body class="body">
        <h1>Project : Zero Hunger</h1>
        <h2 align="center">Please Enter the food amount</h2>
        <form method="GET" align="center" action="record.php">
            <input type="number" id="requested_amnt" name="amnt" placeholder="Amount..."><br><br>
            <input type="hidden" name="u"  <?php echo ("value='"); echo $_GET['u']; echo ("'"); ?>>
            <button type="submit" class="btn btn-success">Submit</button>
            <br><br>
            <div id="submit">
            </div>

        </form>
    </body>
</html>

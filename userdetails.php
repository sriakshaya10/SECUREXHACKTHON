<?php
include('config.php');
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        #login {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            margin: 0 auto;
        }
        td {
            padding: 10px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    
</body>
</html>

<table>
    <th> <h1>Enter user details:</h1></th>
    <tr>
        <td>
           Name:
        </td>
        <td><input type="text" name="name"></td></tr>
<tr>
        <td>Occupation:</td>
        <td><input type="text" name="occupation"></td>
    </tr>

    <tr>
        <td>Mobile number:</td>
        <td><input type="number" name="mnumber"></td>
    </tr>
</table>
<?php
include('footer.php');
?>
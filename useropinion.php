<?php
include('config.php');
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Opinion</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        #login {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            margin: 0 auto;
            width: 100%;
        }
        td {
            padding: 10px;
            text-align: left;
        }
        label {
            margin-left: 10px;
            font-size: 1rem;
            color: #333;
            cursor: pointer;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div id="login">
        <h1>Enter Your Opinion</h1>
        <table>
            <tbody>
                <tr>
                    <td>
                        <input type="radio" name="opinion" id="self" value="self">
                        <label for="self">Select courses by yourself</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="opinion" id="gpt" value="gpt">
                        <label for="gpt">Recommended courses by AI</label>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        // Handle radio button selection and redirection
        document.getElementById('self').addEventListener('change', function () {
            if (this.checked) {
                window.location.href = 'courses.php'; // Redirect to courses.php
            }
        });

        document.getElementById('gpt').addEventListener('change', function () {
            if (this.checked) {
                window.location.href = 'airec.php'; // Redirect to airec.php
            }
        });
    </script>
</body>
</html>
<?php
include('footer.php');
?>

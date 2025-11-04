<?php
declare(strict_types=1);
session_start();
// Start Store $_SESSION data 
$_SESSION['start_timestamp'] = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photo Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 70px auto;
            padding: 20px;
            background: #f5f5f5;
        }

        .upload_wrapper {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        button {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #5568d3;
        }
    </style>
</head>

<body> 
   
    <!-- <form action="process.php" method="POST">  -->
    <div class="upload_wrapper"> 
        <form action="upload_handler.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend> <h2>📸 Upload Your Photo</h2> </legend>
                <input type="file" id ="photo" name="photo" accept="image/*" required><br><br>
                <button type="submit">Upload Photo</button>
            </fieldset> <!-- End of Fieldset -->
        </form> <!-- End of Form -->
    </div>

</body>
</html>   

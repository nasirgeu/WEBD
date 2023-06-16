<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }

        .file-input-container {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 200px;
            height: 40px;
            background-color: #f1f1f1;
            border-radius: 4px;
        }

        .file-input-container input[type="file"] {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-input-container label {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .file-input-container label:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            font-size: 14px;
            margin-top: 20px;
            margin-bottom: 20px;
            color:#ff3333;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #FFCCCC;
        }

        .box{
            width:70%;
            margin:auto;
            margin-top: 120px;
            margin-bottom: 20px;
            color:#ff3333;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
        }

    </style>
</head>
<body>
    <div class="box">
    <h2>Select File to Upload</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <label for="file">Select a file:</label>
        <input type="file" name="file" id="file">
        <input type="submit" value="Upload" name="submit">
    </form>
   

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif']; 
        $maxFileSize = 2 * 1024 * 1024; 

        $uploadedFile = $_FILES['file'];
        if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
            $fileName = $uploadedFile['name'];
            $fileSize = $uploadedFile['size'];
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            if (!in_array($fileType, $allowedFileTypes)) {
                echo '<p class="error-message">Error: Invalid file type. Allowed file types are: ' . implode(', ', $allowedFileTypes) . '</p>';

            }
            elseif ($fileSize > $maxFileSize) {
                echo '<p class="error-message">Error: File size exceeds the maximum limit of 2MB.</p>';

            } else {
                $uploadPath = 'uploads/' . $fileName;
                if (move_uploaded_file($uploadedFile['tmp_name'], $uploadPath)) {
                    echo "<p>File uploaded successfully.</p>";
                } else {
                    echo "<p>Error uploading the file.</p>";
                }
            }
        } else {
            echo "<p>Error: " . $uploadedFile['error'] . "</p>";
        }
    }
    ?>
    </div>
</body>
</html>

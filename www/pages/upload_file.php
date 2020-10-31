<?php
include "header.php";
include "config.php";
?>
<h1> Upload file </h1>

<form action="index.php?page=upload_file" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>
<?php

function insert_file($file_size, $user_id, $file_name, $mysqli)
{

    $sql = "INSERT INTO files (file_size, user_id, file_name)
            VALUES ($file_size, $user_id, '$file_name')";

    if (mysqli_query($mysqli, $sql)) {
        echo "Záznam byl úspěšně vytvořen. ";
    } else {
        echo "Chyba vytvoreni zaznamu: " . $sql . "<br>" . mysqli_error($mysqli);
    }
}

if (isset($_POST["submit"])) {

    $target_file = $ADRESAR . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);


    if ($_FILES["fileToUpload"]["size"] > 500000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    insert_file($_FILES["fileToUpload"]["size"], $_SESSION['id'], basename($_FILES["fileToUpload"]["name"]), $mysqli);
    $file_name = $_FILES["fileToUpload"]["name"];

    $file_id = mysqli_insert_id($mysqli);
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $ADRESAR . $file_id)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
include "footer.php";
?>

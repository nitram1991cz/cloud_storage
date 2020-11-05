<?php
include "header.php";
include "config.php";
?>
<h1> Upload file </h1>

<form action="index.php?page=upload_file" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>
<?php
function error_message($error)
{
    ?>
    <div class='error'><?php echo($error); ?></div>
    <?php
}

function insert_file($file_size, $user_id, $file_name, $mysqli)
{

    $sql = "INSERT INTO files (file_size, user_id, file_name)
            VALUES ($file_size, $user_id, '$file_name')";

    if (mysqli_query($mysqli, $sql)) {
        echo "Záznam byl úspěšně vytvořen. ";
    } else {
        error_message("Chyba vytvoreni zaznamu. ");
    }
}

if (isset($_POST["submit"])) {

    $target_file = $ADRESAR . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);


    if ($_FILES["fileToUpload"]["size"] > 500000000) {
        error_message("Soubor je prilis velky. ");
        $uploadOk = 0;
    }
    insert_file($_FILES["fileToUpload"]["size"], $_SESSION['id'], basename($_FILES["fileToUpload"]["name"]), $mysqli);
    $file_name = $_FILES["fileToUpload"]["name"];

    $file_id = mysqli_insert_id($mysqli);
    if ($uploadOk == 0) {
        error_message("Chyba pri nahrati souboru. ");

    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $ADRESAR . $file_id)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            error_message("Chyba pri nahrati souboru. ");
        }
    }
}
include "footer.php";
?>

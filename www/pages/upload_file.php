<?php

include "config.php";
include "header.php";
if (!$_SESSION['logged_username']) {
    header("Location: index.php?page=login");
    exit;
}
echo($status);
include "menu.php";
?>
<h1> Upload file </h1>

<form action="index.php?page=upload_file" method="post" enctype="multipart/form-data">
    Vyber soubor k nahrati:
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

    if (!mysql_query(/*$mysqli,*/ $sql)) {
        error_message("Chyba vytvoreni zaznamu. ");
    }
}

if (isset($_POST["submit"])) {

    $target_file = $ADRESAR . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $id = $_SESSION["id"];
   /* $sql = "SELECT storage_limit FROM users where id='$id'";
    $result = mysql_query(/*$mysqli, $sql);
    $file_name = mysql_fetch_assoc($result);
    var_dump($file_name);*/
    if ($_SESSION['storage_limit'] == null) {
        insert_file($_FILES["fileToUpload"]["size"], $_SESSION['id'], basename($_FILES["fileToUpload"]["name"]), $mysqli);
    } else {
        $sql = "SELECT SUM(file_size) FROM files where user_id='$id'";
        $result = mysql_query(/*$mysqli,*/ $sql);
        $row = mysql_fetch_row($result);
        if (($_FILES["fileToUpload"]["size"] + $row[0]) > ($_SESSION['storage_limit']*1000000)) {
            error_message("Soubor je prilis velky. ");
            $uploadOk = 0;
        } else {
            insert_file($_FILES["fileToUpload"]["size"], $_SESSION['id'], basename($_FILES["fileToUpload"]["name"]), $mysqli);
        }
    }

    $file_id = mysql_insert_id($mysqli);
    if ($uploadOk == 0) {
        error_message("Chyba pri nahrati souboru. ");

    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $ADRESAR . $file_id)) {
            echo "Soubor " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " byl nahrán.";
        } else {
            error_message("Chyba pri nahrati souboru. ");
        }
    }
}
include "footer.php";
?>

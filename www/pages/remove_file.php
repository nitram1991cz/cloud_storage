<?php
include "header.php";
include "config.php";
?>
<h1> Remove file </h1>
<?php
function error_message($error)
{
    ?>
    <div class='error'><?php echo($error); ?></div>
    <?php
}

$file_id = htmlspecialchars($_GET['file_id']);
$sql = "DELETE FROM files where file_id='$file_id'";
$result = mysqli_query($mysqli, $sql);

$a = $ADRESAR . $file_id;
if (unlink($a) and $result) {
    header("Location: index.php?page=file_list");
} else {
    error_message("Odstraneni souboru se nezdarilo.");
}
?>


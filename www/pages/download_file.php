<?php
include "config.php";
$file_id = htmlspecialchars($_GET['file_id']);
$sql = "SELECT * FROM files where file_id='$file_id'";
$result = mysql_query(/*$mysqli,*/ $sql);
$file = mysql_fetch_assoc($result);

$a = $ADRESAR . $file['file_id'];
if (file_exists($a)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file['file_name']) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    flush();
    readfile($a);
    die();
}
function error_message($error)
{
    ?>
    <div class='error'><?php echo($error); ?></div>
    <?php
}

error_message("Soubor " . basename($file['file_name']) . " nenalezen.");
?>


<?php
?>
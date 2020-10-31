<?php
include "header.php";
include "config.php";
?>
<h1> File list </h1>
<?php
if (!$_SESSION['logged_username']) {
    header("Location: index.php?page=login");
    exit;
}

$files = scandir($ADRESAR);
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM files where user_id='$user_id'";
$result = mysqli_query($mysqli, $sql);
$file_name = mysqli_fetch_assoc($result);
$db_files = mysqli_query($mysqli, $sql);

while ($row = mysqli_fetch_assoc($db_files)) {
            echo $row['file_name'] . PHP_EOL;
            $pripona = pathinfo($row["file_name"], PATHINFO_EXTENSION);
            ?>
            <form action="index.php?page=download_file" method="get">
                <table border="1">
                    <tr>
                        <td>
                            <?php
                            if ($pripona == "jpg" or $pripona == "JPG") {
                                ?>
                                <img src="index.php?page=view_file&file_id=<?php echo(htmlspecialchars($row['file_id'])); ?>"
                                     width="100" height="100">
                                <?php
                            }
                            if ($pripona == "txt") {
                                ?>
                                <pre>
<?php
$soubor = fopen($ADRESAR . (htmlspecialchars($row['file_id'])), "r");
$text = fread($soubor, filesize($ADRESAR . (htmlspecialchars($row['file_id']))));
echo($text);
fclose($soubor);
?>
                                </pre>
                                <?php
                            }
                            ?>

                            <input type="hidden" name="page"
                                   value="download_file">
                            <input type='submit' name='download' value='download'>
                            <input type="hidden" name="file_id"
                                   value="<?php echo(htmlspecialchars($row['file_id'])); ?>"></td>
                </table>
            </form>
            <form action="index.php?page=remove_file" method="get">
                <table border="1">
                    <tr>
                        <td><input type="hidden" name="page"
                                   value="remove_file">
                            <input type='submit' name='remove' value='remove'>
                            <input type="hidden" name="file_id"
                                   value="<?php echo(htmlspecialchars($row['file_id'])); ?>"></td>
                </table>
            </form>
            <?php
}

?>
<?php
include "footer.php";
?>

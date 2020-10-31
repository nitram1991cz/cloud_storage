<?php
include "header.php";
?>
    <h1> Home </h1>
<?php
if ($_SESSION['logged_username']) {
    echo("Prihlasen");
} else {
    echo("neprihlasen");
    header("Location: index.php?page=login");
    exit;
}
?>
    <form action="index.php?page=upload_file" method="post">
        <table border="1">
            <tr>
                <td><input type='submit' name='add_file' value='Add file'></td>
            </tr>
        </table>
    </form>
    <form action="index.php?page=file_list" method="post">
        <table border="1">
            <tr>
                <td><input type='submit' name='file_list' value='File list'></td>
            </tr>
        </table>
    </form>
    <form action="index.php?page=admin" method="post">
        <table border="1">
            <tr>
                <td><input type='submit' name='admin' value='Admin'></td>
            </tr>
        </table>
    </form>

<?php
include "footer.php";
?>
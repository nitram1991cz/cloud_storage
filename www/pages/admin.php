<?php
include "header.php";
?>
<h1> Admin </h1>
<?php

$users = array(array('id' => 1, 'username' => 'Franta', 'password' => 'heslo1', 'storage_limit' => 5),
    array('id' => 2, 'username' => 'Pepa', 'password' => 'heslo2', 'storage_limit' => 7),
    array('id' => 3, 'username' => 'Pavel', 'password' => 'heslo3', 'storage_limit' => 10),
    array('id' => 4, 'username' => 'Ondra', 'password' => 'heslo4', 'storage_limit' => NULL),
    array('id' => 5, 'username' => 'Michal', 'password' => 'heslo5', 'storage_limit' => 3));

/* var_dump($users); */

?>
<table border="1">

    <?php
    foreach ($users as $index) {
        ?>
        <form action="admin.php" method="post">
            <tr>
                <td><input type="text" size="10" name="jmeno"
                           value="<?php echo(htmlspecialchars($index['username'])); ?>"</td>
                <td><input type="text" size="10" name="limit"
                           value="<?php echo(htmlspecialchars($index['storage_limit'])); ?>"</td>
                <input type=submit value=save>
            </tr>
            <input type="hidden" name="cislo" value="<?php echo(htmlspecialchars($index['id'])); ?>">
        </form>
        <?php
    }
    ?>

</table>
<?php
/**echo($_POST["jmeno"]);
 * echo($_POST["limit"]);
 * echo($_POST["cislo"]);**/
include "footer.php";
?>


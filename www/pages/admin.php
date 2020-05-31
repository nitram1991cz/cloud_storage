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
<span style="color: red;">
    <?php
    function validatePasswordLength($password, $min, $max)
    {
        if ($password < $min) {
            echo("Heslo musi mit minimalne 5 znaku");
        }
        if ($password > $max) {
            echo("Heslo musi mit maximalne 20 znaku");
        }
    }

    function validateStorageLimit($storage_limit)
    {
        if (!is_numeric($storage_limit) and $storage_limit != null) {
            echo("Limit muze byt pouze cislo nebo prazdny retezec");
        }
    }

    if (isset($_POST['save'])) {
        validatePasswordLength(strlen($_POST["password"]), 5, 20);
        validateStorageLimit($_POST["storage_limit"]);
    }
    /**    if (isset($_POST["password"])) {
     * if (strlen($_POST["password"]) < 5) {
     * echo("Heslo musi mit minimalne 5 znaku");
     * }
     * if (strlen($_POST["password"]) > 20) {
     * echo("Heslo musi mit maximalne 20 znaku");
     * }
     * if (!is_numeric($_POST["storage_limit"]) and $_POST["storage_limit"] != null) {
     * echo("Limit muze byt pouze cislo nebo prazdny retezec");
     * }
     * }**/

    foreach ($users

    as $index) {

    ?>
</span>
    <form action="admin.php" method="post">
        <tr>
            <td><input type="text" size="10" name="username"
                       value="<?php echo(htmlspecialchars($index['username'])); ?>"</td>
            <td><input type="text" size="10" name="storage_limit"
                       value="<?php echo(htmlspecialchars($index['storage_limit'])); ?>"</td>


            <td><input type="text" size="10" name="password"
                       value="<?php echo(htmlspecialchars($index['password'])); ?>"</td>


            <input type=submit name=save value=save>
        </tr>
        <input type="hidden" name="id" value="<?php echo(htmlspecialchars($index['id'])); ?>">
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



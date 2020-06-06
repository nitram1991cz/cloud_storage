<?php
include "header.php";
?>
<h1> Admin </h1>
<?php

?>
<table border="1">
<span style="color: red;">
    <?php

    function update($position, $value, $id, $mysqli)
    {
        $var = $value;
        if (trim($var) == "" || intval($var) == 0 && gettype($var) != 'string') {
            $var = "NULL";
        } else {
            $var = "'$var'";
        }

        $sql2 = "UPDATE users SET $position=$var WHERE id=$id";

        if (!mysqli_query($mysqli, $sql2)) {
            echo "Error updating record: " . mysqli_error($mysqli);
        }
    }

    function validatePasswordLength($password_length, $min, $max)
    {
        if ($password_length < $min) {
            echo("Heslo musi mit minimalne 5 znaku. ");
            return false;
        }
        if ($password_length > $max) {
            echo("Heslo musi mit maximalne 20 znaku. ");
            return false;
        }
        return true;
    }

    function validateStorageLimit($storage_limit)
    {
        if (!is_numeric($storage_limit) and $storage_limit != "") {
            echo("Limit muze byt pouze cislo nebo prazdny retezec. ");
            return false;
        }
        return true;
    }

    function validateUsername($username)
    {
        if (strlen($username) > 50) {
            echo("Uživatelské jméno může mít maximálně 50 znaků. ");
            return false;
        }
        return true;
    }

    if (isset($_POST['save'])) {

        if (validatePasswordLength(strlen($_POST["password"]), 5, 20) && validateStorageLimit(mysqli_real_escape_string($mysqli, $_POST['storage_limit'])) && validateUsername(mysqli_real_escape_string($mysqli, $_POST["username"]))) {
            update("password", mysqli_real_escape_string($mysqli, $_POST['password']), $_POST['id'], $mysqli);
            update("storage_limit", mysqli_real_escape_string($mysqli, $_POST['storage_limit']), $_POST['id'], $mysqli);
            update("username", mysqli_real_escape_string($mysqli, $_POST['username']), $_POST['id'], $mysqli);
        }
    }

    $sql = "SELECT * FROM users";
    $users = mysqli_query($mysqli, $sql);
    /*   if (!mysqli_query($mysqli,"SET @a:='this will not work'")) {
           echo (mysqli_error($mysqli));
           echo("chyba");
       }*/
    if (mysqli_num_rows($users) > 0) {

    foreach ($users

    as $index) {

    ?>
</span>
    <form action="index.php?page=admin" method="post">
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
    }
    ?>

</table>

<?php

include "footer.php";
?>



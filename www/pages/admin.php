<?php
include "header.php";
?>
    <h1> Admin </h1>
<?php

?>
    <table border="1">
<span style="color: red;">
        <form action="index.php?page=admin" method="post">
        <tr>
            <td><input type="text" size="10" name="username"
                       value=""</td>
            <td><input type="text" size="10" name="storage_limit"
                       value=""</td>
            <td><input type="text" size="10" name="password"
                       value=""</td>
            <input type=submit name=add_user value='Add user'>
        </tr>
        <input type="hidden" name="id" value="">
    </form>
    <?php

    function insert($username, $password, $storage_limit, $mysqli)
    {
        if ($storage_limit == "") {
            $storage_limit = "NULL";
        }
        $sql = "INSERT INTO users (username, password, storage_limit)
            VALUES ('$username', '$password', $storage_limit)";

        if (mysqli_query($mysqli, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
        }
    }

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

    function validatePasswordLength($password, $min, $max)
    {
        if (strlen($password) < $min) {
            echo("Heslo musi mit minimalne 5 znaku. ");
            return false;
        }
        if (strlen($password) > $max) {
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

    function validateUsername($username, $mysqli)
    {
        if (strlen($username) == 0) {
            echo("Uživatelské jméno musí být zadané. ");
            return false;
        }
        if (strlen($username) > 50) {
            echo("Uživatelské jméno může mít maximálně 50 znaků. ");
            return false;
        }

        $sql = "SELECT COUNT(*) FROM users WHERE username='$username' ";
        $result = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        if ($row[0] > 0) {
            echo("Uživatel s touto přezdívkou je již v databázi obsažen.");
            return false;
        }
        return true;
    }

    if (isset($_POST['add_user'])) {

        if (validatePasswordLength($_POST["password"], 5, 20) && validateStorageLimit($_POST['storage_limit']) && validateUsername($_POST["username"], $mysqli)) {

            insert(mysqli_real_escape_string($mysqli, $_POST['username']), mysqli_real_escape_string($mysqli, $_POST['password']), $_POST['storage_limit'], $mysqli);
        }
    }

    if (isset($_POST['save'])) {

        if (validatePasswordLength($_POST["password"], 5, 20) && validateStorageLimit($_POST['storage_limit']) && validateUsername($_POST["username"], $mysqli)) {
            $id = $_POST['id'];
            update("password", mysqli_real_escape_string($mysqli, $_POST['password']), $id, $mysqli);
            update("storage_limit", mysqli_real_escape_string($mysqli, $_POST['storage_limit']), $id, $mysqli);
            update("username", mysqli_real_escape_string($mysqli, $_POST['username']), $id, $mysqli);
        }
    }
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM users WHERE id=$id";

        if (mysqli_query($mysqli, $sql)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($mysqli);
        }

    }

    $sql = "SELECT * FROM users";
    $users = mysqli_query($mysqli, $sql);

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
                <input type=submit name=delete value=delete>
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
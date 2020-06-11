<?php
include "header.php";
?>
    <h1> Admin </h1>
<?php

?>
    <form action="index.php?page=admin" method="post">
        <table border="1">
            <tr>
                <td><input type="text" size="10" name="username"
                           value=""</td>
                <td><input type="text" size="10" name="storage_limit"
                           value=""</td>
                <td><input type="text" size="10" name="password"
                           value=""</td>
                <input type=submit name=add_user value='Add user'>
            </tr>
        </table>
    </form>
    <span style="color: red;">
<?php

function delete($id, $mysqli)
{
    $id = mysqli_real_escape_string($mysqli, $id);
    $sql = "DELETE FROM users WHERE id=$id";

    if (mysqli_query($mysqli, $sql)) {
        echo "Záznam byl úspěšně smazán. ";
    } else {
        echo "Chyba při mazání záznamu: " . mysqli_error($mysqli);
    }
}

function insert($username, $password, $storage_limit, $mysqli)
{
    if ($storage_limit == "") {
        $storage_limit = "NULL";
    }
    $username = mysqli_real_escape_string($mysqli, $username);
    $password = mysqli_real_escape_string($mysqli, $password);
    $storage_limit = mysqli_real_escape_string($mysqli, $storage_limit);

    $sql = "INSERT INTO users (username, password, storage_limit)
            VALUES ('$username', '$password', $storage_limit)";

    if (mysqli_query($mysqli, $sql)) {
        echo "Záznam byl úspěšně vytvořen. ";
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
    $var = mysqli_real_escape_string($mysqli, $var);

    $sql2 = "UPDATE users SET $position=$var WHERE id=$id";

    if (!mysqli_query($mysqli, $sql2)) {
        echo "Chyba při aktualizaci záznamu: " . mysqli_error($mysqli);
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

    $username = mysqli_real_escape_string($mysqli, $username);

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

        insert($_POST['username'], $_POST['password'], $_POST['storage_limit'], $mysqli);
    }
}

if (isset($_POST['save'])) {

    if (validatePasswordLength($_POST["password"], 5, 20) && validateStorageLimit($_POST['storage_limit']) && validateUsername($_POST["username"], $mysqli)) {
        $id = $_POST['id'];
        update("password", $_POST['password'], $id, $mysqli);
        update("storage_limit", $_POST['storage_limit'], $id, $mysqli);
        update("username", $_POST['username'], $id, $mysqli);
    }
}
if (isset($_POST['delete'])) {
    delete($_POST['id'], $mysqli);
}

$sql = "SELECT * FROM users";
$users = mysqli_query($mysqli, $sql);

if (mysqli_num_rows($users) > 0) {

    foreach ($users as $user) {
        ?>
        </span>
        <form action="index.php?page=admin" method="post">
            <table border="1">
                <tr>
                    <td><input type="text" size="10" name="username"
                               value="<?php echo(htmlspecialchars($user['username'])); ?>"</td>
                    <td><input type="text" size="10" name="storage_limit"
                               value="<?php echo(htmlspecialchars($user['storage_limit'])); ?>"</td>
                    <td><input type="text" size="10" name="password"
                               value="<?php echo(htmlspecialchars($user['password'])); ?>"</td>
                    <input type=submit name=save value=save>
                    <input type=submit name=delete value=delete>
                </tr>
                <input type="hidden" name="id" value="<?php echo(htmlspecialchars($user['id'])); ?>">
            </table>
        </form>
        <?php
    }
}
?>


<?php

include "footer.php";
?>
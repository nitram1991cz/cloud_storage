<?php
include "header.php";

if (!$_SESSION['is_logged_user_admin']) {
    header("Location: index.php?page=login");
    exit;
}
echo($status);
include "menu.php";
?>
    <h1> Admin </h1>
    <form action="index.php?page=admin" method="post">
        <table border="1">
            <tr>
                <td><input type="text" size="10" name="username"
                           value=""</td>
                <td><input type="text" size="10" name="storage_limit"
                           value=""</td>
                <td><input type="text" size="10" name="password"
                           value=""</td>
                <td><input type='submit' name='add_user' value='Add user'></td>
            </tr>
        </table>
    </form>

<?php

function error_message($error)
{
    ?>
    <div class='error'><?php echo($error); ?></div>
    <?php
}

function delete($id, $mysqli)
{
    $id = mysql_real_escape_string(/*$mysqli,*/ $id);
    $sql = "DELETE FROM users WHERE id='$id'";

    if (mysql_query(/*$mysqli,*/ $sql)) {
        echo "Záznam byl úspěšně smazán. ";
    } else {
        error_message("Chyba při mazání záznamu: " . mysqli_error($mysqli));
    }
}

function insert($username, $password, $storage_limit, $mysqli)
{
    $storage_limit = intval($storage_limit);    // pozor na bezpečnost
    if (trim($storage_limit) == "" || intval($storage_limit) == 0) {
        $storage_limit = "NULL";
    }
    $username = mysql_real_escape_string(/*$mysqli,*/ $username);
    $password = mysql_real_escape_string(/*$mysqli,*/ $password);
    $sql = "INSERT INTO users (username, password, storage_limit)
            VALUES ('$username', '$password', $storage_limit)";

    if (mysql_query(/*$mysqli,*/ $sql)) {
        echo "Záznam byl úspěšně vytvořen. ";
    } else {
        error_message("Chyba vytvoreni zaznamu: " . $sql . "<br>" . mysql_error($mysqli));
    }
}

function update($column_name, $column_value, $id, $mysqli)
{

    $id = mysql_real_escape_string(/*$mysqli,*/ $id);
    if (trim($column_value) == "" || intval($column_value) == 0 && gettype($column_value) != 'string') {
        $column_value = "NULL";
        $sql = "UPDATE users SET $column_name=$column_value WHERE id='$id'"; // pozor na bezpečnost $column_value
    } else {
        $column_value = mysql_real_escape_string(/*$mysqli,*/ $column_value);
        $sql = "UPDATE users SET $column_name='$column_value' WHERE id='$id'";
    }
    if (!mysql_query(/*$mysqli,*/ $sql)) {
        error_message("Chyba při aktualizaci záznamu: " . mysql_error($mysqli));
    }
}

function validatePasswordLength($password, $min, $max)
{
    if (strlen($password) < $min) {
        error_message("Heslo musi mit minimalne 5 znaku. ");
        return false;
    }
    if (strlen($password) > $max) {
        error_message("Heslo musi mit maximalne 20 znaku. ");
        return false;
    }
    return true;
}

function validateStorageLimit($storage_limit)
{
    if (!is_numeric($storage_limit) and $storage_limit != "") {
        error_message("Limit muze byt pouze cislo nebo prazdny retezec. ");
        return false;
    }
    return true;
}

function validateUsernameUpdate($username, $mysqli, $id)
{
    if (strlen($username) == 0) {
        error_message("Uživatelské jméno musí být zadané. ");
        return false;
    }
    if (strlen($username) > 50) {
        error_message("Uživatelské jméno může mít maximálně 50 znaků. ");
        return false;
    }
    $username = mysql_real_escape_string(/*$mysqli,*/ $username);
    $id = mysql_real_escape_string(/*$mysqli,*/ $id);
    $sql = "SELECT COUNT(*) FROM users WHERE username='$username' AND id<>'$id' ";
    $result = mysql_query(/*$mysqli,*/ $sql);
    $row = mysql_fetch_array($result, MYSQL_NUM);
    if ($row[0] > 0) {
        error_message("Uživatel s touto přezdívkou je již v databázi obsažen.");
        return false;
    }
    return true;
}

function validateNewUsername($username, $mysqli)
{
    if (strlen($username) == 0) {
        error_message("Uživatelské jméno musí být zadané. ");
        return false;
    }
    if (strlen($username) > 50) {
        error_message("Uživatelské jméno může mít maximálně 50 znaků. ");
        return false;
    }
    $username = mysql_real_escape_string(/*$mysqli,*/ $username);
    $sql = "SELECT COUNT(*) FROM users WHERE username='$username' ";
    $result = mysql_query(/*$mysqli,*/ $sql);
    $row = mysql_fetch_array($result, MYSQL_NUM);
    if ($row[0] > 0) {
        error_message("Uživatel s touto přezdívkou je již v databázi obsažen.");
        return false;
    }
    return true;
}

if (isset($_POST['add_user'])) {

    if (validatePasswordLength($_POST['password'], 5, 20) && validateStorageLimit($_POST['storage_limit']) && validateNewUsername($_POST['username'], $mysqli)) {

        insert($_POST['username'], $_POST['password'], $_POST['storage_limit'], $mysqli);
    }
}

if (isset($_POST['save'])) {

    if (validatePasswordLength($_POST["password"], 5, 20) && validateStorageLimit($_POST['storage_limit']) && validateUsernameUpdate($_POST["username"], $mysqli, $_POST["id"])) {
        $id = $_POST['id'];
        update("password", $_POST['password'], $id, $mysqli);
        update("storage_limit", $_POST['storage_limit'], $id, $mysqli);
        $_SESSION['storage_limit']=$_POST['storage_limit'];
        update("username", $_POST['username'], $id, $mysqli);
        $_SESSION["logged_username"]=$_POST["username"];
    }
}
if (isset($_POST['delete'])) {
    delete($_POST['id'], $mysqli);
}

$sql = "SELECT * FROM users";
$result = mysql_query(/*$mysqli,*/ $sql);
//$row = mysql_fetch_array($users);
//var_dump($row);
$rows=mysql_num_rows($result);
if ( $rows> 0) {
   //foreach ($users as $user) {
while($user=mysql_fetch_object($result)){
        ?>
        <form action="index.php?page=admin" method="post">
            <table border="1">
                <tr>
                    <td><input type="text" size="10" name="username"
                               value="<?php echo(htmlspecialchars($user-> username)); ?>"</td>
                    <td><input type="text" size="10" name="storage_limit"
                               value="<?php echo(htmlspecialchars($user-> storage_limit)); ?>"</td>
                    <td><input type="text" size="10" name="password"
                               value="<?php echo(htmlspecialchars($user-> password)); ?>"</td>
                    <td><input type='submit' name='save' value='save'></td>
                    <td><input type='submit' name='delete' value='delete'></td>
                </tr>
                <input type="hidden" name="id" value="<?php echo(htmlspecialchars($user->id)); ?>">
            </table>
        </form>
        <?php
    }
}
?>
<?php
include "footer.php";
?>
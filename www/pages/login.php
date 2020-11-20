<?php
include "header.php";
if (isset($_POST['Login'])) {
    $password = mysql_real_escape_string(/*$mysqli,*/ $_POST["password"]);
    $username = mysql_real_escape_string(/*$mysqli,*/ $_POST["username"]);
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysql_query( $sql);
    if (!$result) {
        die("Connection failed: " . mysql_error());
    }
    $row = mysql_fetch_assoc($result);
    $result = mysql_num_rows($result);
    if ($result == 1) {
        $_SESSION['logged_username'] = $username;
        $_SESSION['id'] = $row['id'];
        $_SESSION['is_logged_user_admin'] = $row['admin'];
        $_SESSION['storage_limit'] = $row['storage_limit'];
        //var_dump($row);
        header("Location: index.php?page=home");
        exit;
    } else {
        echo "Zadal jsi špatný username nebo heslo! ";
    }
}
echo($status);
include "menu.php";
?>
    <h1> Login </h1>

    <form action="index.php?page=login" method="post">
        <table border="1">
            <tr>
                <td><input type="text" size="10" name="username"
                           value="username"</td>
                <td><input type="text" size="10" name="password"
                           value="password"</td>
                <td><input type=submit name='Login' value='Login'></td>
            </tr>
        </table>
    </form>

<?php


include "footer.php";
?>
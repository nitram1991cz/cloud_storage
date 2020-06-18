<?php
include "header.php";


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
if (isset($_POST['Login'])) {
    $password = mysqli_real_escape_string($mysqli, $_POST["password"]);
    $username = mysqli_real_escape_string($mysqli, $_POST["username"]);
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    $result = mysqli_num_rows($result);
    if ($result == 1) {
        $_SESSION['logged_username'] = $username;
        $_SESSION['id'] = $row[0];
        $_SESSION['is_logged_user_admin'] = $row[4];
        //var_dump($row);
        header("Location: index.php?page=home");
        exit;
    } else {
        echo "Zadal jsi špatný username nebo heslo! ";
    }
}

?>

<?php

include "footer.php";
?>
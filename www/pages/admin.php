<?php
include "header.php";
?>
<h1> Admin </h1>
<?php

$users = array( array( 'id'=>1,'username'=>'Franta','password'=>'heslo1','storage_limit'=>5 ),
    array( 'id'=>2,'username'=>'Pepa','password'=>'heslo2','storage_limit'=>7 ),
    array( 'id'=>3,'username'=>'Pavel','password'=>'heslo3','storage_limit'=>10 ),
    array( 'id'=>4,'username'=>'Ondra','password'=>'heslo4','storage_limit'=>NULL ),
    array( 'id'=>5,'username'=>'Michal','password'=>'heslo5','storage_limit'=>3 ) );

/* var_dump($users); */

?>
<table border="1">
    <?php
foreach ( $users as $index ) {
?>
    <tr><td><?php echo( htmlspecialchars( $index[ 'username' ] ) ); ?></td>
    <td><?php echo( htmlspecialchars( $index[ 'storage_limit' ] ) ); ?></td></tr>
    <?php
}
?>
</table>
<?php
include "footer.php";
?>


<?php
include "header.php";
?>
<h1> Admin </h1>
<?php
/*
 * $users = ["user1"=>[id=>1,username=>'Franta',password=>'heslo1',storage_limit=>5],
        "user2"=>[id=>2,username=>'Pepa',password=>'heslo2',storage_limit=>7],
        "user3"=>[id=>3,username=>'Pavel',password=>'heslo3',storage_limit=>10],
        "user4"=>[id=>4,username=>'Ondra',password=>'heslo4',storage_limit=>2],
        "user5"=>[id=>5,username=>'Michal',password=>'heslo5',storage_limit=>3]];
*/
$users = array(array('id'=>1,'username'=>'Franta','password'=>'heslo1','storage_limit'=>intval(5)),
    array('id'=>2,'username'=>'Pepa','password'=>'heslo2','storage_limit'=>intval(7)),
    array('id'=>3,'username'=>'Pavel','password'=>'heslo3','storage_limit'=>intval(10)),
    array('id'=>4,'username'=>'Ondra','password'=>'heslo4','storage_limit'=>intval("")),
    array('id'=>5,'username'=>'Michal','password'=>'heslo5','storage_limit'=>intval(3)));

/*var_dump($users);*/

echo('<table border="1">');
foreach ($users as $index) {
    echo('<tr><td>' . htmlspecialchars($index['username']) . '</td>');
    echo('<td>'. htmlspecialchars($index['storage_limit']) . '</td></tr>');
}
echo('</table>');


include "footer.php";
?>
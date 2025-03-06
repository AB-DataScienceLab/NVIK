<?php
$id = $_REQUEST['id'];
$db_id = "2D_".$_REQUEST['db_id'];
$dir = $_REQUEST['dir'];
//echo"$id";
$file = file("$dir/$id.sdf");
header("Content-type: text");
header("Content-Disposition: attachment; filename=$db_id.sdf");
foreach($file as $file2){
echo $file2;
}
#include 'library/closedb.php';
#exit;
?>

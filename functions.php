<?php
include'con1.php';
//////////////////////////////////// START Search in All Fields..........
function se_all($table,$type,$key){
include'con1.php';
$awhe = "";
$sql = "select * from $table";
$res = mysql_query($sql);
if($type == 'exact'){////////////// For Exact....
for($i=0;$i<mysql_num_fields($res);$i++){
$f_name = mysql_field_name($res,$i);
$awhe = $awhe.$f_name."='$key'"." or ";
}
$awhe_final = preg_replace("/ or $/","",$awhe);
}

else if($type == 'similar'){/////// For Similar.....
for($i=0;$i<mysql_num_fields($res);$i++){
$f_name = mysql_field_name($res,$i);
$awhe = $awhe.$f_name." like '%$key%' "." or ";
}
$awhe_final = preg_replace("/ or $/","",$awhe);
}

return $awhe_final;
}
///////////////////////////////////// END Search in All Fields..........


////////////////////////////////////////// START Display All Fields........
function de_all($table){
include'con1.php';
$bwhe_final = "select * from $table where ";


return $bwhe_final;
}
///////////////////////////////////////// END Display All Fields........



///////////////////////////////////////// START Selected Search.......

function se_selected($search,$type,$key){
include'con1.php';
$awhe = "";
if($type == 'exact'){////////////// For Exact....
foreach($search as $f_name){
$awhe = $awhe.$f_name."='$key'"." or ";
}
$awhe_final = preg_replace("/ or $/","",$awhe);
}
else if($type == 'similar'){/////// For Similar.....
foreach($search as $f_name){
$awhe = $awhe.$f_name." like '%$key%' "." or ";
}
$awhe_final = preg_replace("/ or $/","",$awhe);
}

return $awhe_final;
}
///////////////////////////////////////// END Selected Search.......


//////////////////////////////////////// START Selected Display........
function de_selected($display,$table){
include'con1.php';
$bwhe  = "";
foreach($display as $f_name){
$bwhe = $bwhe.$f_name.",";
}
$bwhe = preg_replace("/,$/","",$bwhe);
$bwhe_final = "select $bwhe from $table where ";
return $bwhe_final;
}
//////////////////////////////////////// END Selected Display........
?>

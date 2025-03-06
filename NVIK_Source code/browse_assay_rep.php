<?php
include'template-nidb_new.php';
include'con1.php';

if(isset($_GET['f'])){
    $fname = $_GET['f'];
}


global $fname;
#$fname = $_GET['f'];
//print $fname;
include'for_browse.php';
print"<center><h2>Browse</h2></center>";
side_bar();
 
#global $all_rec;
#if($fname == 'reporter_assay')

#$all_rec = file("new_rep.txt");
#$rec = count($all_rec);

print"<b><center>Reporter Assay (Unique)= 2 </center></b><br>";
print"<table bordercolor='black' border='3' align='center' id='tableTwo' class='yui'>";
print"<thead><tr><th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>assay_type</b>&nbsp;&nbsp;&nbsp;</a></font></th><th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;</a></font></th></tr></thead>"; 

$result = fopen('new_rep.txt','r');
echo"<tbody>";


$name = preg_replace("/\n$/","","REPORTER ASSAYS");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data_2024` where `assay_type` like '%$name%'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}


$name = preg_replace("/\n$/","","Luc reporter");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data_2024` where `assay_type` like '%$name%'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}


?>

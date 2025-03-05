<?php
include'template-nidb_new.php';
include'con1.php';
#head();
#side();
#include'css.html';
#side();
if(isset($_GET['f'])){
    $fname = $_GET['f'];
}


global $fname;
#$fname = $_GET['f'];
//print $fname;
include'for_browse.php';
print"<center><h2>Browse</h2></center>";


if($fname == 'assay_type')
side_bar();
$all_rec = file("new.txt");
$rec = count($all_rec);

print"<b><center>Assay_Type (Unique) = $rec</center></b><br>";
print"<table bordercolor='black' border='3' align='center' id='tableTwo' class='yui'>";
print"<thead><tr><th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>assay_type</b>&nbsp;&nbsp;&nbsp;</a></font></th><th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;</a></font></th></tr></thead>"; 

$result = fopen('new.txt','r');
echo"<tbody>";


$name = preg_replace("/\n$/","","cytopathic effect assay(CPE)");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '$name'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";

}


$name = preg_replace("/\n$/","","HTS immunolabeling assay");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '$name'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}

$name = preg_replace("/\n$/","","WT virus titer reduction");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '$name'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
#print $name_send."\n";
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}

$name = preg_replace("/\n$/","","REPORTER ASSAYS");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '%$name%'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}

$name = preg_replace("/\n$/","","NiV F protein-based fusion assay");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '%$name%'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}

$name = preg_replace("/\n$/","","HTS assay");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` = '$name'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}

$name = preg_replace("/\n$/","","BSL4 HTS assay");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '%$name%'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}

$name = preg_replace("/\n$/","","CPE reduction assay");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '%$name%'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}

$name = preg_replace("/\n$/","","Dose-response assay");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '%$name%'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
#print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
#print"</td><td>$entries_num</td></tr>";


}

$name = preg_replace("/\n$/","","Luc reporter");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '%$name%'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}

$name = preg_replace("/\n$/","","multicycle pseudotyped virus HTS assay");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '%$name%'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}
$name = preg_replace("/\n$/","","Virus titer reduction assay (VTR)");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '%$name%'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}
$name = preg_replace("/\n$/","","FIPV Replication assay");
$name = ucfirst(addslashes($name));
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '%$name%'");
$entries_num = mysql_num_rows($res);
$name_send = urlencode($name);
if($name_send !== ''){
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";
#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
print"</td><td>$entries_num</td></tr>";
}

























/*
if($fname == 'assay_type')
side_bar();
$all_rec = file("new.txt");
$rec = count($all_rec);

print"&nbsp<center>Assay_Type (Unique) = $rec</center><br>";
print"<table bordercolor='black' border='3' align='center' id='tableTwo' class='yui'>";
print"<thead><tr><th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>assay_type</b>&nbsp;&nbsp;&nbsp;</a></font></th><th align='center' bgcolor='#3E6990'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;</a></font></th></tr></thead>"; 

$result = fopen("new.txt","r");

if(($result = fopen("new.txt","r"))) {
    echo "true";
}
else    echo "false";
$value=$result;
echo"<tbody>";


while(!feof($value)){
//while($row = mysql_fetch_array($result)){

$name = fgets($value);
$name = preg_replace("/\n$/","","$name");
//print"<br>$name";
//$name =(addslashes($name));
//print"<br>$name";
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '%$name%'");
//print"<br>$res";

if ($res>='0') {
    echo "true2";
    $count = array_count_values($name);
}



/*
{
    echo "true2";
    $data = $res->fetch_all(MYSQLI_ASSOC);
    $names = array_column($data, '$name');
    $count = array_count_values($names);
    print_r($count);
}

//$entries_num = mysql_num_rows($res);
//print "<br> $entries_num";

$name_send = urlencode($name);
//print"<br>$name_send = urlencode($name);";
if($name_send !== ''){
#print $name_send."\n";
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";

#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";

//print"</td><td>$entries_num</td></tr>";
print"</td><td>$count</td></tr>";
}
}      
        
 */       
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
/*
if($fname == 'assay_type'){///////////////////////////////////Name////////////////////////////
side_bar();
$all_rec = file("new.txt");
//print "allec=$all_rec";
$rec = count($all_rec);
//print"rec=$rec";
print"&nbsp<center>Assay_Type (Unique) = $rec</center><br>";
print"<table bordercolor='black' border='3' align='center' id='tableTwo' class='yui'>";
print"<thead><tr><th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>assay_type</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='#3E6990'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead>";
#$result = fopen('Target_bacteria_unique.txt','r'); 
$result = fopen('new.txt','r');
//print"<br>result resource id 2=$result";
echo"<tbody>";
while(!feof($result)){
    //print"<br>while(!feof($result))";
$name = fgets($result);
   // print"<br>$name = fgets($result);";
$name = preg_replace("/\n$/","",$name);
   // print"<br>$name = preg_replace($name)";
$name = ucfirst(addslashes($name));
   // print"<br>$name = ucfirst(addslashes($name))";
         //print"<br>name=$name";
        //$res = mysql_query("select 'assay_type' from 'data' where assay_type like '%$name%'");
$res = mysql_query( "select `assay_type` from `data` where `assay_type` like '%$name%'");

//print"<br>$res = mysql_query( select `assay_type` from `data` where `assay_type` like '%$name%')";
//print"<br>resourse id 2 = $res";
//print"<br>res= $res";
//print"select `assay_type` from `data` where `assay_type` like '%$name%'";
$entries_num = mysql_num_rows($res);
//print"<br>$entries_num = mysql_num_rows($res)";
//print $entries_num;
$name_send = urlencode($name);
//print"<br>$name_send = urlencode($name);";
if($name_send !== ''){
#print $name_send."\n";
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";

#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";

print"</td><td>$entries_num</td></tr>";
}

}
*/
print"</tbody>";
 
/* 
print<<<HTML


<tfoot>
            <tr id="pagerTwo">
                <td colspan="25" style="border-right: solid 3px #7f7f7f;">
                        <img src="poly-img/first.png" class="first"/>
                        <img src="poly-img/prev.png" class="prev"/>
                        <input type="text" class="pagedisplay"/>
                        <img src="poly-img/next.png" class="next"/>
                        <img src="poly-img/last.png" class="last"/>
                        <select class="pagesize">
                                <option selected="selected"  value="50">50</option>

                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                                <option value="250">250</option>
                                <option value="300">300</option>
                                <option value="350">350</option>
                                <option value="400">400</option>

                        </select>
                    </td>
            </tr>
        </tfoot>
HTML;
 */
print"</table><br><br>";

if($fname == 'sp'){
$sp = $_GET['sp_name'];
//print $sp."<br>";
side_bar();
#print"<table id='tableTwo' class='yui' border='3' align='center' valign='top'>";
print"<table bordercolor='black' border='3' align='center' id='tableTwo' class='yui'>";
print"<thead><tr><th align='center' bgcolor='#3E6990'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>assay_test</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='#3E6990'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead>";
$result = fopen('new.txt','r');
echo"<tbody>";
while(!feof($result)){
    print"<br>while(!feof($result))";
$name = fgets($result);
$name = preg_replace("/\n$/","",$name);
if(preg_match("/$sp.*/",$name)){
$name = addslashes($name);
$res = mysql_query("select 'assay_type' from data where assay_type like '%$name%'");
$entries_num = mysql_num_rows($res);
print $entries_num ;
$name_send = urlencode($name);
if($name_send !== ''){
#print $name_send."\n";
print"<tr><td><a href='search-nidb.php?assay_type=$name_send&type=assay_type'><b><i>$name</i></b></a>";

#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";

}
print"</td><td>$entries_num</td></tr>";

}

}
print"</tbody>";
/*
print<<<HTML
<tfoot>
            <tr id="pagerTwo">
                <td colspan="25" style="border-right: solid 3px #7f7f7f;">
                        <img src="poly-img/first.png" class="first"/>
                        <img src="poly-img/prev.png" class="prev"/>
                        <input type="text" class="pagedisplay"/>
                        <img src="poly-img/next.png" class="next"/>
                        <img src="poly-img/last.png" class="last"/>
                        <select class="pagesize">
                                <option selected="selected"  value="50">50</option>

                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                                <option value="250">250</option>
                                <option value="300">300</option>
                                <option value="350">350</option>
                                <option value="400">400</option>

                        </select>
                    </td>
            </tr>
        </tfoot>
HTML;
*/
print"</table><br><br>";
}

#footer();
?>

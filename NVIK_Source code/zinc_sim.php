<?php
include'template-nidb_new.php';
#include 'sidemenu.php';
#include'logo_nidb.html';
#include'simple_menu2.html';

#print<<<HTML
#<br><br>
#<center><h1><u><b></b> This page will be available soon</u></center></h1>
#<br><br>
#HTML;


print <<<HTML
	<title>NVIK ZINC Similarity</title>
	<script type="text/javascript">
		function go()
		{
		location=document.forms[0].gowhere.value;
		}
		var timer;
		function scrolltop()
		{
		document.getElementById('scrollmenu').style.top=document.body.scrollTop;
		timer=setTimeout("scrolltop()",1);
		}
		function stoptimer()
		{
		clearTimeout(timer);
		}
	</script>
	<style>
		a.rollover img {
				width: 180px;
				height: 180px;
		}

		a.rollover:hover > img {
				width: 200px;
				height: 200px;
		}
	</style>

	<a name='biophyt_arc'>
	<center>
		<b><h2>Similarity of Prioritised NVIs with ZINC Lead-like compounds<h2>
	</center>
	<br>
HTML;
$all_key = file('top5_zinc_NVIs_priority.csv');
print"<table valign='top' width='50' id='tableTwo' class='yui' border='2' align='center' style='margin-right: 250px';>";

print"<thead><tr><th align='center'  bgcolor='#3E6990'><font color='white' size='3'><b>NVIC_ID</b>&nbsp;&nbsp;&nbsp;</a></font></th><th align='center'  bgcolor='#3E6990'><font color='white' size='3'><b>No of Simililar ZINC lead-like Compounds</b>&nbsp;&nbsp;&nbsp;</a></font></th>
<th align='center' colspan='5' bgcolor='#3E6990'><font color='white' size='3'><b>Top 5 ZINC Lead-like Compounds</b>&nbsp;&nbsp</a></font></th></tr></thead>";

echo"<tbody>";

foreach($all_key as $keywd){
#echo"$keywd<br>";
  $keywd = preg_replace("/\n$/","",$keywd);
  $all = explode('#',$keywd);
  $cls_id = $all[0];
  $comp_no = $all[1];
  $memb_comps = $all[2];
  $all_memb_comps = explode(';',$memb_comps);

  echo"<tr>
	<td valign='top' align='center'><a href='search-nidb.php?NVIC_ID=$cls_id&type=NVIC_ID' title='Click to See Details' target='_blank'><b><i>$cls_id</i></b></a><br><br><a href='search-nidb.php?NVIC_ID=$cls_id&type=NVIC_ID' target='_blank' class='rollover'><img src='store_data/str_images_updated/$cls_id.png' width='180' height='105'></a></td>

	<td align='center'><a href='./data/zinc/$cls_id/SwissSimilarity.pdf' title='Click to See all structure in PDF file' target='_blank'><b><i>$comp_no</i></b></a></td>
	";

  foreach($all_memb_comps as $pub_id){
  #echo"$memb_comp ";
  $zinc_id= explode('<', $pub_id)[0];

  print"<td><a href='http://zinc.docking.org/substances/$zinc_id' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><a href='http://zinc.docking.org/substances/$zinc_id' target='_blank' class='rollover'><img src='./data/zinc/$cls_id/$zinc_id.structure.png' width='180' height='105'></a></td>";

}
echo"</tr>";
}
print"</tbody>";

print"</table><br>";

echo"<center><a href='#top' style='text-decoration: none;'><b>[Top]</b></a></center><br>";
echo"<br>";
include ('footerfix.html');
?>

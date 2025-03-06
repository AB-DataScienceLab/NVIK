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

$excelFilePath = 'data/cf_jarp_30_nvik (1).txt';

print <<<HTML
	<title>NVIK Cluster Visualization</title>
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
				height: 175px;
		}

		a.rollover:hover > img {
				width: 220px;
				height: 215px;
		}
	</style>

	<a name='biophyt_arc'>
	<center>
		<b><h2>Structural diversity of the 142 unique small-molecule NVIs</h2><br></b>
		<a></a>
	</center>
	<br>
	<center>
		<p>Number of non-singleton NVIs cluster = 12 (max cluster size = 4)</p>
		<p>Number of Singleton NVIs = 113</p>
          <p> Average dissimilarity index among NVIs = 0.80</p>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<img src='cluster_visual/cluster-with-ic_ec50-nvik_final.png' 
     width="60%" 
     height="25%" 
     border="0" 
     style="display: block; margin: auto; padding: 5px; border-collapse: collapse;">

	<a name='biophyt_clusters'>


<div style="text-align: center; margin-top: 20px;">
    <a href="$excelFilePath" download>
        <button style="padding: 10px 20px; font-size: 16px; background-color: #3E6990; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Click to Download Clustering Results
        </button>
    </a>
</div>

HTML;
/* <ul>
<li style='color: blue; font-size: 2.4em;'><span style="color:black; font-size: 0.4em;">Active compound (MIC < 200 &micro;g/ml)</span></li>
<li style='color: red; font-size: 2.4em;'><span style="color:black; font-size: 0.4em;">Inactive compound (MIC >= 200 &micro;g/ml)</span></li>
<li style='color: #FFFF00; font-size: 2.4em;'><span style="color:black; font-size: 0.4em;">Compound for which MIC value not given</span></li>
</ul>
  */
$all_key = file('cluster1.txt');
print"<table valign='top' width='50' id='tableTwo' class='yui' border='2' align='center'>";
print"<thead><tr><th align='center'  bgcolor='#3E6990'><font color='white' size='3'><b>Cluster ID</b>&nbsp;&nbsp;&nbsp;</a></font></th><th align='center'  bgcolor='#3E6990'><font color='white' size='3'><b>No. of Compounds</b>&nbsp;&nbsp;&nbsp;</a></font></th>
<th align='center' colspan='5' bgcolor='#3E6990'><font color='white' size='3'><b>Compound IDs</b>&nbsp;&nbsp;&nbsp;</a></font></th></tr></thead>";
echo"<tbody>";



foreach($all_key as $keywd){
#echo"$keywd<br>";
$keywd = preg_replace("/\n$/","",$keywd);
$all = explode('#',$keywd);
$cls_id = $all[0];
$comp_no = $all[1];
$memb_comps = $all[2];
$all_memb_comps = explode(',',$memb_comps);
echo"<tr><td valign='top' align='center' ><b>$cls_id</b></td>
	<td valign='top' align='center'>$comp_no</td>";

foreach($all_memb_comps as $pub_id){
#echo"$memb_comp ";
if($pub_id <= 315){
#$pub_id = preg_replace("/_self_drawn/",'',$pub_id);

#print"<a href='search-nidb.php?pubchem_id=$pub_id&type=pubchem_id' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><a href='' class='rollover'><img src='store_data/str_images/$pub_id.png' width='180' height='105'></a></td><td>";

print"<td><a href='search-nidb.php?NVIC_ID=$pub_id&type=NVIC_ID' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><a href='' class='rollover'><img src='store_data/str_images_updated/$pub_id.png' width='180' height='105'></a></td>";

#print "<tr><td><a href='search-nidb.php? compound_id=$id2 &type=compound_id' target='_blank'>$id2</a></td><td>$name</td><td><a href='' class='rollover'><img src='store_data/str_images/$id2.png'></a></td></tr>";

}
else{
print"<td><a href='search-nidb.php?Pubchem_id=$pub_id&type=Pubchem_id' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><a href='' class='rollover'><img src='http://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?t=l&cid=$pub_id' width='180' height='105'></a></td>";
}
}
echo"</tr>";
}
print"</tbody>";

/*
$all_key = file('cluster.txt');
print"<br><br><table valign='top' width='50' id='tableTwo' class='yui' border='2' align='center'>";
print "<br>";
print"<thead><tr><th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>Cluster ID</b>&nbsp;&nbsp;&nbsp;</a></font></th><th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>No. of Compounds</b>&nbsp;&nbsp;&nbsp;</a></font></th>
<th align='center' colspan='2' bgcolor='#3E6990'><font color='white' size='3'><b>Compound IDs</b>&nbsp;&nbsp;&nbsp;</a></font></th></tr></thead>";
echo"<tbody>";



foreach($all_key as $keywd){
#echo"$keywd<br>";
$keywd = preg_replace("/\n$/","",$keywd);
$all = explode('#',$keywd);
$cls_id = $all[0];
$comp_no = $all[1];
$memb_comps = $all[2];
$all_memb_comps = explode(',',$memb_comps);
echo"<tr><td valign='top' align='center'><b>$cls_id</b></td>
        <td valign='top' align='center'>$comp_no</td>";
foreach($all_memb_comps as $pub_id){
#echo"$memb_comp ";
if($pub_id <= 315){
#$pub_id = preg_replace("/_self_drawn/",'',$pub_id);

#print"<a href='search-nidb.php?pubchem_id=$pub_id&type=pubchem_id' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><a href='' class='rollover'><img src='store_data/str_images/$pub_id.png' width='180' height='105'></a></td><td>";

print"<td><a href='search-nidb.php?compound_id=$pub_id&type=compound_id' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><a href='' class='rollover'><img src='store_data/str_images/$pub_id.png' width='180' height='105'></a></td>";

#print "<tr><td><a href='search-nidb.php? compound_id=$id2 &type=compound_id' target='_blank'>$id2</a></td><td>$name</td><td><a href='' class='rollover'><img src='store_data/str_images/$id2.png'></a></td></tr>";

}
else{
print"<a href='search-nidb.php?pubchem_id=$pub_id&type=pubchem_id' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><a href='' class='rollover'><img src='http://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?t=l&cid=$pub_id' width='180' height='105'></a>";
}
}
echo"</tr>";
}
print"</tbody>";
print"</table><br><br>";
*/



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

#echo"<a href='#top' style='text-decoration: none;'><b>[Top]</b></a><br><br>";
print<<<HTML
<div id="bottom"> 
<a name='biophyt_circos'>
 <b><u><center><center> 
<br>
<!--form><select name='circos_fig' id='gowhere' onchange='go()' style='position: relative'>
<option value=''>--------Sorted On--------</option>
<option value='circos.php?page=mol_wt#bottom' align='center'>Molecular Weight</option>
<option value='circos.php?page=XLogP#bottom' align='center'>XlogP</option>
<option value='circos.php?page=nHBd#bottom' align='center' >Hydrogen Bond Donors (HBD)</option>
<option value='circos.php?page=nHBa#bottom' align='center' >Hydrogen Bond Acceptors (HBA)</option>
<option value='circos.php?page=TopoPSA#bottom' align='center' >Polar Surface Area (PSA)</option>
<option value='circos.php?page=nRotB#bottom' align='center' >No. of Rotatable Bonds</option>
</select></form--><br>
HTML;
$heads = array('mol_wt' => 'Molecular Weight', 'XLogP' => 'XlogP', 'nHBd' => 'Hydrogen Bond Donors (HBD)', 'nHBa' => 'Hydrogen Bond Acceptors (HBA)', 'TopoPSA' => 'Polar Surface Area (PSA)', 'nRotB' => 'No. of Rotatable Bonds');


if(!isset($_GET['page']) || $_GET['page'] == 'mol_wt')
{

global $pre_na;
if(isset($_GET['page'])){

$pre_na = $_GET['page'];
}



if($pre_na == ''){
$pre_na = 'mol_wt';
}
$full_name = $heads[$pre_na];

echo"<h2><u><br><b>Details of 12 non-singleton NVIs cluster </b></u></h2>";

/*echo"<img src='pass image name'  style='width: 50%;padding-right: 100px ; border-collapse:collapse;'>";*/
echo "<p style='text-align: center;'></p>";
}
/*
else if($_GET['page'] == 'XLogP'){
$pre_na = $_GET['page'];
$full_name = $heads[$pre_na];

echo"<h2><u><br><b>Sorted on $full_name</b></u></h2>";
#echo"<u><b>Sorted on $full_name</b></u><br>";
echo"<img src='images/Circos_XlogP.png' padding-right=200px style='padding-right: 200px ; border-collapse:collapse;'>";
}
else if($_GET['page'] == 'nHBd'){
$pre_na = $_GET['page'];
$full_name = $heads[$pre_na];

echo"<h2><u><br><b>Sorted on $full_name</b></u></h2>";
#echo"<u><b>Sorted on $full_name</b></u><br>";
echo"<img width='1200' height='700' src='images/Circos_hbd.png' border=0px; style='border-collapse:collapse;'>";
}
else if($_GET['page'] == 'nHBa'){
$pre_na = $_GET['page'];
$full_name = $heads[$pre_na];


echo"<h2><u><br><b>Sorted on $full_name</b></u></h2>";
#echo"<u><b>Sorted on $full_name</b></u><br>";
echo"<img width='1200' height='700' src='images/Circos_hba.png' border=0px; style='border-collapse:collapse;'>";
}
else if($_GET['page'] == 'TopoPSA'){
$pre_na = $_GET['page'];
$full_name = $heads[$pre_na];


echo"<h2><u><br><b>Sorted on $full_name</b></u></h2>";
#echo"<u><b>Sorted on $full_name</b></u><br>";
echo"<img width='1200' height='700' src='images/Circos_topopsa.png' border=0px; style='border-collapse:collapse;'>";
}
else if($_GET['page'] == 'nRotB'){
$pre_na = $_GET['page'];
$full_name = $heads[$pre_na];


echo"<h2><u><br><b>Sorted on $full_name</b></u></h2>";
#echo"<u><b>Sorted on $full_name</b></u><br>";
echo"<img width='1200' height='700' src='images/Circos_rotb.png' border=0px; style='border-collapse:collapse;'>";
}
*/
echo"<center><a href='#top' style='text-decoration: none;'><b>[Top]</b></a></center><br>";
echo"<br>";

 


?>


<?php
include'template-nidb_new.php';
include'con1.php';
#head();
#include'css.html';
#side();
//print $fname;

echo "<title>NVIK Browse</title>";
print"<div style=\"height: auto; right: 200px;\">";
print"<center><h2>Browse</h2></center>";
$res_all_biophytmol = mysql_query("select * from data_2024");
include'for_browse.php';
global $fname;
side_bar();
/*
print"<table class='yui' align='center' valign='top' border='2' bgcolor='pink'>";
print"<thead>";
print"<tr><td><font color='green'><b>Browse By</b></font></td></tr>";
for($i=0;$i<mysql_num_fields($res_all_biophytmol);$i++){
$f_name = mysql_field_name($res_all_biophytmol, $i);
#print $f_name."<br>";
if($f_name == 'plant_name' || $f_name == 'plant_family' || $f_name == 'origin' || $f_name == 'com_name' || $f_name == 'part_used' || $f_name == 'extract' || $f_name == 'target_bacteria' || $f_name == 'assay_test' || $f_name == 'inhibition' || $f_name == 'ethno_med_info' || $f_name == 'chem_class' || $f_name == 'active_comp_identified'){
$fname_full = array('plant_name' => 'Plant Source', 'plant_family' => 'Source Family', 'origin' => 'Origin', 'com_name' => 'Common Name', 'part_used' => 'Plant Part Used', 'extract' => 'Extract [%]', 'target_bacteria' => 'Target Bacteria', 'assay_test' => 'Assay / Test Done', 'inhibition' => 'Inhibition [%]', 'ethno_med_info' => 'Ethnomedicinal Information', 'source_class' => 'Classification [Source Based]', 'chem_class' => 'Chemical Classification [Active Compound]', 'active_comp_identified' => 'Active Compound Identified');
$name_dis = $fname_full[$f_name];
if($f_name == 'plant_name'){
print"<tr><td><b><a href='browse_plant.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
}
else if($f_name == 'plant_family'){
print"<tr><td><b><a href='browse_family.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
}
else if($f_name == 'com_name'){
#print"<tr><td><b><a href='browse_com_name.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
}
else if($f_name == 'part_used'){
print"<tr><td><b><a href='browse_part.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
}
else if($f_name == 'extract'){
print"<tr><td><b><a href='browse_extract.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
}
else if($f_name == 'target_bacteria'){
print"<tr><td><b><a href='browse_target.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
}
else if($f_name == 'origin'){
print"<tr><td><b><a href='browse_origin.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
}
else{
print"<tr><td><b><a href='?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
}

}
}
print"</thead>";
print"</table>";
*/
if(!isset($_GET['f'])){
print"<table valign='top'>";
#print"<tr><td align='center'><font size='4'>This is Dummy image (Final Image will be clickable)</font></td></tr>";
#print"<tr><td><img src='images/pie-chart.jpg' width='550'></td></tr>";
#print"<tr><td align='center'><font size='4'><b>Figure:</b><u> Plant family-wise distribution of plants having antimycobacterial properties</u></font></td></tr>";
#print"<tr><td><img width='875' height='500' src='images/family-wise1.jpg'  border=1px; style='border-collapse:collapse;'></td></tr>";
#print"<tr><td align='center'><font size='4'><b>Figure:</b><u> Tag cloud of NVI's Inhibitors</u></font></td></tr>";
#print"<tr><td><img width='850' height='500' src='images/wordle.png'  border=1px; style='border-collapse:collapse;'></td></tr>";
print"</table>";
}

else if(isset($_GET['f'])){
$fname = $_GET['f'];
if($fname == 'assey_test'||$fname == 'inhibition'){
$result = mysql_query("select distinct($fname) from data_2024 order by $fname");
$entries_num = mysql_num_rows($result);
}

/*else if($fname == 'active_comp_identified'){
$result = mysql_query("select distinct(activity) from data_2024 where $fname !='' and $fname !='NR%' and $fname !='NR' and $fname !='NA' and $fname !='N/A' order by activity");
$res_no = mysql_num_rows($result);
#print"<center>Active Compound Identified (Unique) = $res_no</center>";
}*/
else if($fname == 'Inhibitor_name' && $_GET['tp'] == 'ky'){
$all_key = file('plant_genus_species_unique');
print"<br><br><table valign='top' width='70' id='tableTwo' class='yui' border='3' align='center'>";
print"<thead><tr><th align='center' bgcolor='#3E6990'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>plant_genus_species_unique (Keyword)</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='#3E6990'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead>";
echo"<tbody>";
foreach($all_key as $keywd){
#echo"$keywd<br>";
$keywd = preg_replace("/\n$/","",$keywd);
$result = mysql_query("select distinct(chem_class) from data_2024 where $fname like '%$keywd%'");
$result_1 = mysql_query("select chem_class from data_2024 where $fname like '%$keywd%'");
$res_no = mysql_num_rows($result_1);
echo"<tr><td><a href='search-nidb.php?$fname=$keywd&type=$fname' style='text-decoration:none;'><b>$keywd</b></a></td><td>$res_no</td></tr>";
}
print"</tbody>";
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
print"</table><br><br>";
#print"<center>Active Compound Identified (Unique) = $res_no</center>";
#footer();
exit;
}
else{
$result = mysql_query("select distinct($fname) from data_2024 where $fname !='' and $fname !='NR%' and $fname !='NR' and $fname !='NA' and $fname !='N/A' and $fname is not null order by $fname");
$res_no = mysql_num_rows($result);
#print"<center>Active Compound Identified (Unique) = $res_no</center>";
}
#$fname_full = array('plant_name' => 'Plant Source', 'plant_family' => 'Source Family', 'origin' => 'Origin', 'com_name' => 'Common Name', 'part_used' => 'Plant Part Used', 'extract' => 'Extract [%]', 'target_bacteria' => 'Target Bacteria', 'assay_test' => 'Assay / Test Done', 'inhibition' => 'Inhibition [%]', 'ethno_med_info' => 'Ethnomedicinal Information', 'source_class' => 'Classification [Source Based]', 'chem_class' => 'Chemical Classification [Active Compound]', 'active_comp_identified' => 'Active Compound Identified');
$fname_full = array('compound_id' => 'Compound ID','compound_image' => 'Compound Structure','plant_name' => 'Inhibitor','plant_family' => 'IC50 (in nM)','origin' => 'Origin','com_name' => 'Common Name','part_used' => 'Drug Bank ID','chemspider' => 'ChemSpider ID','target_bacteria' => 'Target','assay_test'=>'Assay Type','pos_control' => 'Assay Description','source' => 'Assay Source','activity' => 'Outcome','inhibition' => 'EC50 (in nM)','inhibition_zone' => 'Activity (Zone of inhibition in mm)','extract' => 'Cell Type','pubchem_id' => 'PubChem ID','ethno_med_info' => 'Ethnomedicinal Information','pubmed_source_lit' => 'PubMed ID [Source Literature]','ext_pre' => 'Extract Preparation','source_class' => 'Classification [Source Based]','chem_class' => 'Chemical Classification [Active Compound]','tar_pro' => 'Target Protein','media_antimicro_test' => 'Media / Broth Used [Antimicrobial Assay/Test]','conc_pos_control' => 'Active Concentration [Positive Control]','cyto_assay' => 'Cytotoxicity Assay [AID]','cyto_conc_ext' => 'Cytotoxic Concentration of Extract / Active Compound [&micro;g/ml]','ref' => 'Reference(s)','ref2' => 'Reference 2','ref3' => 'Curator', 'date' => 'Date', 'mol_wt' => 'Molecular Weight', 'xlog_p' => 'XLogP', 'tpsa' => 'PSA', 'hb_d' => 'H-bond Donor', 'hb_a' => 'H-bond Acceptor', 'n_rot_bond' => 'No. of Rotatable Bond Count', 'n_ring' => 'No. of Rings', 'n_nitro' => 'No. of N', 'n_O' => 'No. of O', 'n_S' => 'No. of S', 'mol_formula' => 'Molecular Formula', 'smiles' => 'SMILES');
$name_dis = $fname_full[$fname];
print"<br><br><table valign='top' width='70' id='tableTwo' class='yui' border='3' align='center'>";
#if($fname == 'inhibition'){
#print"<thead><tr><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>$name_dis</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'<th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead>";
#}
/*else if($fname == 'active_comp_identified'){
print"<thead><tr><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>$name_dis</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>Activity (MIC) &micro;g/ml&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><!--th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th--></tr></thead>";
}*/
/*else{
print"<thead><tr><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>$name_dis</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead>";
}*/

echo"<tbody>";
while($row = mysql_fetch_array($result)){
$carb_class = $row[$fname];
$carb_class = addslashes($carb_class);
#$mic = $row['assay_test'];
#$mic_ori1 = $mic;
#echo"$mic<br>";
#$carb_class = stripslashes($carb_class);
$res = "";
if($fname == 'Inhibitor'){
$res = mysql_query("select distinct(Inhibitor) from data_2024 where activity='$mic'") or die(mysql_error());
#echo"$mic ##### $entries_num<br>";
}
else{
$res = mysql_query("select * from amphydb where $fname='$carb_class'");
$pos_con = mysql_fetch_array($res);
$entries_num = mysql_num_rows($res);
$carb_class = stripslashes($carb_class);
#$pos_cont = $pos_con['pos_control'];
}
#$carb_class = ucfirst(strtolower($carb_class));
#$carb_class = ucfirst($carb_class);
if($carb_class != '' || $fname == 'Inhibitor'){
$carb_class_send = urlencode($carb_class);
if($fname == 'Inhibitor'){
#if(preg_match("/\(.*\)/", $carb_class)){
#$pos_cont = urlencode($pos_cont);
#echo"$pos_cont<br>";
if($pos_cont !== ''){
print"<tr><td><a href='search-nidb.php?$fname=$carb_class_send&type=$fname' style='text-decoration:none;'><b>$carb_class</b></a></td><td>$pos_cont</td><td>$entries_num</td></tr>";
}

}
else if($fname == 'Inhibitor'){
#echo"$mic ##### $entries_num<br>";
while($mic_con=mysql_fetch_array($res)){
$carb_class = $mic_con['Inhibitor'];
if($_GET['tp'] == 'def'){
$mic_ori = preg_replace("/\&micro;g\/ml/","",$mic);
$mic = trim($mic_ori);
}
$carb_class_send = urlencode($carb_class);
if(!(preg_match("/(\s|NR|-|>|<|=)+/",$mic)) && $_GET['tp'] == 'def'){
if($mic != '' && $carb_class != ''){
$carb_class = addslashes($carb_class);
$mic_send = urlencode($mic);
$carb_class_send = urlencode($carb_class);
#$sql = "select * from amphydb where activity='$mic_ori1' and active_comp_identified='$carb_class'";
#echo"$sql<br>";
$res4_mic = mysql_query("select * from data_2024 where activity='$mic_ori1' and active_comp_identified='$carb_class'") or die(mysql_error());
$comp_id_all = "";
while($res4_mic1=mysql_fetch_array($res4_mic)){
#echo $res4_mic1[0]."$sql<br>";
$comp_id = $res4_mic1[0];
$comp_id_all = $comp_id_all.",".$comp_id;
}
#$ent_num = mysql_num_rows($res4_mic1);
$comp_id_all = preg_replace("/^\,/","",$comp_id_all);
print"<tr><td><a href='search-nidb.php?$fname=$carb_class_send&type=$fname&mic=$mic_ori1&com=$comp_id_all' style='text-decoration:none;'><b>$carb_class</b></a></td><td>$mic</td><!--td>$ent_num</td--></tr>";
#print"<tr><td><a href='search-biophytmol.php?$fname=$carb_class_send&type=$fname&mic=$mic_ori1' style='text-decoration:none;'><b>$carb_class</b></a></td><td>$mic</td><!--td>$ent_num</td--></tr>";
}
}
else if(preg_match("/(plusmn|Ã‚Â± |\+|-|NR|-|>|<|=)+/",$mic) && $_GET['tp'] == 'vari'){
if($mic != '' && $carb_class != '' && $carb_class != 'NR' && $carb_class != 'N/A'){
$carb_class = addslashes($carb_class);
$carb_class_send = urlencode($carb_class);
$mic_send = urlencode($mic);
$res4_mic = mysql_query("select * from amphydb where activity='$mic_ori1' and active_comp_identified='$carb_class'") or die(mysql_error());
$comp_id_all = "";
while($res4_mic1=mysql_fetch_array($res4_mic)){
#echo $res4_mic1['compound_id']."<br>";
$comp_id = $res4_mic1[0];
$comp_id_all = $comp_id_all.",".$comp_id;
}
$comp_id_all = preg_replace("/^\,/","",$comp_id_all);
#$res4_mic1 = mysql_fetch_array($res4_mic);
#$ent_num = mysql_num_rows($res4_mic1);
print"<tr><td><a href='search-nidb.php?$fname=$carb_class_send&type=$fname&mic=$mic_ori1&com=$comp_id_all' style='text-decoration:none;'><b>$carb_class</b></a></td><td>$mic</td><!--td>$ent_num</td--></tr>";
#print"<tr><td><a href='search-biophytmol.php?$fname=$carb_class_send&type=$fname&mic=$mic_ori1' style='text-decoration:none;'><b>$carb_class</b></a></td><td>$mic</td><!--td>$ent_num</td--></tr>";
}
}

}
}
#}
else{
#echo"$carb_class_send<br>";
if(!preg_match("/^\%0D/",$carb_class_send)){
print"<tr><td><a href='search-nidb.php?$fname=$carb_class_send&type=$fname' style='text-decoration:none;'><b>$carb_class</b></a></td><td>$entries_num</td></tr>";
}
}
}
}
echo"</tbody>";
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
print"</table><br><br>";
print"</div>";
}
if($fname == 'name' && (!isset($_GET['type']))){///////////////////////////////////Name////////////////////////////
#include'selected.php';
print"<br><br>";
print"<table id='tableTwo' class='yui' border='3' align='center'>";
print"<thead><tr><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>Antigenic Carbohydrate</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='#006699'><font color='white' size='3'><b><a href='#' title='Click Header to Sort'>No. of Entries</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead>";
if(isset($_GET['op'])){
$result = mysql_query("select distinct(name) from data_2024 where name like '".$_GET['op']."%'");
}
else{
$result = mysql_query("select distinct(name) from data_2024 order by name");
}
print"<tbody>";
while($row = mysql_fetch_array($result)){
$name = $row['name'];
//print $name."<br>";
$name = addslashes($name);
$entries = mysql_query("select * from data_2024 where name like '$name'") or die(mysql_error());
$entries_num = mysql_num_rows($entries);
$name = stripslashes($name);
$name_send = urlencode($name);
if(preg_match("/\n/","$name")){
$name = 'N/A';
}
print"<tr><td><a href='search-nidb.php?name=$name_send'><b>$name</b></a></td><td>$entries_num</td></tr>";
}
print"</tbody>";
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
print"</table><br><br>";
}
else if($fname == 'microbe'){///////////////////////////////////Name////////////////////////////
$mic = $_GET['microbe'];
print"<table id='tableTwo' border='3' class='yui' align='center'>";

print"<thead><tr><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>Microbe (Genus Species Strain)</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead>";
$result = mysql_query("select distinct(microbe) from amphydb where microbe like '%$mic%' order by microbe");
echo"<tbody>";
while($row = mysql_fetch_array($result)){
$name = $row['microbe'];
//print $name."<br>";
$name = addslashes($name);
$entries = mysql_query("select * from amphydb where microbe like '$name'") or die(mysql_error());
$entries_num = mysql_num_rows($entries);
$name = stripslashes($name);
$name_send = urlencode($name);
if(preg_match("/\n/","$name")){
$name = 'N/A';
}
print"<tr><td><a href='adquery.php?microbe=$name_send'><b><i>$name</i></b></a></td><td>$entries_num</td></tr>";
}
print"</tbody>";
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

print"</table><br><br>";
}
else if($fname == 'antigenic_nature'){///////////////////////////////////Name////////////////////////////
print"<table bordercolor='black' bgcolor='#B4CFEC' border='3' align='center'>";
print"<tr><td align='center' bgcolor='#006699'><font color='white' size='3'><b>Antigenic Nature</b></font></td><td align='center' bgcolor='#006699'><font color='white' size='3'><b>No. of Entries</b></font></td></tr>";
$result = mysql_query("select distinct(antigenic_nature) from amphydb order by antigenic_nature");
while($row = mysql_fetch_array($result)){
$name = $row['antigenic_nature'];
//print $name."<br>";
$name = addslashes($name);
$entries = mysql_query("select * from amphydb where antigenic_nature like '$name'") or die(mysql_error());
$entries_num = mysql_num_rows($entries);
$name = stripslashes($name);
$name_send = urlencode($name);
if(preg_match("/\n/","$name")){
$name = 'N/A';
}
print"<tr><td><a href='adquery.php?antigenic_nature=$name_send'><b>$name</b></a></td><td>$entries_num</td></tr>";
}
print"</table><br><br>";
}
else if($fname == 'carrier_name'){///////////////////////////////////Name////////////////////////////
print"<table align='center' id='tableTwo' border='3' class='yui'>";
print"<thead><tr><th align='center' bgcolor='#006699' class='tableHeader'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>Carrier Name</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead>";
$result = mysql_query("select distinct(carrier_name) from amphydb order by carrier_name");
echo"<tbody>";
while($row = mysql_fetch_array($result)){
$name = $row['carrier_name'];
//print $name."<br>";
//$name = addslashes($name);
$entries = mysql_query("select * from amphydb where carrier_name like '$name'") or die(mysql_error());
$entries_num = mysql_num_rows($entries);
$name = stripslashes($name);
$name_send = urlencode($name);
if(preg_match("/\n/","$name")){
$name = 'N/A';
}
print"<tr><td><a href='search-biophytmol.php?carrier_name=$name_send'><b>$name</b></a>";
if($name !== 'N/A' && $name !== 'nil' && $name !== 'Pseudomonas aeruginosa exoprotein A (rEPA), tetanus toxoid'){
print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
}
print"</td><td>$entries_num</td></tr>";
}
print"</tbody>";
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
print"</table><br><br>";
}
else if($fname == 'antibodies'){///////////////////////////////////Name////////////////////////////
print"<table id='tableTwo' class='yui' border='3' align='center'>";
print"<thead><tr><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>Antibodies</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='#006699'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>No. of Entries</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead>";
$result = mysql_query("select distinct(antibodies) from amphydb order by antibodies");
echo"<tbody>";
while($row = mysql_fetch_array($result)){
$name = $row['antibodies'];
//print $name."<br>";
$name = addslashes($name);
$entries = mysql_query("select * from amphydb where antibodies like '$name'") or die(mysql_error());
$entries_num = mysql_num_rows($entries);
$name = stripslashes($name);
$name_send = urlencode($name);
if(preg_match("/\n/","$name")){
$name = 'N/A';
}
print"<tr><td><a href='adquery.php?antibodies=$name_send'><b>$name</b></a></td><td>$entries_num</td></tr>";
}
print"</tbody>";
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
print"</table><br><br>";
}
else if($fname == 'antib_type_class'){///////////////////////////////////Name////////////////////////////
print"<table bordercolor='black' bgcolor='#B4CFEC' border='3' align='center'>";
print"<tr><td align='center' bgcolor='#006699'><font color='white' size='3'><b>Antibody Type & Class</b></font></td><td align='center' bgcolor='#006699'><font color='white' size='3'><b>No. of Entries</b></font></td></tr>";
$result = mysql_query("select distinct(antib_type_class) from amphydb order by antib_type_class");
while($row = mysql_fetch_array($result)){
$name = $row['antib_type_class'];
//print $name."<br>";
$name = addslashes($name);
$entries = mysql_query("select * from amphydb where antib_type_class like '$name'") or die(mysql_error());
$entries_num = mysql_num_rows($entries);
$name = stripslashes($name);
$name_send = urlencode($name);
if(preg_match("/\n/","$name")){
$name = 'N/A';
}
print"<tr><td><a href='search-biophytmol.php?antib_type_class=$name_send'><b>$name</b></a>";
if($name == 'IgA' || $name == 'IgD' || $name == 'IgG' || $name == 'IgM'){
print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";
}
print"</td><td>$entries_num</td></tr>";
}
print"</tbody>";
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
print"</table><br><br>";
}
else if($fname == 'assay_system'){///////////////////////////////////Name////////////////////////////
print"<table bordercolor='black' bgcolor='#B4CFEC' border='3' align='center'>";
print"<tr><td align='center' bgcolor='#006699'><font color='white' size='3'><b>Assay System</b></font></td><td align='center' bgcolor='#006699'><font color='white' size='3'><b>No. of Entries</b></font></td></tr>";
$result = mysql_query("select distinct(assay_system) from amphydb order by assay_system");
while($row = mysql_fetch_array($result)){
$name = $row['assay_system'];
//print $name."<br>";
$name = addslashes($name);
$entries = mysql_query("select * from amphydb where assay_system like '$name'") or die(mysql_error());
$entries_num = mysql_num_rows($entries);
$name = stripslashes($name);
$name_send = urlencode($name);
if(preg_match("/\n/","$name")){
$name = 'N/A';
}
print"<tr><td><a href='adquery.php?assay_system=$name_send'><b>$name</b></a></td><td>$entries_num</td></tr>";
}
print"</table><br><br>";
}

#print"<center><img src='images/pie-fine-tuned.jpg' width='40%' height='45%'></center><br><br>";
#print"<center><u>Fig: Showing distribution of data_2024 in various carbohydrate classes</u></center><br><br>";

#footer();
 

?>

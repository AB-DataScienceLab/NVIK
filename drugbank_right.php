<?php
session_start();
include'logo_nidb.html';
include'simple_menu2.html';
#include"template-nidb_new.php";
#head();
#side();
#include'authentication.php';
#include'css.html';
print<<<HTML
<style>
a.rollover img {
        width: 180px;
        height: 175px;
}

a.rollover:hover > img {
        width: 380px;
        height: 440px;
}
</style>
HTML;
include"con1.php";
$selection=$_POST['select11'];
#print "slection=$selection";
#$ui = $_POST['struct_file'];
$headers = array('compound_id' => 'Compound ID','compound_image' => 'Compound Structure','plant_name' => 'Plant Source','plant_family' => 'Source Family','origin' => 'Origin','com_name' => 'Common Name','part_used' => 'Plant Part Used','extract' => 'Extract','target_bacteria' => 'Target Bacteria','assay_test' => 'Assay / Test Done','pos_control' => '+Ve Control Used (conc.)','inhibition' => 'Inhibition [%]','activity' => 'Activity [MIC] &micro;g/ml','activity_in_dilutn' => 'Activity (In terms of dilution)','inhibition_zone' => 'Activity (Zone of inhibition in mm)','active_comp_identified' => 'Active Compound Identified','pubchem_id' => 'PubChem ID','ethno_med_info' => 'Ethnomedicinal Information','pubmed_source_lit' => 'PubMed ID [Source Literature]','ext_pre' => 'Extract Preparation','source_class' => 'Classification [Source Based]','chem_class' => 'Chemical Classification [Active Compound]','tar_pro' => 'Target Protein','media_antimicro_test' => 'Media / Broth Used [Antimicrobial Assay/Test]','conc_pos_control' => 'Active Concentration [+Ve Control]','cyto_assay' => 'Cytotoxicity Assay [AID]','cyto_conc_ext' => 'Cytotoxic Concentration of Extract / Active Compound [&micro;g/ml]','ref1' => 'Reference 1','ref2' => 'Reference 2','ref3' => 'Reference 3', 'date' => 'Date');
######################
#####  ITS FUNCTIONAL
######################

if(isset($_POST['smi'])){
echo'<div style="height: auto; width: 950px;">';
//print "str_file =$str_file";
if($_POST['smi'] == '' && $_FILES['str_file']['tmp_name'] == '' && $_POST['smil'] == ''){
print"<br><br><br><br><br><br><br><br><center><h3><font color='brown' align = 'center'>Please Draw Structure (using JME editor) / Paste SMILES / Upload Structure File (SDF/MOL/MOL2) only then you can use Structure Search facility of BioPhytMol database</font></h3></center>";
print"<center><input type='button' onClick='history.go(-1)' value='Go Back'></center>";
//print "_file=$_FILES";
}
else{
if(!empty($_POST['smi'])){
$line = $_POST['smi'];
$mol_type = $_POST['mol_type'];
}
else if(!empty($_POST['smil'])){
$line = $_POST['smil'];
$mol_type = $_POST['mol_type'];
}
if(isset($_POST['str_file'])){
if($_POST['str_file']['tmp_name'] !== ''){
     
    
#shell_exec("find ./store_data/ -ctime +7 -exec rm -Rf {} \;");
//print $_FILES['str_file']['tmp_name']."<br>";
#print $_FILES['str_file']['name'];
$tmpName = $_FILES['str_file']['tmp_name'];
$oriName = $_FILES['str_file']['name'];
$rand = rand(5, 150000000);
$sm_file = "str-"."$rand";
mkdir("./store_data/$sm_file");
$sdffileName = $_POST['str_file'];
//print"<br>sdf=$sdffileName";
print "<br>tmpName= $tmpName";
print "<br>oriName= $oriName";
//print "str_file= $str_";
$fp = fopen("$tmpName", 'r');
//print"fp=$fp";
$sdf_content = fread($fp, filesize($tmpName));
//print"sdf=$sdf_content";
$fp_r = fopen("store_data/$sm_file/$oriName", 'w');
fwrite($fp_r,"$sdf_content");
fclose($fp_r);
fclose($fp);
$line = "./store_data/$sm_file/$oriName";
$mol_type = $_POST['mol_type'];
}
}

//print $line;
//print $selection;
//exec("/usr1/webserver/cgidocs/raghava/hmrbase/ChemAxon/JChem/bin/jcsearch -q \"$line\" $selection ChemAxon/JChem/bin/smile.txt",$res);
if (isset($_POST['$mol_type'])){
if($mol_type == 'biophytmol_drugs'){
#$file2use = 'All_BioPhytMol_SMILES_531_classified_used.txt';
$file2use = '633_reloaded_2_smiles_used.smiles';
}
else if($mol_type == 'all_drugs'){
$file2use = 'drugbank-all-drugs-smiles';
}
else if($mol_type == 'anti_tb_drugs'){
$file2use = 'known_antiTB_drugs_list_final';
}
else if($mol_type == 'experimental_drugs'){
$file2use = 'DrugBank-Experimental-SMILES';
}
else if($mol_type == 'approved_drugs'){
$file2use = 'DrugBank-Approved-Drugs-SMILES';
}
else if($mol_type == 'withdrawn_drugs'){
$file2use = 'DrugBank-Withdrawn-SMILES';
}
else if($mol_type == 'nutraceutical_drugs'){
$file2use = 'DrugBank-Nutraceutical-SMILES';
}
else if($mol_type == 'illicit_drugs'){
$file2use = 'DrugBank-Illicit-SMILES';
}
}
//print "<br>str_file=";
if(isset($_POST['str_file'])){
if($_POST['str_file']['tmp_name'] !== ''){
#exec("/usr1/webserver/ChemAxon/JChem/bin/jcsearch -q $line -f cssdf $selection $file2use |grep 'OSDD'",$res);
    print "Control came here";
 shell_exec("/home/users/nipa/cgidocs/one.sh");
//$res = shell_exec("/home/users/nipa/cgidocs/jc.sh $line $selection $file2use >> /tmp/test");
//exec("C:\xampp\htdocs\Nidb\var\www\Nidb\ChemAxon\JChem\bin\jcsearch -q $line -f cssdf $selection $file2use |grep 'OSDD'",$res);
}
else{
 shell_exec("/home/users/nipa/cgidocs/one.sh");
#exec("/usr1/webserver/ChemAxon/JChem/bin/jcsearch -q \"$line\" -f cssdf $selection $file2use |grep 'OSDD'",$res);
//exec("C:\xampp\htdocs\Nidb\var\www\Nidb\ChemAxon\JChem\bin\jcsearch -q \"$line\" -f cssdf $selection $file2use |grep 'OSDD'",$res);
}
}
$count=(sizeof($res));
print"res=$res";
print "<br><center><b>Total Molecules Found: ".$count."</b></center><br>";
print"<center><input type='button' onClick='history.go(-1)' value='Go Back'></center>";
if($count == 0){
$title = array('-t:s' => 'Substructure Search Results', '-t:e' => 'Exact Search Results', '-t:u' => 'Superstructure Search Results', '-t:p' => 'Perfect Search Results', '-t:i:60' => 'Search Results');
echo"<br><br><center><h3><font color='green'><b>[ $title[$selection] ]</b></font></h3></center><br>";
print"<br><br><center><h2><font color='brown'>No similar structure found in Database !!!</font></h2></center>";
print"<center><input type='button' onClick='history.go(-1)' value='Go Back'></center>";
}
else{
//print $count;
$title = array('-t:s' => 'Substructure Search Results', '-t:e' => 'Exact Search Results', '-t:u' => 'Superstructure Search Results', '-t:p' => 'Perfect Search Results', '-t:i' => 'Search Search Results');
$DrugBank_Molecule_Class = array('all_drugs' => 'Structures in DrugBank (All Drugs)', 'approved_drugs' => 'Structures in DrugBank (Approved Drugs)', 'experimental_drugs' => 'Structures in DrugBank (Experimental Drugs)', 'withdrawn_drugs' => 'Structures in DrugBank (Withdrawn Drugs)', 'nutraceutical_drugs' => 'Structures in DrugBank (Nutraceutical Drugs)', 'illicit_drugs' => 'Structures in DrugBank (Illicit_drugs)');
echo"<center><h3><font color='red'><b>$title[$selection]</b></font></h3>$DrugBank_Molecule_Class[$mol_type]</center><br>";
#echo"<table  width=100% bgcolor=silver height=50 bordercolor=\"silver\" border=\"3\" align=center><tr><td bgcolor=silver align=center><font color=blue><b>Submitter ID</b></font></td><td bgcolor=silver align=center><font color=blue><b>Class</b></font></td><td bgcolor=silver align=center><font color=blue><b>IUPAC Name</b></font></td><td bgcolor=silver align=center><font color=blue><b>Status</b></font></td><td bgcolor=silver align=center><font color=blue><b>Screened Against</b></font></td><td bgcolor=silver align=center><font color=blue><b>Target</b></font></td><td bgcolor=silver align=center><font color=blue><b>Detail</b></font></td></tr>";
if($mol_type == 'anti_tb_drugs'){
$heading = 'AntiTB Drug (Linked to PubChem)';
$heading = "<th  width='10px;'><a href='#' title='Click Header to Sort'><b>Sr.No.</b></a><img src='sort.jpg' width='15' height='15'></th><th  width='10px;'><a href='#' title='Click Header to Sort'><b>$heading</b></a><img src='sort.jpg' width='15' height='15'></th><th  width='10px;'><a href='#' title='Click Header to Sort'><b>Structure</b></a><img src='sort.jpg' width='15' height='15'></th>";
}
else if($mol_type == 'biophytmol_drugs'){
$heading = 'Link to BioPhytMol Database';
$heading = "<th  width='10px;'><a href='#' title='Click Header to Sort'><b>Sr.No.</b></a><img src='sort.jpg' width='15' height='15'></th><th  width='10px;'><a href='#' title='Click Header to Sort'><b>$heading</b></a><img src='sort.jpg' width='15' height='15'></th><th  width='10px;'><a href='#' title='Click Header to Sort'><b>Structure</b></a><img src='sort.jpg' width='15' height='15'></th>";
}
else{
$heading = 'DrugBank ID';
$heading = "<th  width='10px;'><a href='#' title='Click Header to Sort'><b>Sr.No.</b></a><img src='sort.jpg' width='15' height='15'></th><th  width='10px;'><a href='#' title='Click Header to Sort'><b>$heading</b></a><img src='sort.jpg' width='15' height='15'></th><th  width='10px;'><a href='#' title='Click Header to Sort'><b>Structure</b></a><img src='sort.jpg' width='15' height='15'></th>";
}
#echo"<table  width=50% bgcolor=skyblue height=50 bordercolor=\"silver\" border=\"3\" align=center><tr><td bgcolor=silver align=center><font color=blue><b>Sr.No.</b></font></td><td bgcolor=silver align=center><font color=blue><b>$heading</b></font></td><!--td bgcolor=silver align=center><font color=blue><b>Detail</b></font></td--></tr>";
echo"<table id=\"tableTwo\" class=\"yui\" align='center'>";
echo"<thead>";
print"$heading";
print"</thead>";
print"<tbody>";

$sr_no = 1;
for($i=0;$i<$count;$i++)
{
$take = $res[$i];
#$NPH_Id = $take;
//print $take."<br>";
$NPH_Id = preg_replace("/OSDD/","",$take);
//print $NPH_Id;
/*
$query="select * from syncdb_temporary where id='$NPH_Id'";
$result=mysql_query($query) or die("Query ($query) sucks!");
$fields = mysql_num_rows($result);
while($row = mysql_fetch_array($result))
{
$id = $row['id'];
if(!preg_match("/$id/","$uid")){
$uid = $uid."\t".$id;
echo "<tr><td align=center bgcolor=brown width=50 height=50><font color=white><b>$row[id]</b></font></td>";
echo "<td align=left bgcolor=brown width=50 height=50><font color=white><b>$row[class]</b></font></td>";
echo "<td align=left bgcolor=brown width=50 height=50><font color=white><b>$row[iupac]</b></font></td>";
echo "<td align=left bgcolor=brown width=50 height=50><font color=white><b>$row[status]</b></font></td>";
echo "<td align=left bgcolor=brown width=50 height=50><font color=white><b>$row[disease]</b></font></td>";
echo "<td align=left bgcolor=brown width=50 height=50><font color=white><b>$row[target]</b></font></td>";
/*
$break=preg_split("//",$row['formula']);
$c=sizeof($break);
//echo"<td bgcolor='gray'><font color='white'>";
echo"<td align=center bgcolor=brown><font color=white><b>";
        for($m=0;$m<$c;$m++)
         {
                if($break[$m]=='1'|$break[$m]=='2'|$break[$m]=='3'|$break[$m]=='4'|$break[$m]=='5'|$break[$m]=='6'|$break[$m]=='7'|$break[$m]=='8'|$break[$m]=='9'|$break[$m]==addslashes('0'))
                 {
                        echo"<sub>$break[$m]</sub>";
                 }
                else
                 {
                        echo"$break[$m]";
                 }
        }
print"</b></font></td>";
echo "<td align=center bgcolor=brown width=50 height=50><font color=white><b>$row[mol_wt]</b></font></td>";
*/
if(preg_match("/DB.*/", $NPH_Id)){
$url = "http://www.drugbank.ca/drugs/$NPH_Id";
$image_url = "<a href='' class='rollover'><img src='http://structures.wishartlab.com/molecules/$NPH_Id/image.png' width='180' height='105'></a>";
}
else if(preg_match("/BioPhytMol/", $NPH_Id)){
$NPH_Id = preg_replace("/BioPhytMol/","",$NPH_Id);
$NPH_Id_bio = $NPH_Id."_self_drawn";
$url = "search-nidb.php?pubchem_id=$NPH_Id_bio&type=pubchem_id";
$image_url = "<a href='' class='rollover'><img src='store_data/str_images/$NPH_Id.svg' width='180' height='105'></a>";
}
else if(preg_match("/PubChem/", $NPH_Id)){
$NPH_Id = preg_replace("/PubChem/","",$NPH_Id);
$url = "search-nidb.php?pubchem_id=$NPH_Id&type=pubchem_id";
#$url = "http://pubchem.ncbi.nlm.nih.gov/summary/summary.cgi?cid=$NPH_Id";
$image_url = "<a href='' class='rollover'><img src='http://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?t=l&cid=$NPH_Id' width='180' height='105'></a>";
}
else{
$anti_TB_id_name = array(37768 => 'Amikacin',16667680 => 'Capreomycin',84029 => 'Clarithromycin',2794 => 'Clofazimine',6234 => 'Cycloserine',14052 => 'Ethambutol',2761171 => 'Ethionamide',5379 => 'Gatifloxacin',3767 => 'Isoniazid',5311199 => 'Kanamycin',149096 => 'Levofloxacin',441401 => 'Linezolid',6479837 => 'LL-3858',101526 => 'Moxifloxacin',6480466 => 'OPC-67683',456199 => 'PA-824',4649 => 'Para-aminosalicylic',666418 => 'Prothionamide',1046 => 'Pyrazinamide',6323490 => 'Rifabutin',6540558 => 'Rifalazil',5381226 => 'Rifampin',6323497 => 'Rifapentine',5274428 => 'SQ109',19649 => 'Streptomycin',5452 => 'Thioridazine',10437679 => 'TMC-207');
$url = "http://pubchem.ncbi.nlm.nih.gov/summary/summary.cgi?cid=$NPH_Id";
$image_url = "<a href='' class='rollover'><img src='http://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?t=l&cid=$NPH_Id' width='180' height='105'></a>";
$NPH_Id = $anti_TB_id_name[$NPH_Id];
}
#echo"<form action='$url'>";
echo"<tr><td align=center  width=50 height=50>$sr_no</td><td align=center  width=50 height=50><a href='$url' target='_blank' title='Click to See Details'>$NPH_Id</a></td><td align=center  width=50 height=50>$image_url</td></tr>";
#echo"</form>";
$sr_no++;
#}
#}
}
print"</tbody>";
print<<<HTML
<tfoot>
            <tr id="pagerTwo">
                <td colspan="25" style="border-right: solid 3px #7f7f7f;">
                        <img src="images/first.png" class="first"/>
                        <img src="images/prev.png" class="prev"/>
                        <input type="text" class="pagedisplay"/>
                        <img src="images/next.png" class="next"/>
                        <img src="images/last.png" class="last"/>
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
print"</table>";
#print"<br /><center><input type='button' onClick='history.go(-1)' value='Go Back'></center>";
}
}
echo'</div>';
}

?>

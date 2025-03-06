<?php
#session_start();
include'template-nidb_new.php';
include'con1.php';

print<<<HTML


<title>NVIK Submission Form</title>
<center>
<center><font color='black'><h2>Submission Form</h2></font></center>
<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfPHo15e-yARIY1B8xvMQxX_v4FpG9dDE6ZdkyhSWrSlim1hg/viewform?embedded=true" width="640" height="2648" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
</center>
HTML;
#head();
#side();
/*
include'authentication2.php';
$auth_name = $_SESSION['SCR_NAME'];
printf("<div name=KEYWORD style=\"height: auto; width: 800px;\">");
print"<p align='center' valign='top'><font color='red'><b>Welcome</b></font>&nbsp;&nbsp;<b>$_SESSION[SCR_NAME]</b>&nbsp;&nbsp;<a href='logout.php'>Logout</a>&nbsp;&nbsp;&nbsp;";
print"<center><h2>NVI's: Online Submission</h2></center>";
if(isset($_GET['msg'])){
$t_name = $_GET['msg'];
print"<center><font color='blue'><br><br><b>Data Submitted to $t_name Successfully</b></font></center>";
print"<center><font color='blue'><b>Fill columns with appropriate information & Press \"Submit Data\" button to add more data</b></font></center>";
}
print<<<HTML
<script language="JavaScript">
<!-- script start
function validateComplete(formObj) {
 if ((emptyField(formObj.plant_name))||(emptyField(formObj.email_id))||(emptyField(formObj.plant_family))||(emptyField(formObj.part_used))||(emptyField(formObj.target_bacteria))||(emptyField(formObj.ref1))||((emptyField(formObj.smiles))&&(emptyField(formObj.ext_pre))))
          alert("Please enter value in mandatory fields !!!");
 else return true;
  return false;
}
// Check to see if field is empty
function emptyField(textObj)
{
     if (textObj.value.length == 0) return true;
     for (var i=0; i<textObj.value.length; ++i) {
          var ch = textObj.value.charAt(i);
          if (ch != ' ' && ch != '\t') return false;
     }
     return true;
}
// script end -->
function sdfCheck() {
//if(document.form1.inst_name.value==''){
//alert('Please Select Institute Name !!!');
//return false;
//}

  window.open('pre-exist-sdf.php','Check pre-existence of molecule','width=500,height=auto,scrollbars=yes,resizable=yes');
}
function startEditor() {
//if(document.form1.inst_name.value==''){
//alert('Please Select Institute Name !!!');
//return false;
//}

  window.open('jme_window.html','JME','width=500,height=450,scrollbars=no,resizable=yes');
}

function mol_exist(response,smiles,mol,molid){
//alert(molid);
var str=/Your/g;
if(str.test(response)){
//alert(molid);
    document.form1.smiles.value = smiles;
    document.form1.mol_file1.value = mol;
    document.form1.compound_id.value = molid;
}
else{
document.form1.smiles.value = "";
}

}

function sdf_exist(response,smiles,sdf,molid){
//alert(mol);
//alert(molid);
var str=/Your/g;
if(str.test(response)){
    document.form1.smiles.value = smiles;
    document.form1.sdf_file_name.value = sdf;
    document.form1.compound_id.value = molid;
    document.getElementById("inst_read").setAttribute("readOnly","true")
}
else{
document.form1.smiles.value = "";
}

}

function fromEditor(smiles,jme) {
  // this function is called from jme_window
  // editor fills variable smiles & jme
  if (smiles=="") {
    alert ("no molecule submitted");
    return;
  }
  document.form1.smiles.value = smiles;
}


</script>

HTML;
$sql_time = "select date_format(now(),'%M%e,%Y - %l:%i%p %a');";
$result_time = mysql_query($sql_time);
$row_time = mysql_fetch_array($result_time);
$time = $row_time[0];
$result = mysql_query("select * from amphydb_temporary") or die(mysql_error());
$t_headers = array('Compound ID','Submitter\'s Name','Email','Institute/University','Structure','SMILES','Plant Source','Source Family','Origin','Common Name','Plant Part Used','Extract [%]','Target Bacteria','Assay / Test Done','Positive Control Used (conc.)','Inhibition [%]','Activity [MIC] ug/ml','Activity (In terms of dilution)','Activity (Zone of inhibition in mm)','Active Compound Identified','PubChem ID','Ethnomedicinal Information','PubMed ID [Source Literature]','Extract Preparation','Classification [Source Based]','Chemical Classification [Active Compound]','Target Protein','Media / Broth Used [Antimicrobial Assay/Test]','Active Concentration [Positive Control]','Cytotoxicity Assay [AID]','Cytotoxic Concentration of Extract / Active Compound [ug/ml]','Reference 1','Reference 2','Reference 3','Date');
$row = mysql_fetch_row($result);
printf("<form action='insert_final.php' enctype='multipart/form-data' method='post' name=\"form1\" onSubmit=\"return validateComplete(document.form1)\">");
print"<table align='center' border='3' bordercolor='gray' style=\"width: 100%; table-layout:fixed; border-collapse: collapse;\">";
for($i=0;$i<mysql_num_fields($result);$i++){
$field_name = mysql_field_name($result, $i);
print"<tr><td width='200' bgcolor=\"green\"><font color='white'><b>$t_headers[$i]</b></font></td>";
if($field_name=='compound_id'||$field_name=='date'||$field_name=='smiles'){
if($field_name=='compound_id'||$field_name=='smiles'){
printf("<td bgcolor='silver'><input type='text' name='$field_name' size='50' readonly>Not Required</td></tr>");
}
else{
printf("<td bgcolor='silver'><input type='text' name='$field_name' value='$time' size='50' readonly>Not Required</td></tr>");
}
}
else if($field_name=='plant_name'||$field_name=='email_id'||$field_name=='plant_family'||$field_name=='target_bacteria'||$field_name=='ref1'||$field_name=='part_used'){
printf("<td bgcolor='white'><input type='text' name='$field_name' size='50'>&nbsp;&nbsp;&nbsp;*</td></tr>");
}
else if($field_name=='compound_image'){
print"<td><input type=\"button\" name='sdf_check' value='Check Availability & Upload' onClick=\"sdfCheck();\">&nbsp;&nbsp;<input type=\"hidden\" name=\"sdf_file_name\">&nbsp;&nbsp;<input type=\"hidden\" name=\"mol_file1\">&nbsp;&nbsp;OR&nbsp;&nbsp;<input type=\"button\" value=\"Draw Molecule\" onClick=\"startEditor();\">&nbsp;&nbsp;&nbsp;**";
printf("</td></tr>");
}
else if($field_name=='ext_pre'){
printf("<td bgcolor='white'><input type='text' name='$field_name' size='50'>&nbsp;&nbsp;&nbsp;**</td></tr>");
}
else{
printf("<td bgcolor='white'><input type='text' name='$field_name' size='50'></td></tr>");
}
}
printf("<tr><td bgcolor='white' colspan='2' align='center'>* These fields are mandatory; **Any one of the two is mandatory</td></tr>");
printf("<tr><td bgcolor='white' colspan='2' align='center'><input type='submit' value='Submit Data' onclick=\"if (! confirm('Are you sure to Submit Data ?')) return false;\">&nbsp;&nbsp;&nbsp;<input type='reset' value='Clear All'></td></tr>");
printf("</table>");
printf("</form>");
printf("</div>");
#footer();
*/
?>

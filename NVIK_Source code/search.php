<?php
 include'template-nidb_new.php';



 echo "<title>NVIK Simple Search</title>";
  
?>
<script type="text/javascript">
<!--scripts start here -->
function MyWindow()
{
//Create new Window
 options =      "toolbar=0,status=0,menubar=0,scrollbars=2," +
                "resizable=1,width=600,height=600";
//newwindow= window.open("mywindow.html","",options)
}
function example()
{
//Create new Window
 values =       "toolbar=0,status=0,menubar=0,scrollbars=2," +
                "resizable=1,width=1000,height=400";
//newwindow2= window.open("example_hormone.html","",values)
}
<!--
function formValidation(form)
{
if((form.key1.value == "")) {
alert("Please enter a keyword !!!");
return false;
}
}
-->
</script>
<div style="position: relative; padding:10px 30px 10px 30px;">
	<center><h2><b>Simple Search</b></h2></center>
	<form onsubmit="return formValidation(this);" enctype="multipart/form-data" method="POST" action="search-nidb.php">

	<center>         <b>Enter Query:</b> <input type="text" id="search" onfocus="setStyle(this.id)" name="key1" value="" size='60' style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<!--input name="help" type="button" value="Example" onClick="example()"--><input type="submit" value="Search" size='80' style="font-size: 20px;"><br><br>
	<!--b>Click here for <a href='query.html'><u style="color:brown;align:left">Advanced Search</u></a></b><br><br-->
				   <b>Search Type:</b>
					  &nbsp;&nbsp;<input type="radio" checked="" value="similar" name="type">Containing
					  &nbsp;&nbsp;<input type="radio" value="exact" name="type">Exact
				   </center><br>

	<font size="4" color="white"></font><table cellspacing="0" cellpadding="1" border="2" align="center" width="40%" style=' border-collapse: collapse; text-color: white'>
	<tbody><tr bgcolor="#3E6990" style="color:white;"><td><b>Select Fields</b></td><td><b>Search in</b> </td><td><b>Display</b></td></tr>
	<tr bgcolor="#f1f1f1"><td><b>All</b></td><td><input type="checkbox" checked="" value="all" name="hse[]"></td><td><input type="checkbox" value="all" name="hde[]" checked></td></tr>
	<tr bgcolor="#f1f1f1"><td><b>Inhibitor Name</b> </td><td><input type="checkbox" value="Inhibitor_name" name="hse[]"></td><td><input type="checkbox"  value="Inhibitor_name" name="hde[]"></td></tr>
	<tr bgcolor="#f1f1f1"><td><b>Targets/Mechanisms</b> </td><td><input type="checkbox" value="Target" name="hse[]"></td><td><input type="checkbox"  value="Target" name="hde[]"></td></tr>
	<tr bgcolor="#f1f1f1"><td><b>Assay Type</b> </td><td><input type="checkbox" value="Assay_type" name="hse[]"></td><td><input type="checkbox"  value="Assay_type" name="hde[]"></td></tr>
	<tr bgcolor="#f1f1f1"><td><b>Cell Type</b> </td><td><input type="checkbox" value="Cell_type" name="hse[]"></td><td><input type="checkbox"  value="Cell_type" name="hde[]"></td></tr>
	<tr bgcolor="#f1f1f1"><td><b>IC50 Value (in nM)</b></td><td><input type="checkbox" value="IC50_nM" name="hse[]"></td><td><input type="checkbox"  value="IC50_nM" name="hde[]"></td></tr>
	<tr bgcolor="#f1f1f1"><td><b>EC50 Value (in nM)</b> </td><td><input type="checkbox" value="EC50_nM" name="hse[]"></td><td><input type="checkbox"  value="EC50_nM" name="hde[]"></td></tr>
	<tr bgcolor="#f1f1f1"><td><b>PubMed ID</b> </td><td><input type="checkbox" value="Pubmed_id" name="hse[]"></td><td><input type="checkbox"  value="Pubmed_id" name="hde[]"></td></tr>
	</tbody></table>

	<center>
	<br>
		<b>Results per page:</b>&nbsp;&nbsp;<select name="results">
		<option selected="" value="50">50</option>
		<option value="100">100</option>
		<option value="150">150</option>
		<option value="200">200</option>
		<option value="250">250</option>
		</select>
		<!--b>Download Results (.csv format):</b>&nbsp;&nbsp;<input type="checkbox" value="download" name="down_data"-->
		<br><br>
		<p align="center"><input type="submit" value="Search" style="font-size: 20px;">&nbsp;&nbsp;<input type="reset" value="Clear Data" style="font-size: 20px;">&nbsp;&nbsp;<!--input name="help" type="button" value="Help" onClick="MyWindow()"--></p>
	</center>

</div>

<?php
include ('footer.html');
?>


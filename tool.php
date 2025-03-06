<?php
#session_start();
include'template-nidb_new.php';
print <<<HTML
<head>
  <script type="text/javascript" language="javascript" src="jsme/jsme.nocache.js"></script>
  <title>NVIK Structure Search</title>
</head>

<!--fieldset name=KEYWORD style="background: #B4CFEC; height: auto; width: 1050px;"-->
<div width='1600'>
<!--p style="background: green; color: white; size: 6;"><b>JME (Draw Structures & Search)</b></p-->
<SCRIPT LANGUAGE="JavaScript">
  function getSmiles1() {
    var drawing = document.JME.smiles();
    document.form1.smi.value = drawing;
  }
  
  function example()
  {
  //Create new Window
   values =       "toolbar=0,status=0,menubar=0,scrollbars=2," +
                  "resizable=1,width=900,height=600";
  newwindow2= window.open("help_structure.html","",values)
  }
  
  function example2()
  {
  //Create new Window
   values =       "toolbar=0,status=0,menubar=0,scrollbars=2," +
                  "resizable=1,width=700,height=500";
  newwindow= window.open("readme_jme.html","",values)
  }
  function readMolecule() {
        var jme = "38 42 C 4.72 -6.46 C 3.53 -7.15 N 3.53 -8.52 C 4.72 -9.21 C 5.91 -8.52 N 5.91 -7.15 C 2.34 -9.21 O 1.15 -8.52 C -0.05 -9.21 C -1.24 -8.52 O 2.34 -10.59 C 7.10 -6.46 C 8.30 -7.15 C 9.49 -6.46 C 9.49 -5.08 C 8.30 -4.40 C 7.10 -5.08 F 5.91 -4.40 N 10.68 -7.15 C 11.87 -6.46 C 11.87 -5.08 C 10.68 -4.40 O 10.68 -3.02 C 10.68 -8.52 C 9.49 -9.21 C 11.87 -9.21 C 13.06 -4.40 N 14.18 -5.20 C 15.43 -4.65 C 16.55 -5.45 C 16.40 -6.82 C 17.52 -7.63 C 18.77 -7.07 C 18.92 -5.70 C 17.80 -4.89 Cl 17.95 -3.53 Cl 19.89 -7.88 O 13.13 -3.02 1 2 1 4 5 1 2 3 1 3 4 1 1 6 1 5 6 1 3 7 1 9 10 1 7 8 1 8 9 1 7 11 2 12 13 2 13 14 1 14 15 2 15 16 1 16 17 2 17 12 1 6 12 1 17 18 1 21 22 1 15 22 1 19 20 1 14 19 1 22 23 2 21 20 2 19 24 1 24 25 1 24 26 1 25 26 1 21 27 1 29 30 1 31 32 1 32 33 2 33 34 1 34 35 2 30 31 2 35 30 1 33 37 1 35 36 1 27 28 1 28 29 1 27 38 2";
	document.JME.readMolecule(jme);
  }

</SCRIPT>
HTML;
print <<<HTML
<table border=1px; style='border-collapse: collapse;' align=center>
  <tr align='center'><td colspan='2'><b><h2>Nipah Virus Inhibitor Structure Search Form</h2></b></td></tr>
  <tr align='left'>
  <td colspan='2'><b>NVIK</b> allow users to find similar molecules matches with Tanimoto coefficient >0.8 in Nipah Virus Inhibitor Molecules.<br>User may submit a single molecule using any of the three options provided.
    <br> Please choose only one option at a time.
    <ol type='1'>
      <li>Draw using JSME editor</li>
      <li>Paste SMILES</li>
      <li>Upload SDF/MOL/MOL2 file</li>
    </ol>
  </td></tr>

  <tr><td align=center valign='top'> 
    <span style='background: #D1FFA3;'><b>Option 1. JSME (Draw Structures & Search)</b></p>
    <!--FORM METHOD="POST" NAME="form1" action="drugbank_right.php" enctype='multipart/form-data'-->
    <FORM METHOD="POST" NAME="form1" action="str_out.php" enctype='multipart/form-data'>
    <div code="JME.class" name="JME" archive="JME.jar" width="500" height="300" id="JME">You have to enable JavaScript in your browser to use JSME! </div>
    <INPUT TYPE="button" VALUE="Load Example Molecule" onClick="readMolecule()" style="font-size:20px">
    <INPUT TYPE="button" VALUE="Clear Editor" onClick="document.JME.reset()" style="font-size:20px"><br>
    <a href = data/Structures_Marvin_updated/NVIC0007.mol download><h4>Example Mol file</h4></a>
    <!--INPUT TYPE="button" VALUE="README" onClick="example2()"><br-->
    <form name='form1' action="str_out.php" method="post" align="center">
    <INPUT TYPE="hidden" NAME="smi">
    <!--BR><INPUT TYPE="submit" name=search value='Search Structure' onClick="getSmiles1()"-->
  </td>
  <td valign='top' align='center'><span style='background: #D1FFA3;'><b>Option 2. Paste Structure in SMILES Format</b></span><br><br>
	<textarea rows='16' cols='50' name='smil'></textarea>
	<br><br>
	_____________________________________________
	<br><br><b><span style='background: #D1FFA3;'>Option 3. Upload File (MOL/SDF/MOL2)</b> </span><br><br>
        <input type='file' name='myfile' style="font-size:20px">
  </td></tr>

  <tr align='center'>
    <td colspan='2'><br><INPUT TYPE="submit" name=search value='Similarity Structure Search' onClick="getSmiles1()" style="font-size:20px" > &nbsp;&nbsp;&nbsp;
    <input type='reset' value='Clear All' onClick="document.JME.reset()" style="font-size:20px"></FORM><br><br>
    </td>
  </tr>
</table>

</div>

HTML;
include ('footerfix.html');

?>

<?php


global $var;
print<<<HTML

 <form action="str_out.php" method="post" enctype="multipart/form-data">
        Upload a File:
        <input type="file" name="myfile" id="fileToUpload">

<form action="str_out.php" method="post">
<INPUT TYPE="hidden" value=" $var>" name="var">
<br><b>Search Type:</b> <select name="select11">
        <option value="-t:s" selected>Substructure search</option>
        <option value="-t:e">Exact search </option>
        <option value="-t:u">Superstructure search </option>
        <option value="-t:i">Similarity search</option>
</select>

 <input type="submit" name="submit" value="Upload File Now" >
</form>

HTML;

global $title;

if(isset($_POST['var']))
{
$title = array('-t:s' => 'Substructure Search Results', '-t:e' => 'Exact Search Results', '-t:u' => 'Superstructure Search Results', '-t:p' => 'Perfect Search Results', '-t:i' => 'Search Search Results');
$title = $_POST['var'];


}




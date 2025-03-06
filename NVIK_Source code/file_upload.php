<?php


global $var;
print<<<HTML

 <form action="file_upload.php" method="post" enctype="multipart/form-data">
        Upload a File:
        <input type="file" name="myfile" id="fileToUpload">

<form action="file_upload.php" method="post">
<INPUT TYPE="text" value=" $var>" name="var">
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

if(isset($_POST['title']))
{
$title = array('-t:s' => 'Substructure Search Results', '-t:e' => 'Exact Search Results', '-t:u' => 'Superstructure Search Results', '-t:p' => 'Perfect Search Results', '-t:i' => 'Search Search Results');
$title = $_POST['title'];


}





        

$currentDir = getcwd();
    $uploadDirectory = "/uploaded_files/";

    $errors = []; // Store all foreseen and unforseen errors here

   $fileExtensions = ['sdf','mol','png']; // Get all the file extensions


/*
print<<<HTML
 <form action="fileUpload.php" method="post" enctype="multipart/form-data">
        Upload a File:
        <input type="file" name="myfile" id="fileToUpload">
        <input type="submit" name="submit" value="Upload File Now" >
    </form>


HTML;
*/




 global $fileName;   
if(isset($_FILES['myfile']['name'])){
	$fileName = $_FILES['myfile']['name'];
        shell_exec('rm /uploaded_file/$fileName ');



#$fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName  = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];
}
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a sdf or mol or PNG file";
        }

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                echo "The file " . basename($fileName) . " has been uploaded";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    }


echo "<pre>upload file: $fileName, and  argument: $title</pre>";
#$output = shell_exec('./jc.sh /uploaded_file/$fileName  $title ');
#chdir($old_path);
#echo "<pre>$output</pre>";



?>

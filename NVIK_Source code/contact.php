<?php
#session_start();
include'template-nidb_new.php';
#include'contact.html';

print<<<HTML
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/contact.css">
</head>
<body>
    <h1 style="text-align:center; margin-right: 15%;">Contact Us</h1>    
<!--
<div class="about-section">
<h1>About Us Page</h1>
<p>Some text about who we are and what we do.</p>
<p>Resize the browser window to see that this page is responsive by the way.</p>
</div>
-->
HTML;

print <<<HTML2

	
  
 </div>
HTML2;

$all = file("data/contact.tsv");
foreach($all as $a){
    list($pic,$social, $name,$position,$affiliation,$email) = split("\t",$a);
    //$e = preg_replace("/\n$/","",$d);
    print <<<HTML1
    <div class="row1">
    <div class="column1">
    <div class="card">
        <img src="$pic" alt="$name" style="height:250px;">
        <div class="container">
        <h2><a href="$social" target=_blank>$name</a></h2>
        <p class=title>$position</p>
        <p>$affiliation</p>
        <p><a href="mailto:$email">$email</a></p>  
    </div>
    </div>
    </div>
HTML1;
}

echo "</div></body>";





#<!-- This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License. -->
echo "<p style=\"margin-left: 180px;\">";
include('LICENSE');
echo "</p>";
include ('footerfix.html');
?>
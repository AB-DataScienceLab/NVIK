<?php
#session_start();
include'template-nidb_new.php';
echo "<title>NVIK Home</title>";

print <<<HTML
<style>
.menu li{
    opacity: 1;
}
.menu ul{
    transform: rotate(0deg) translateY(-1em);
}
</style>

HTML;

include 'about.html';


include ('footerfix.html');
?>

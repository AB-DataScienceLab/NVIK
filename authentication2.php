<?php
if (!isset($_SESSION['OPENID_AUTH']) || $_SESSION['OPENID_AUTH'] !== true) {
#print'<br><br><font color="red" size="4"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are not permitted to access this page! Please logIn &nbsp;&nbsp;<a href="http://crdd.osdd.net/osddchem/biophytmol/openid.php"><b>Click Here</b></a></b></font>';
print"<h2><center>Community Annotation/Curation</center></h2>";
print"<p align='center'>BioPhytMol is a community project with all the data curated manually by large number of authors and contributors.<br> This data needs continous update for identifying any errors or adding new information as and when it is published. The scientific community <br>is requested to update and curate the data using the Submit option. For anyone to curate data, the<br> OpenID hosted by http://sysborg2.osdd.net is required. For submitting information please <br>create sysborg2.osdd.net login.<br><br><a href='http://sysborg2.osdd.net/web/guest/home?p_p_id=58&p_p_lifecycle=1&p_p_state=maximized&p_p_mode=view&p_p_col_id=column-1&p_p_col_count=1&saveLastPath=0&_58_struts_action=%2Flogin%2Fcreate_account' target='_blank'>Register ?</a>&nbsp;&nbsp;&nbsp;<a href='http://sysborg2.osdd.net/web/guest/home?p_p_id=58&p_p_lifecycle=0&p_p_state=maximized&p_p_mode=view&_58_struts_action=%2Flogin%2Fforgot_password' target='_blank'>Forgot Password ?</a>
<form action='openid.php' method='post'>
<br><center><font size=3><b>LOGIN WITH YOUR SYSBORG ACCOUNT:</b> </font><input type='text' name='id' placeholder='Screen Name'>&nbsp;&nbsp;&nbsp;<input type='submit' value='Log In'></form></p></Scenter>";
print'<br><br><br><br><br><br>';
#footer();
exit;
/*
print<<<HTML
<script type="text/javascript">
<!--
window.location = "http://crdd.osdd.net/osddchem/biophytmol/index.html"
//-->
</script>

HTML;
*/

}
include'auto_logout.php';
?>

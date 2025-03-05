<?php


#$old_path = getcwd();
#chdir('/my/path/');
$output = shell_exec('./jc.sh /uploaded_file/* ');
#chdir($old_path);
echo "<pre>$output</pre>";

?>

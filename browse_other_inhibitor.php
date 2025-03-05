<?php
## by rakesh4osdd@gmail.com 
## read tsv file and display html table
include'template-nidb_new.php';
include'con1.php';
include'for_browse.php';
print "<title>Peptides and other than small-molecule inhibitors</title>";
print"<center><h2>Browse</h2></center>";
side_bar();
echo "<style>
thead {color:white;}
tbody {color:black;}
tfoot {color:red;}

table, th, td {
  border: 1px solid black;
}
</style>";
print"<center><h3>Peptides and other than small-molecule inhibitors</h3></center>";
$row = 1;
if (($handle = fopen("NORC_other_inh_nipah.tsv", "r")) !== FALSE) {
   
    echo '<table border="1" align=center>';
   
    while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
        $num = count($data);
        if ($row == 1) {
            echo '<thead bgcolor="#3E6990"><tr>';
        }else{
            echo '<tr>';
        }
       
        for ($c=0; $c < $num; $c++) {
            if(empty($data[$c])) {
               $value = "&nbsp;";
            }else{
               $value = $data[$c];
            }
            if ($row == 1) {
                echo '<th>'.$value.'</th>';
            }else{
		if($c==3){echo "<td><a href=https://www.ncbi.nlm.nih.gov/pubmed/$value target=_blank>".$value.'</a></td>';}

		else{
                echo '<td>'.$value.'</td>';
		}
		#echo "$value<br>";
            }
        }
       
        if ($row == 1) {
            echo '</tr></thead><tbody>';
        }else{
            echo '</tr>';
        }
        $row++;
	
    }
    echo '</tbody></table>';
    fclose($handle);
}
?>

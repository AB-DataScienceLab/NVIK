<?php
## by rakesh4osdd@gmail.com 
## read tsv file and display html table
include 'template-nidb_new.php';
#include 'sidemenu2.php';
include 'con1.php';
##include 'for_browse.php';
print "<title>Priority Inhibitors</title>";
print "<center><h2>Combined Evidence Based Prioritised NVIs</h2></center>";
#side_bar();
echo "<style>
thead {color:white;}
tbody {color:black;}
tfoot {color:red;}

table, th, td {
  border: 1px solid black;
   text-align: center;
}
</style>";

$row = 1;
if (($handle = fopen("prioritised_nvics.tsv", "r")) !== FALSE) {
    echo '<table border="1" align="center">';
   
    while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
        $num = count($data);
        if ($row == 1) {
            echo '<thead bgcolor="#3E6990"><tr>';
        } else {
            echo '<tr>';
        }
       
        for ($c = 0; $c < $num; $c++) {
            if (empty($data[$c])) {
               $value = "&nbsp;";
            } else {
               $value = $data[$c];
            }

            if ($row == 1) {
                echo '<th>'.$value.'</th>';
            } else {
                if ($c == 0) {
                    // Extract NVIC identifier (e.g., "NVIC0136") using regex
                    preg_match('/NVIC[0-9]+/', $value, $matches);
                    $nvic_id = isset($matches[0]) ? $matches[0] : $value;

                    // Create hyperlink using extracted NVIC_ID
                    echo "<td><a href='search-nidb.php?NVIC_ID=$nvic_id&type=NVIC_ID' target='_blank'>".$nvic_id.'</a></td>';
                } else {
                    echo '<td>'.$value.'</td>';
                }
            }
        }
       
        if ($row == 1) {
            echo '</tr></thead><tbody>';
        } else {
            echo '</tr>';
        }
        $row++;
    }
    echo '</tbody></table>';
    fclose($handle);
}

print "<center>*minimum value has been reported **minimum effective concentration in &#117Mg/ml<br><hr>
List of the top 10 prioritised NVIs along with their biological activity, presence of PAINS flag, structural similarity with FDA drugs and other libraries and number toxicity endpoints cleared based on predictions from both servers.<br> The prioritised NVIs identified as approved drugs are given with their DrugBank accession number.<br> None of these compounds showed similarity (Tc&ge;0.8) with known antivirals and pathogen box compounds.
</center>";
include ('footer.html');
?>

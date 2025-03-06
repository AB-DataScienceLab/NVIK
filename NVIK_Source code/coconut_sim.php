<?php
include 'template-nidb_new.php';

print<<<HTML
<title>NVIK Coconut Identifier Similarity</title>
<style>
a.rollover img {
        width: 180px;
        height: 175px;
}

a.rollover:hover > img {
        width: 380px;
        height: 440px;
}
</style>
<center><b><h2>NVIs Similarity with COCONUT Natural Product Database</h2><br></b></center>
<br>
<table id='tableTwo' class='yui' border='center' width='84%' >
<thead>
    <tr>
        <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>NVIC ID</b>&nbsp;</font></th>
        <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>COCONUT Identifier</b>&nbsp;</font></th>
        <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>Tanimoto coefficient</b>&nbsp;</font></th>
        <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>Web-URL (COCONUT Identifier)</b>&nbsp;</font></th>
    </tr>
</thead>
<tbody>
HTML;

// Open the CSV file
$csvFile = fopen('/home/gpsr/webserver/cgidocs/anshu/nipah/nvik_vs_coconut_hsp.csv', 'r');


// Loop through each row in the CSV file
while (($row = fgetcsv($csvFile)) !== false) {
    // Ensure there are exactly 4 columns in each row
    if (count($row) === 4) {
        $nvic_id = $row[0];
        $coconut_id = $row[1];
        $tanimoto = round($row[2], 2);
        $web_url = $row[3];

        // Generate table row for each entry
        print "<tr>";
        print "<td align='center'><a href='search-nidb.php?NVIC_ID=$nvic_id&type=NVIC_ID' title='Click to See Details' target='_blank'><b><i>$nvic_id</i></b></a></td>";
        print "<td align='center'>$coconut_id</td>";
        print "<td align='center'>$tanimoto</td>";
        print "<td align='center'><a href='$web_url' target='_blank'>$web_url</a></td>";
        print "</tr>";
    } else {
        // Optionally handle invalid rows here, e.g., log for debugging
        // print "<tr><td colspan='4' align='center'>Invalid data in file</td></tr>";
    }
}

// Close the CSV file
fclose($csvFile);

print<<<HTML
</tbody>
</table>
HTML;
?>

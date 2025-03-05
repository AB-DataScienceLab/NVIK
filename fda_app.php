<?php
include 'template-nidb_new.php';

print<<<HTML
<title>NVIK FDA Drugs Similarity</title>
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
<center><b><h2>Similarity with FDA Approved Small Molecule Drugs</h2><br>Table: List of NVI's molecules showing similarity with FDA approved small molecule drugs</b></center>
<br>
<table id='tableTwo' class='yui' border='center' width='84%' >
<thead>
    <tr>
        <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>NVIC ID</b>&nbsp;</font></th>
        <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>FDA approved drug</b>&nbsp;</font></th>
        <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>Tanimoto coefficient</b>&nbsp;</font></th>
        <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>Drug Bank ID of FDA drug</b>&nbsp;</font></th>
        <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>Side effects from Drug Bank</b>&nbsp;</font></th>
        <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>Rat acute toxicity (LD50, mol/kg) from Drug Bank</b>&nbsp;</font></th>
    </tr>
</thead>
<tbody>
HTML;

$result = fopen('/home/gpsr/webserver/cgidocs/anshu/nipah/fda_1.txt', 'r');

while (!feof($result)) {
    $name = fgets($result);
    $name = trim($name); // Trim whitespace and newline characters

    if ($name !== '') {
        $sep_val = explode("\t", $name);  // Assuming tab-separated values

        // Ensure there are exactly 6 columns
        if (count($sep_val) === 6) {
            $pub_id = $sep_val[0];
            $fda_drug = $sep_val[1];
            $tani = round($sep_val[2], 2);
            $drug_bank_id = $sep_val[3];
            $side_eff = $sep_val[4];
            $toxi = $sep_val[5];  // Assuming this is the LD50 value

            if ($pub_id <= 315) {
                print "<tr><td align='center'><a href='search-nidb.php?NVIC_ID=$pub_id&type=NVIC_ID' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><br><br><a href='' class='rollover'><img src='store_data/str_images_updated/$pub_id.png' width='180' height='105'></a></td>";
            } else {
                print "<tr><td align='center'><a href='search-nidb.php?Pubchem_id=$sep_val[0]&type=Pubchem_id' title='Click to See Details'><b><i>$sep_val[0]</i></b></a><br><br><a href='' class='rollover'><img src='http://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?t=l&cid=$sep_val[0]' width='180' height='105'></a></td>";
            }

            print "<td align='center'>$fda_drug</td>";
            print "<td align='center'>$tani</td>";
            print "<td align='center'><a href='http://www.drugbank.ca/drugs/$drug_bank_id' target='_blank' title='Click to See Details'>$drug_bank_id</a></td>";
            print "<td align='center'>$side_eff</td>";
            print "<td align='center'>$toxi</td></tr>";
        } else {
            // Handle the case where the line doesn't have the expected number of columns
            // Optionally log this for debugging
            // print "<tr><td colspan='6' align='center'>Invalid data in file: $name</td></tr>";
        }
    }
}

print<<<HTML
</tbody>
</table>
HTML;

fclose($result);
include ('footerfix.html');
?>

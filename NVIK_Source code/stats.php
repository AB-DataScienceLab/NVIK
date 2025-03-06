<?php
include 'template-nidb_new.php';
include 'sidemenu.php';
print <<<HTML
<title>NVIK Statistics</title>
<head>
<style>
.center {
  text-align: center;
  margin-right: 60px;
}
</style>
</head>
<body>
<div class="center">
<a name='nipah_stat'>
<h2><center>Nipah Virus Inhibitors (NVIs) Statistics</center></h2>

<br><br>
<center><b>Table - 1:</b> General information about Nipah Virus Inhibitors (NVIs)</center>
<br>

<table border="1px" style="border-collapse:collapse;" align="center" width="700px">
<tr bgcolor="#3E6990">
    <td align="center"><font color="white">Total NVI's</font></td>
    <td align="center"><font color="white">Small molecule NVIs</font></td>
    <td align="center"><font color="white">Other than small molecule NVIs</font></td>
</tr>
<tr>
    <td align="center">220</td>
    <td align="center">178</td>
    <td align="center">42</td>
</tr>
</table>
<br><br>
HTML;

// Table 2
echo "<center><u><b>Table - 2:</b> Statistics of molecular properties of NVIs</u></center>";
echo "<br>";
echo "<table border='2px' style='border-collapse:collapse;' align='center' width='500px'>";
$all = file("statistics_13_Nov_2019.txt");

foreach ($all as $a) {
    list($a, $b, $c, $d) = explode("\t", $a);
    $e = preg_replace("/\n$/", "", $d);
    print "<tr><td bgcolor='#3E6990'><font color='white'>$a</font></td><td align='center'>$b</td><td align='center'>$c</td><td align='center'>$d</td></tr>";
}
echo "</table>";

// New Table
echo "<br><br>";
echo "<center><u><b>Table - 3:</b>Chemical Library Size </u></center>";
echo "<br>";
echo "<table border='2px' style='border-collapse:collapse;' align='center' width='500px'>";

// Load and parse the new TSV file
$tsvFile = "NVIK- STASTISTICS - library_size.tsv"; // Update the path to your TSV file
if (file_exists($tsvFile)) {
    $fileContent = file($tsvFile);

    // Generate table headers
    $headerRow = explode("\t", trim($fileContent[0]));
    echo "<tr bgcolor='#3E6990'>";
    foreach ($headerRow as $header) {
        echo "<td align='center'><font color='white'>" . htmlspecialchars($header) . "</font></td>";
    }
    echo "</tr>";

    // Generate table rows
    for ($i = 1; $i < count($fileContent); $i++) {
        $row = explode("\t", trim($fileContent[$i]));
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td align='center'>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4' align='center'>TSV file not found.</td></tr>";
}

echo "</table>";
print <<<HTML
<br><br>

<center><h2>Physicochemical properties based comparison of NVIs with FDA approved drugs and Enamine antivirals</h2></center>
<br>
<center><img width='80%' src='images/prop/nvi-fda-avr-physprop-comp.png' border='0' style='border-collapse:collapse;'></center>
<center><a href='#top' style='text-decoration: none;'><b>[Top]</b></a></center>
<br><br>

<center><h2>Physicochemical properties based comparison of NVIs with Pathogen Box, CAS and Coconut Libraries respectively</h2></center>
<br>
<center><img width='80%' src='images/prop/vs-coconut-cas-pbox.png' border='0' style='border-collapse:collapse;'></center>
<center><a href='#top' style='text-decoration: none;'><b>[Top]</b></a></center>

</div>
</body>
HTML;

include('footerfix.html');
?>

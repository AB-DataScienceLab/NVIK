<?php
// Include necessary files for template and database connection
include 'template-nidb_new.php';
include 'con1.php';

// Start HTML head and layout
echo "<title>NVIK Browse - ADMET Predictions</title>";  // Set page title

// Begin main content container
print "<div style='height: auto; right: 200px;'>";

// Include sidebar or any additional elements


// Start the ADMET predictions section with dropdowns
echo "<div style='margin-bottom: 20px;'>";
echo "<table align='center' valign='top' border=2 style='border-collapse: collapse; text-align: center; background: #f1f1f1; text-color: black; width: 800px;'>";
echo "<thead>";
echo "<tr><td bgcolor='#3E6990' align='center' colspan=4><font color='white'><b>Deep learning based ADMET predictions</b></font></td></tr>";

// First Dropdown: Deep-PK
echo "<tr><td><b>Deep-PK</b></td><td>";
echo "<select name='Deep-PK' onchange='location = this.value;'>";  // Dropdown to navigate
$options = array(
    'Select' => '',
    'Absorption' => 'absorption.php',
    'Distribution' => 'distribution.php',
    'Metabolism' => 'metabolism.php',
    'Excretion' => 'excretion.php',
    'Toxicity' => 'toxicity.php'
);
foreach ($options as $option => $link) {
    echo "<option value='$link'>$option</option>";  // Each option links to corresponding page
}
echo "</select>";
echo "</td></tr>";

// Second Dropdown: admetSAR 3.0
echo "<tr><td><b>admetSAR 3.0</b></td><td>";
echo "<select name='admetSAR 3.0' onchange='location = this.value;'>";  // Dropdown to navigate
$admetSAR_options = array(
    'Select' => '',
    'Absorption' => 'admetsar_absorption.php',
    'Distribution' => 'admetsar_distribution.php',
    'Metabolism' => 'admetsar_metabolism.php',
    'Excretion' => 'admetsar_excretion.php',
    'Toxicity' => 'admetsar_toxicity.php'
);
foreach ($admetSAR_options as $option => $link) {
    echo "<option value='$link'>$option</option>";  // Each option links to corresponding page
}
echo "</select>";
echo "</td></tr>";

// End table and section
echo "</thead>";
echo "</table>";
echo "</div>";

// Close main content container
echo "</div>";

// Optionally close dat
include ('footer.html');
?>

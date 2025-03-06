<?php
function side_bar() {
    $res_all_biophytmol = mysql_query("SELECT * FROM data_2024");
    echo "<div style='margin-bottom: 20px;'>";
    echo "<table align='center' valign='top' border=2 style='border-collapse: collapse; text-align: center; background: #f1f1f1; text-color: black; width: 800px;'>";
    echo "<thead>";
    echo "<tr><td bgcolor='#3E6990' align='center' colspan=4><font color='white'><b>Small Molecule Inhibitors</b></font></td></tr>";
    
    for ($i = 0; $i < mysql_num_fields($res_all_biophytmol); $i++) {
        $f_name = mysql_field_name($res_all_biophytmol, $i);
        if ($f_name == 'Inhibitor_name' || $f_name == 'Target' || $f_name == 'Assay_type' || $f_name == 'Cell_type' || $f_name == 'IC50_nM' || $f_name == 'EC50_nM' || $f_name == 'Pubmed_id') {
            $fname_full = array(
                'Inhibitor_name' => 'Inhibitors',
                'Target' => 'Targets/Mechanisms',
                'Assay_type' => 'Assay type',
                'Cell_type' => 'Cell Type',
                'IC50_nM' => 'IC50 (in nM)',
                'EC50_nM' => 'EC50 (in nM)',
                'Pubmed_id' => 'Reference'
            );
            $name_dis = $fname_full[$f_name];

            if ($f_name == 'Inhibitor_name') {
                echo "<tr><td><b><a href='browse_inhibitor.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
            } else if ($f_name == 'Cell_type') {
                echo "<tr><td><b><a href='browse_celltype.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
            } else if ($f_name == 'extract') {
                echo "<tr><td><b><a href='browse_extract.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
            } else if ($f_name == 'Target') {
                echo "<tr><td><b><a href='browse_target.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
            } else if ($f_name == 'IC50_nM') {
                echo "<tr><td><b><a href='browse_ic.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
            } else if ($f_name == 'EC50_nM') {
                echo "<tr><td><b><a href='browse_ec.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
            } else if ($f_name == 'Pubmed_id') {
                echo "<tr><td><b><a href='browse_pubmed.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
            } else if ($f_name == 'Assay_type') {
                echo "<tr><td><b><a href='c_browse_assay.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
            } else {
                echo "<tr><td><b><a href='browse.php?f=$f_name' style='text-decoration: none;'>$name_dis</a></b></td></tr>";
            }
        }
    }
    echo "<tr><td bgcolor='#3E6990' align='center' colspan=4><font color='white'><b>Other Inhibitors</b></font></td></tr>";
    echo "<tr><td><b><a href='browse_other_inhibitor.php' style='text-decoration: none;'>Peptides and other than small-molecule inhibitors</a></b></td></tr>";
    echo "</thead>";
    echo "</table>";
    echo "</div>";

    // New ADMET table with gap
   // New ADMET table with gap

}
?>
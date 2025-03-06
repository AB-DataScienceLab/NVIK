<?php
error_reporting(0);
# session_start();
include 'template-nidb_new.php';
include 'con1.php';
include 'functions.php';
# include'logo_nidb.html';
# include'simple_menu2.html';

print <<<HTML
<style type="text/css">
table.sample {
	border: 6px inset #8B8378;
	-moz-border-radius: 6px;
}
table.sample td {
	border: 1px solid black;
	padding: 0.2em 2ex 0.2em 2ex;
	color: black;
}
table.sample tr.d0 td {
	background-color: #FCF6CF;
}
table.sample tr.d1 td {
	background-color: #FEFEF2;
}

.row2 {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: 150px;
}
</style>
HTML;
if (! isset($_GET['page'])) {
    if (! isset($_GET['type']) && ! isset($_GET['antib_type_class']) && ! isset($_GET['name']) && ! isset($_GET['carrier_name'])) {
        $search = $_POST['hse'];
        $display = $_POST['hde'];
        $key1 = addslashes($_POST['key1']);
        $key1 = trim($key1);
        // print $key1."<br>";
        $key2 = addslashes($_POST['key2']);
        $key2 = trim($key2);
        # print $key2."<br>";
        $micro = addslashes($_POST['micro']);
        $micro = trim($micro);
        $type = $_POST['type'];
        $se_count = count($search);
        $de_count = count($display);
        $table = $_POST['table'];
        $rec_limit = $_POST['results'];
        $start_rec = 0;
        # echo $_POST['home_page'];
        if ($_POST['home_page'] == 'home') {
            # side();
            $type = 'similar';
            $table = 'data';
            $rec_limit = 25;
            # $awhe = se_all($table,$type,$key1);
            foreach ($_POST as $key => $value) {
                if ($_POST[$key] !== '' && $key !== 'home_page') {
                    $awhe = $awhe . "$key like '%$_POST[$key]%' and ";
                }
            }
            $awhe = preg_replace("/ and $/", "", $awhe);
            # echo $awhe."<br>";
            # echo "<br>$awhe<br>";
            $sql = "select * from data where " . "$awhe";
            # print "$sql";
            $res = mysql_query($sql) or die(mysql_error());
            $no_res = mysql_num_rows($res);
        } else {
            if ($search[0] == '' && $display[0] == '') {
                side();
                print "<br><br><br><br><br><br><br><br><font color='brown' size='4'><b>Please Select Fields to be Searched and Displayed !!!!</b></font><br><input type='button' value='Go Back' onClick='history.go(-1)'>";
                footer();
                exit();
            } 
            else if ($search[0] == '') {
                side();
                print "<br><br><br><br><br><br><br><br><font color='brown' size='4'><b>Please Select Fields to be Searched !!!!</b></font><br><input type='button' value='Go Back' onClick='history.go(-1)'>";
                footer();
                exit();
            } else if ($display[0] == '') {
                side();
                print "<br><br><br><br><br><br><br><br><font color='brown' size='4'><b>Please Select Fields to be Displayed !!!!</b></font><br><input type='button' value='Go Back' onClick='history.go(-1)'>";
                footer();
                exit();
            } else if ($type == '') {
                side();
                print "<br><br><br><br><br><br><br><br><font color='brown' size='4'><b>Please Select Search Type !!!!</b></font><br><input type='button' value='Go Back' onClick='history.go(-1)'>";
                footer();
                exit();
            } 
            else if ($key2 !== '' && $micro !== '') {
                if ($type == 'exact') { // //////////// For Exact....
                    $awhe = "name='$key2' and microbe='$micro'";
                } else if ($type == 'similar') { // ///// For Similar.....
                    $awhe = "name like '%$key2%' and microbe like '%$micro%'";
                }
                if ($display[0] == 'all') {
                    $bwhe = de_all($table);
                } else if ($display[0] !== 'all') {
                    $bwhe = de_selected($display, $table);
                }
                $sql = "$bwhe" . "$awhe";
                # print "$sql";
                $res = mysql_query($sql) or die(mysql_error());
                $no_res = mysql_num_rows($res);
            } 
            else if ($key2 !== '') {
                if ($type == 'exact') { // //////////// For Exact....
                    $awhe = "name='$key2'";
                } else if ($type == 'similar') { // ///// For Similar.....
                    $awhe = "name like '%$key2%'";
                }
                if ($display[0] == 'all') {
                    $bwhe = de_all($table);
                } else if ($display[0] !== 'all') {
                    $bwhe = de_selected($display, $table);
                }
                $sql = "$bwhe" . "$awhe";
                # print "$sql";
                $res = mysql_query($sql) or die(mysql_error());
                $no_res = mysql_num_rows($res);
            } 
            else if ($micro !== '') {
                if ($type == 'exact') { // //////////// For Exact....
                    $awhe = "microbe='$micro'";
                } else if ($type == 'similar') { // ///// For Similar.....
                    $awhe = "microbe like '%$micro%'";
                }
                if ($display[0] == 'all') {
                    $bwhe = de_all($table);
                } else if ($display[0] !== 'all') {
                    $bwhe = de_selected($display, $table);
                }
                $sql = "$bwhe" . "$awhe";
                # print "$sql";
                $res = mysql_query($sql) or die(mysql_error());
                $no_res = mysql_num_rows($res);
            } 
            else if ($search[0] == 'all' && $display[0] == 'all') { // ////////////////////// Search and Display in all fields /////////////
                $bwhe = de_all($table);
                $awhe = se_all($table, $type, $key1);
                $sql = "$bwhe" . "$awhe";
                # print "$sql";
                $res = mysql_query($sql) or die(mysql_error());
                $no_res = mysql_num_rows($res);
            } 
            else if ($search[0] !== 'all' && $display[0] !== 'all') { // ///////////// Search and display in selected fields ////////////
                $awhe = se_selected($search, $type, $key1);
                $bwhe = de_selected($display, $table);
                $sql = "$bwhe" . "$awhe";
                # print "$sql";
                $res = mysql_query($sql) or die(mysql_error());
                $no_res = mysql_num_rows($res);
            } 
            else if ($search[0] !== 'all' && $display[0] == 'all') { // ///////////// Search "selected" and display "all" //////////////
                $bwhe = de_all($table);
                $awhe = se_selected($search, $type, $key1);
                $sql = "$bwhe" . "$awhe";
                # print "$sql";
                $res = mysql_query($sql) or die(mysql_error());
                $no_res = mysql_num_rows($res);
            } 
            else if ($search[0] == 'all' && $display[0] !== 'all') { // ///////////// Search "all" and display "selected" //////////////
                $awhe = se_all($table, $type, $key1);
                $bwhe = de_selected($display, $table);
                $sql = "$bwhe" . "$awhe";
                # print "$sql";
                $res = mysql_query($sql) or die(mysql_error());
                $no_res = mysql_num_rows($res);
            }
        } // ////////////////////////// Simple Search Coding.....
    } else if (isset($_GET['type'])) { // ///////////////// Browse Classwise Coding Including Pagination Coding........ !!!!!!!!!!!!!
        $fname = $_GET['type'];
        $fval = $_GET[$fname];
        if (isset($_GET['mic'])) {
            $all_com = $_GET['com'];
            $all_com = preg_replace("/,/", " or NVIC_ID=", $all_com);
            $sql = "select * from $table where NVIC_ID=$all_com";
            # print $sql."<br>";
            /*
             * $mic = $_GET['mic'];
             * $fval = htmlentities($fval);
             * #$fval = trim($fval);
             * if(!preg_match('/\'/',$fval)){
             * $fval = addslashes($fval);
             * }
             * else{
             * $fval = stripslashes($fval);
             * }
             * $mic = htmlentities($mic);
             * #$mic = addslashes($mic);
             * echo"$fval##$mic<br>";
             * if(preg_match('/\w+/',$mic)){
             * $sql = "select * from $table where $fname='$fval' and activity='$mic'";
             * }
             * else{
             * $sql = "select * from $table where $fname='$fval' and activity=$mic";
             * }
             * print $sql."<br>";
             */
        } else if ($fname == 'plant_name' || $fname == 'origin' || $fname == 'part_used' || $fname == 'target_bacteria' || $fname == 'chem_class') {
            if ($fname == 'chem_class' && (preg_match("/\,/", $fval))) {
                $sql = "select * from $table where $fname='$fval'";
            } else if ($fname == 'chem_class' && ! (preg_match("/\,/", $fval))) {
                $sql = "select * from $table where $fname like '%$fval%'";
            } else {
                $sql = "select * from $table where $fname like '%$fval%'";
            }
        } else {
            $sql = "select * from $table where $fname='$fval'";
        }
        if ($fname == 'Pubchem_id') {
            if ($fval <= 315 && ! preg_match("/_self_drawn$/", $fval)) {
                $fval = $fval . "_self_drawn";
            }
            $sql = "select * from $table where $fname='$fval'";
        }
        # print $sql."<br>";
        $res = mysql_query($sql) or die(mysql_error());
        $no_res = mysql_num_rows($res);
        $start_rec = 0;
        $rec_limit = 150;
    }

    # print $sql."<br>";
    $_SESSION['skl'] = "$sql"; // /////////////////////// Pagination..............Coding.....!!!!!!!
    $_SESSION['start'] = 1;
    $_SESSION['rec_limit'] = $rec_limit;
    $total_page = $no_res / $rec_limit;
    if (preg_match("/\.\d+/", $total_page)) {
        $total_page = preg_replace("/\.\d+/", "", $total_page);
        $total_page = $total_page + 1;
        # print $total_page."<br>";
    }
    $_SESSION['total_page'] = $total_page;
    // print "$sql&nbsp;&nbsp;$rec_limit&nbsp;&nbsp;$no_res";
    if ($total_page > 1) {
        print "<br><a href='search-nidb.php?page=1'><b><center><img src='images/next.jpg' align='center' height='30'></center></b></a>";
    }
} 
if (isset($_GET['page'])) {
    $sql = $_SESSION['skl'];
    $total_page = $_SESSION['total_page'];
    $rec_limit = $_SESSION['rec_limit'];
    $page_no = $_GET['page'];
    if (($page_no == 0) || ! (isset($_GET['page']))) {
        $start_rec = $page_no * $rec_limit;
    } else {
        $start_rec = $rec_limit * $page_no;
    }
    $pre_page = $page_no - 1;
    $page_no = $page_no + 1;
    
    print "<div class='row2'>";
    if ($page_no > 1) {
        print "<div class='column'>";
        print "<a href='search-nidb.php?page=0'><b><img src='images/start.jpg' height='30'></b></a>";
    }
    print "</div>";
    
    if ($page_no > 1) {
        print "<div class='column'>";
        print "<a href='search-nidb.php?page=$pre_page'><b><img src='images/prev.jpg' height='30'></b></a>";
        print "</div>";
    }
    
    
    if ($page_no < $total_page) {
        # echo"$page_no";
        #
        
        if ($page_no == 1) {
            print "<div class='row2'>";
            print "<div class='column'>";
            print "<a href='search-nidb.php?page=$page_no'><b><img src='images/next.jpg' height='30'></b></a>";
        } else {
            print "<div class='column'>";
            print "<a href='search-nidb.php?page=$page_no'><b><img src='images/next.jpg'  height='30'></b></a>";
        }
        print "</div>";
    }
    // print $sql."<br>$total_page<br>$rec_limit";
    
    if ($page_no < $total_page && $total_page > 1) {
        $last = $total_page - 1;
        print "<div class='column'>";
        print "<a href='search-nidb.php?page=$last'><b><img src='images/last.jpg' height='30'></b></a>";
        print "</div>";
    }  
    print "</div>";
}

# print $res;
$total_res = mysql_query($sql) or die(mysql_error());
$total_records = mysql_num_rows($total_res);
$sql = $sql . " limit $start_rec,$rec_limit";
# print $sql;
$res = mysql_query($sql) or die(mysql_error());
$no_res = mysql_num_rows($res);
if ($no_res == 0) {
    # side();
    print "<br><font color='brown' size='6'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><center>No Record Found in NVI's database Corresponding to your keyword !!!</center></b></font><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<center><input type='button' value='Go Back' onClick='history.go(-1)'></center><br><br><br>";
} 
else {
    if (! isset($_GET['page'])) {
        $page_no = 1;
    }
    # echo"$total_page";
    if ($total_page > 1) {
        // print"<br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Page - $page_no of $total_page</b>";
    } else {
        // print"<br><br><br><br><br><br><br><br><br><br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Page - $page_no of $total_page</b>";
    }
    $headers = array(
        'NVIC_ID' => 'Compound ID',
        'compound_image' => 'Compound Structure',
        'Inhibitor_name' => 'Inhibitor',
        'IC50_nM' => 'IC50 (nM)',
        'Drug_bank_id' => 'Drug Bank ID',
        'Chemspider_id' => 'ChemSpider ID',
        'Target' => 'Target',
        'Assay_type' => 'Assay Type',
        'Assay_description' => 'Assay Description',
        'Assay_source' => 'Assay Source',
        'Outcome' => 'Outcome',
        'EC50_nM' => 'EC50 (in nM)',
        'Cell_type' => 'Cell Type',
        'Pubchem_id' => 'PubChem ID',
        'Reference' => 'Reference',
        'Curator_email_id' => 'Curator Email ID',
        'Data_QC_email_id' => 'Data QC Email ID',
        'ref3' => 'Curator',
        'date' => 'Date',
        'MW' =>'Molecular Weight (in g/mol)',
        'LogP'=> 'LogP',
        'TPSA' => 'Topological Polar Surface Area (&#197;)',
        'HBD' => 'H-bond Donor',
        'HBA'=> 'H-bond Acceptor',
        'RB'=> 'No. of Rotatable Bonds',
        'n_ring' => 'No. of Rings',
        'n_nitro' => 'No. of N',
        'n_O' => 'No. of O',
        'n_S' => 'No. of S',
        "Pubmed_id" =>"PUBMED ID",
        'mol_formula' => 'Molecular Formula',
        "Smiles" => "SMILES",
        "Inchi_Smiles" => "InChI (The International Chemical Identifier)",
    );

    # $headers = array('compound_id' => 'Compound ID','compound_image' => 'Compound Structure','plant_name' => 'Plant Source','plant_family' => 'Source Family','origin' => 'Origin','com_name' => 'Common Name','part_used' => 'Plant Part Used','extract' => 'Extract','target_bacteria' => 'Target Bacteria','assay_test' => 'Assay / Test Done','pos_control' => 'Positive Control Used (conc.)','inhibition' => 'Inhibition [%]','activity' => 'Activity [MIC] &micro;g/ml','activity_in_dilutn' => 'Activity (In terms of dilution)','inhibition_zone' => 'Activity (Zone of inhibition in mm)','active_comp_identified' => 'Active Compound Identified','Pubchem_id' => 'PubChem ID','ethno_med_info' => 'Ethnomedicinal Information','pubmed_source_lit' => 'PubMed ID [Source Literature]','ext_pre' => 'Extract Preparation','source_class' => 'Classification [Source Based]','chem_class' => 'Chemical Classification [Active Compound]','tar_pro' => 'Target Protein','media_antimicro_test' => 'Media / Broth Used [Antimicrobial Assay/Test]','conc_pos_control' => 'Active Concentration [Positive Control]','cyto_assay' => 'Cytotoxicity Assay [AID]','cyto_conc_ext' => 'Cytotoxic Concentration of Extract / Active Compound [&micro;g/ml]','ref1' => 'Reference(s)','ref2' => 'Reference 2','ref3' => 'Curator', 'date' => 'Date', 'mol_wt' => 'Molecular Weight', 'xlog_p' => 'XLogP', 'tpsa' => 'PSA', 'hb_d' => 'H-bond Donor', 'hb_a' => 'H-bond Acceptor', 'n_rot_bond' => 'No. of Rotatable Bond Count', 'n_ring' => 'No. of Rings', 'n_nitro' => 'No. of N', 'n_O' => 'No. of O', 'n_S' => 'No. of S', 'mol_formula' => 'Molecular Formula', 'smiles' => 'SMILES');
    /*
     * print"<span align='left' style='background: #DDE026; text-color: white; height: 22px'>";
     * echo"<form action='download_data.php' method=post>";
     * echo"<input type=hidden name=id value='$down_fi_name'>";
     * echo"<br><input type=submit name=DOWNLOAD value='Download: Tab-Delimited'>";
     * echo"</form>";
     * print"</span><br>";
     */
    $rec = $start_rec + 1;
    while ($row = mysql_fetch_array($res)) {
        $mol_id = $row['NVIC_ID'];
        $pubchem = $row['Pubchem_id'];
        # echo"$pubchem";
        # print"<center>Page - $page_no of $total_page</center>";
        print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<center><b>Record - $rec of $total_records</b>&nbsp;&nbsp;&nbsp;<a href='#top'><b>[TOP]</b></a><br>";
        print "<table width='1020px' border=3px; style='border-collapse: collapse; border-color: black;'>";
        $f_no = mysql_num_fields($res);
        # print $f_no."<br>";
        for ($j = 0; $j < $f_no; $j ++) {
            $f_name = mysql_field_name($res, $j);
            $r = $row[$f_name];
            if ($f_name == 'weblink') {
                if (preg_match("/^PMC/", $r)) {
                    print "<tr><td width='15%' bgcolor='green'><font  color='white'><b>" . $headers[$f_name] . "</font></b></td><td bgcolor='white'><a href='http://www.pubmedcentral.nih.gov/articlerender.fcgi?artid=$r&tool=pmcentrez&rendertype=abstract' target='_blank'><b>$r</b></a></td></tr>";
                } else if (preg_match("/^\d+/", $r)) {
                    print "<tr><td width='15%' bgcolor='green'><font  color='white'><b>" . $headers[$f_name] . "</font></b></td><td bgcolor='white'><a href='http://www.ncbi.nlm.nih.gov/pubmed/$r?dopt=Abstract' target='_blank'><b>$r</b></a></td></tr>";
                } else if (preg_match("/^TUMS/", $r)) {
                    $r = preg_replace("/TUMS ID: /", "", $r);
                    print "<tr><td width='15%' bgcolor='green'><font  color='white'><b>" . $headers[$f_name] . "</font></b></td><td bgcolor='white'><a href='http://journals.tums.ac.ir/abs.aspx?org_id=59&culture_var=en&journal_id=9&segment=fa&keyword=G&issue_id=1186&manuscript_id=$r' target='_blank'><b>TUMS Journals</b></a></td></tr>";
                } else {
                    print "<tr><td width='15%' bgcolor='green'><font  color='white'><b>" . $headers[$f_name] . "</font></b></td><td bgcolor='white'>$r</td></tr>";
                }
            } else if ($f_name == 'bcsdb') {
                $r = $row[$f_name];
                $all_bcsdb = split(",", $r);
                print "<tr><td width='15%' bgcolor='green'><font  color='white'><b>" . $headers[$f_name] . "</font></b></td><td bgcolor='white'>";
                foreach ($all_bcsdb as $sin) {
                    if ($sin == '') {
                        print "N/A";
                    } else {
                        print "<a href='http://csdb.glycoscience.ru/bacterial/core/search_id.php?database=bacterial&id_list=$sin&mode=record' target='_blank'><b>$sin</b></a></br>";
                    }
                }
                print "</td></tr>";
            } else if ($f_name == 'plant_name' || $f_name == 'com_name') {
                if ($f_name == 'plant_name') {
                    $com_name = $row['com_name'];
                    $r = $row[$f_name];
                    print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>" . $headers[$f_name] . "</font></b></td><td bgcolor='white'>$r &nbsp;&nbsp;&nbsp;&nbsp;<b>Common Name:</b>$com_name</td></tr>";
                }
            } 
            else if ($f_name == 'compound_image') {
                $dir = '';
                $pub_id = $row['NVIC_ID'];
                if (preg_match("/\d+_self_drawn/", $pub_id)) {
                    $dir = 'data/Structures_Marvin_updated';
                    $pub_id = preg_replace("/_self_drawn/", '', $pub_id);
                } else if (preg_match("/\d#SID/", $pub_id)) {
                    $pub_id = preg_replace("/#.*/", '', $pub_id);
                    $dir = 'data/structures_updated';
                    # print $pub_id."<br>";
                } else if (preg_match("/\d+/", $pub_id)) {
                    $dir = 'data/Structures_Marvin_updated';
                }
                if (preg_match("/\d+/", $pub_id)) {
                    print "<tr><td width='15%' bgcolor='#3E6990' valign='top'><font  color='white'><b>" . $headers[$f_name] . "</font></b></td><td bgcolor='white' align='left' valign='top'>";
                    /*
                     * echo'<center>
                     * <APPLET CODE="StructureEditorApplet.class" CODEBASE="sda/" width=700 height=450>';
                     * echo"
                     * <PARAM name=\"molFile\" value=\"$dir/$pub_id.MOL\">";
                     * echo'
                     * <PARAM name="maximizeScreen" value="yes">
                     * <PARAM name="backgroundColor" value="#FFFFFF">
                     * </APPLET></center>
                     * </td></tr>';
                     */
                    if (! file_exists("store_data/str_images_updated/$pub_id.png")) {

                        $a = file("./633_reloaded_2_smiles.smiles");
                        foreach ($a as $b) {
                            $all = split("\t", $b);
                            $smi_id = $all[1];
                            $smi = $all[0];
                            $smi = preg_replace("\n$", "", $smi);
                            if (preg_match("/.*$pub_id.*/", $smi_id)) {
                                # print $all[0]."<br>";
                                # print $idi;
                                exec("/usr/bin/obabel -:\"$all[0]\" -O store_data/str_images_updated/$pub_id.png");
                                print "<img src='store_data/str_images_updated/$pub_id.png' width='450' height='350'>";
                                # echo"Test";
                                /*
                                 * print<<<HTML
                                 * <applet name="jmol" code="JmolApplet" archive="JmolApplet.jar" width="400" height="350" align="left">
                                 * <param name="load" value="sdf_files/$pub_id.SDF">
                                 * <param name="progressbar" value="true">
                                 * <param name="script" value="
                                 * spin off;
                                 * ribbons on;
                                 * select ligand; color brown; zoom 100%; Spacefill 40%;
                                 * background white;
                                 * label off;
                                 * ">
                                 * </applet>
                                 * HTML;
                                 */
                                $dir_3D_mol = "$dir";
                                $dir_2D_mol = '2D_mol';
                                echo "<table>";
                                echo "<tr>";
                                echo "<td>";
                                echo "<form action='download_3Dmol.php' method=post>";
                                echo "<input type=hidden name=id value=$pub_id>";
                                echo "<input type=hidden name=db_id value=$mol_id>";
                                echo "<input type=hidden name=dir value='$dir_3D_mol'>";
                                echo "<br><b>DOWNLOAD:</b> <input type=submit name=DOWNLOAD value='3D MOL'>";
                                echo "</form>";
                                echo "</td>";
                                echo "<td>";
                                echo "<form action='download_2Dmol.php' method=post>";
                                echo "<input type=hidden name=id value=$pub_id>";
                                echo "<input type=hidden name=db_id value=$mol_id>";
                                echo "<input type=hidden name=dir value='$dir_2D_mol'>";
                                echo "<input type=submit name=DOWNLOAD value='2D MOL'>";
                                echo "</form>";
                                echo "</td>";
                                $dir_3D_sdf = 'sdf_files';
                                $dir_2D_sdf = '2D_sdf';
                                echo "<td>";
                                echo "<form action='download_3Dsdf.php' method=post>";
                                echo "<input type=hidden name=id value=$pub_id>";
                                echo "<input type=hidden name=db_id value=$mol_id>";
                                echo "<input type=hidden name=dir value='$dir_3D_sdf'>";
                                echo "<input type=submit name=DOWNLOAD value='3D MOL'>";
                                echo "</form>";
                                echo "</td>";
                                echo "<td>";
                                echo "<form action='download_2Dsdf.php' method=post>";
                                echo "<input type=hidden name=id value=$pub_id>";
                                echo "<input type=hidden name=db_id value=$mol_id>";
                                echo "<input type=hidden name=dir value='$dir_2D_sdf'>";
                                echo "<input type=submit name=DOWNLOAD value='2D MOL'>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                                echo "</table>";
                                # prasun
                                # print"<img src='http://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?t=l&cid=$all[0]'>";
                                # prasun
                                break;
                            }
                            # print "$b<br>";
                        }
                    } else {
                        print "<img src='store_data/str_images_updated/$pub_id.png' width='450' height='350'>";
                        # echo"Test";
                        /*
                         * print<<<HTML
                         * <applet name="jmol" code="JmolApplet" archive="JmolApplet.jar" width="400" height="350" align="left">
                         * <param name="load" value="sdf_files/$pub_id.SDF">
                         * <param name="progressbar" value="true">
                         * <param name="script" value="
                         * spin off;
                         * ribbons on;
                         * select ligand; color brown; zoom 100%; Spacefill 40%;
                         * background white;
                         * label off;
                         * ">
                         * </applet>
                         * HTML;
                         */
                        $dir_3D_mol = "$dir";
                        $dir_2D_mol = 'data/structures_2d_updated';
                        echo "<table>";
                        echo "<tr>";
                        echo "<td>";
                        echo "<form action='download_3Dmol.php' method=post>";
                        echo "<input type=hidden name=id value=$pub_id>";
                        echo "<input type=hidden name=db_id value=$mol_id>";
                        echo "<input type=hidden name=dir value='$dir_3D_mol'>";
                        echo "<b>DOWNLOAD:</b> <input type=submit name=DOWNLOAD value='3D MOL'>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form action='download_2Dmol.php' method=post>";
                        echo "<input type=hidden name=id value=$pub_id>";
                        echo "<input type=hidden name=db_id value=$mol_id>";
                        echo "<input type=hidden name=dir value='$dir_2D_mol'>";
                        echo "<input type=submit name=DOWNLOAD value='2D MOL'>";
                        echo "</form>";
                        echo "</td>";
                        $dir_3D_sdf = 'data/Structures_Marvin_sdf_updated';
                        $dir_2D_sdf = 'data/structures_2d_updated';
                        echo "<td>";
                        echo "<form action='download_3Dsdf.php' method=post>";
                        echo "<input type=hidden name=id value=$pub_id>";
                        echo "<input type=hidden name=db_id value=$mol_id>";
                        echo "<input type=hidden name=dir value='$dir_3D_sdf'>";
                        echo "<input type=submit name=DOWNLOAD value='3D SDF'>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form action='download_2Dsdf.php' method=post>";
                        echo "<input type=hidden name=id value=$pub_id>";
                        echo "<input type=hidden name=db_id value=$mol_id>";
                        echo "<input type=hidden name=dir value='$dir_2D_sdf'>";
                        echo "<input type=submit name=DOWNLOAD value='2D SDF'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                        echo "</table>";
                    }
                    echo '</td></tr>';
                } 
                else {
                    print "<tr><td width='15%' bgcolor='#3E6990' valign='top'><font  color='white'><b>" . $headers[$f_name] . "</font></b></td><td bgcolor='white'>$pub_id</td></tr>";
                }
            } 
            else if ($f_name == 'microbe') {
                $f_value = $row[$f_name];
                $complete = split(" ", $f_value);
                $cnt = count($complete);
                if ($cnt > 2) {
                    $mic = $complete[0] . " " . $complete[1];
                    # print $mic."<br>";
                } else if ($cnt <= 2) {
                    $mic = $f_value;
                    # print $mic."<br>";
                }
                print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>$headers[$f_name]</b></font></td><td bgcolor='white'>$f_value&nbsp;&nbsp;&nbsp;<a href='http://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?name=$f_value&lvl=0' target='_blank'><b>(NCBI Taxonomy)</b></a>&nbsp;&nbsp;&nbsp;<a href='http://crdd.osdd.net/drugpedia/index.php/$mic' target='_blank'><b>(Drugpedia)</b></a></td></tr>";
            } 
            else if ($f_name == 'iedb_id') {
                $f_value = $row[$f_name];
                if (! $f_value == '') {
                    print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>$headers[$f_name]</b></font></td><td bgcolor='white'><a href='http://www.immuneepitope.org/epId/$f_value' target='_blank'><b>$f_value</b></a></td></tr>";
                } else {
                    print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>$headers[$f_name]</b></font></td><td bgcolor='white'>N/A</td></tr>";
                }
            } 
            else if ($f_name == 'name') {
                $f_value = ucfirst($row[$f_name]);
                $f_value2 = $row['drugpedia'];
                print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>$headers[$f_name]</b></font></td><td bgcolor='white'>$f_value&nbsp;<a href='http://crdd.osdd.net/drugpedia/index.php/$f_value2' target='_blank'><b>(Drugpedia)</b></a></td></tr>";
            } // Add pubmed ID to the link
            else if ($f_name == 'pubmed_source_lit') {
                $f_value = $row[$f_name];
                print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>$headers[$f_name]</b></font></td><td bgcolor='white'>&nbsp;<a href='https://www.ncbi.nlm.nih.gov/pubmed/$f_value' target='_blank'><b>$f_value</b></a></td></tr>";
            } // Add ChemSpider ID to the link
            else if ($f_name == 'chemspider') {
                $f_value = $row[$f_name];
                print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>$headers[$f_name]</b></font></td><td bgcolor='white'>&nbsp;<a href='http://www.chemspider.com/Chemical-Structure.$f_value.html' target='_blank'><b>$f_value</b></a></td></tr>";
            } 
            else if ($f_name == 'Pubchem_id') {
                $f_value = $row[$f_name];
                if (preg_match("/\d+_self_drawn/", $f_value)) {
                    # print'Captured!!';
                    $f_value = 'NR';
                    print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>$headers[$f_name]</b></font></td><td bgcolor='white'>$f_value</td></tr>";
                } else if (preg_match("/#.*/", $f_value)) {
                    $f_value = preg_replace("/#.*/", '', $f_value);
                    print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>$headers[$f_name]</b></font></td><td bgcolor='white'>&nbsp;<a href='http://pubchem.ncbi.nlm.nih.gov/summary/summary.cgi?sid=$f_value' target='_blank'><b>$f_value</b></a></td></tr>";
                } else if ($f_value == '' || $f_value == 'NR' || $f_value == 'N/A') {
                    $f_value = 'NR';
                    print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>$headers[$f_name]</b></font></td><td bgcolor='white'>$f_value</td></tr>";
                } else {
                    print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>$headers[$f_name]</b></font></td><td bgcolor='white'>&nbsp;<a href='http://pubchem.ncbi.nlm.nih.gov/summary/summary.cgi?cid=$f_value' target='_blank'><b>$f_value</b></a></td></tr>";
                }
            } else if (($f_name == 'mol_wt' || $f_name == 'mol_formula' || $f_name == 'smiles' || $f_name == 'xlog_p' || $f_name == 'tpsa' || $f_name == 'hb_d' || $f_name == 'hb_a' || $f_name == 'n_rot_bond' || $f_name == 'n_ring' || $f_name == 'n_nitro' || $f_name == 'n_O' || $f_name == 'n_S')) {
                if ($pubchem != '' && $pubchem != 'NR' && $pubchem != 'N/A') {
                    if ($f_name == 'mol_formula') {
                        $f_value = $row[$f_name];
                        $break = preg_split("//", $f_value);
                        $c = sizeof($break);
                        print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>$headers[$f_name]</b></font></td><td bgcolor='white'>";
                        for ($m = 0; $m < $c; $m ++) {
                            if ($break[$m] == '1' | $break[$m] == '2' | $break[$m] == '3' | $break[$m] == '4' | $break[$m] == '5' | $break[$m] == '6' | $break[$m] == '7' | $break[$m] == '8' | $break[$m] == '9' | $break[$m] == addslashes('0')) {
                                echo "<sub>$break[$m]</sub>";
                            } else {
                                echo "$break[$m]";
                            }
                        }
                        print "</td></tr>";
                    } else {
                        $r = ucfirst($r);
                        print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>" . $headers[$f_name] . "</font></b></td><td bgcolor='white'>$r</td></tr>";
                    }
                }
            } else if ($f_name == 'ref1') {
                $f_value = $row[$f_name];
                $all_ref = explode("#", $f_value);
                print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>" . $headers[$f_name] . "</font></b></td><td bgcolor='white'>";
                $ref_no = 1;
                foreach ($all_ref as $r) {
                    echo "<b>$ref_no)</b> $r<br><br>";
                    $ref_no ++;
                }

                echo "</td></tr>";
            } 
            else { // ///////////////////// Simple Field Printing.........
                   # $r = ucfirst($r);
                print "<tr><td width='15%' bgcolor='#3E6990'><font  color='white'><b>" . $headers[$f_name] . "</font></b></td><td bgcolor='white'>$r</td></tr>";
            }
        }
        print "</table><br>";
        $rec ++;
    }
}
# ## Start of bottom pagination

if (isset($_GET['page'])) {

    print "<div class='row2' style=\"margin-right: 160px;\">";
    if ($page_no > 1) {
        print "<div class='column'>";
        print "<a href='search-nidb.php?page=0'><b><img src='images/start.jpg' height='30'></b></a>";
    }
    print "</div>";
    
    if ($page_no > 1) {
        print "<div class='column'>";
        print "<a href='search-nidb.php?page=$pre_page'><b><img src='images/prev.jpg' height='30'></b></a>";
        print "</div>";
    }
    
    
    if ($page_no < $total_page) {
        # echo"$page_no";
        #
        
        if ($page_no == 1) {
            print "<div class='row2' style=\"margin-right: 160px;\">";
            print "<div class='column'>";
            print "<a href='search-nidb.php?page=$page_no'><b><img src='images/next.jpg' height='30'></b></a>";
        } else {
            print "<div class='column'>";
            
            print "<a href='search-nidb.php?page=$page_no'><b><img src='images/next.jpg'  height='30'></b></a>";
        }
        print "</div>";
    }
    // print $sql."<br>$total_page<br>$rec_limit";
    
    if ($page_no < $total_page && $total_page > 1) {
        $last = $total_page - 1;
        print "<div class='column'>";
        print "<a href='search-nidb.php?page=$last'><b><img src='images/last.jpg' height='30'></b></a>";
        print "</div>";
    }

    print "</div>";
}
elseif ($page_no < $total_page){
    print "<div class='row2' style=\"margin-right: 160px;\">";
    print "<div class='column'>";
    print "<a href='search-nidb.php?page=$page_no'><b><img src='images/next.jpg' height='30'></b></a>";
    print "</div>";
    print "</div>";
}

### End of bottom pagination
?>

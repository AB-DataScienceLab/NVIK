<?php
include 'template-nidb_new.php';
include 'con1.php';
include 'sidemenu.php';

print <<<HTML
<title>NVIK Physicochemical Properties</title>
<style>
a.rollover img {
    width: 180px;
    height: 175px;
}

a.rollover:hover > img {
    width: 220px;
    height: 215px;
}

th { 
    word-wrap: break-word;
    max-width: 150px; 
}
h4 {
           
            padding: 10px 15px;
        }

.zoomable-image {
    transition: transform 0.3s ease; /* Smooth zoom transition */
}

.zoomable-image.zoomed {
    transform: scale(2); /* Zoom level */
    cursor: zoom-out; /* Change cursor when zoomed */
}
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* Image styles */
.zoomable-image {
    transition: transform 0.3s ease; /* Smooth transition for zoom effect */
}

.zoomable-image.zoomed {
    transform: scale(2); /* Zoom factor */
    cursor: zoom-out; /* Change cursor on zoom */
}

/* Centering container for aesthetics */
.plot-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
}
</style>
<br><br>


<div class="plot-container" style="text-align: center; margin-bottom: 20px;">
        <img id="plot-image" 
             src="./images/Circular_plot_NVIK_final (1).png" 
             alt="Physicochemical Properties Plot" 
             class="zoomable-image" 
             style="width: 600px; height: auto; margin-bottom: 10px; cursor: zoom-in;">
        <h4>
            Circular plot illustrating the overall distribution of physicochemical properties of 142 small molecule NVIs
        </h4>
    </div>
    <script src="js/zoomimg.js"></script>

<br><br>
<center>
<h4><b>Table:Physicochemical Properties of NVIs</b></h4>
<table id='tableTwo' class='yui' border='3' style='margin-right: 30px';>
<thead>
<tr>
    <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>NVIC Structure</b></font></th>
    <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>NVIC ID</b></font></th>
    <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>Molecular Weight</b></font></th>
    <th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>H-bond Acceptor</b></font></th>
     <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>H-bond Donor</b></font></th>
      
    <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>Rotatable bonds</b></font></th>
     <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>LogP</b></font></th>
      <th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>TopoPSA</b></font></th>
    
   
    
   
</tr>
</thead>
<tbody>
HTML;

// Database query and table generation
$result = mysql_query("SELECT  NVIC_ID,NVIC_ID,MW,HBA, HBD, RB, LogP,TPSA FROM data_2024 WHERE NVIC_ID REGEXP '[[:digit:]]' OR NVIC_ID REGEXP '%_self_drawn' GROUP BY NVIC_ID") or die(mysql_error());

while ($sep_val = mysql_fetch_array($result)) {
    $pub_id = $sep_val[1];
    
    // Display molecule images and data
    if ($pub_id == $pub_id) {
        print "<tr><td align='center'><a href='search-nidb.php?NVIC_ID=$pub_id&type=NVIC_ID' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><br><a href='' class='rollover'><img src='store_data/str_images_updated/$pub_id.png' width='180' height='105'></a></td>";
    } else {
        print "<tr><td align='center'><a href='search-nidb.php?pubchem_id=$sep_val[0]&type=pubchem_id' title='Click to See Details' target='_blank'><b><i>$sep_val[0]</i></b></a><br><a href='' class='rollover'><img src='http://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?t=l&cid=$sep_val[0]' width='180' height='105'></a></td>";
    }
    
    // Loop to print additional columns
    for ($i = 1; $i <= 7; $i++) {
        print "<td align='center'>$sep_val[$i]</td>";
    }
    print "</tr>";
}

print <<<HTML
</tbody>
<tfoot></tfoot>
</table>
<br><br>
<center><a href='#top' style='text-decoration: none;'><b>[Top]</b></a></center>
<br>
HTML;
include ('footerfix.html');
?>

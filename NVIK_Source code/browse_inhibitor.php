<?php
include 'template-nidb_new.php';
include 'con1.php';

if (isset($_GET['f'])) { 
    $fname = $_GET['f']; 
}

global $fname;
$fname = 'Inhibitor_name';
include 'for_browse.php';

print "<div width='1000'>";
print "<center><h2>Browse</h2></center>";

if ($fname == 'Inhibitor_name') {
    side_bar();
    $all_rec = file("nipah_inhibitor_sort.txt");
    $rec = count($all_rec);
    print "<b><center>Inhibitor_Name (Unique) = 142</center></b><br>";
    print "<table bordercolor='black' border='3' align='center' id='tableTwo' class='yui'>";
    print "<thead><tr>
        <th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>Sr. No</b></font></th>
        <th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>NVIC ID</b></font></th>
        <th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>Inhibitors</b></font></th>
        <th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>No. of Entries</b></font></th>
        </tr></thead>";
    
  $result = fopen('nipah_inhibitor_sort.txt', 'r'); 
$sr_no = 1;

echo "<tbody>";
while (!feof($result)) {
    $name = fgets($result);
    $name = preg_replace("/\n$/", "", $name);
    $name = trim($name); // Remove extra whitespace or newlines
    $name = addslashes($name); // Prevent SQL injection

    if (!empty($name)) {
        // Query to get NVIC_ID and count of inhibitors
        $query = "SELECT NVIC_ID, COUNT(*) AS entry_count 
                  FROM data_2024 
                  WHERE Inhibitor_name = '$name'";
        $res = mysql_query($query) or die("Query Failed: " . mysql_error());

        // Fetch data
        if ($row = mysql_fetch_assoc($res)) {
            $cls_id = $row['NVIC_ID']; // Fetch NVIC_ID value
            $entry_count = $row['entry_count']; // Fetch count of inhibitors

            echo "<tr>";
            echo "<td>$sr_no</td>"; // Serial number column

            // NVIC_ID column with clickable link and image
            echo "<td valign='top' align='center'>
                    <a href='search-nidb.php?NVIC_ID=$cls_id&type=NVIC_ID' title='Click to See Details' target='_blank'>
                        <b><i>$cls_id</i></b>
                    </a> 
                    
                  </td>";

            echo "<td><a href='search-nidb.php?Inhibitor_name=" . urlencode($name) . "&type=Inhibitor_name'><b><i>$name</i></b></a></td>"; // Inhibitor Name column
            echo "<td>$entry_count</td>"; // No. of Entries column
            echo "</tr>";
        } else {
            // Row for inhibitor names not found in the database
            echo "<tr>";
            echo "<td>$sr_no</td>"; // Serial number column
            echo "<td>Not Found</td>"; // NVIC_ID column
            echo "<td><i>$name</i></td>"; // Inhibitor Name column
            echo "<td>0</td>"; // No. of Entries column (0 for missing entries)
            echo "</tr>";
        }
        $sr_no++;
    }
}
echo "</tbody>";


    print "</table><br><br>";
    fclose($result);
}
print "</div>";
?>

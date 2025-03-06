<?php
include 'template-nidb_new1.php';
include 'con2.php'; // Use PDO connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Advanced NVIK Query Builder</title>
    <link href="bootstrap-v3.min.css" rel="stylesheet">
    <link href="css/theme.bootstrap.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/tablesorter.min.js"></script>
    <script src="js/tablesorter.bootstrap.min.js"></script>
    
    <!-- Your custom scripts -->
    <script src="scripts.js"></script>
</head>
<body>
    <center><h2><b>Query Builder</b></h2></center>
    <p class='center-text'><b>
        Users may build complex queries using the logical operators 'AND' and 'OR'. Each sub-query can be built using other operators such as LIKE, NOT LIKE, EQUAL and NOT EQUAL TO while dealing with strings like words or letters and =, !=, <=, >=, < and > while dealing with numerical values.
        The Query builder aids to the flexibility of performing search on a number of fields simultaneously.
    </b></p>
<form name='form1' action='complex_query.php' method='post' onsubmit="return formValidation(this);" class="container">
    <div id="queryContainer">
        <!-- Query Block 1 -->
        <div class="query-block">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="field1">Field 1:</label>
                    <select name="field[]" class="form-control" required>
                        <option value="all">All Fields</option>
                             <option value="NVIC_ID">NVIC ID</option>
                             <option value="Inhibitor_name">Inhibitor</option>
                             <option value="Target">Target</option>
                             <option value="Assay_type">Assay Type</option>
                             
                             
                             <option value="IC50_nM">IC50 (nM)</option>
                             <option value="EC50_nM">EC50 (nM)</option>
                             <option value="Outcome">Outcome</option>
                             <option value="Pubmed_id">PubMed ID</option>
                             <option value="MW">Molecular Weight</option>
                             <option value="HBA">HBA</option>
                            <option value="HBD">HBD</option>
                            <option value="RB">RB</option>
                            <option value="LogP">LogP</option>
                            <option value="TPSA">TPSA</option>
                            <option value="Pubmed_id">PubMed ID</option>
                        
                   
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Operator:</label>
                    <select name="field_op[]" class="form-control" required>
                        <option value="like">LIKE</option>
                        <option value="not like">NOT LIKE</option>
                        <option value="equal">EQUAL</option>
                        <option value="not_equal">NOT EQUAL</option>
                        <option value="<">&lt;</option>
                        <option value=">">&gt;</option>
                        <option value="<=">&lt;=</option>
                        <option value=">=">&gt;=</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Keyword:</label>
                    <input type='text' name='keyword[]' class="form-control" required>
                </div>
            </div>

            <!-- Logical Operator after the first block -->
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="logic1">Logical Operator:</label>
                    <select name="logic_op[]" id="logic1" class="form-control">
                        <option value="AND">AND</option>
                        <option value="OR">OR</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Field Button -->
    <div class="form-group row">
        <div class="col-md-12">
            <button type="button" class="btn btn-info" id="addFieldButton">Add Field</button>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="form-group row">
        <div class="col-md-12">
            <input type='submit' value='Search' class="btn btn-success">
        </div>
    </div>
</form>

    </form>

    <br><br>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['keyword'])) {
    $keywords = $_POST['keyword'];
    $fields = $_POST['field'];
    $field_ops = $_POST['field_op'];
    $logic_ops = isset($_POST['logic_op']) ? $_POST['logic_op'] : [];

    $table = 'data_2024';
    $params = [];
    $conditions = [];
    $query_preview = '';

    foreach ($keywords as $i => $keyword) {
        $keyword = trim($keyword);
        if (empty($keyword) && empty($fields[$i])) continue;

        $field_val = $fields[$i];
        $field_op_val = $field_ops[$i];

        $allowed_fields = ['all', 'NVIC_ID', 'Inhibitor_name', 'Assay_type', 'Target', 'MW', 'IC50_nM', 'EC50_nM', 'Outcome', 'Pubmed_id','HBA','HBD','RB','TPSA','LogP'];
        $allowed_ops = ['like', 'not like', 'equal', 'not_equal', '=', '!=', '<=', '>=', '<', '>'];
        if (!in_array($field_val, $allowed_fields)) continue;
        if (!in_array(strtolower($field_op_val), $allowed_ops)) continue;

        if ($field_val === 'all') {
            $stmt = $pdo->prepare("SHOW COLUMNS FROM $table");
            $stmt->execute();
            $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $sub_conditions = [];
            foreach ($columns as $col) {
                if (in_array($col, ['compound_image'])) continue;
                switch (strtolower($field_op_val)) {
                    case 'like':
                    case 'not like':
                        $sub_conditions[] = "$col $field_op_val ?";
                        $params[] = "%$keyword%";
                        break;
                    case 'equal':
                        $sub_conditions[] = "$col = ?";
                        $params[] = $keyword;
                        break;
                    case 'not_equal':
                        $sub_conditions[] = "$col != ?";
                        $params[] = $keyword;
                        break;
                    default:
                        break;
                }
            }
            
            $conditions[] = '(' . implode(' OR ', $sub_conditions) . ')';
        } else {
            switch (strtolower($field_op_val)) {
                case 'like':
                    $conditions[] = "$field_val $field_op_val ?";
                    $params[] = "%$keyword%";
                    break;
                case 'not like':
                    $conditions[] = "$field_val $field_op_val ?";
                    $params[] = "%$keyword%";
                    break;
                case 'equal':
                    $conditions[] = "$field_val = ?";
                    $params[] = $keyword;
                    break;
                case 'not_equal':
                    $conditions[] = "$field_val != ?";
                    $params[] = $keyword;
                    break;
                case '<':
                case '>':
                case '<=':
                case '>=':
                    $conditions[] = "$field_val $field_op_val ?";
                    $params[] = is_numeric($keyword) ? $keyword : 0; // Default to 0 if not numeric
                    break;
                default:
                    break;
            }
        }

        $query_preview .= "Field: $field_val, Operator: $field_op_val, Keyword: $keyword<br>";

        // Append the logical operator, except for the last field
        if (isset($logic_ops[$i]) && $i < count($keywords) - 1) {
            $conditions[] = $logic_ops[$i];
            $query_preview .= "Logical Operator: {$logic_ops[$i]}<br>";
        }
    }

    if (count($conditions) > 0) {
        $query = "SELECT * FROM $table WHERE " . implode(" ", $conditions);
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $hits = $stmt->rowCount(); // Get the number of rows returned by the query

        echo "<h3>Query Results</h3>";
        echo "<p><b>Query Preview:</b></p>";
        echo "<p>$query_preview</p>";
        echo "<p><b>Number of Hits:</b> $hits</p>"; // Display the number of hits

        if ($hits > 0) {
            echo "<table class='table table-striped'>";
            echo "<thead><tr>";
            foreach (array_keys($results[0]) as $header) {
                echo "<th>" . htmlspecialchars($header) . "</th>";
            }
            echo "</tr></thead>";
            echo "<tbody>";
            foreach ($results as $row) {
                echo "<tr>";
                foreach ($row as $header => $cell) {
                    // Check if the column header is 'Reference' and render as a link if it's a valid URL
                    if ($header === 'Reference' && filter_var($cell, FILTER_VALIDATE_URL)) {
                        echo "<td><a href='" . htmlspecialchars($cell) . "' target='_blank'>" . htmlspecialchars($cell) . "</a></td>";
                    } else {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No results found.</p>";
        }
        // Provide download link for CSV
        echo "<form action='download.php' method='post'>";
        echo "<input type='hidden' name='results' value='" . base64_encode(json_encode($results)) . "'>";
        echo "<input type='submit' value='Download CSV' class='btn btn-primary'>";
        echo "</form>";
    } else {
        echo "<p>No valid search criteria provided.</p>";
    }
}
include ('footerfix.html');
?>
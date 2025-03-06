 <?php
include 'template-nidb_new1.php';

// Path to the CSV file
$csvFile = 'data/ADMET admetsar/admetsar_absorption.csv';

// Function to read the CSV file and return the data as an array
function readCSV($csvFile) {
    $data = [];
    if (($handle = fopen($csvFile, 'r')) !== FALSE) {
        while (($row = fgetcsv($handle, 2000, ',')) !== FALSE) {
            $data[] = $row;
        }
        fclose($handle);
    } else {
        echo "Error opening the file.";
    }
    return $data;
}

$data = readCSV($csvFile);

// Handle search
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Filter data based on search query
if ($searchQuery != '') {
    $filteredData = array_filter($data, function ($row) use ($searchQuery) {
        foreach ($row as $cell) {
            if (stripos($cell, $searchQuery) !== false) {
                return true;
            }
        }
        return false;
    });
    // Reset array keys
    $filteredData = array_values($filteredData);
} else {
    $filteredData = $data;
}

// Pagination settings
$itemsPerPage = 15;
$totalItems = count($filteredData);
$totalPages = ceil($totalItems / $itemsPerPage);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($totalPages, $page));

// Get the data for the current page
$startIndex = ($page - 1) * $itemsPerPage;
$pageData = array_slice($filteredData, $startIndex, $itemsPerPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nipah Virus Inhibitor Results</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px; /* Smaller font size for entire table */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color:#4c84af ;
            text-align: center;
            font-size: 12px; /* Smaller font size for column names */
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .pagination {
            margin: 20px 0;
            text-align: center;
        }
        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #3E6990;
        }
        .pagination a.active {
            background-color: #3E6990;
            color: white;
            border: 1px solid #3E6990;
        }
        .table-container {
            max-height: 500px;
            overflow-y: auto;
            margin-top: 10px;
        }
        table th, table td {
            min-width: 100px;
        }
        thead th {
            position: sticky;
            top: 0;
            z-index: 2;
        }
        h1{
        	COLOR:BROWN;
        	text-align:center;
        }
    </style>
</head>
<body>
    <header>
        <h1>admetSAR 3.0 Absorption Table</h1>
    </header>
    <section>
        <!--<form method="get" action="">
            <input type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Search...">
            <button type="submit">Search</button>
        </form>-->
        <?php if (!empty($pageData)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <?php foreach ($data[0] as $header): ?>
                                <th><?php echo htmlspecialchars($header); ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pageData as $index => $row): ?>
                            <?php if ($index > 0 || $page > 1): // Skip the header row in pagination ?>
                                <tr>
                                    <?php foreach ($row as $cell): ?>
                                        <td><?php echo htmlspecialchars($cell); ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($searchQuery); ?>" class="<?php if ($i == $page) echo 'active'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php else: ?>
            <p>No data available.</p>
        <?php endif; ?>
    </section>
</body>
</html>
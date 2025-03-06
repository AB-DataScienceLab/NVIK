<?php
include 'template-nidb_new1.php';



// Path to the CSV file
$csvFile = 'data/tanimoto_coefficients_nvik_vs_antivirals.csv';

// Handle search query
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Pagination settings
$itemsPerPage = isset($_GET['itemsPerPage']) ? (int)$_GET['itemsPerPage'] : 15;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page);

// Function to read the CSV file and return the filtered and paginated data
function readCSVChunked($csvFile, $searchQuery, $itemsPerPage, $page, &$headers, &$totalItems) {
    $data = [];
    $headers = [];
    $startIndex = ($page - 1) * $itemsPerPage;
    $currentIndex = 0;
    $filteredCount = 0;

    if (($handle = fopen($csvFile, 'r')) !== FALSE) {
        // Read headers
        if (($row = fgetcsv($handle, 2000, ',')) !== FALSE) {
            $headers = $row;
        }

        // Read data in chunks
        while (($row = fgetcsv($handle, 2000, ',')) !== FALSE) {
            // Apply search filter if needed
            if ($searchQuery !== '') {
                $matchFound = false;
                foreach ($row as $cell) {
                    if (stripos($cell, $searchQuery) !== false) {
                        $matchFound = true;
                        break;
                    }
                }
                if (!$matchFound) continue;
            }

            // Count filtered rows
            $filteredCount++;

            // Add rows for the current page
            if ($filteredCount > $startIndex && $filteredCount <= $startIndex + $itemsPerPage) {
                $data[] = $row;
            }
        }

        $totalItems = $filteredCount; // Total items after filtering
        fclose($handle);
    } else {
        echo "Error opening the file.";
    }

    return $data;
}

// Get paginated and filtered data
$totalItems = 0;
$headers = [];
$pageData = readCSVChunked($csvFile, $searchQuery, $itemsPerPage, $page, $headers, $totalItems);

// Calculate total pages
$totalPages = ceil($totalItems / $itemsPerPage);

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
    width: 70%;
    border-collapse: collapse;
    font-size: 12px; /* Smaller font size for entire table */
    margin: 0 auto; /* Centers the table horizontally */
}
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: ;
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
        	color:brown;
        	text-align:center;
        }
    </style>
    <script>
        // Dynamically set itemsPerPage based on available screen space
        function adjustPagination() {
            const rowsPerPage = Math.floor((window.innerHeight - 200) / 25); // Calculate rows based on row height
            const url = new URL(window.location.href);
            url.searchParams.set('itemsPerPage', rowsPerPage);
            window.location.href = url.toString();
        }

        // Adjust pagination on initial load if itemsPerPage is not set
        window.onload = function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (!urlParams.has('itemsPerPage')) {
                adjustPagination();
            }
        };
    </script>
</head>
<body>
    <header>
        <h1>NVIs similarity with Enamine Antivirals</h1>
    </header>
    <section>
        <?php if (!empty($pageData)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <?php foreach ($headers as $header): ?>
                                <th><?php echo htmlspecialchars($header); ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pageData as $row): ?>
                            <tr>
                                <?php foreach ($row as $cell): ?>
                                    <td><?php echo htmlspecialchars($cell); ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($searchQuery); ?>&itemsPerPage=<?php echo $itemsPerPage; ?>" class="<?php if ($i == $page) echo 'active'; ?>">
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

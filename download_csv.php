<?php
session_start();

if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="query_results.csv"');

    $output = fopen('php://output', 'w');

    // Write the headers
    fputcsv($output, array_keys($results[0]));

    // Write the data
    foreach ($results as $row) {
        fputcsv($output, $row);
    }

    fclose($output);
    unset($_SESSION['results']);
    exit;
} else {
    echo "No data available for download.";
}

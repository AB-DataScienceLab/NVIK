<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['results'])) {
    // Decode the base64 encoded JSON data
    $results = json_decode(base64_decode($_POST['results']), true);

    // Open a file for output
    $filename = "query_results.csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Create a file pointer
    $output = fopen('php://output', 'w');

    // Output the column headers
    if (!empty($results)) {
        fputcsv($output, array_keys($results[0]));

        // Output each row of the results
        foreach ($results as $row) {
            fputcsv($output, $row);
        }
    }

    // Close the output file
    fclose($output);
    exit;
}
?>

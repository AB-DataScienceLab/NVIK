<?php
# session_start();
include 'template-nidb_new.php';
echo "<title>NVIK VirtualBox</title>";

// Array of sheet names and file paths
$sheets = [
    ["name" => "<b>NVIK SMILES and InChlKey</b>", "file" => "data/data_download/NVIK-smiles-inchikey.xlsx"],
    ["name" => "<a href='https://enamine.net/compound-libraries/bioactive-libraries/fda-approved-drugs-collection' target='_blank'><b>Enamine FDA approved Drugs Collection</b> (Library code: FAD-1123; Version: 9 November 2023)</a>", "file" => "data/data_download/fda.csv"],
    ["name" => "<a href='https://enamine.net/compound-libraries/targeted-libraries/antiviral-library' target='_blank'><b>Enamine Antiviral Library<b> (Library code: AVR-3200; Version: 8 September 2020)</a>", "file" => "data/data_download/enamine-antivirals.csv"],
    ["name" => "<b>Pathogen box</b>", "file" => "data/data_download/pathogen_box.csv"],
    ["name" => "<b>CAS</b>", "file" => "data/data_download/cas.csv"],
    ["name" => "<a href='https://coconut.naturalproducts.net/download' target='_blank'><b>COCONUT: the COlleCtion of Open NatUral producTs</b> (Version: 08-2024)</a>", "file" => "data/data_download/coconut.csv"]];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Optional CSS file for styling -->
    <title>Download Data Sheets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
           
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            
            padding: 30px;
            border-radius: 10px;
         
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .sheet-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .sheet {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border: 1px solid #ccd6dd;
            border-radius: 6px;
            background-color: #f9fcff;
            transition: transform 0.3s;
        }
        .sheet:hover {
            transform: scale(1.02);
            background-color: #eaf4fc;
        }
        .sheet p {
            margin: 0;
            color: #34495e;
            font-size: 16px;
            flex: 1;
        }
        .download-button {
            background-color: #a7c7dc; /* Glacial Blue Ice */
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .download-button:hover {
            background-color: #85b0cd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>NVIK Downloads</h1>
        
        <div class="sheet-buttons">
            <?php foreach ($sheets as $sheet): ?>
                <div class="sheet">
                    <p><?php echo $sheet['name']; ?></p>
                    <a href="<?php echo htmlspecialchars($sheet['file']); ?>" class="download-button" download>
                        Download
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

<?php
include 'template-nidb_new.php';
print <<<HTML
<title>NVIK Useful Resources</title>
<style type='text/css'>
a.down{text-decoration: none;}
</style>
<a name='misc'>
<h2><center>Useful Resources</center></h2>
<table align='center' border='1px;' style='width: 70%;margin-right: 250px; border-collapse: collapse;'>
<thead>
<tr bgcolor='#3E6990'>
    <th><font color='white'>Sr.No</font></th>
    <th><font color='white'>Resource</font></th>
    <th><font color='white'>Description</font></th>
</tr>
</thead>
<tbody>
HTML;

// Initialize counter
$counter = 1;

// Data rows
$rows = [
    ['https://lmmd.ecust.edu.cn/admetsar3/','admetSAR3.0','admetSAR 3.0 is a contrast learning based multitask graph neural network framework, which utilizes transformation rules and scaffold hopping optimization strategies to provide predictions on 119 ADMET endpoints.'],
    ['https://www.collaborativedrug.com/', 'CDD database', 'The Collaborative Drug Discovery (CDD) Database is a collaborative "cloud-based" tool that aims to bring together neglected disease researchers and<br> other researchers from usually separate areas, to collaborate and to share compounds and drug discovery data in the research community.'],
    ['http://www.ebi.ac.uk/chebi/', 'ChEBI', 'Chemical Entities of Biological Interest (ChEBI) is a freely available dictionary of molecular entities focused on \'small\'<br> chemical compounds.'],
    ['https://www.ebi.ac.uk/chembl/', 'ChEMBL', 'An Open Data database containing binding, functional and ADMET information for a large number of drug-like bioactive compounds.'],
    ['http://www.chemspider.com/', 'ChemSpider', 'ChemSpider is a free chemical structure database providing fast text and structure search access to over 32 million<br> structures from hundreds of data sources.'],
    ['https://coconut.naturalproducts.net/','COCONUT','COCONUT: the COlleCtion of Open NatUral producTs is a comprehensive platform facilitating natural product research by providing data, tools, and services for deposition, curation, and reuse.'],
    ['https://biosig.lab.uq.edu.au/deeppk/','DeepPK','Uses 449 graph-level features for DMPNN (directed message passing neural network) based learning and bayesian hyperparameter optimization to provide predictions on 64 ADMET endpoints.'],
    ['http://www.drugbank.ca/', 'DrugBank', 'The DrugBank database is an online resource that combines detailed drug (i.e. chemical, pharmacological and pharmaceutical) data with comprehensive<br> drug target (i.e. sequence, structure, and pathway) information.'],
    ['https://www.enaminestore.com/', 'Enamine', 'EnamineStore is an e-commerce portal for online searching and ordering products by Enamine Ltd - a leading supplier of innovative chemistry<br> products for the drug discovery community. The online catalog contains more than 15 million small molecules, including building blocks, fragments,<br> and screening compounds.'],
    ['https://pubchem.ncbi.nlm.nih.gov/', 'PubChem', 'PubChem is a public repository for chemical molecules and their activities against biological assays. It comprises three interconnected databases:<br> (i) Compound (ii) Bioassay (iii) Substance.'],
    ['http://www.swisssimilarity.ch/index.php','SwissSimilarity','The main purpose of SwissSimilarity is to provide user-friendly interface to perform ligand-based virtual screening of chemical libraries. By employing different molecular fingerprints, SwissSimilarity is able to retrieve compounds that are similar to query molecule.'],
    ['https://zinc.docking.org/', 'ZINC', 'A free database of commercially-available compounds for virtual screening. ZINC contains over 35 million purchasable compounds in ready-to-dock,<br> 3D formats.']
];

// Generate table rows with serial numbers
foreach ($rows as $row) {
    echo "<tr>";
    echo "<td>$counter</td>";
    echo "<td><a href='{$row[0]}' target='_blank' class='down'><b>{$row[1]}</b></a></td>";
    echo "<td>{$row[2]}</td>";
    echo "</tr>";
    $counter++;
}

print <<<HTML
</tbody>
</table>
<br><br>
HTML;
include ('footerfix.html');
?>

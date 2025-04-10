# NVIK Source Code & Analysis Repository

NVIK is hosted at https://datascience.imtech.res.in/anshu/nipah/

# About NVIK

NVIK is crowd-sourcing based knowledgebase which provides information regarding the curated small-molecule inhibitors and their prioritisation using cheminformatics approaches. 
At the time of first release the knowledgebase has 220 NVIs entries with 142  unique small molecule inhibitors. 
All of the NVIs related information including their structures, physicochemical properties, similarity analysis with FDA approved drugs and other chemical libraries and ADMET predictions are freely accessible. 
The knowledgebase also has the provision to check the tanimoto similarity of input small molecules against the curated NVIs. 
For continuous updation of the knowledgebase, this platform allows the submission of newly identified inhibitors as and when they are reported.

The 'NVIK-analysis' folder contains the comparison and prioritisation results for NVIs.

The 'NVIK_Source code' folder contains the files used to develop the NVIK web-server.

# Web-server Architecture

The NVIK is built using the LAMP stack: Linux (CentOS release 6.5 ), Apache/2.2.15 (Unix), mysql 5.1.73, and PHP 5.1.73. The web interface is created with HTML, CSS, JavaScript, and AJAX to provide a dynamic and easy-to-use experience. PHP handles the server-side
operations, connecting with MySQL to manage the database of NVIs. The platform offers search features, including text, structure, and complex query-based searches, helping researchers quickly find the information they need. This setup ensures the NVIK is secure, 
scalable, and user-friendly, making it a valuable tool for research and drug discovery.

![Image Alt](https://github.com/AB-DataScienceLab/NVIK/blob/f5970a6a3151d453e59de90f2b2b7494b8ee9721/ga-final.png)


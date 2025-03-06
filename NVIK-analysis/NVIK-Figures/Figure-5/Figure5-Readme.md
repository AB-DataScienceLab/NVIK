Steps to generate the Figure-5 using 'Figure5/phys-chem-bp.py'
1. Downloaded the Enamine FDA and Antiviral libraries from-
	a. https://enamine.net/compound-libraries/bioactive-libraries/fda-approved-drugs-collection
	b. https://enamine.net/compound-libraries/targeted-libraries/antiviral-library

2. Converted the downloaded libraries to SMILES format using obabel 3.1.1

3. Mention input file names as- input_files = ['Figure-5/nvik.csv', 'Figure-5/fda-enamine.csv', 'Figure-5/antivirals-enamine.csv'] and run the script using 'Figure5/phys-chem-bp.pypython phys-chem-bp.py' in terminal

4. Combined all the generated plots into a single plot using Inkscape Inkscape V 1.4 (Figure-5/plots/nvi-fda-avr-physprop-comp.svg) and exported as png (Figure-5/plots/nvi-fda-avr-physprop-comparison.png) plot.  
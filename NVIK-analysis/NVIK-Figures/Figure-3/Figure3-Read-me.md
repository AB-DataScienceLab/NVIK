An overview of the steps followed to generate the Figure 3 (NVIK)

1. Using 'Figure-3-NVIK-calculate-properties/cal_desc-for-cv.py' for calculation of NVIKs physicochemical properties	input file- nvik_indexed.csv
	output file- nvik_indexed_calculated_properties.xlsx
	
2. Perform clustering of NVIKs using JARP version 6.0.2 at 'Figure-3/Figure-3-JARP'
	input file- nvik_final_merged.smi
	output file- jarp-c30-CF-nvik.txt    
	
3. Generate circular plot using 'Figure-3/circularplot.py'
	input files- nvik_indexed_calculated_properties.csv, Jarp_cluster_unique.csv
	output file- nvik-properties_plot_final.png

4. Now taking this plot as reference further modifications including annotating important connections (Figure-3/Jarp_cluster_unique.csv) were done by using Inkscape V 1.4 tool (Figure-3/nvik-chemical_properties_circular-plot.svg) and final plot saved as- Figure3/NVIK-chemical_properties_circular-plot.png
	
	Images for NVIs 
		NVIC0026- https://pubchem.ncbi.nlm.nih.gov/compound/155669302
		NVIC0044- https://pubchem.ncbi.nlm.nih.gov/compound/2277040

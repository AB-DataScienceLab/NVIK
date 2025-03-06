import pandas as pd
import numpy as np
from rdkit import Chem
from rdkit.Chem import Descriptors
from rdkit.Chem import Crippen
from rdkit.Chem import rdMolDescriptors
import matplotlib.pyplot as plt
import os

def calculate_properties(smiles):
    mol = Chem.MolFromSmiles(smiles)
    if mol is None:
        return None
    
    mol_wt = Descriptors.ExactMolWt(mol)
    hbd = rdMolDescriptors.CalcNumHBD(mol)
    hba = rdMolDescriptors.CalcNumHBA(mol)
    rotatable_bonds = rdMolDescriptors.CalcNumRotatableBonds(mol)
    logP = Crippen.MolLogP(mol)
    tpsa = Descriptors.TPSA(mol)
    
    return mol_wt, hbd, hba, rotatable_bonds, logP, tpsa

def process_csv(file_path):
    encodings = ['utf-8', 'iso-8859-1', 'cp1252']
    
    for encoding in encodings:
        try:
            df = pd.read_csv(file_path, encoding=encoding)
            print(f"Successfully read {file_path} with {encoding} encoding")
            
            properties = df['smiles'].apply(calculate_properties)
            prop_df = pd.DataFrame(list(properties), columns=['mol_wt', 'hbd', 'hba', 'rotatable_bonds', 'logP', 'tpsa'])
            result_df = pd.concat([df, prop_df], axis=1)
            
            output_file = os.path.splitext(file_path)[0] + '_properties.csv'
            result_df.to_csv(output_file, index=False, encoding='utf-8')
            
            return result_df
        except UnicodeDecodeError:
            print(f"Failed to read {file_path} with {encoding} encoding")
        except Exception as e:
            print(f"An error occurred while processing {file_path}: {str(e)}")
    
    print(f"Failed to read {file_path} with any of the attempted encodings")
    return None

def get_property_ranges(property_name):
    ranges = {
        'mol_wt': [0, 100, 200, 300, 400, 500, float('inf')],
        'hbd': [0, 6, 11, 16, float('inf')],  # Changed boundaries to get 0-5, 6-10, 11-15, >15
        'hba': [0, 6, 11, 16, float('inf')],  # Changed boundaries to get 0-5, 6-10, 11-15, >15
        'rotatable_bonds': [0, 6, 11, 16, float('inf')],  # Changed boundaries to get 0-5, 6-10, 11-15, >15
        'logP': [float('-inf'), -10, -5, 0, 5, 10, float('inf')],
        'tpsa': [0, 100, 200, 300, float('inf')]
    }
    return ranges[property_name]

def calculate_percentages(data, ranges, property_name):
    percentages = []
    total = len(data)
    discrete_vars = ['hbd', 'hba', 'rotatable_bonds']
    
    for i in range(len(ranges) - 1):
        if property_name in discrete_vars:
            if i == len(ranges) - 2:  # Last bin (>15)
                count = (data[property_name] > ranges[i]).sum()
            else:
                count = ((data[property_name] >= ranges[i]) & (data[property_name] < ranges[i+1])).sum()
        else:
            count = ((data[property_name] >= ranges[i]) & (data[property_name] < ranges[i+1])).sum()
        
        percentages.append((count / total) * 100)
    
    return percentages

def get_range_labels(ranges, property_name):
    labels = []
    discrete_vars = ['hbd', 'hba', 'rotatable_bonds']
    
    for i in range(len(ranges) - 1):
        if property_name in discrete_vars:
            if i == len(ranges) - 2:  # Last bin
                labels.append(f'>{ranges[i]-1}')
            else:
                # For discrete variables, adjust labels to show correct ranges
                labels.append(f'{ranges[i]}-{ranges[i+1]-1}')
        else:
            if ranges[i] == float('-inf'):
                labels.append(f'<{ranges[i+1]}')
            elif ranges[i+1] == float('inf'):
                labels.append(f'>{ranges[i]}')
            else:
                labels.append(f'{ranges[i]}-{ranges[i+1]}')
    return labels

def plot_property(data_list, legend_names, property_name, output_folder):
    plt.figure(figsize=(10, 8))
    colors = ['#1b9e77', '#f4f1de', '#78909C', '#26C6DA']
    
    ranges = get_property_ranges(property_name)
    range_labels = get_range_labels(ranges, property_name)  # Added property_name parameter
    
    bar_width = 0.20
    index = np.arange(len(ranges) - 1)
    
    for i, (data, legend_name) in enumerate(zip(data_list, legend_names)):
        percentages = calculate_percentages(data, ranges, property_name)
        plt.bar(index + i * bar_width, percentages, bar_width, color=colors[i], label=legend_name)
    
    plt.xlabel(property_name)
    plt.ylabel('Percent of Compounds')
    plt.title(f'Distribution of {property_name}', fontsize=16)
    plt.xticks(index + bar_width, range_labels, rotation=45, ha='right')
    plt.legend(fontsize=16)
    plt.tight_layout()
    
    output_file = os.path.join(output_folder, f'{property_name}_distribution.png')
    plt.savefig(output_file, dpi=1200)
    plt.close()
def main():
    input_files = ['nvik.csv', 'pathogen_box.csv', 'cas.csv', 'coconut.csv']
    legend_names = ['NVIs', 'Pathogen box', 'CAS', 'Coconut']  # Custom legend names
    output_folder = 'plots'
    os.makedirs(output_folder, exist_ok=True)
    
    data_list = []
    for file in input_files:
        data = process_csv(file)
        if data is not None:
            data_list.append(data)
        else:
            print(f"Skipping {file} due to processing error")
    
    if not data_list:
        print("No data could be processed. Exiting.")
        return
    
    properties = ['mol_wt', 'hbd', 'hba', 'rotatable_bonds', 'logP', 'tpsa']
    
    for prop in properties:
        plot_property(data_list, legend_names[:len(data_list)], prop, output_folder)

if __name__ == "__main__":
    main()
    
    
#The above code was partially generated by Claude, an AI assistant created by Anthropic.
#It has been modified and verified for use in this project.
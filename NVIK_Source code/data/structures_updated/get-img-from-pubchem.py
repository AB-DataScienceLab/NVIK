import csv
import requests

def download_image(pubchem_id, nvic_id):
    url = f"https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/CID/{pubchem_id}/PNG"
    response = requests.get(url)
    if response.status_code == 200:
        with open(f"{nvic_id}.png", 'wb') as f:
            f.write(response.content)
    else:
        print(f"Failed to download image for {nvic_id}")

with open('nvik-pubchem.csv', 'r') as csvfile:
    reader = csv.reader(csvfile)
    next(reader)  # Skip the header row
    for row in reader:
        nvic_id, pubchem_id = row
        print(f"Processing: NVIC_ID={nvic_id}, Pubchem_id={pubchem_id}")
        download_image(pubchem_id, nvic_id)
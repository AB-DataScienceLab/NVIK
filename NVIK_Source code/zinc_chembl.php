<?php
include'template-nidb_new.php';
#include'logo_nidb.html';
#include'simple_menu2.html';

/*
print<<<HTML
<br><br>
<center><h1><u><b></b> The page will be available soon</u></center></h1>
<br><br>
HTML;
*/


print<<<HTML
<title>NVIK Similarity with FDA Drugs</title>
<style>
a.rollover img {
        width: 180px;
        height: 175px;
}

a.rollover:hover > img {
        width: 380px;
        height: 440px;
}
</style>
<center><b><h2>Similarity with ZINC Lead-like & ChEMBL compounds </h2><br>Table: List of NVI's molecules showing similarity with ZINC Lead-like & ChEMBL compounds</b></center>
<br>
<table id='tableTwo' class='yui' border='center' width='84%' >
<thead ><tr><th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='3'><b>NVI's Compound</b>&nbsp;</font></th><th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>ZINC ID</b>&nbsp;</font></th><th align='center' bgcolor='#3E6990' class='tableHeader'><font color='white' size='4'><b>ChEMBL ID</b>&nbsp;</font></th><th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>Tanimoto coefficient (max>0.85) ZINC/ChEMBL</b>&nbsp;</font></th><th align='center' bgcolor='#3E6990'><font color='white' size='3'><b>No. of ZINC/ChEMBL compound TC >0.85 (out of top 400)</b>&nbsp;</a></font></th></tr></thead>
<!--thead><tr><th align='center' bgcolor='green' class='tableHeader'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>BioPhytMol Compound</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='green'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>DrugBank ID</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='green' class='tableHeader'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>Dissimilarity Threshold</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead-->
<tbody>
HTML;
#$result = fopen('tanimoto_0.85_n_above_using_fp4_for_all_BioPhytMol_n_FDA_approved_sorted.txt','r');
#$result = fopen('all_biophytmol_FDA_approved_Oct_28_2013_sorted_0.85_n_above_180_used.txt','r');
$result = fopen('zinc_chembl.tsv','r');
echo $result;
#$result = fopen('B_mols_FDA_small_final.txt','r');
while(!feof($result)){
$name = fgets($result);
$name = preg_replace("/\n$/","",$name);

$sep_val = explode("\t",$name);
if($name !== ''){

$chembl = $sep_val[2];
#$chembl = round($chembl,2);
$pub_id = $sep_val[0];
$side_eff = $sep_val[3];
$toxi = $sep_val[4];
if($pub_id <= 315){
#$pub_id = preg_replace("/_self_drawn/",'',$pub_id);

#print"<tr><td align='center'><a href='search-nidb.php?pubchem_id=$pub_id&type=pubchem_id' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><br><br><a href='' class='rollover'><img src='store_data/str_images/$pub_id.png' width='180' height='105'></a></td>";

print"<tr><td align='center'><a href='search-nidb.php?compound_id=$pub_id&type=compound_id' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><br><br><a href='' class='rollover'><img src='store_data/str_images/$pub_id.png' width='180' height='105'></a></td>";


}
else{
print"<tr><td align='center'><a href='search-nidb.php?pubchem_id=$sep_val[0]&type=pubchem_id' title='Click to See Details'><b><i>$sep_val[0]</i></b></a><br><br><a href='' class='rollover'><img src='http://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?t=l&cid=$sep_val[0]' width='180' height='105'></a></td>";
}

#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";

print"<td align='center'><a href='http://www.drugbank.ca/drugs/$sep_val[1]' target='_blank' title='Click to See Details'>$sep_val[1]</a><br><br><a href='' class='rollover'><img src='http://structures.wishartlab.com/molecules/$sep_val[1]/image.png' width='250' height='250'></a></td>";
print"<td align='center'><a href='http://www.drugbank.ca/drugs/$chembl' target='_blank' title='Click to See Details'>$chembl</a><br><br><a href='' class='rollover'><img src='http://structures.wishartlab.com/molecules/$chembl/image.png' width='250' height='250'></a></td>";
#print"<td align='center'>$chembl</td>
print "<td align='center'>$side_eff</td><td align='center'>$toxi</td></tr>";
}
}
/*
print<<<HTML
</tbody>
<tfoot>
            <tr id="pagerTwo">
                <td colspan="25" style="border-right: solid 3px #7f7f7f;">
                        <img src="poly-img/first.png" class="first"/>
                        <img src="poly-img/prev.png" class="prev"/>
                        <input type="text" class="pagedisplay"/>
                        <img src="poly-img/next.png" class="next"/>
                        <img src="poly-img/last.png" class="last"/>
                        <select class="pagesize">
                                <option selected="selected" value="50">50</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                                <option value="250">250</option>
                                <option value="300">300</option>
                                <option value="350">350</option>
                                <option value="400">400</option>

                        </select>
                    </td>
            </tr>
        </tfoot>

</table><br><br>
<?php}?>
<br>
<center><a href='#top' style='text-decoration: none;'><b>[Top]</b></a></center>
<br>
<br><br>
HTML;
*/
?>

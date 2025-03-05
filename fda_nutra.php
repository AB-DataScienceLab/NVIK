<?php
include'template-nidb_new.php';
#include'logo_nidb.html';
#include'simple_menu2.html';

print<<<HTML
<br><br>
<center><h1><u><b></b> The page will be available soon</u></center></h1>
<br><br>
HTML;
/*
print<<<HTML
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
<br><br>
<center><u><b>Table:</b> List of NVI's inhibitors showing similarity with Antivirals</u></center>
<br><br>
<table id='tableTwo' class='yui'>
<!--thead><tr><th align='center' bgcolor='green' class='tableHeader'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>BioPhytMol Compound</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='green'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>DrugBank ID</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='green' class='tableHeader'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>Dissimilarity Threshold</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead-->
<thead><tr><th align='center' bgcolor='green' class='tableHeader'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>BioPhytMol Compound</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='green'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>DrugBank ID</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='green' class='tableHeader'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>Dissimilarity Threshold</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='green'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>Side effects [From DrugBank]</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th><th align='center' bgcolor='green'><font color='white' size='3'><a href='#' title='Click Header to Sort'><b>Predicted Rat acute toxicity (mol/kg) [LD<sub>50</sub> Value from DrugBank]</b>&nbsp;&nbsp;&nbsp;<img src='sort.jpg' width='15' height='15'></a></font></th></tr></thead>
<tbody>
HTML;
#$result = fopen('tanimoto_0.85_n_above_using_fp4_for_all_BioPhytMol_n_FDA_approved_sorted.txt','r');
#$result = fopen('all_biophytmol_Nutra_Oct_28_2013_sorted_0.85_n_above_91_used.txt','r');
#$result = fopen('B_mols_Nutra_final.txt','r');
$result = fopen('nutra_final.txt','r');
while(!feof($result)){
$name = fgets($result);
$name = preg_replace("/\n$/","",$name);
#print $name."<br>";
$sep_val = explode("\t",$name);
if($name !== ''){
#print $name_send."\n";
$tani = $sep_val[2];
$tani = round($tani,2);
$pub_id = $sep_val[0];
$side_eff = $sep_val[3];
$toxi = $sep_val[4];
if($pub_id <= 315){
#$pub_id = preg_replace("/_self_drawn/",'',$pub_id);
print"<tr><td align='center'><a href='search-nidb.php?pubchem_id=$pub_id&type=pubchem_id' title='Click to See Details' target='_blank'><b><i>$pub_id</i></b></a><br><br><a href='' class='rollover'><img src='store_data/str_images/$pub_id.svg' width='180' height='105'></a></td>";
}
else{
print"<tr><td align='center'><a href='search-nidb.php?pubchem_id=$sep_val[0]&type=pubchem_id' title='Click to See Details' target='_blank'><b><i>$sep_val[0]</i></b></a><br><br><a href='' class='rollover'><img src='http://pubchem.ncbi.nlm.nih.gov/image/imgsrv.fcgi?t=l&cid=$sep_val[0]' width='180' height='105'></a></td>";
}

#print"<br><a href='http://crdd.osdd.net/drugpedia/index.php/$name' target='_blank'><b>(Drugpedia Detail)</b></a>";

print"<td align='center'><a href='http://www.drugbank.ca/drugs/$sep_val[1]' target='_blank' title='Click to See Details'>$sep_val[1]</a><br><br><a href='' class='rollover'><img src='http://structures.wishartlab.com/molecules/$sep_val[1]/image.png' width='250' height='250'></a></td>";
print"<td align='center'>$tani</td><td align='center'>$side_eff</td><td align='center'>$toxi</td></tr>";
}
}
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

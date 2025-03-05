<?php
# session_start();
include 'template-nidb_new.php';
echo "<title>NVIK VirtualBox</title>";
# include 'sidemenu.php';
# include 'button2.html';
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NVIK VirtualBox</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link href="css/stylep.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<a name="top"></a>
	<div id="col1">
		<p><center>
			<h2>Nipah Virus Inhibitor Knowledgebase (NVIK) Virtual Machine for VirtualBox</h2>
			</center>
		</p>
		<hr />
		<p align="justify">
			<font size="3" face="Arial"> This page facilitates users to import
				NVIK Virtual Machine (VM) for Oracle VirtualBox. Users need
				to install Oracle VirtualBox Version 6.1.12 or higher on their
				computer after that user can import NVIK VM in VirtualBox.
				Following is brief description...<br />
				<ul>
					<li><font size="3"><a href="#vboxdownload">Downloading Oracle
								VirtualBox Software</a></font></li>
					<li><font size="3"><a href="#vboxinstall">Installation of Oracle 
								VirtualBox</a></font></li>
					<li><font size="3"><a href="#vboxova">Downloading NVIK
								"nipah_vm.ova" VM appliance file</a></font></li>
					<li><font size="3"><a href="#vboximport">Import NVIK
								Virtual machine in VirtualBox</a></font></li>
					<li><font size="3"><a href="#vboxrun">Run and Update NVIK
								Virtual machine in VirtualBox</a></font></li>
				</ul>
				<hr /> <a name="vboxdownload"> <font size="3"><u>Downloading Oracle
							VirtualBox Software</u></font><br />
			</a> <br />Oracle VirtualBox is a virtualization application which
				runs across cross-platforms. To download VirtualBox and extension
				packages .vbox-extpack file, please visit the download page of
				VirtualBox. Go to the <a href="https://www.virtualbox.org/"><font
					size="4">VirtualBox website</font></a> and go to the <a
				href="https://www.virtualbox.org/wiki/Downloads"><font size="4">download
						section</font></a>. There are versions available for Windows, Mac,
				and Linux. <br /> <br />

				<hr /> <a name="vboxinstall"> <font size="3"><u>Installation of
							Oracle VirtualBox</u></font><br />
			</a> <br />User can install VirtualBox with its extension packs and
				proceed to import NVIK VM "nipah_vm". User should follow
				below mentioned steps to install VirtualBox on their machine.<b></b>
				<ul>
					<li>Windows users can install VirtualBox by double clicking on the
						downloaded exe file and follow the instructions thereafter.
						<li>Mac users can install VirtualBox by double clicking on the
							downloaded dmg file and follow the instructions thereafter.
							<li>Linux users can install VirtualBox using downloaded deb or
								rpm file with following command to be run on terminal<br /> <b>$ sudo
									dpkg -i virtualbox-*_amd64.deb</b><br /> or <br /><b>$ sudo yum install
									VirtualBox-*.rpm</b>.

						</li>
					</li>
					</li>
				</ul>
				<ul>
					Oracle VirtualBox extension packages have a .vbox-extpack file name
					extension. To install an extension, simply download it from
					<a href="https://www.virtualbox.org/wiki/Downloads"><font size="4">https://www.virtualbox.org/wiki/Downloads</font></a>
					and double-click on the package file and a Network Operations
					Manager window is shown to guide you through the required steps.
					Please check VirtualBox manual
					<a href="https://www.virtualbox.org/manual/ch02.html">https://www.virtualbox.org/manual/ch02.html</a>
					for more details.
				</ul>

				<table>
					<tr>
						<td width="1000" align="right"><a href="#top"><font color="purple"><b><u>Go
											to Top</u></b></font></a></td>
					</tr>
				</table>

				<hr /> <br /> <a name="vboxova"> <font size="3"><u>Downloading NVIK "nipah_vm.ova" VM appliance file</u></font>
			</a> <br /> <br /> User should download NVIK VM "nipah_vm"
				for import VM appliance in VirtualBox. It is .ova file of ~4.3 GB
				size. The VM is based on Ubuntu 12.04 x64 with configuration 1
				processor, 2 GB RAM, 15 GB HDD disk space, Two network (NAT, Host
				only) requires in VirtualBox for its working.
				<ul>
					<li><font size="4"><b> <a href="http://ab-openlab.csir.res.in/anshu/nipah/data/nipah_vm.ova">Click
							here to download "nipah_vm.ova" file</a></b></font></li>
				</ul> <br />

				<table>
					<tr>
						<td width="1000" align="right"><a href="#top"><font color="purple"><b><u>Go
											to Top</u></b></font></a></td>
					</tr>
				</table>

				<hr /> <a name="vboximport"> <font size="3"><u>Import Virtual
							machine appliance file in VirtualBox</u></font>
			</a>
				<ul>
					<li>In Oracle VM VirtualBox Manager, click the File -> Import
						Appliance to import the virtual machine appliance wizard.

						<table width="700">
							<tr>
								<td align="center"><a href="images/vbox/vbox1.png"><img
										src="images/vbox/vbox1.png" width="90%;" alt="Pic2" /></a></td>
								<td align="center"><a href="images/vbox/vbox2.png"><img
										src="images/vbox/vbox2.png" width="90%;" alt="Pic2" /></a></td>
							</tr>
						</table>
					</li>
					

					<li>Browse and give your NVIK VM appliance file
						"nipah_vm.ova" path in Appliance to Import as shown in the figure
						below and click next<br /> <br />

						<table width="700">
							<tr>
								<td align="center"><a href="images/vbox/vbox3.png"><img
										src="images/vbox/vbox3.png" width="90%;" alt="Pic3" /></a></td>
							</tr>
						</table>

						<li>Review the import VM appliace settings for your VirtualBox.
							You can import it using default settings with accepting Creative
							Commons Attribution-NonCommercial-ShareAlike 4.0 International
							License.<br />
							<table width="700">
								<tr>
									<td align="center"><a href="images/vbox/vbox4.png"><img
											src="images/vbox/vbox4.png" width="90%;" alt="Pic4" /></a></td>
								</tr>
								<td align="center"><a href="images/vbox/vbox5.png"><img
										src="images/vbox/vbox5.png" width="90%;" alt="Pic5" /></a></td>
								<tr></tr>
							</table>
					</li>
					</li>
					<li>Your VM is created after import VM and you can see NVIK VM "nipah_vm" your new VM name in the list. <br>For more
							details about Import Wizard, please visit <a
							href="https://docs.oracle.com/cd/E26217_01/E26796/html/qs-import-vm.html">https://docs.oracle.com/cd/E26217_01/E26796/html/qs-import-vm.html</a></br>
						<table width="700">
							<tr>
								<td align="center"><a href="images/vbox/vbox6.png"><img
										src="images/vbox/vbox6.png" width="90%;" alt="Pic6" /></a></td>
							</tr>
						</table>

					</li>
				</ul> <br />
				<table>
					<tr>
						<td width="1000" align="right"><a href="#top"><font color="purple"><b><u>Go
											to Top</u></b></font></a></td>
					</tr>
				</table>
				<hr /> <a name="vboxrun"> <font size="3"><u>Run and Update NVIK Virtual machine in VirtualBox</u></font><br />
				<br />
					<li>You can run the NVIK VM "nipah_vm" from the VirtualBox. It will start VM with auto-login to user "nipah" with password "nipah_vm", auto-start Apache webserver and MySQL database, then it will auto-open firefox by default after two minutes of the system starts to show NVIK in VM on URL <a href="http://localhost/nipah/" target=_blank>http://localhost/nipah</a>.</li></a>
						<br>You can also check NVIK from VirtualBox host machine at URL <a href="http://192.168.56.101/nipah/" target=_blank>http://192.168.56.101/nipah/</a> using default IP address of host-only adaptor network</br>
				<table width="700">
					<tr>
						<td align="center"><a href="images/vbox/vbox7.png"><img
								src="images/vbox/vbox7.png" width="90%;" alt="Pic7" /></a></td>
					</tr>
				</table>
				<br/>
				<table>
					<tr>
						<td width="1000" align="right"><a href="#top"><font color="purple"><b><u>Go
											to Top</u></b></font></a></td>
					</tr>
				</table>
				<li>You can clone NVIK source code from GitHub URL <a href="https://github.com/tinabioinfo/nipah" target=_blank>https://github.com/tinabioinfo/nipah</a> into your
					persoanl system or "nipah_vm" VM. <br><br/>
					Go to the web directory: <b> $ cd /opt/lampp/htdocs/</b></br>
					<br>For new repository:<b> $ sudo git clone
						https://github.com/tinabioinfo/nipah.git</b></br> <br>For existing
						repository: <b>$ cd nipah; sudo git pull origin master; </b></br>
						<br>Update folder permission: <b>$ sudo chown -R daemon.daemon /opt/lampp/htdocs/nipah/</b></br>
						<br>Then
						Update the NVIK database:<b>
							$ echo "drop databsae nipah; create database nipah"|/opt/lampp/bin/mysql -unipah -pnipah_vm ; <br>
							/opt/lampp/bin/mysql -unipah -pnipah_vm --force nipah < /opt/lampp/htdocs/nipah/data/nipah.sql </b>
				</br> <a></a><br></br>
					<table width="700">
						<tr>
							<td align="center"><a href="images/vbox/vbox8.png"><img
									src="images/vbox/vbox8.png" width="90%;" alt="Pic7" /></a></td>
						</tr>
					</table>

			</li>
				<ul></ul> <br />
				<table>
					<tr>
						<td width="1000" align="right"><a href="#top"><font color="purple"><b><u>Go
											to Top</u></b></font></a></td>
					</tr>
				</table>
			</font>
		</p>
		<p></p>
		<!-- This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License. -->
		<p><?php include('LICENSE'); ?></p>
	</div>
</body>
</html>



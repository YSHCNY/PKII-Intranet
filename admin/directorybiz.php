<?php 

include("db1.php");

include ("addons.php");

$loginid = $_GET['loginid'];

$companytype = $_POST['companytype'];
$orderby = $_POST['orderby'];
$orderdirection = $_POST['orderdirection'];

$dirbizdisp = 0;

$found = 0;

if($loginid != "") {
    include("logincheck.php");
}

if ($found == 1) {
    include ("header.php");
    include ("sidebar.php");
?>
<style>
	.table td{
		vertical-align: middle;
		font-weight: 500;
	}
	#backbtn{
		background-color: #0a1d44;
		transition: transform 0.5s ease;
	}
	#backbtn:active{
		transform: scale(0.95);
	}
	#subbtn{
		width: 7%;
		height: 4.2%;
		cursor: pointer;
		transition: transform 0.5s ease;
	}
	#subbtn:active{
		transform: scale(0.95);
	}
</style>
	<p class="poppins text-black fw-semibold"><font size=1>Directory >> Business Contacts</font></p>

	<div class="w-100 text-center mb-5">
		<h2 class="text-black fw-semibold poppins">PKII Business Directory</h2>
	</div>
	<div class="w-100 text-center mb-5">
		<h3 class="text-black fw-medium poppins mb-4">List preferences</h3>
		<div>
		<form action="directorybiz.php?loginid=<?php echo $loginid; ?>" method="POST">
			<?php
				if($companytype == 'supplier') { $comptypesupplier = "selected"; }
				else if($companytype == 'client') { $comptypeclient = "selected"; }
				else if($companytype == 'project') { $comptypeproject = "selected"; }
				else if($companytype == 'associate') { $comptypeassociate = "selected"; }
				else if($companytype == 'personal') { $comptypepersonal = "selected"; }
				else if($companytype == 'partner') { $comptypepartner = "selected"; }
				else if($companytype == 'uncategorized') { $comptypeuncateg = "selected"; }
				else if($companytype == 'all') { $comptypeall = "selected"; }
			?>
			<select name="companytype" style="width: 15%; height: 4%; cursor: pointer;" class="poppins fs-4 fw-medium text-black border border-1 border-black rounded-3 me-2">
				<option>select</option>
				<option value="supplier" <?php echo $comptypesupplier; ?>>supplier</option>
				<option value="client" <?php echo $comptypeclient; ?>>client</option>
				<option value="project" <?php echo $comptypeproject; ?>>project</option>
				<option value="partner" <?php echo $comptypepartner; ?>>partner</option>
				<option value="associate" <?php echo $comptypeassociate; ?>>associate</option>
				<option value="personal" <?php echo $comptypepersonal; ?>>personal</option>
				<option value="uncategorized" <?php echo $comptypeuncateg; ?>>uncategorized</option>
				<option value="all" <?php echo $comptypeall; ?>>all contact person</option>
			</select>
			<?php
				if($orderby == 'tblcompany.company') { $ordercompany = "selected"; }
				else if($orderby == 'tblcontact.name_first') { $ordernamefirst = "selected"; }
				else if($orderby == 'tblcompany.ofc_city') { $orderofccity = "selected"; }
				else if($orderby == 'tblcompany.ofc_province') { $orderofcprovince = "selected"; }
				else if($orderby == 'tblcompany.ofc_country') { $orderofccountry = "selected"; }
				else if($orderby == 'tblcompany.ofc_email') { $orderofcemail = "selected"; }
			?>
			<select name="orderby" style="width: 10%; height: 4%; cursor: pointer;" class="poppins fs-4 fw-medium text-black border border-1 border-black rounded-3 me-2">
				<option value="tblcompany.company" <?php echo $ordercompany; ?>>companies</option>
				<option value="tblcompany.ofc_city" <?php echo $orderofccity; ?>>city/town</option>
				<option value="tblcompany.ofc_province" <?php echo $orderofcprovince; ?>>province</option>
				<option value="tblcompany.ofc_country" <?php echo $orderofccountry; ?>>country</option>
				<option value="tblcompany.ofc_email" <?php echo $orderofcemail; ?>>email</option>
				<option value="tblcontact.name_first" <?php echo $ordernamefirst; ?>>first name</option>
			</select>
			<select name="orderdirection" style="width: 10%; height: 4%; cursor: pointer;" class="poppins fs-4 fw-medium text-black border border-1 border-black rounded-3 me-2">
				<option value="ASC">ascending</option>
				<option value="DESC">descending</option>
			</select>
			<input type="submit" value="Submit" id="subbtn" class="poppins fs-4 fw-medium text-white border border-1 border-success rounded-3 bg-success">
		</form>
		</div>
	</div>

<div class="d-flex justify-content-center" style="margin-left: -1.9rem;">
<div class="d-flex justify-content-center p-3 rounded-2" style="width: 99%; box-shadow: 0 0 8px rgba(0, 0, 0, 0.1), 0 0 8px rgba(0, 0, 0, 0.1), 0 0 8px rgba(0, 0, 0, 0.1), 0 0 5px rgba(0, 0, 0, 0.1);">
	<table class="w-100 table table-striped poppins">
	<?php
		if($companytype <> 'all') {
	?>
		<tr>
			<th>Count</th>
			<th>Company Name</th>
			<th>Address</th>
			<th>Landline</th>
			<th>Fax</th>
			<th>Email/Url</th>
			<th>Contact Person</th>
			<th>Type</th>
		</tr>
	<?php
		} else {
	?>
		<table>
			<tr>
				<th>Count</th>
				<th>Company Name</th>
				<th>Address</th>
				<th>Landline</th>
				<th>Fax</th>
				<th>Email/Url</th>
				<th>Contact Person</th>
				<th>Type</th>
			</tr>
		</table>
	<?php
		}

    if($companytype == 'supplier') {
      $result = mysql_query("SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcompany LEFT JOIN tblcontact ON tblcompany.supplierid = tblcontact.supplierid WHERE tblcompany.company_type=\"$companytype\" ORDER BY $orderby $orderdirection", $dbh);
    }
    else if($companytype == 'client' || $companytype == 'partner' || $companytype == 'associate') {
      $result = mysql_query("SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcompany LEFT JOIN tblcontact ON tblcompany.contactid = tblcontact.contactid WHERE tblcompany.company_type=\"$companytype\" ORDER BY $orderby $orderdirection", $dbh);
    }
    else if($companytype == 'project') {
      $result = mysql_query("SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_period FROM tblcompany LEFT JOIN tblproject1 ON tblcompany.proj_code = tblproject1.proj_code LEFT JOIN tblcontact ON tblcompany.employeeid = tblcontact.employeeid WHERE tblcompany.company_type=\"$companytype\" ORDER BY $orderby $orderdirection", $dbh);
    }
    else if($companytype == 'personal') {
      $result = mysql_query("SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2 FROM tblcompany LEFT JOIN tblcontact ON tblcompany.employeeid = tblcontact.employeeid WHERE tblcompany.company_type=\"$companytype\" ORDER BY $orderby $orderdirection", $dbh);
    }
    else if($companytype == 'uncategorized') {
      $result = mysql_query("SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid FROM tblcompany WHERE tblcompany.companyid <> '' ORDER BY $orderby $orderdirection", $dbh);
    }
    else if($companytype == 'all') {
      if($orderby == 'tblcontact.name_first') {
		$result11 = mysql_query("SELECT tblcontact.contactid, tblcontact.loginid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.num_mobile3_cc, tblcontact.num_mobile3_ac, tblcontact.num_mobile3, tblcontact.email1, tblcontact.email2, tblcontact.email3, tblcontact.url, tblcontact.remarks_contact, tblcontact.contact_type, tblcontact.supplierid, tblcontact.emergrelation, tblcontact.emergempid, tblcontact.proj_code, tblcontact.persempid, tblcontact.persrelation FROM tblcontact WHERE contact_type <> 'personnel' ORDER BY contact_type ASC, name_first $orderdirection", $dbh);
      } else {
		$result = mysql_query("SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid FROM tblcompany WHERE tblcompany.company_type<>\"uncategorized\" ORDER BY $orderby $orderdirection", $dbh);
      }
    }

    if($companytype <> 'all') {
    	while ($myrow = mysql_fetch_row($result)) {
			$found = 1;
			$pid = $myrow[0];
			$companyid = $pid;
			$company = $myrow[1];
			$branch = $myrow[2];
			$ofc_address1 = $myrow[3];
			$ofc_address2 = $myrow[4];
			$ofc_city = $myrow[5];
			$ofc_province = $myrow[6];
			$ofc_zipcode = $myrow[7];
			$ofc_country = $myrow[8];
			$ofc_num1_cc = $myrow[9];
			$ofc_num1_ac = $myrow[10];
			$ofc_num1 = $myrow[11];
			$ofc_num1_ext = $myrow[12];
			$ofc_num2_cc = $myrow[13];
			$ofc_num2_ac = $myrow[14];
			$ofc_num2 = $myrow[15];
			$ofc_num2_ext = $myrow[16];
			$ofc_num3_cc = $myrow[17];
			$ofc_num3_ac = $myrow[18];
			$ofc_num3 = $myrow[19];
			$ofc_num3_ext = $myrow[20];
			$ofc_fax_cc = $myrow[21];
			$ofc_fax_ac = $myrow[22];
			$ofc_fax = $myrow[23];
			$ofc_fax2_cc = $myrow[24];
			$ofc_fax2_ac = $myrow[25];
			$ofc_fax2 = $myrow[26];
			$ofc_mobile_cc = $myrow[27];
			$ofc_mobile_ac = $myrow[28];
			$ofc_mobile = $myrow[29];
			$ofc_email = $myrow[30];
			$ofc_url = $myrow[31];
			$products = $myrow[32];
			$services = $myrow[33];
			$remarks_company = $myrow[34];
			$company_type = $myrow[35];
			$supplierid = $myrow[36];
			$name_last = $myrow[37];
			$name_first = $myrow[38];
			$name_middle = $myrow[39];
			$contact_gender = $myrow[40];
			$picture = $myrow[41];
			$position = $myrow[42];
			$num_mobile1_cc = $myrow[43];
			$num_mobile1_ac = $myrow[44];
			$num_mobile1 = $myrow[45];
			$num_mobile2_cc = $myrow[46];
			$num_mobile2_ac = $myrow[47];
			$num_mobile2 = $myrow[48];

	if($companytype == 'project') {
		$proj_code = $myrow[49];
		$proj_fname = $myrow[50];
		$proj_sname = $myrow[51];
		$proj_period = $myrow[52];
	}

	$count = $count + 1;
?>
	<tr>
		<td><?php $count; ?></td>
		<td>
<?php
	if($companytype == 'project') {
		echo "$proj_code - $proj_fname<br>$proj_sname"; }
	else { echo "$company"; }
		echo "</td>";
		echo "<td>$ofc_address1 $ofc_address2 $ofc_city<br>$ofc_province $ofc_zipcode $ofc_country</td>";
		echo "<td>$ofc_num1_cc $ofc_num1_ac $ofc_num1<br>$ofc_num2_cc $ofc_num2_ac $ofc_num2<br>$ofc_num3_cc $ofc_num3_ac $ofc_num3</td>";
		echo "<td>$ofc_fax_cc $ofc_fax_ac $ofc_fax<br>$ofc_fax2_cc $ofc_fax2_ac $ofc_fax2</td><td><a href=\"mailto:$ofc_email\">$ofc_email</a><br><a href=\"http://$ofc_url\" target=\"_blank\">$ofc_url</a></td>";
		echo "<td>$name_first $name_middle[0] $name_last<br>$position<br>$num_mobile1_cc $num_mobile1_ac $num_mobile1<br>$num_mobile2_cc $num_mobile2_ac $num_mobile2</td>";
		echo "<td>$companytype</td></tr>";
     }
    } 
	else {
    	while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$contactid11 = $myrow11[0];
			$loginid11 = $myrow11[1];
			$companyid11 = $myrow11[2];
			$employeeid11 = $myrow11[3];
			$name_last11 = $myrow11[4];
			$name_first11 = $myrow11[5];
			$name_middle11 = $myrow11[6];
			$contact_gender11 = $myrow11[7];
			$picture11 = $myrow11[8];
			$position11 = $myrow11[9];
			$contact_address111 = $myrow11[10];
			$contact_address211 = $myrow11[11];
			$contact_city11 = $myrow11[12];
			$contact_province11 = $myrow11[13];
			$contact_zipcode11 = $myrow11[14];
			$contact_country11 = $myrow11[15];
			$num_res1_cc11 = $myrow11[16];
			$num_res1_ac11 = $myrow11[17];
			$num_res111 = $myrow11[18];
			$num_res2_cc11 = $myrow11[19];
			$num_res2_ac11 = $myrow11[20];
			$num_res211 = $myrow11[21];
			$num_mobile1_cc11 = $myrow11[22];
			$num_mobile1_ac11 = $myrow11[23];
			$num_mobile111 = $myrow11[24];
			$num_mobile2_cc11 = $myrow11[25];
			$num_mobile2_ac11 = $myrow11[26];
			$num_mobile211 = $myrow11[27];
			$num_mobile3_cc11 = $myrow11[28];
			$num_mobile3_ac11 = $myrow11[29];
			$num_mobile311 = $myrow11[30];
			$email111 = $myrow11[31];
			$email211 = $myrow11[32];
			$email311 = $myrow11[33];
			$url11 = $myrow11[34];
			$remarks_contact11 = $myrow11[35];
			$contact_type11 = $myrow11[36];
			$supplierid11 = $myrow11[37];
			$emergrelation11 = $myrow11[38];
			$emergempid11 = $myrow11[39];
			$proj_code11 = $myrow11[40];
			$persempid11 = $myrow11[41];
			$persrelation11 = $myrow11[42];

	$count11 = $count11 + 1;

	echo "<tr><td>$count11</td>";
	echo "<td>$name_first11 $name_middle11[0] $name_last11<br>$position11</td>";
	echo "<td>$contact_address111 $contact_address211 $contact_city11<br>$contact_province11 $contact_zipcode11 $contact_country11</td>";
	echo "<td>$num_res1_cc11 $num_res1_ac11 $num_res111<br>$num_res2_cc11 $num_res2_ac11 $num_res211</td>";
	echo "<td>$num_mobile1_cc11 $num_mobile1_ac11 $num_mobile111<br>$num_mobile2_cc11 $num_mobile2_ac11 $num_mobile211<br>$num_mobile3_cc11 $num_mobile3_ac11 $num_mobile311</td><td><a href=\"mailto:$email111\">$email111</a><br><a href=\"mailto:$email211\">$email211</a><br><a href=\"mailto:$email311\">$email311</a><br><a href=\"http://$url11\" target=\"_blank\">$url11</a></td>";
	echo "<td>";

	if($supplierid11 != '') {
		$result12 = mysql_query("SELECT companyid, company, branch FROM tblcompany WHERE supplierid=\"$supplierid11\"", $dbh);
		if($result12 != '') {
			while($myrow12 = mysql_fetch_row($result12)) {
				$found12 = 1;
				$companyid12 = $myrow12[0];
				$company12 = $myrow12[1];
				$branch12 = $myrow12[2];
			}
		}
	  echo "<a href=\"moreinfobiz.php?pid=$companyid12&loginid=$loginid\" target=\"_blank\">$company12 $branch12</a><br>";
	}

	if($proj_code11 != '') {
		$result15 = mysql_query("SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$proj_code11\"", $dbh);
			if($result15 != '') {
			while($myrow15 = mysql_fetch_row($result15)) {
				$found15 = 1;
				$projectid15 = $myrow15[0];
				$proj_code15 = $myrow15[1];
				$proj_fname15 = $myrow15[2];
				$proj_sname15 = $myrow15[3];
			}
		}
	echo "<a href=\"moreinfoproj.php?pid=$projectid15&loginid=$loginid\" target=\"_blank\">$proj_code15 - $proj_sname15</a>";
	}

	if($emergempid11 != '') {
		$result16 = mysql_query("SELECT contactid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$emergempid11\"", $dbh);
		if($result16 != '') {
			while($myrow16 = mysql_fetch_row($result16)) {
				$found16 = 1;
				$contactid16 = $myrow16[0];
				$employeeid16 = $myrow16[1];
				$name_last16 = $myrow16[2];
				$name_first16 = $myrow16[3];
				$name_middle16 = $myrow16[4];
			}
		}
	echo "<a href=\"personnelmoreinfo?pid=$employeeid16&loginid=$loginid\" target=\"_blank\">$employeeid16 - $name_first16 $name_middle16[0] $name_last16</a><br>";
	}

	if($persempid11 != '') {
		$result14 = mysql_query("SELECT contactid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$persempid11\"", $dbh);
		if($result14 != '') {
			while($myrow14 = mysql_fetch_row($result14)) {
				$found14 = 1;
				$contactid14 = $myrow14[0];
				$employeeid14 = $myrow14[1];
				$name_last14 = $myrow14[2];
				$name_first14 = $myrow14[3];
				$name_middle14 = $myrow14[4];
			}
		}
	echo "<a href=\"personnelmoreinfo?pid=$employeeid16&loginid=$loginid\" target=\"_blank\">$employeeid14 - $name_first14 $name_middle14[0] $name_last14<br>$persrelation11</a><br>";
	}

	echo "</td>";
        echo "<td>$contact_type11</td>";
	echo "<td><a href=businesspersedit.php?loginid=$loginid&cid=$contactid11>Edit</td></tr>";
      }
    }
?>

</table>
</div>
</div>

	<div class="d-flex justify-content-end mt-4">
        <button id="backbtn" class="border border-1 border-primary rounded-3" style="width: 12.5%; height: 40px;">
            <a href="<?php echo 'index2.php?loginid=' . $loginid ?>" class="text-white text-decoration-none poppins fw-medium fs-4">Back</a>
        </button>
    </div>

<?php
     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 
  
     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
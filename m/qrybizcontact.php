<?php
//
// qrybizcontact.php
// fr: ../vc/vbizcontact.php
//
require '../includes/dbh.php';

	if($disptyp=='' || $disptyp=='all') {
		$res11query="SELECT companyid, company, branch, ofc_address1, ofc_address2, ofc_city, ofc_province, ofc_zipcode, ofc_country, ofc_num1_cc, ofc_num1_ac, ofc_num1, ofc_num1_ext, ofc_num2_cc, ofc_num2_ac, ofc_num2, ofc_num2_ext, ofc_num3_cc, ofc_num3_ac, ofc_num3, ofc_num3_ext, ofc_fax_cc, ofc_fax_ac, ofc_fax, ofc_fax2_cc, ofc_fax2_ac, ofc_fax2, ofc_mobile_cc, ofc_mobile_ac, ofc_mobile, ofc_email, ofc_url, products, services, supplierid, contactid, proj_code, employeeid, comptypassocrel FROM tblcompany WHERE company<>'' ORDER BY company ASC";
	} else {
		$res11query="SELECT companyid, company, branch, ofc_address1, ofc_address2, ofc_city, ofc_province, ofc_zipcode, ofc_country, ofc_num1_cc, ofc_num1_ac, ofc_num1, ofc_num1_ext, ofc_num2_cc, ofc_num2_ac, ofc_num2, ofc_num2_ext, ofc_num3_cc, ofc_num3_ac, ofc_num3, ofc_num3_ext, ofc_fax_cc, ofc_fax_ac, ofc_fax, ofc_fax2_cc, ofc_fax2_ac, ofc_fax2, ofc_mobile_cc, ofc_mobile_ac, ofc_mobile, ofc_email, ofc_url, products, services, supplierid, contactid, proj_code, employeeid, comptypassocrel FROM tblcompany WHERE company<>'' AND company_type=\"$disptyp\" ORDER BY company ASC";
	}
	$result11=""; $found11=0; $ctr11=0; $data="";
	$result11=$dbh->query($res11query);
	$companyidArr=array();
	$companyArr=array();
	$branchArr=array();
	$ofc_address1Arr=array();
	$ofc_address2Arr=array();
	$ofc_cityArr=array();
	$ofc_provinceArr=array();
	$ofc_zipcodeArr=array();
	$ofc_countryArr=array();
	$ofc_num1_ccArr=array();
	$ofc_num1_acArr=array();
	$ofc_num1Arr=array();
	$ofc_num1_extArr=array();
	$ofc_num2_ccArr=array();
	$ofc_num2_acArr=array();
	$ofc_num2Arr=array();
	$ofc_num2_extArr=array();
	$ofc_num3_ccArr=array();
	$ofc_num3_acArr=array();
	$ofc_num3Arr=array();
	$ofc_num3_extArr=array();
	$ofc_fax_ccArr=array();
	$ofc_fax_acArr=array();
	$ofc_faxArr=array();
	$ofc_fax2_ccArr=array();
	$ofc_fax2_acArr=array();
	$ofc_fax2Arr=array();
	$ofc_mobile_ccArr=array();
	$ofc_mobile_acArr=array();
	$ofc_mobileArr=array();
	$ofc_emailArr=array();
	$ofc_urlArr=array();
	$productsArr=array();
	$servicesArr=array();
	$supplieridArr=array();
	$contactidArr=array();
	$proj_codeArr=array();
	$employeeidArr=array();
	$comptypassocrelArr=array();
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		array_push($employeeidArr, $myrow11['employeeid']);
		array_push($companyidArr, $myrow11['companyid']);
		array_push($companyArr, $myrow11['company']);
		array_push($branchArr, $myrow11['branch']);
		array_push($ofc_address1Arr, $myrow11['ofc_address1']);
		array_push($ofc_address2Arr, $myrow11['ofc_address2']);
		array_push($ofc_cityArr, $myrow11['ofc_city']);
		array_push($ofc_provinceArr, $myrow11['ofc_province']);
		array_push($ofc_zipcodeArr, $myrow11['ofc_zipcode']);
		array_push($ofc_countryArr, $myrow11['ofc_country']);
		array_push($ofc_num1_ccArr, $myrow11['ofc_num1_cc']);
		array_push($ofc_num1_acArr, $myrow11['ofc_num1_ac']);
		array_push($ofc_num1Arr, $myrow11['ofc_num1']);
		array_push($ofc_num1_extArr, $myrow11['ofc_num1_ext']);
		array_push($ofc_num2_ccArr, $myrow11['ofc_num2_cc']);
		array_push($ofc_num2_acArr, $myrow11['ofc_num2_ac']);
		array_push($ofc_num2Arr, $myrow11['ofc_num2']);
		array_push($ofc_num2_extArr, $myrow11['ofc_num2_ext']);
		array_push($ofc_num3_ccArr, $myrow11['ofc_num3_cc']);
		array_push($ofc_num3_acArr, $myrow11['ofc_num3_ac']);
		array_push($ofc_num3Arr, $myrow11['ofc_num3']);
		array_push($ofc_num3_extArr, $myrow11['ofc_num3_ext']);
		array_push($ofc_fax_ccArr, $myrow11['ofc_fax_cc']);
		array_push($ofc_fax_acArr, $myrow11['ofc_fax_ac']);
		array_push($ofc_faxArr, $myrow11['ofc_fax']);
		array_push($ofc_fax2_ccArr, $myrow11['ofc_fax2_cc']);
		array_push($ofc_fax2_acArr, $myrow11['ofc_fax2_ac']);
		array_push($ofc_fax2Arr, $myrow11['ofc_fax2']);
		array_push($ofc_mobile_ccArr, $myrow11['ofc_mobile_cc']);
		array_push($ofc_mobile_acArr, $myrow11['ofc_mobile_ac']);
		array_push($ofc_mobileArr, $myrow11['ofc_mobile']);
		array_push($ofc_emailArr, $myrow11['ofc_email']);
		array_push($ofc_urlArr, $myrow11['ofc_url']);
		array_push($productsArr, $myrow11['products']);
		array_push($servicesArr, $myrow11['services']);
		array_push($supplieridArr, $myrow11['supplierid']);
		array_push($contactidArr, $myrow11['contactid']);
		array_push($proj_codeArr, $myrow11['proj_code']);
		array_push($employeeidArr, $myrow11['employeeid']);
		array_push($comptypassocrelArr, $myrow11['comptypassocrel']);
		} // while
	} // if
		
$dbh->close();
?>

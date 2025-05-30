<?php

// 20190606 modified
// fn: dirbizlist.php
// fr: businessedit.php
// req vars: $companytype $orderby $orderdirection

	echo "<table class=\"table table-striped\">";
	echo "<thead>";
    if($companytype != 'all') {
      echo "<tr><th>count</th><th>company_name</th><th>address</th><th>landline</th><th>fax</th><th>email/url</th><th>contact_person</th><th>type</th>";
			if($dirbizdisp==1) {
			echo "<th colspan=\"2\">Action</th>";
			} // if
			echo "</tr>";
    } else {
      echo "<tr><th>count</th><th>contact_person</th><th>address</th><th>landline</th><th>mobile</th><th>email/url</th><th>related_link</th><th>type</th>";
			if($dirbizdisp==1) {
			echo "<th colspan=\"2\">Action</th>";
			} // if
			echo "</tr>";
    } // if-else
	echo "</thead>";
	echo "<tbody>";
    if($companytype == 'supplier') {
			$resquery="SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid, tblcompany.comptypassocrel, tblcompany.tin_number FROM tblcompany WHERE tblcompany.company_type=\"$companytype\" ORDER BY $orderby $orderdirection";
    } else if($companytype == 'client' || $companytype == 'partner' || $companytype == 'associate') {
			$resquery="SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid, tblcompany.comptypassocrel, tblcompany.tin_number FROM tblcompany WHERE tblcompany.company_type=\"$companytype\" ORDER BY $orderby $orderdirection";
    } else if($companytype == 'project') {
      $resquery = "SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid, tblcompany.comptypassocrel, tblcompany.tin_number,  tblproject1.proj_code, tblproject1.proj_fname, tblproject1.proj_sname, tblproject1.proj_period FROM tblcompany LEFT JOIN tblproject1 ON tblcompany.proj_code = tblproject1.proj_code WHERE tblcompany.company_type=\"$companytype\" ORDER BY $orderby $orderdirection";
    } else if($companytype == 'personal') {
      $resquery = "SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid FROM tblcompany WHERE tblcompany.company_type=\"$companytype\" ORDER BY $orderby $orderdirection";
    } else if($companytype == 'uncategorized') {
      $resquery = "SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid, tblcompany.comptypassocrel, tblcompany.tin_number FROM tblcompany WHERE tblcompany.companyid <> '' AND tblcompany.company_type<>'spouse_employer' ORDER BY $orderby $orderdirection";
    } else if($companytype == 'all') {

      // if($orderby == 'tblcontact.name_first') {
	$res11query = "SELECT tblcontact.contactid, tblcontact.loginid, tblcontact.companyid, tblcontact.employeeid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_res2_cc, tblcontact.num_res2_ac, tblcontact.num_res2, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.num_mobile3_cc, tblcontact.num_mobile3_ac, tblcontact.num_mobile3, tblcontact.email1, tblcontact.email2, tblcontact.email3, tblcontact.url, tblcontact.remarks_contact, tblcontact.contact_type, tblcontact.supplierid, tblcontact.emergrelation, tblcontact.emergempid, tblcontact.proj_code, tblcontact.persempid, tblcontact.persrelation FROM tblcontact WHERE contact_type <> 'personnel' AND contact_type <> 'emergency' AND tblcontact.contact_type<>'applicant' ORDER BY contact_type ASC, name_first $orderdirection";
      // } else {
	// $res11query = "SELECT tblcompany.companyid, tblcompany.company, tblcompany.branch, tblcompany.ofc_address1, tblcompany.ofc_address2, tblcompany.ofc_city, tblcompany.ofc_province, tblcompany.ofc_zipcode, tblcompany.ofc_country, tblcompany.ofc_num1_cc, tblcompany.ofc_num1_ac, tblcompany.ofc_num1, tblcompany.ofc_num1_ext, tblcompany.ofc_num2_cc, tblcompany.ofc_num2_ac, tblcompany.ofc_num2, tblcompany.ofc_num2_ext, tblcompany.ofc_num3_cc, tblcompany.ofc_num3_ac, tblcompany.ofc_num3, tblcompany.ofc_num3_ext, tblcompany.ofc_fax_cc, tblcompany.ofc_fax_ac, tblcompany.ofc_fax, tblcompany.ofc_fax2_cc, tblcompany.ofc_fax2_ac, tblcompany.ofc_fax2, tblcompany.ofc_mobile_cc, tblcompany.ofc_mobile_ac, tblcompany.ofc_mobile, tblcompany.ofc_email, tblcompany.ofc_url, tblcompany.products, tblcompany.services, tblcompany.remarks_company, tblcompany.company_type, tblcompany.supplierid, tblcompany.comptypassocrel, tblcompany.tin_number FROM tblcompany WHERE tblcompany.company_type<>\"uncategorized\" ORDER BY $orderby $orderdirection";
      // } // if-else($orderby)

    } // if-else($companytype)

	$result=$dbh2->query($resquery);
  if($companytype != 'all') {
		if($result->num_rows>0) {
			while($myrow=$result->fetch_assoc()) {
	$found = 1;
	$pid = $myrow['companyid'];
	$companyid = $pid;
	$company = $myrow['company'];
	$branch = $myrow['branch'];
	$ofc_address1 = $myrow['ofc_address1'];
	$ofc_address2 = $myrow['ofc_address2'];
	$ofc_city = $myrow['ofc_city'];
	$ofc_province = $myrow['ofc_province'];
	$ofc_zipcode = $myrow['ofc_zipcode'];
	$ofc_country = $myrow['ofc_country'];
	$ofc_num1_cc = $myrow['ofc_num1_cc'];
	$ofc_num1_ac = $myrow['ofc_num1_ac'];
	$ofc_num1 = $myrow['ofc_num1'];
	$ofc_num1_ext = $myrow['ofc_num1_ext'];
	$ofc_num2_cc = $myrow['ofc_num2_cc'];
	$ofc_num2_ac = $myrow['ofc_num2_ac'];
	$ofc_num2 = $myrow['ofc_num2'];
	$ofc_num2_ext = $myrow['ofc_num2_ext'];
	$ofc_num3_cc = $myrow['ofc_num3_cc'];
	$ofc_num3_ac = $myrow['ofc_num3_ac'];
	$ofc_num3 = $myrow['ofc_num3'];
	$ofc_num3_ext = $myrow['ofc_num3_ext'];
	$ofc_fax_cc = $myrow['ofc_fax_cc'];
	$ofc_fax_ac = $myrow['ofc_fax_ac'];
	$ofc_fax = $myrow['ofc_fax'];
	$ofc_fax2_cc = $myrow['ofc_fax2_cc'];
	$ofc_fax2_ac = $myrow['ofc_fax2_ac'];
	$ofc_fax2 = $myrow['ofc_fax2'];
	$ofc_mobile_cc = $myrow['ofc_mobile_cc'];
	$ofc_mobile_ac = $myrow['ofc_mobile_ac'];
	$ofc_mobile = $myrow['ofc_mobile'];
	$ofc_email = $myrow['ofc_email'];
	$ofc_url = $myrow['ofc_url'];
	$products = $myrow['products'];
	$services = $myrow['services'];
	$remarks_company = $myrow['remarks_company'];
	$company_type = $myrow['company_type'];
	$supplierid = $myrow['supplierid'];
	// $contactid = $myrow['contactid'];
	$comptypassocrel = $myrow['comptypassocrel'];
	$tin_number = $myrow['tin_number'];

	if($companytype == 'project') {
	  $proj_code = $myrow['proj_code'];
	  $proj_fname = $myrow['proj_fname'];
	  $proj_sname = $myrow['proj_sname'];
	  $proj_period = $myrow['proj_period'];
	}

	$count = $count + 1;

	echo "<tr><td>$count</td>";
	echo "<td>";
	if($companytype == 'project') {
		if($proj_code!='') {
		echo "$proj_code - $proj_fname<br>$proj_sname";
		} else {
			if($company=='' && $supplierid!='') {
			echo "$supplierid";
			} else {
			echo "$company";
			} // if-else
		} // if-else
	} else {
		if($company=='' && $supplierid!='') {
		echo "$supplierid";
		} else {
		echo "$company";
		} // if-else
	} // if-else($companytype)
	echo "</td>";
	echo "<td>$ofc_address1 $ofc_address2 $ofc_city<br>$ofc_province $ofc_zipcode $ofc_country";
	// echo "<br>cid:$companyid";
	// echo "|resqry:$resquery";
	// echo "<br>res11qry:$res11query";
	echo "</td>";
	echo "<td>$ofc_num1_cc $ofc_num1_ac $ofc_num1<br>$ofc_num2_cc $ofc_num2_ac $ofc_num2<br>$ofc_num3_cc $ofc_num3_ac $ofc_num3</td>";
	echo "<td>$ofc_fax_cc $ofc_fax_ac $ofc_fax<br>$ofc_fax2_cc $ofc_fax2_ac $ofc_fax2</td><td><a href=\"mailto:$ofc_email\">$ofc_email</a><br><a href=\"http://$ofc_url\">$ofc_url</a></td>";
	// echo "<td>$name_first $name_middle[0] $name_last<br>$position<br>$num_mobile1_cc $num_mobile1_ac $num_mobile1<br>$num_mobile2_cc $num_mobile2_ac $num_mobile2</td>";
	echo "<td>";
	$result12=""; $found12=0; $ctr12=0;
	if($supplierid != "") {
	$res12query = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.email1 FROM tblcontact WHERE tblcontact.companyid=$companyid OR tblcontact.supplierid=\"$supplierid\"";
	} else {
	$res12query = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.picture, tblcontact.position, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.email1 FROM tblcontact WHERE tblcontact.companyid=$companyid";
	} // if-else($supplierid)
	$result12=$dbh2->query($res12query);
	if($result12->num_rows>0) {
		while($myrow12=$result12->fetch_assoc()) {
		$found12 = 1;
		$name_last12 = $myrow12['name_last'];
		$name_first12 = $myrow12['name_first'];
		$name_middle12 = $myrow12['name_middle'];
		$contact_gender12 = $myrow12['contact_gender'];
		$picture12 = $myrow12['picture'];
		$position12 = $myrow12['position'];
		$num_mobile1_cc12 = $myrow12['num_mobile1_cc'];
		$num_mobile1_ac12 = $myrow12['num_mobile1_ac'];
		$num_mobile112 = $myrow12['num_mobile1'];
		$num_mobile2_cc12 = $myrow12['num_mobile2_cc'];
		$num_mobile2_ac12 = $myrow12['num_mobile2_ac'];
		$num_mobile212 = $myrow12['num_mobile2'];
		$email112 = $myrow12['email1'];
		$ctr12 = $ctr12 + 1;
		echo "$name_first12 $name_last12";
		if($position != "") {
			echo "<br>$position12";
		} // if($position)
		if($num_mobile112 != "") {
			echo "<br>";
			if($num_mobile1_cc12 != "") {
				echo "&nbsp;+$num_mobile1_cc12";
			} // if($num_mobile1_cc12
			if($num_mobile1_ac12 != "") {
				echo "&nbsp;$num_mobile1_ac12";
			} // if($num_mobile1_ac12)
			echo "&nbsp;$num_mobile112";
		} // if($num_mobile112)
		if($email112 != "") {
			echo "<br><a href=\"mailto:$email112\">$email112</a>";
		} // if($email112)
		if($ctr12 >= 1) {
			echo "<br>";
		} // if($ctr12)
		} // while
	} // if
	echo "</td>";
	echo "<td>$companytype";
	if(($companytype=="associate") && (($comptypassocrel != "") || ($comptypassocrel != "-"))) {
		echo "<br>";
		if($comptypassocrel == "nkmain") {
			echo "NK main";
		} else if($comptypassocrel == "nkgroup") {
			echo "NK group";
		} else if($comptypassocrel == "others") {
			echo "others";
		} // if-else($comptypassocrel)
	} // if($companytype)
	echo "</td>";

	if($dirbizdisp==1) {
	echo "<form action=\"businessedit2.php?pid=$pid&loginid=$loginid\" method=\"POST\" name=\"businessedit2\">";
	echo "<input type='hidden' name='pid' value='$pid'>";
	echo "<input type='hidden' name='loginid' value='$loginid'>";
	echo "<td>";
	// echo "$pid|$loginid|";
	// echo "<a href=businessedit2.php?pid=$pid&loginid=$loginid>Edit</a>";
	echo "<button type=\"submit\" class=\"btn btn-primary\">Edit</button>";
	// echo "<br>cid:$companyid|sid:$supplierid|f12:$found12<br>r12qry:$res12query";
	echo "</td>";
	echo "</form>";
	echo "<form action=\"businessdel.php?pid=$pid&loginid=$loginid\" method=\"POST\" name=\"businessdel\">";
	echo "<input type='hidden' name='pid' value='$pid'>";
	echo "<input type='hidden' name='loginid' value='$loginid'>";
	echo "<td>";
	// echo "<a href=businessdel.php?pid=$pid&loginid=$loginid>Del</a>";
	echo "<button type=\"submit\" class=\"btn btn-danger\">Delete</button>";
	echo "</td>";
	echo "</form>";
	} // if

	echo "</tr>";
			} // while
		} // if

    } else { // if($companytype)

		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
	$found11 = 1;
	$contactid11 = $myrow11['contactid'];
	$loginid11 = $myrow11['loginid'];
	$companyid11 = $myrow11['companyid'];
	$employeeid11 = $myrow11['employeeid'];
	$name_last11 = $myrow11['name_last'];
	$name_first11 = $myrow11['name_first'];
	$name_middle11 = $myrow11['name_middle'];
	$contact_gender11 = $myrow11['contact_gender'];
	$picture11 = $myrow11['picture'];
	$position11 = $myrow11['position'];
	$contact_address111 = $myrow11['contact_address1'];
	$contact_address211 = $myrow11['contact_address2'];
	$contact_city11 = $myrow11['contact_city'];
	$contact_province11 = $myrow11['contact_province'];
	$contact_zipcode11 = $myrow11['contact_zipcode'];
	$contact_country11 = $myrow11['contact_country'];
	$num_res1_cc11 = $myrow11['num_res1_cc'];
	$num_res1_ac11 = $myrow11['num_res1_ac'];
	$num_res111 = $myrow11['num_res1'];
	$num_res2_cc11 = $myrow11['num_res2_cc'];
	$num_res2_ac11 = $myrow11['num_res2_ac'];
	$num_res211 = $myrow11['num_res2'];
	$num_mobile1_cc11 = $myrow11['num_mobile1_cc'];
	$num_mobile1_ac11 = $myrow11['num_mobile1_ac'];
	$num_mobile111 = $myrow11['num_mobile1'];
	$num_mobile2_cc11 = $myrow11['num_mobile2_cc'];
	$num_mobile2_ac11 = $myrow11['num_mobile2_ac'];
	$num_mobile211 = $myrow11['num_mobile2'];
	$num_mobile3_cc11 = $myrow11['num_mobile3_cc'];
	$num_mobile3_ac11 = $myrow11['num_mobile3_ac'];
	$num_mobile311 = $myrow11['num_mobile3'];
	$email111 = $myrow11['email1'];
	$email211 = $myrow11['email2'];
	$email311 = $myrow11['email3'];
	$url11 = $myrow11['url'];
	$remarks_contact11 = $myrow11['remarks_contact'];
	$contact_type11 = $myrow11['contact_type'];
	$supplierid11 = $myrow11['supplierid'];
	$emergrelation11 = $myrow11['emergrelation'];
	$emergempid11 = $myrow11['emergempid'];
	$proj_code11 = $myrow11['proj_code'];
	$persempid11 = $myrow11['persempid'];
	$persrelation11 = $myrow11['persrelation'];

	$count11 = $count11 + 1;

	echo "<tr><td>$count11</td>";
	echo "<td>$name_first11 $name_middle11[0] $name_last11<br>$position11</td>";
	echo "<td>$contact_address111 $contact_address211 $contact_city11<br>$contact_province11 $contact_zipcode11 $contact_country11";
	// echo "cntctid:$contactid11";
	// echo "cmpid:$companyid11";
	// echo "|r11qry:$res11query";
	echo "</td>";
	echo "<td>$num_res1_cc11 $num_res1_ac11 $num_res111<br>$num_res2_cc11 $num_res2_ac11 $num_res211</td>";
	echo "<td>$num_mobile1_cc11 $num_mobile1_ac11 $num_mobile111<br>$num_mobile2_cc11 $num_mobile2_ac11 $num_mobile211<br>$num_mobile3_cc11 $num_mobile3_ac11 $num_mobile311</td><td><a href=\"mailto:$email111\">$email111</a><br><a href=\"mailto:$email211\">$email211</a><br><a href=\"mailto:$email311\">$email311</a><br><a href=\"http://$url11\">$url11</a></td>";
	// display related link
	echo "<td>";
	if($supplierid11 != '') {
	  $res12query="SELECT companyid, company, branch FROM tblcompany WHERE supplierid=\"$supplierid11\" LIMIT 1";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
	    $found12 = 1;
	    $companyid12 = $myrow12['companyid'];
	    $company12 = $myrow12['company'];
	    $branch12 = $myrow12['branch'];
			} // while
		} // if
	  echo "<a href=\"moreinfobiz.php?pid=$companyid12&loginid=$loginid\" target=\"_blank\">$company12 $branch12</a><br>";
	}
	if($companyid11 != '') {
	  $res12query="SELECT companyid, company, branch FROM tblcompany WHERE companyid=\"$companyid11\" LIMIT 1";
		$result12=""; $found12=0;
		$result12=$dbh2->query($res12query);
		if($result12->num_rows>0) {
			while($myrow12=$result12->fetch_assoc()) {
	    $found12 = 1;
	    $companyid12 = $myrow12['companyid'];
	    $company12 = $myrow12['company'];
	    $branch12 = $myrow12['branch'];
			} // while
		} // if
	  echo "<a href=\"moreinfobiz.php?pid=$companyid12&loginid=$loginid\" target=\"_blank\">$company12 $branch12</a><br>";
	} // if($supplierid11)
	if($proj_code11 != '') {
	  $res15query="SELECT projectid, proj_code, proj_fname, proj_sname FROM tblproject1 WHERE proj_code=\"$proj_code11\"";
		$result15=""; $found15=0;
		$result15=$dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15=$result15->fetch_assoc()) {
	    $found15 = 1;
	    $projectid15 = $myrow15['projectid'];
	    $proj_code15 = $myrow15['proj_code'];
	    $proj_fname15 = $myrow15['proj_fname'];
	    $proj_sname15 = $myrow15['proj_sname'];
			} // while
		} // if
	  echo "<a href=\"moreinfoproj.php?pid=$projectid15&loginid=$loginid\" target=\"_blank\">$proj_code15 - $proj_sname15</a>";
	} // if($proj_code11)
	if($emergempid11 != '') {
	  $res16query="SELECT contactid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$emergempid11\"";
		$result16=""; $found16=0;
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
	    $found16 = 1;
	    $contactid16 = $myrow16['contactid'];
	    $employeeid16 = $myrow16['employeeid'];
	    $name_last16 = $myrow16['name_last'];
	    $name_first16 = $myrow16['name_first'];
	    $name_middle16 = $myrow16['name_middle'];
			} // while
		} // if
	  echo "<a href=\"personnelmoreinfo?pid=$employeeid16&loginid=$loginid\" target=\"_blank\">$employeeid16 - $name_first16 $name_middle16[0] $name_last16</a><br>";
	} // if($emergempid11)
	if($persempid11 != '') {
	  $res14query="SELECT contactid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$persempid11\"";
		$result14=""; $found14=0;
		$result14=$dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14=$result14->fetch_assoc()) {
	    $found14 = 1;
	    $contactid14 = $myrow14['contactid'];
	    $employeeid14 = $myrow14['employeeid'];
	    $name_last14 = $myrow14['name_last'];
	    $name_first14 = $myrow14['name_first'];
	    $name_middle14 = $myrow14['name_middle'];
			} // while
		} // if
	  echo "<a href=\"personnelmoreinfo?pid=$employeeid16&loginid=$loginid\" target=\"_blank\">$employeeid14 - $name_first14 $name_middle14[0] $name_last14<br>$persrelation11</a><br>";
	} // if($persempid11)
	// echo "<br>cid:$companyid11|sid:$supplierid11|r12qry:$res12query</td>";

	echo "<td>$contact_type11</td>";

	if($dirbizdisp==1) {
	echo "<form action=\"businesspersedit.php?loginid=$loginid&cid=$contactid11\" method=\"GET\" name=\"businesspersedit\">";
	echo "<td>";
	// echo "<a href=businesspersedit.php?loginid=$loginid&cid=$contactid11>Edit</a>";
	echo "<button type=\"submit\" class=\"btn btn-primary\">Edit</button>";
	echo "</td>";
	echo "</form>";
	if($contact_type11 != 'emergency') {
		echo "<form action=\"businesspersdel.php?loginid=$loginid&cid=$contactid11\" method=\"GET\" name=\"businesspersdel\">";
	  echo "<td>";
		// echo "<a href=businesspersdel.php?loginid=$loginid&cid=$contactid11>Del</a>";
		echo "<button type=\"submit\" class=\"btn btn-danger\">Delete</button>";
		echo "</td>";
		echo "</form>";
	} else {
		echo "<td></td>";
	} // if-else
	} // if

	echo "</tr>";
	// reset variables
	$companyid12=''; $company12=''; $branch12='';
	$projectid15=''; $proj_code15=''; $proj_fname15=''; $proj_sname15=''; $contactid16=''; $employeeid16=''; $name_last16=''; $name_first16=''; $name_middle16=''; $contactid14=''; $employeeid14=''; $name_last14=''; $name_first14=''; $name_middle14=''; 

			} // while
		} // if
    } // if-else($companytype)

	echo "</tbody>";
	echo "</table>";
?>

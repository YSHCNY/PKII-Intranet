<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<!-- Include JS -->


</head>
<body class = ''>

<?php 

// start edit emergency contact

	$result = mysql_query("SELECT tblcontact.contactid, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_address1, tblcontact.contact_address2, tblcontact.contact_city, tblcontact.contact_province, tblcontact.contact_zipcode, tblcontact.contact_country, tblcontact.num_res1_cc, tblcontact.num_res1_ac, tblcontact.num_res1, tblcontact.num_mobile1_cc, tblcontact.num_mobile1_ac, tblcontact.num_mobile1, tblcontact.num_mobile2_cc, tblcontact.num_mobile2_ac, tblcontact.num_mobile2, tblcontact.email1, tblcontact.remarks_contact, tblcontact.emergrelation, tblcontact.emergempid FROM tblcontact WHERE tblcontact.contactid='$contactid' AND tblcontact.contact_type = 'emergency'", $dbh);
   
	while ($myrow = mysql_fetch_row($result))
	{
	  $em_contactid = $myrow[0];
	  $em_name_last = $myrow[1];
	  $em_name_first = $myrow[2];
	  $em_name_middle = $myrow[3];
	  $em_contact_address1 = $myrow[4];
	  $em_contact_address2 = $myrow[5];
	  $em_contact_city = $myrow[6];
	  $em_contact_province = $myrow[7];
	  $em_contact_zipcode = $myrow[8];
	  $em_contact_country = $myrow[9];
	  $em_num_res1_cc = $myrow[10];
	  $em_num_res1_ac = $myrow[11];
	  $em_num_res1 = $myrow[12];
	  $em_num_mobile1_cc = $myrow[13];
	  $em_num_mobile1_ac = $myrow[14];
	  $em_num_mobile1 = $myrow[15];
	  $em_num_mobile2_cc = $myrow[16];
	  $em_num_mobile2_ac = $myrow[17];
	  $em_num_mobile2 = $myrow[18];
	  $em_email1 = $myrow[19];
	  $em_remarks_contact = $myrow[20];
	  $em_emergrelation = $myrow[21];
	}

	?>
	<div class = 'px-4'>
 <div class="form-row">
    <div class="form-group mt-2 col-md-4">
      <label for="inputEmail4">Last</label>
      <input type="text" class="form-control" placeholder = 'Last Name Here...' name = 'name_last' >
    </div>

	<div class="form-group mt-2 col-md-4">
      <label for="inputEmail4">First</label>
      <input type="text" class="form-control" placeholder = 'First Name Here...' name = 'name_first' >
    </div>

	<div class="form-group mt-2 col-md-4">
      <label for="inputEmail4">Middle</label>
      <input type="text" class="form-control" placeholder = 'Middle Name Here...' name = 'name_middle' >
    </div>
   
  </div>


  <div class="form-group mt-2">
      <label for="inputEmail4">Relation</label>
      <input type="text" class="form-control" placeholder = 'Relation Here...' name = 'emergrelation' >
    </div>


	<div class="form-row">
    <div class="form-group mt-2 col-md-6">
      <label for="inputEmail4">Address 1</label>
      <input type="text" class="form-control" placeholder = 'Address 1...' name = 'contact_address1' >
    </div>

	<div class="form-group mt-2 col-md-6">
      <label for="inputEmail4">Address 2</label>
      <input type="text" class="form-control" placeholder = 'Address 2...' name = 'contact_address2' >
    </div>
   
  </div>



	<div class="form-row">
    <div class="form-group mt-2 col-md-3">
      <label for="inputEmail4">City</label>
      <input type="text" class="form-control" placeholder = 'City here..' name = 'contact_city' >
    </div>

	<div class="form-group mt-2 col-md-3">
      <label for="inputEmail4">Province</label>
      <input type="text" class="form-control" placeholder = 'Province here..' name = 'contact_province' >
    </div>

	<div class="form-group mt-2 col-md-3">
      <label for="inputEmail4">Zip Code</label>
      <input type="text" class="form-control" placeholder = 'Zip Code here..' name = 'contact_zipcode' >
    </div>

	<div class="form-group mt-2 col-md-3">
      <label for="inputEmail4">Country</label>
      <input type="text" class="form-control" placeholder = 'Country here..' name = 'contact_country' >
    </div>
   
  </div>



  <div class="form-row">
  <div class="form-group mt-2 col-md-2 text-end">
  <label for="">Landline 1</label>

    </div>
    <div class="form-group mt-2 col-md-2">
      <input type="text" class="form-control" placeholder = '00' name = 'num_res1_cc' >
    </div>
	<div class="form-group mt-2 col-md-2">
      <input type="text" class="form-control" placeholder = '00' name = 'num_res1_ac' >
    </div>

	<div class="form-group mt-2 col-md-6">
    
      <input type="text" class="form-control" placeholder = '00' name = 'num_res1' >
    </div>

  </div>


  <div class="form-row">

    <div class="form-group mt-2 col-md-2">
			<label for="">Country</label>
      <input type="text" class="form-control" placeholder = '00' name = 'num_mobile1_cc' >
    </div>
	<div class="form-group mt-2 col-md-2">
			<label for="">Area</label>
      <input type="text" class="form-control" placeholder = '00' name = 'num_mobile1_ac' >
    </div>

	<div class="form-group mt-2 col-md-6">
			<label for="">Cell</label>
    
      <input type="text" class="form-control" placeholder = '00' name = 'num_mobile1' >
    </div>


   
  </div>



  <div class="form-row">
 
    <div class="form-group mt-2 col-md-2">
	<label for="">Country</label>
      <input type="text" class="form-control" placeholder = '00' name = 'num_mobile2_cc' >
    </div>
	<div class="form-group mt-2 col-md-2">
	<label for="">Area</label>

      <input type="text" class="form-control" placeholder = '00' name = 'num_mobile2_ac' >
    </div>

	<div class="form-group mt-2 col-md-8">
	<label for="">Cell</label>
    
      <input type="text" class="form-control" placeholder = '00' name = 'num_mobile2' >
    </div>


  </div>



  <div class="form-group mt-2">
	<label for="">Email</label>
      <input type="text" class="form-control" placeholder = 'youremail@hotmail.com' name = 'email1' >
    </div>


	<div class="form-group mt-2">
	<label for="">Remarks</label>
      <input type="text" class="form-control" placeholder = 'Remarks here...' name = 'remarks_contact' >
    </div>

	</div>
<?php
	// echo "<input type=\"hidden\" name=\"em_contactid\" value=\"$em_contactid\">";
	// echo "<input name=name_last value=\"$em_name_last\"><input name=name_first value=\"$em_name_first\"><input name=name_middle value=\"$em_name_middle\">";
	// echo "LastNameFirstNameMiddleName</table>";
	// echo "Relation<input name=emergrelation value=\"$em_emergrelation\">";

	// echo "Address<textarea name=contact_address1 rows=2 cols=50>$em_contact_address1</textarea>";
	// echo "<textarea name=contact_address2 rows=2 cols=50>$em_contact_address2</textarea>";
	// echo "City<input name=contact_city value=\"$em_contact_city\">";
	// echo "Province<input name=contact_province value=\"$em_contact_province\">";
	// echo "Zip Code<input name=contact_zipcode value=$em_contact_zipcode>";
	// echo "Country<input name=contact_country value=\"$em_contact_country\">";

	// echo "Landline1";
	// echo "+<input size=4 name=num_res1_cc value=$em_num_res1_cc><input size=5 name=num_res1_ac value=$em_num_res1_ac><input name=num_res1 value=\"$em_num_res1\">";
	// echo "CountryAreaPhoneNumber</table>";

	// echo "Mobile1+<input size=4 name=num_mobile1_cc value=$em_num_mobile1_cc><input size=5 name=num_mobile1_ac value=$em_num_mobile1_ac><input name=num_mobile1 value=\"$em_num_mobile1\">";
	// echo "CountryAreaCellNumber</table>";

	// echo "Mobile2+<input size=4 name=num_mobile2_cc value=$em_num_mobile2_cc><input size=5 name=num_mobile2_ac value=$em_num_mobile2_ac><input name=num_mobile2 value=\"$em_num_mobile2\">";
	// echo "CountryAreaCellNumber</table>";

	// echo "Email1<input size=50 name=email1 value=$em_email1>";

    //     echo "Remarks<textarea name=remarks_contact value=$em_remarks_contact rows=3 cols=50>$em_remarks_contact</textarea>";

	// echo "&nbsp<input type=submit value='Update Emergency Contact Details'>";
	// echo "</table>";

// end edit emergency contact

   
 
    //  echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 


?> 
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect6');
        new Choices(element, { searchEnabled: true });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect7');
        new Choices(element, { searchEnabled: true });
    });
</script>
</body>
</html>

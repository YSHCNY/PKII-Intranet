<?php

// 20190606
// fn: dirbizmnu.php
// fr: businessedit.php
// req vars: $companytype $orderby $orderdirection

	echo "<table class=\"table\">";
	echo "<thead>";
      echo "<tr><th colspan=\"4\">List preferences</th></tr>";
	echo "</thead>";
	echo "<tbody>";
      echo "<tr><td><form action=\"businessedit.php?loginid=$loginid\" method=\"POST\" name=\"businessedit\">";
      if($companytype == 'supplier') { $comptypesupplier = "selected"; }
      else if($companytype == 'client') { $comptypeclient = "selected"; }
      else if($companytype == 'partner') { $comptypepartner = "selected"; }
      else if($companytype == 'associate') { $comptypeassociate = "selected"; }
      else if($companytype == 'project') { $comptypeproject = "selected"; }
      else if($companytype == 'personal') { $comptypepersonal = "selected"; }
      else if($companytype == 'uncategorized') { $comptypeuncateg = "selected"; }
      else if($companytype == 'all') { $comptypeall = "selected"; }
      echo "<select name=\"companytype\">";
      echo "<option>select</option>";
      echo "<option value=\"supplier\" $comptypesupplier>supplier</option>";
      echo "<option value=\"client\" $comptypeclient>client</option>";
      echo "<option value=\"partner\" $comptypepartner>partner</option>";
      echo "<option value=\"associate\" $comptypeassociate>associate</option>";
      echo "<option value=\"project\" $comptypeproject>project</option>";
      echo "<option value=\"personal\" $comptypepersonal>personal</option>";
      echo "<option value=\"uncategorized\" $comptypeuncateg>uncategorized</option>";
      echo "<option value=\"all\" $comptypeall>all contact person</option>";
      echo "</select></td>";
      if($orderby == 'tblcompany.company') { $ordercompany = "selected"; }
      else if($orderby == 'tblcontact.name_first') { $ordernamefirst = "selected"; }
      else if($orderby == 'tblcompany.ofc_city') { $orderofccity = "selected"; }
      else if($orderby == 'tblcompany.ofc_province') { $orderofcprovince = "selected"; }
      else if($orderby == 'tblcompany.ofc_country') { $orderofccountry = "selected"; }
      else if($orderby == 'tblcompany.ofc_email') { $orderofcemail = "selected"; }
      echo "<td><select name=\"orderby\">";
      echo "<option value=\"tblcompany.company\" $ordercompany>companies</option>";
      echo "<option value=\"tblcompany.ofc_city\" $orderofccity>city/town</option>";
      echo "<option value=\"tblcompany.ofc_province\" $orderofcprovince>province</option>";
      echo "<option value=\"tblcompany.ofc_country\" $orderofccountry>country</option>";
      echo "<option value=\"tblcompany.ofc_email\" $orderofcemail>email</option>";
      echo "<option value=\"tblcontact.name_first\" $ordernamefirst>first name</option>";
      echo "</select></td>";
      echo "<td><select name=\"orderdirection\">";
      echo "<option value=\"ASC\">ascending</option>";
      echo "<option value=\"DESC\">descending</option>";
      echo "</select></td>";
      echo "<td><button type=\"submit\" class=\"btn btn-success\">Submit</button></form></td></tr>";
	echo "</tbody>";
	echo "</table>";
?>

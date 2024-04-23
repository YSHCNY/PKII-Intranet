<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$wpgendate = $_GET['gd'];

$cutarrgendate = split("-", $wpgendate);
$cutarrgenyyyy = $cutarrgendate[0];
$cutarrgenmonth = $cutarrgendate[1];

$cutarrgenmonthname = date("F", mktime(0, 0, 0, $cutarrgenmonth));

$result11 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
if($result11 != '')
{
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $version11 = $myrow11[0];
  }
}
$glrefver = $version11;

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}  

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// start contents here

echo "<table class=\"fin\" border=\"1\">";

// display labels
echo "<tr><th colspan=\"16\">PKII Working Paper - Generate $cutarrgenyyyy-$cutarrgenmonthname</th></tr>";
echo "<tr><th colspan=\"2\">Account</th><th colspan=\"2\">Beginning Balance</th><th colspan=\"2\">Cash Disbursement</th><th colspan=\"2\">Cash Receipt</th><th colspan=\"2\">Journal Book</th><th colspan=\"2\">Trial Balance</th><th colspan=\"2\">Balance Sheet</th><th colspan=\"2\">Income Statement</th></tr>";
echo "<tr><th>Acct Code</th><th>Acct Name</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th></tr>";


// query tblfindisbursement glcodes and compute month total
  $result01 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result01 != '')
  {
    while($myrow01 = mysql_fetch_row($result01))
    {
      $found01 = 1;
      $debitamt01 = $myrow01[0];
      $creditamt01 = $myrow01[1];
      $cdisbdr1010100tot = $cdisbdr1010100tot + $debitamt01;
      $cdisbcr1010100tot = $cdisbcr1010100tot + $creditamt01;
    }
  }
  $result02 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.201\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result02 != '')
  {
    while($myrow02 = mysql_fetch_row($result02))
    {
      $found02 = 1;
      $debitamt02 = $myrow02[0];
      $creditamt02 = $myrow02[1];
      $cdisbdr1010201tot = $cdisbdr1010201tot + $debitamt02;
      $cdisbcr1010201tot = $cdisbcr1010201tot + $creditamt02;
    }
  }
  $result03 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.202\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result03 != '')
  {
    while($myrow03 = mysql_fetch_row($result03))
    {
      $found03 = 1;
      $debitamt03 = $myrow03[0];
      $creditamt03 = $myrow03[1];
      $cdisbdr1010202tot = $cdisbdr1010202tot + $debitamt03;
      $cdisbcr1010202tot = $cdisbcr1010202tot + $creditamt03;
    }
  }
  $result04 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.209\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result04 != '')
  {
    while($myrow04 = mysql_fetch_row($result04))
    {
      $found04 = 1;
      $debitamt04 = $myrow04[0];
      $creditamt04 = $myrow04[1];
      $cdisbdr1010209tot = $cdisbdr1010209tot + $debitamt04;
      $cdisbcr1010209tot = $cdisbcr1010209tot + $creditamt04;
    }
  }
  $result05 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.211\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result05 != '')
  {
    while($myrow05 = mysql_fetch_row($result05))
    {
      $found05 = 1;
      $debitamt05 = $myrow05[0];
      $creditamt05 = $myrow05[1];
      $cdisbdr1010211tot = $cdisbdr1010211tot + $debitamt05;
      $cdisbcr1010211tot = $cdisbcr1010211tot + $creditamt05;
    }
  }
  $result06 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.207\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result06 != '')
  {
    while($myrow06 = mysql_fetch_row($result06))
    {
      $found06 = 1;
      $debitamt06 = $myrow06[0];
      $creditamt06 = $myrow06[1];
      $cdisbdr1010207tot = $cdisbdr1010207tot + $debitamt06;
      $cdisbcr1010207tot = $cdisbcr1010207tot + $creditamt06;
    }
  }
  $result07 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.204\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result07 != '')
  {
    while($myrow07 = mysql_fetch_row($result07))
    {
      $found07 = 1;
      $debitamt07 = $myrow07[0];
      $creditamt07 = $myrow07[1];
      $cdisbdr1010204tot = $cdisbdr1010204tot + $debitamt07;
      $cdisbcr1010204tot = $cdisbcr1010204tot + $creditamt07;
    }
  }
  $result08 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.203\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result08 != '')
  {
    while($myrow08 = mysql_fetch_row($result08))
    {
      $found08 = 1;
      $debitamt08 = $myrow08[0];
      $creditamt08 = $myrow08[1];
      $cdisbdr1010203tot = $cdisbdr1010203tot + $debitamt08;
      $cdisbcr1010203tot = $cdisbcr1010203tot + $creditamt08;
    }
  }
  $result09 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.300\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result09 != '')
  {
    while($myrow09 = mysql_fetch_row($result09))
    {
      $found09 = 1;
      $debitamt09 = $myrow09[0];
      $creditamt09 = $myrow09[1];
      $cdisbdr1010300tot = $cdisbdr1010300tot + $debitamt09;
      $cdisbcr1010300tot = $cdisbcr1010300tot + $creditamt09;
    }
  }
  $result10 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.400\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result10 != '')
  {
    while($myrow10 = mysql_fetch_row($result10))
    {
      $found10 = 1;
      $debitamt10 = $myrow10[0];
      $creditamt10 = $myrow10[1];
      $cdisbdr1010400tot = $cdisbdr1010400tot + $debitamt10;
      $cdisbcr1010400tot = $cdisbcr1010400tot + $creditamt10;
    }
  }

  $result11 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.400-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result11 != '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $debitamt11 = $myrow11[0];
      $creditamt11 = $myrow11[1];
      $cdisbdr10104001tot = $cdisbdr10104001tot + $debitamt11;
      $cdisbcr10104001tot = $cdisbcr10104001tot + $creditamt11;
    }
  }
  $result12 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.500\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result12 != '')
  {
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $debitamt12 = $myrow12[0];
      $creditamt12 = $myrow12[1];
      $cdisbdr1010500tot = $cdisbdr1010500tot + $debitamt12;
      $cdisbcr1010500tot = $cdisbcr1010500tot + $creditamt12;
    }
  }
  $result13 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.554\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result13 != '')
  {
    while($myrow13 = mysql_fetch_row($result13))
    {
      $found13 = 1;
      $debitamt13 = $myrow13[0];
      $creditamt13 = $myrow13[1];
      $cdisbdr1010554tot = $cdisbdr1010554tot + $debitamt13;
      $cdisbcr1010554tot = $cdisbcr1010554tot + $creditamt13;
    }
  }
  $result14 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.555\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result14 != '')
  {
    while($myrow14 = mysql_fetch_row($result14))
    {
      $found14 = 1;
      $debitamt14 = $myrow14[0];
      $creditamt14 = $myrow14[1];
      $cdisbdr1010555tot = $cdisbdr1010555tot + $debitamt14;
      $cdisbcr1010555tot = $cdisbcr1010555tot + $creditamt14;
    }
  }
  $result15 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.552\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result15 != '')
  {
    while($myrow15 = mysql_fetch_row($result15))
    {
      $found15 = 1;
      $debitamt15 = $myrow15[0];
      $creditamt15 = $myrow15[1];
      $cdisbdr1010552tot = $cdisbdr1010554tot + $debitamt15;
      $cdisbcr1010552tot = $cdisbcr1010554tot + $creditamt15;
    }
  }
  $result16 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.553\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result16 != '')
  {
    while($myrow16 = mysql_fetch_row($result16))
    {
      $found16 = 1;
      $debitamt16 = $myrow16[0];
      $creditamt16 = $myrow16[1];
      $cdisbdr1010553tot = $cdisbdr1010553tot + $debitamt16;
      $cdisbcr1010553tot = $cdisbcr1010553tot + $creditamt16;
    }
  }
  $result17 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.556\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result17 != '')
  {
    while($myrow17 = mysql_fetch_row($result17))
    {
      $found17 = 1;
      $debitamt17 = $myrow17[0];
      $creditamt17 = $myrow17[1];
      $cdisbdr1010556tot = $cdisbdr1010556tot + $debitamt17;
      $cdisbcr1010556tot = $cdisbcr1010556tot + $creditamt17;
    }
  }
/*  $result18 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result18 != '')
  {
    while($myrow18 = mysql_fetch_row($result18))
    {
      $found18 = 1;
      $debitamt18 = $myrow18[0];
      $creditamt18 = $myrow18[1];
      $cdisbdrxxxxxxxtot = $cdisbdrxxxxxxxtot + $debitamt18;
      $cdisbcrxxxxxxxtot = $cdisbcrxxxxxxxtot + $creditamt18;
    }
  } */
  $result19 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.551\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result19 != '')
  {
    while($myrow19 = mysql_fetch_row($result19))
    {
      $found19 = 1;
      $debitamt19 = $myrow19[0];
      $creditamt19 = $myrow19[1];
      $cdisbdr1010551tot = $cdisbdr1010551tot + $debitamt19;
      $cdisbcr1010551tot = $cdisbcr1010551tot + $creditamt19;
    }
  }
  $result20 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.700\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result20 != '')
  {
    while($myrow20 = mysql_fetch_row($result20))
    {
      $found20 = 1;
      $debitamt20 = $myrow20[0];
      $creditamt20 = $myrow20[1];
      $cdisbdr1010700tot = $cdisbdr1010700tot + $debitamt20;
      $cdisbcr1010700tot = $cdisbcr1010700tot + $creditamt20;
    }
  }

  $result21 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.706\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result21 != '')
  {
    while($myrow21 = mysql_fetch_row($result21))
    {
      $found21 = 1;
      $debitamt21 = $myrow21[0];
      $creditamt21 = $myrow21[1];
      $cdisbdr1010706tot = $cdisbdr1010706tot + $debitamt21;
      $cdisbcr1010706tot = $cdisbcr1010706tot + $creditamt21;
    }
  }
  $result22 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.707\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result22 != '')
  {
    while($myrow22 = mysql_fetch_row($result22))
    {
      $found22 = 1;
      $debitamt22 = $myrow22[0];
      $creditamt22 = $myrow22[1];
      $cdisbdr1010707tot = $cdisbdr1010707tot + $debitamt22;
      $cdisbcr1010707tot = $cdisbcr1010707tot + $creditamt22;
    }
  }
/*  $result23 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result23 != '')
  {
    while($myrow23 = mysql_fetch_row($result23))
    {
      $found23 = 1;
      $debitamt23 = $myrow23[0];
      $creditamt23 = $myrow23[1];
      $cdisbdrxxxxxxxtot = $cdisbdrxxxxxxxtot + $debitamt23;
      $cdisbcrxxxxxxxtot = $cdisbcrxxxxxxxtot + $creditamt23;
    }
  } */
  $result24 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.10.600\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result24 != '')
  {
    while($myrow24 = mysql_fetch_row($result24))
    {
      $found24 = 1;
      $debitamt24 = $myrow24[0];
      $creditamt24 = $myrow24[1];
      $cdisbdr1010600tot = $cdisbdr1010600tot + $debitamt24;
      $cdisbcr1010600tot = $cdisbcr1010600tot + $creditamt24;
    }
  }
  $result25 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.202\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result25 != '')
  {
    while($myrow25 = mysql_fetch_row($result25))
    {
      $found25 = 1;
      $debitamt25 = $myrow25[0];
      $creditamt25 = $myrow25[1];
      $cdisbdr1020202tot = $cdisbdr1020202tot + $debitamt25;
      $cdisbcr1020202tot = $cdisbcr1020202tot + $creditamt25;
    }
  }
  $result26 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.202-2\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result26 != '')
  {
    while($myrow26 = mysql_fetch_row($result26))
    {
      $found26 = 1;
      $debitamt26 = $myrow26[0];
      $creditamt26 = $myrow26[1];
      $cdisbdr10202022tot = $cdisbdr10202022tot + $debitamt26;
      $cdisbcr10202022tot = $cdisbcr10202022tot + $creditamt26;
    }
  }
  $result27 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.700\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result27 != '')
  {
    while($myrow27 = mysql_fetch_row($result27))
    {
      $found27 = 1;
      $debitamt27 = $myrow27[0];
      $creditamt27 = $myrow27[1];
      $cdisbdr1020700tot = $cdisbdr1020700tot + $debitamt27;
      $cdisbcr1020700tot = $cdisbcr1020700tot + $creditamt27;
    }
  }
  $result28 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result28 != '')
  {
    while($myrow28 = mysql_fetch_row($result28))
    {
      $found28 = 1;
      $debitamt28 = $myrow28[0];
      $creditamt28 = $myrow28[1];
      $cdisbdr1020100tot = $cdisbdr1020100tot + $debitamt28;
      $cdisbcr1020100tot = $cdisbcr1020100tot + $creditamt28;
    }
  }
  $result29 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.101-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result29 != '')
  {
    while($myrow29 = mysql_fetch_row($result29))
    {
      $found29 = 1;
      $debitamt29 = $myrow29[0];
      $creditamt29 = $myrow29[1];
      $cdisbdr10201011tot = $cdisbdr10201011tot + $debitamt29;
      $cdisbcr10201011tot = $cdisbcr10201011tot + $creditamt29;
    }
  }
  $result30 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.401\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result30 != '')
  {
    while($myrow30 = mysql_fetch_row($result30))
    {
      $found30 = 1;
      $debitamt30 = $myrow30[0];
      $creditamt30 = $myrow30[1];
      $cdisbdr1020401tot = $cdisbdr1020401tot + $debitamt30;
      $cdisbcr1020401tot = $cdisbcr1020401tot + $creditamt30;
    }
  }

  $result31 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.401-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result31 != '')
  {
    while($myrow31 = mysql_fetch_row($result31))
    {
      $found31 = 1;
      $debitamt31 = $myrow31[0];
      $creditamt31 = $myrow31[1];
      $cdisbdr10204011tot = $cdisbdr10204011tot + $debitamt31;
      $cdisbcr10204011tot = $cdisbcr10204011tot + $creditamt31;
    }
  }
  $result32 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.301\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result32 != '')
  {
    while($myrow32 = mysql_fetch_row($result32))
    {
      $found32 = 1;
      $debitamt32 = $myrow32[0];
      $creditamt32 = $myrow32[1];
      $cdisbdr1020301tot = $cdisbdr1020301tot + $debitamt32;
      $cdisbcr1020301tot = $cdisbcr1020301tot + $creditamt32;
    }
  }
  $result33 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.301-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result33 != '')
  {
    while($myrow33 = mysql_fetch_row($result33))
    {
      $found33 = 1;
      $debitamt33 = $myrow33[0];
      $creditamt33 = $myrow33[1];
      $cdisbdr10203011tot = $cdisbdr10203011tot + $debitamt33;
      $cdisbcr10203011tot = $cdisbcr10203011tot + $creditamt33;
    }
  }
  $result34 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result34 != '')
  {
    while($myrow34 = mysql_fetch_row($result34))
    {
      $found34 = 1;
      $debitamt34 = $myrow34[0];
      $creditamt34 = $myrow34[1];
      $cdisbdr1020200tot = $cdisbdr1020200tot + $debitamt34;
      $cdisbcr1020200tot = $cdisbcr1020200tot + $creditamt34;
    }
  }
  $result35 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.201-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result35 != '')
  {
    while($myrow35 = mysql_fetch_row($result35))
    {
      $found35 = 1;
      $debitamt35 = $myrow35[0];
      $creditamt35 = $myrow35[1];
      $cdisbdr10202011tot = $cdisbdr10202011tot + $debitamt35;
      $cdisbcr10202011tot = $cdisbcr10202011tot + $creditamt35;
    }
  }
  $result36 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.204\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result36 != '')
  {
    while($myrow36 = mysql_fetch_row($result36))
    {
      $found36 = 1;
      $debitamt36 = $myrow36[0];
      $creditamt36 = $myrow36[1];
      $cdisbdr1020204tot = $cdisbdr1020204tot + $debitamt36;
      $cdisbcr1020204tot = $cdisbcr1020204tot + $creditamt36;
    }
  }
  $result37 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.204-4\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result37 != '')
  {
    while($myrow37 = mysql_fetch_row($result37))
    {
      $found37 = 1;
      $debitamt37 = $myrow37[0];
      $creditamt37 = $myrow37[1];
      $cdisbdr10202044tot = $cdisbdr10202044tot + $debitamt37;
      $cdisbcr10202044tot = $cdisbcr10202044tot + $creditamt37;
    }
  }
  $result38 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.203\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result38 != '')
  {
    while($myrow38 = mysql_fetch_row($result38))
    {
      $found38 = 1;
      $debitamt38 = $myrow38[0];
      $creditamt38 = $myrow38[1];
      $cdisbdr1020203tot = $cdisbdr1020203tot + $debitamt38;
      $cdisbcr1020203tot = $cdisbcr1020203tot + $creditamt38;
    }
  }
  $result39 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.203-3\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result39 != '')
  {
    while($myrow39 = mysql_fetch_row($result39))
    {
      $found39 = 1;
      $debitamt39 = $myrow39[0];
      $creditamt39 = $myrow39[1];
      $cdisbdr10202033tot = $cdisbdr10202033tot + $debitamt39;
      $cdisbcr10202033tot = $cdisbcr10202033tot + $creditamt39;
    }
  }
  $result40 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.501\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result40 != '')
  {
    while($myrow40 = mysql_fetch_row($result40))
    {
      $found40 = 1;
      $debitamt40 = $myrow40[0];
      $creditamt40 = $myrow40[1];
      $cdisbdr1020501tot = $cdisbdr1020501tot + $debitamt40;
      $cdisbcr1020501tot = $cdisbcr1020501tot + $creditamt40;
    }
  }

  $result41 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.501-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result41 != '')
  {
    while($myrow41 = mysql_fetch_row($result41))
    {
      $found41 = 1;
      $debitamt41 = $myrow41[0];
      $creditamt41 = $myrow41[1];
      $cdisbdr10205011tot = $cdisbdr10205011tot + $debitamt41;
      $cdisbcr10205011tot = $cdisbcr10205011tot + $creditamt41;
    }
  }
  $result42 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.104\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result42 != '')
  {
    while($myrow42 = mysql_fetch_row($result42))
    {
      $found42 = 1;
      $debitamt42 = $myrow42[0];
      $creditamt42 = $myrow42[1];
      $cdisbdr1020104tot = $cdisbdr1020104tot + $debitamt42;
      $cdisbcr1020104tot = $cdisbcr1020104tot + $creditamt42;
    }
  }
  $result43 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.20.104-4\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result43 != '')
  {
    while($myrow43 = mysql_fetch_row($result43))
    {
      $found43 = 1;
      $debitamt43 = $myrow43[0];
      $creditamt43 = $myrow43[1];
      $cdisbdr10201044tot = $cdisbdr10201044tot + $debitamt43;
      $cdisbcr10201044tot = $cdisbcr10201044tot + $creditamt43;
    }
  }
  $result44 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.30.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result44 != '')
  {
    while($myrow44 = mysql_fetch_row($result44))
    {
      $found44 = 1;
      $debitamt44 = $myrow44[0];
      $creditamt44 = $myrow44[1];
      $cdisbdr1030200tot = $cdisbdr1030200tot + $debitamt44;
      $cdisbcr1030200tot = $cdisbcr1030200tot + $creditamt44;
    }
  }
/*  $result45 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result45 != '')
  {
    while($myrow45 = mysql_fetch_row($result45))
    {
      $found45 = 1;
      $debitamt45 = $myrow45[0];
      $creditamt45 = $myrow45[1];
      $cdisbdrxxxxxxxtot = $cdisbdrxxxxxxxtot + $debitamt45;
      $cdisbcrxxxxxxxtot = $cdisbcrxxxxxxxtot + $creditamt45;
    }
  } */
/*  $result46 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result46 != '')
  {
    while($myrow46 = mysql_fetch_row($result46))
    {
      $found46 = 1;
      $debitamt46 = $myrow46[0];
      $creditamt46 = $myrow46[1];
      $cdisbdrxxxxxxxtot = $cdisbdrxxxxxxxtot + $debitamt46;
      $cdisbcrxxxxxxxtot = $cdisbcrxxxxxxxtot + $creditamt46;
    }
  } */
  $result47 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.30.300\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result47 != '')
  {
    while($myrow47 = mysql_fetch_row($result47))
    {
      $found47 = 1;
      $debitamt47 = $myrow47[0];
      $creditamt47 = $myrow47[1];
      $cdisbdr1030300tot = $cdisbdr1030300tot + $debitamt47;
      $cdisbcr1030300tot = $cdisbcr1030300tot + $creditamt47;
    }
  }
  $result48 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"10.30.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result48 != '')
  {
    while($myrow48 = mysql_fetch_row($result48))
    {
      $found48 = 1;
      $debitamt48 = $myrow48[0];
      $creditamt48 = $myrow48[1];
      $cdisbdr1030100tot = $cdisbdr1030100tot + $debitamt48;
      $cdisbcr1030100tot = $cdisbcr1030100tot + $creditamt48;
    }
  }
  $result49 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.10.208\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result49 != '')
  {
    while($myrow49 = mysql_fetch_row($result49))
    {
      $found49 = 1;
      $debitamt49 = $myrow49[0];
      $creditamt49 = $myrow49[1];
      $cdisbdr2010208tot = $cdisbdr2010208tot + $debitamt49;
      $cdisbcr2010208tot = $cdisbcr2010208tot + $creditamt49;
    }
  }
  $result50 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.10.201\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result50 != '')
  {
    while($myrow50 = mysql_fetch_row($result50))
    {
      $found50 = 1;
      $debitamt50 = $myrow50[0];
      $creditamt50 = $myrow50[1];
      $cdisbdr2010201tot = $cdisbdr2010201tot + $debitamt50;
      $cdisbcr2010201tot = $cdisbcr2010201tot + $creditamt50;
    }
  }

  $result51 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.10.207\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result51 != '')
  {
    while($myrow51 = mysql_fetch_row($result51))
    {
      $found51 = 1;
      $debitamt51 = $myrow51[0];
      $creditamt51 = $myrow51[1];
      $cdisbdr2010207tot = $cdisbdr2010207tot + $debitamt51;
      $cdisbcr2010207tot = $cdisbcr2010207tot + $creditamt51;
    }
  }
  $result52 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.10.203\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result52 != '')
  {
    while($myrow52 = mysql_fetch_row($result52))
    {
      $found52 = 1;
      $debitamt52 = $myrow52[0];
      $creditamt52 = $myrow52[1];
      $cdisbdr2010203tot = $cdisbdr2010203tot + $debitamt52;
      $cdisbcr2010203tot = $cdisbcr2010203tot + $creditamt52;
    }
  }
  $result53 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.10.204\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result53 != '')
  {
    while($myrow53 = mysql_fetch_row($result53))
    {
      $found53 = 1;
      $debitamt53 = $myrow53[0];
      $creditamt53 = $myrow53[1];
      $cdisbdr2010204tot = $cdisbdr2010204tot + $debitamt53;
      $cdisbcr2010204tot = $cdisbcr2010204tot + $creditamt53;
    }
  }
  $result54 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.10.205\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result54 != '')
  {
    while($myrow54 = mysql_fetch_row($result54))
    {
      $found54 = 1;
      $debitamt54 = $myrow54[0];
      $creditamt54 = $myrow54[1];
      $cdisbdr2010205tot = $cdisbdr2010205tot + $debitamt54;
      $cdisbcr2010205tot = $cdisbcr2010205tot + $creditamt54;
    }
  }
  $result55 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.10.206\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result55 != '')
  {
    while($myrow55 = mysql_fetch_row($result55))
    {
      $found55 = 1;
      $debitamt55 = $myrow55[0];
      $creditamt55 = $myrow55[1];
      $cdisbdr2010206tot = $cdisbdr2010206tot + $debitamt55;
      $cdisbcr2010206tot = $cdisbcr2010206tot + $creditamt55;
    }
  }
  $result56 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.10.202\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result56 != '')
  {
    while($myrow56 = mysql_fetch_row($result56))
    {
      $found56 = 1;
      $debitamt56 = $myrow56[0];
      $creditamt56 = $myrow56[1];
      $cdisbdr2010202tot = $cdisbdr2010202tot + $debitamt56;
      $cdisbcr2010202tot = $cdisbcr2010202tot + $creditamt56;
    }
  }
  $result57 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.30.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result57 != '')
  {
    while($myrow57 = mysql_fetch_row($result57))
    {
      $found57 = 1;
      $debitamt57 = $myrow57[0];
      $creditamt57 = $myrow57[1];
      $cdisbdr2030100tot = $cdisbdr2030100tot + $debitamt57;
      $cdisbcr2030100tot = $cdisbcr2030100tot + $creditamt57;
    }
  }
  $result58 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.30.101\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result58 != '')
  {
    while($myrow58 = mysql_fetch_row($result58))
    {
      $found58 = 1;
      $debitamt58 = $myrow58[0];
      $creditamt58 = $myrow58[1];
      $cdisbdr2030101tot = $cdisbdr2030101tot + $debitamt58;
      $cdisbcr2030101tot = $cdisbcr2030101tot + $creditamt58;
    }
  }
  $result59 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.30.211\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result59 != '')
  {
    while($myrow59 = mysql_fetch_row($result59))
    {
      $found59 = 1;
      $debitamt59 = $myrow59[0];
      $creditamt59 = $myrow59[1];
      $cdisbdr2030211tot = $cdisbdr2030211tot + $debitamt59;
      $cdisbcr2030211tot = $cdisbcr2030211tot + $creditamt59;
    }
  }
  $result60 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.30.102\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result60 != '')
  {
    while($myrow60 = mysql_fetch_row($result60))
    {
      $found60 = 1;
      $debitamt60 = $myrow60[0];
      $creditamt60 = $myrow60[1];
      $cdisbdr2030102tot = $cdisbdr2030102tot + $debitamt60;
      $cdisbcr2030102tot = $cdisbcr2030102tot + $creditamt60;
    }
  }

  $result61 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.10.213\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result61 != '')
  {
    while($myrow61 = mysql_fetch_row($result61))
    {
      $found61 = 1;
      $debitamt61 = $myrow61[0];
      $creditamt61 = $myrow61[1];
      $cdisbdr2010213tot = $cdisbdr2010213tot + $debitamt61;
      $cdisbcr2010213tot = $cdisbcr2010213tot + $creditamt61;
    }
  }
  $result62 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.10.209\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result62 != '')
  {
    while($myrow62 = mysql_fetch_row($result62))
    {
      $found62 = 1;
      $debitamt62 = $myrow62[0];
      $creditamt62 = $myrow62[1];
      $cdisbdr2010209tot = $cdisbdr2010209tot + $debitamt62;
      $cdisbcr2010209tot = $cdisbcr2010209tot + $creditamt62;
    }
  }
  $result63 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"20.20.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result63 != '')
  {
    while($myrow63 = mysql_fetch_row($result63))
    {
      $found63 = 1;
      $debitamt63 = $myrow63[0];
      $creditamt63 = $myrow63[1];
      $cdisbdr2020200tot = $cdisbdr2020200tot + $debitamt63;
      $cdisbcr2020200tot = $cdisbcr2020200tot + $creditamt63;
    }
  }
  $result64 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"30.10.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result64 != '')
  {
    while($myrow64 = mysql_fetch_row($result64))
    {
      $found64 = 1;
      $debitamt64 = $myrow64[0];
      $creditamt64 = $myrow64[1];
      $cdisbdr3010100tot = $cdisbdr3010100tot + $debitamt64;
      $cdisbcr3010100tot = $cdisbcr3010100tot + $creditamt64;
    }
  }
  $result65 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"30.10.101\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result65 != '')
  {
    while($myrow65 = mysql_fetch_row($result65))
    {
      $found65 = 1;
      $debitamt65 = $myrow65[0];
      $creditamt65 = $myrow65[1];
      $cdisbdr3010101tot = $cdisbdr3010101tot + $debitamt65;
      $cdisbcr3010101tot = $cdisbcr3010101tot + $creditamt65;
    }
  }
  $result66 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"30.10.102\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result66 != '')
  {
    while($myrow66 = mysql_fetch_row($result66))
    {
      $found66 = 1;
      $debitamt66 = $myrow66[0];
      $creditamt66 = $myrow66[1];
      $cdisbdr3010102tot = $cdisbdr3010102tot + $debitamt66;
      $cdisbcr3010102tot = $cdisbcr3010102tot + $creditamt66;
    }
  }
/*  $result67 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result67 != '')
  {
    while($myrow67 = mysql_fetch_row($result67))
    {
      $found67 = 1;
      $debitamt67 = $myrow67[0];
      $creditamt67 = $myrow67[1];
      $cdisbdrxxxxxxxtot = $cdisbdrxxxxxxxtot + $debitamt67;
      $cdisbcrxxxxxxxtot = $cdisbcrxxxxxxxtot + $creditamt67;
    }
  } */
  $result68 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"30.10.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result68 != '')
  {
    while($myrow68 = mysql_fetch_row($result68))
    {
      $found68 = 1;
      $debitamt68 = $myrow68[0];
      $creditamt68 = $myrow68[1];
      $cdisbdr3010200tot = $cdisbdr3010200tot + $debitamt68;
      $cdisbcr3010200tot = $cdisbcr3010200tot + $creditamt68;
    }
  }
/*  $result69 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result69 != '')
  {
    while($myrow69 = mysql_fetch_row($result69))
    {
      $found69 = 1;
      $debitamt69 = $myrow69[0];
      $creditamt69 = $myrow69[1];
      $cdisbdrxxxxxxxtot = $cdisbdrxxxxxxxtot + $debitamt69;
      $cdisbcrxxxxxxxtot = $cdisbcrxxxxxxxtot + $creditamt69;
    }
  } */
/*  $result70 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result70 != '')
  {
    while($myrow70 = mysql_fetch_row($result70))
    {
      $found70 = 1;
      $debitamt70 = $myrow70[0];
      $creditamt70 = $myrow70[1];
      $cdisbdrxxxxxxxtot = $cdisbdrxxxxxxxtot + $debitamt70;
      $cdisbcrxxxxxxxtot = $cdisbcrxxxxxxxtot + $creditamt70;
    }
  } */

  $result71 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"50.10.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result71 != '')
  {
    while($myrow71 = mysql_fetch_row($result71))
    {
      $found71 = 1;
      $debitamt71 = $myrow71[0];
      $creditamt71 = $myrow71[1];
      $cdisbdr5010000tot = $cdisbdr5010000tot + $debitamt71;
      $cdisbcr5010000tot = $cdisbcr5010000tot + $creditamt71;
    }
  }
  $result72 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"50.10.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result72 != '')
  {
    while($myrow72 = mysql_fetch_row($result72))
    {
      $found72 = 1;
      $debitamt72 = $myrow72[0];
      $creditamt72 = $myrow72[1];
      $cdisbdr5010200tot = $cdisbdr5010200tot + $debitamt72;
      $cdisbcr5010200tot = $cdisbcr5010200tot + $creditamt72;
    }
  }
  $result73 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"50.10.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result73 != '')
  {
    while($myrow73 = mysql_fetch_row($result73))
    {
      $found73 = 1;
      $debitamt73 = $myrow73[0];
      $creditamt73 = $myrow73[1];
      $cdisbdr5010100tot = $cdisbdr5010100tot + $debitamt73;
      $cdisbcr5010100tot = $cdisbcr5010100tot + $creditamt73;
    }
  }
  $result74 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"60.00.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result74 != '')
  {
    while($myrow74 = mysql_fetch_row($result74))
    {
      $found74 = 1;
      $debitamt74 = $myrow74[0];
      $creditamt74 = $myrow74[1];
      $cdisbdr6000000tot = $cdisbdr6000000tot + $debitamt74;
      $cdisbcr6000000tot = $cdisbcr6000000tot + $creditamt74;
    }
  }
  $result75 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"70.00.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result75 != '')
  {
    while($myrow75 = mysql_fetch_row($result75))
    {
      $found75 = 1;
      $debitamt75 = $myrow75[0];
      $creditamt75 = $myrow75[1];
      $cdisbdr7000000tot = $cdisbdr7000000tot + $debitamt75;
      $cdisbcr7000000tot = $cdisbcr7000000tot + $creditamt75;
    }
  }
/*  $result76 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result76 != '')
  {
    while($myrow76 = mysql_fetch_row($result76))
    {
      $found76 = 1;
      $debitamt76 = $myrow76[0];
      $creditamt76 = $myrow76[1];
      $cdisbdrxxxxxxxtot = $cdisbdrxxxxxxxtot + $debitamt76;
      $cdisbcrxxxxxxxtot = $cdisbcrxxxxxxxtot + $creditamt76;
    }
  } */
  $result77 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE glcode=\"70.00.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result77 != '')
  {
    while($myrow77 = mysql_fetch_row($result77))
    {
      $found77 = 1;
      $debitamt77 = $myrow77[0];
      $creditamt77 = $myrow77[1];
      $cdisbdr2010214tot = $cdisbdr2010214tot + $debitamt77;
      $cdisbcr2010214tot = $cdisbcr2010214tot + $creditamt77;
    }
  }

// query tblfincashreceipt glcodes and compute month total
  $result01 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result01 != '')
  {
    while($myrow01 = mysql_fetch_row($result01))
    {
      $found01 = 1;
      $debitamt01 = $myrow01[0];
      $creditamt01 = $myrow01[1];
      $crcptdr1010100tot = $crcptdr1010100tot + $debitamt01;
      $crcptcr1010100tot = $crcptcr1010100tot + $creditamt01;
    }
  }
  $result02 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.201\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result02 != '')
  {
    while($myrow02 = mysql_fetch_row($result02))
    {
      $found02 = 1;
      $debitamt02 = $myrow02[0];
      $creditamt02 = $myrow02[1];
      $crcptdr1010201tot = $crcptdr1010201tot + $debitamt02;
      $crcptcr1010201tot = $crcptcr1010201tot + $creditamt02;
    }
  }
  $result03 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.202\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result03 != '')
  {
    while($myrow03 = mysql_fetch_row($result03))
    {
      $found03 = 1;
      $debitamt03 = $myrow03[0];
      $creditamt03 = $myrow03[1];
      $crcptdr1010202tot = $crcptdr1010202tot + $debitamt03;
      $crcptcr1010202tot = $crcptcr1010202tot + $creditamt03;
    }
  }
  $result04 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.209\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result04 != '')
  {
    while($myrow04 = mysql_fetch_row($result04))
    {
      $found04 = 1;
      $debitamt04 = $myrow04[0];
      $creditamt04 = $myrow04[1];
      $crcptdr1010209tot = $crcptdr1010209tot + $debitamt04;
      $crcptcr1010209tot = $crcptcr1010209tot + $creditamt04;
    }
  }
  $result05 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.211\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result05 != '')
  {
    while($myrow05 = mysql_fetch_row($result05))
    {
      $found05 = 1;
      $debitamt05 = $myrow05[0];
      $creditamt05 = $myrow05[1];
      $crcptdr1010211tot = $crcptdr1010211tot + $debitamt05;
      $crcptcr1010211tot = $crcptcr1010211tot + $creditamt05;
    }
  }
  $result06 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.207\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result06 != '')
  {
    while($myrow06 = mysql_fetch_row($result06))
    {
      $found06 = 1;
      $debitamt06 = $myrow06[0];
      $creditamt06 = $myrow06[1];
      $crcptdr1010207tot = $crcptdr1010207tot + $debitamt06;
      $crcptcr1010207tot = $crcptcr1010207tot + $creditamt06;
    }
  }
  $result07 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.204\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result07 != '')
  {
    while($myrow07 = mysql_fetch_row($result07))
    {
      $found07 = 1;
      $debitamt07 = $myrow07[0];
      $creditamt07 = $myrow07[1];
      $crcptdr1010204tot = $crcptdr1010204tot + $debitamt07;
      $crcptcr1010204tot = $crcptcr1010204tot + $creditamt07;
    }
  }
  $result08 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.203\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result08 != '')
  {
    while($myrow08 = mysql_fetch_row($result08))
    {
      $found08 = 1;
      $debitamt08 = $myrow08[0];
      $creditamt08 = $myrow08[1];
      $crcptdr1010203tot = $crcptdr1010203tot + $debitamt08;
      $crcptcr1010203tot = $crcptcr1010203tot + $creditamt08;
    }
  }
  $result09 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.300\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result09 != '')
  {
    while($myrow09 = mysql_fetch_row($result09))
    {
      $found09 = 1;
      $debitamt09 = $myrow09[0];
      $creditamt09 = $myrow09[1];
      $crcptdr1010300tot = $crcptdr1010300tot + $debitamt09;
      $crcptcr1010300tot = $crcptcr1010300tot + $creditamt09;
    }
  }
  $result10 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.400\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result10 != '')
  {
    while($myrow10 = mysql_fetch_row($result10))
    {
      $found10 = 1;
      $debitamt10 = $myrow10[0];
      $creditamt10 = $myrow10[1];
      $crcptdr1010400tot = $crcptdr1010400tot + $debitamt10;
      $crcptcr1010400tot = $crcptcr1010400tot + $creditamt10;
    }
  }

  $result11 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.400-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result11 != '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $debitamt11 = $myrow11[0];
      $creditamt11 = $myrow11[1];
      $crcptdr10104001tot = $crcptdr10104001tot + $debitamt11;
      $crcptcr10104001tot = $crcptcr10104001tot + $creditamt11;
    }
  }
  $result12 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.500\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result12 != '')
  {
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $debitamt12 = $myrow12[0];
      $creditamt12 = $myrow12[1];
      $crcptdr1010500tot = $crcptdr1010500tot + $debitamt12;
      $crcptcr1010500tot = $crcptcr1010500tot + $creditamt12;
    }
  }
  $result13 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.554\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result13 != '')
  {
    while($myrow13 = mysql_fetch_row($result13))
    {
      $found13 = 1;
      $debitamt13 = $myrow13[0];
      $creditamt13 = $myrow13[1];
      $crcptdr1010554tot = $crcptdr1010554tot + $debitamt13;
      $crcptcr1010554tot = $crcptcr1010554tot + $creditamt13;
    }
  }
  $result14 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.555\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result14 != '')
  {
    while($myrow14 = mysql_fetch_row($result14))
    {
      $found14 = 1;
      $debitamt14 = $myrow14[0];
      $creditamt14 = $myrow14[1];
      $crcptdr1010555tot = $crcptdr1010555tot + $debitamt14;
      $crcptcr1010555tot = $crcptcr1010555tot + $creditamt14;
    }
  }
  $result15 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.552\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result15 != '')
  {
    while($myrow15 = mysql_fetch_row($result15))
    {
      $found15 = 1;
      $debitamt15 = $myrow15[0];
      $creditamt15 = $myrow15[1];
      $crcptdr1010552tot = $crcptdr1010554tot + $debitamt15;
      $crcptcr1010552tot = $crcptcr1010554tot + $creditamt15;
    }
  }
  $result16 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.553\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result16 != '')
  {
    while($myrow16 = mysql_fetch_row($result16))
    {
      $found16 = 1;
      $debitamt16 = $myrow16[0];
      $creditamt16 = $myrow16[1];
      $crcptdr1010553tot = $crcptdr1010553tot + $debitamt16;
      $crcptcr1010553tot = $crcptcr1010553tot + $creditamt16;
    }
  }
  $result17 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.556\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result17 != '')
  {
    while($myrow17 = mysql_fetch_row($result17))
    {
      $found17 = 1;
      $debitamt17 = $myrow17[0];
      $creditamt17 = $myrow17[1];
      $crcptdr1010556tot = $crcptdr1010556tot + $debitamt17;
      $crcptcr1010556tot = $crcptcr1010556tot + $creditamt17;
    }
  }
/*  $result18 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result18 != '')
  {
    while($myrow18 = mysql_fetch_row($result18))
    {
      $found18 = 1;
      $debitamt18 = $myrow18[0];
      $creditamt18 = $myrow18[1];
      $crcptdrxxxxxxxtot = $crcptdrxxxxxxxtot + $debitamt18;
      $crcptcrxxxxxxxtot = $crcptcrxxxxxxxtot + $creditamt18;
    }
  } */
  $result19 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.551\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result19 != '')
  {
    while($myrow19 = mysql_fetch_row($result19))
    {
      $found19 = 1;
      $debitamt19 = $myrow19[0];
      $creditamt19 = $myrow19[1];
      $crcptdr1010551tot = $crcptdr1010551tot + $debitamt19;
      $crcptcr1010551tot = $crcptcr1010551tot + $creditamt19;
    }
  }
  $result20 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.700\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result20 != '')
  {
    while($myrow20 = mysql_fetch_row($result20))
    {
      $found20 = 1;
      $debitamt20 = $myrow20[0];
      $creditamt20 = $myrow20[1];
      $crcptdr1010700tot = $crcptdr1010700tot + $debitamt20;
      $crcptcr1010700tot = $crcptcr1010700tot + $creditamt20;
    }
  }

  $result21 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.706\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result21 != '')
  {
    while($myrow21 = mysql_fetch_row($result21))
    {
      $found21 = 1;
      $debitamt21 = $myrow21[0];
      $creditamt21 = $myrow21[1];
      $crcptdr1010706tot = $crcptdr1010706tot + $debitamt21;
      $crcptcr1010706tot = $crcptcr1010706tot + $creditamt21;

    }
  }
  $result22 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.707\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result22 != '')
  {
    while($myrow22 = mysql_fetch_row($result22))
    {
      $found22 = 1;
      $debitamt22 = $myrow22[0];
      $creditamt22 = $myrow22[1];
      $crcptdr1010707tot = $crcptdr1010707tot + $debitamt22;
      $crcptcr1010707tot = $crcptcr1010707tot + $creditamt22;
    }
  }
/*  $result23 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result23 != '')
  {
    while($myrow23 = mysql_fetch_row($result23))
    {
      $found23 = 1;
      $debitamt23 = $myrow23[0];
      $creditamt23 = $myrow23[1];
      $crcptdrxxxxxxxtot = $crcptdrxxxxxxxtot + $debitamt23;
      $crcptcrxxxxxxxtot = $crcptcrxxxxxxxtot + $creditamt23;
    }
  } */
  $result24 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.10.600\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result24 != '')
  {
    while($myrow24 = mysql_fetch_row($result24))
    {
      $found24 = 1;
      $debitamt24 = $myrow24[0];
      $creditamt24 = $myrow24[1];
      $crcptdr1010600tot = $crcptdr1010600tot + $debitamt24;
      $crcptcr1010600tot = $crcptcr1010600tot + $creditamt24;
    }
  }
  $result25 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.202\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result25 != '')
  {
    while($myrow25 = mysql_fetch_row($result25))
    {
      $found25 = 1;
      $debitamt25 = $myrow25[0];
      $creditamt25 = $myrow25[1];
      $crcptdr1020202tot = $crcptdr1020202tot + $debitamt25;
      $crcptcr1020202tot = $crcptcr1020202tot + $creditamt25;
    }
  }
  $result26 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.202-2\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result26 != '')
  {
    while($myrow26 = mysql_fetch_row($result26))
    {
      $found26 = 1;
      $debitamt26 = $myrow26[0];
      $creditamt26 = $myrow26[1];
      $crcptdr10202022tot = $crcptdr10202022tot + $debitamt26;
      $crcptcr10202022tot = $crcptcr10202022tot + $creditamt26;
    }
  }
  $result27 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.700\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result27 != '')
  {
    while($myrow27 = mysql_fetch_row($result27))
    {
      $found27 = 1;
      $debitamt27 = $myrow27[0];
      $creditamt27 = $myrow27[1];
      $crcptdr1020700tot = $crcptdr1020700tot + $debitamt27;
      $crcptcr1020700tot = $crcptcr1020700tot + $creditamt27;
    }
  }
  $result28 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result28 != '')
  {
    while($myrow28 = mysql_fetch_row($result28))
    {
      $found28 = 1;
      $debitamt28 = $myrow28[0];
      $creditamt28 = $myrow28[1];
      $crcptdr1020100tot = $crcptdr1020100tot + $debitamt28;
      $crcptcr1020100tot = $crcptcr1020100tot + $creditamt28;
    }
  }
  $result29 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.101-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result29 != '')
  {
    while($myrow29 = mysql_fetch_row($result29))
    {
      $found29 = 1;
      $debitamt29 = $myrow29[0];
      $creditamt29 = $myrow29[1];
      $crcptdr10201011tot = $crcptdr10201011tot + $debitamt29;
      $crcptcr10201011tot = $crcptcr10201011tot + $creditamt29;
    }
  }
  $result30 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.401\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result30 != '')
  {
    while($myrow30 = mysql_fetch_row($result30))
    {
      $found30 = 1;
      $debitamt30 = $myrow30[0];
      $creditamt30 = $myrow30[1];
      $crcptdr1020401tot = $crcptdr1020401tot + $debitamt30;
      $crcptcr1020401tot = $crcptcr1020401tot + $creditamt30;
    }
  }

  $result31 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.401-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result31 != '')
  {
    while($myrow31 = mysql_fetch_row($result31))
    {
      $found31 = 1;
      $debitamt31 = $myrow31[0];
      $creditamt31 = $myrow31[1];
      $crcptdr10204011tot = $crcptdr10204011tot + $debitamt31;
      $crcptcr10204011tot = $crcptcr10204011tot + $creditamt31;
    }
  }
  $result32 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.301\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result32 != '')
  {
    while($myrow32 = mysql_fetch_row($result32))
    {
      $found32 = 1;
      $debitamt32 = $myrow32[0];
      $creditamt32 = $myrow32[1];
      $crcptdr1020301tot = $crcptdr1020301tot + $debitamt32;
      $crcptcr1020301tot = $crcptcr1020301tot + $creditamt32;
    }
  }
  $result33 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.301-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result33 != '')
  {
    while($myrow33 = mysql_fetch_row($result33))
    {
      $found33 = 1;
      $debitamt33 = $myrow33[0];
      $creditamt33 = $myrow33[1];
      $crcptdr10203011tot = $crcptdr10203011tot + $debitamt33;
      $crcptcr10203011tot = $crcptcr10203011tot + $creditamt33;
    }
  }
  $result34 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result34 != '')
  {
    while($myrow34 = mysql_fetch_row($result34))
    {
      $found34 = 1;
      $debitamt34 = $myrow34[0];
      $creditamt34 = $myrow34[1];
      $crcptdr1020200tot = $crcptdr1020200tot + $debitamt34;
      $crcptcr1020200tot = $crcptcr1020200tot + $creditamt34;
    }
  }
  $result35 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.201-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result35 != '')
  {
    while($myrow35 = mysql_fetch_row($result35))
    {
      $found35 = 1;
      $debitamt35 = $myrow35[0];
      $creditamt35 = $myrow35[1];
      $crcptdr10202011tot = $crcptdr10202011tot + $debitamt35;
      $crcptcr10202011tot = $crcptcr10202011tot + $creditamt35;
    }
  }
  $result36 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.204\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result36 != '')
  {
    while($myrow36 = mysql_fetch_row($result36))
    {
      $found36 = 1;
      $debitamt36 = $myrow36[0];
      $creditamt36 = $myrow36[1];
      $crcptdr1020204tot = $crcptdr1020204tot + $debitamt36;
      $crcptcr1020204tot = $crcptcr1020204tot + $creditamt36;
    }
  }
  $result37 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.204-4\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result37 != '')
  {
    while($myrow37 = mysql_fetch_row($result37))
    {
      $found37 = 1;
      $debitamt37 = $myrow37[0];
      $creditamt37 = $myrow37[1];
      $crcptdr10202044tot = $crcptdr10202044tot + $debitamt37;
      $crcptcr10202044tot = $crcptcr10202044tot + $creditamt37;
    }
  }
  $result38 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.203\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result38 != '')
  {
    while($myrow38 = mysql_fetch_row($result38))
    {
      $found38 = 1;
      $debitamt38 = $myrow38[0];
      $creditamt38 = $myrow38[1];
      $crcptdr1020203tot = $crcptdr1020203tot + $debitamt38;
      $crcptcr1020203tot = $crcptcr1020203tot + $creditamt38;
    }
  }
  $result39 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.203-3\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result39 != '')
  {
    while($myrow39 = mysql_fetch_row($result39))
    {
      $found39 = 1;
      $debitamt39 = $myrow39[0];
      $creditamt39 = $myrow39[1];
      $crcptdr10202033tot = $crcptdr10202033tot + $debitamt39;
      $crcptcr10202033tot = $crcptcr10202033tot + $creditamt39;
    }
  }
  $result40 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.501\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result40 != '')
  {
    while($myrow40 = mysql_fetch_row($result40))
    {
      $found40 = 1;
      $debitamt40 = $myrow40[0];
      $creditamt40 = $myrow40[1];
      $crcptdr1020501tot = $crcptdr1020501tot + $debitamt40;
      $crcptcr1020501tot = $crcptcr1020501tot + $creditamt40;
    }
  }

  $result41 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.501-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result41 != '')
  {
    while($myrow41 = mysql_fetch_row($result41))
    {
      $found41 = 1;
      $debitamt41 = $myrow41[0];
      $creditamt41 = $myrow41[1];
      $crcptdr10205011tot = $crcptdr10205011tot + $debitamt41;
      $crcptcr10205011tot = $crcptcr10205011tot + $creditamt41;
    }
  }
  $result42 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.104\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result42 != '')
  {
    while($myrow42 = mysql_fetch_row($result42))
    {
      $found42 = 1;
      $debitamt42 = $myrow42[0];
      $creditamt42 = $myrow42[1];
      $crcptdr1020104tot = $crcptdr1020104tot + $debitamt42;
      $crcptcr1020104tot = $crcptcr1020104tot + $creditamt42;
    }
  }
  $result43 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.20.104-4\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result43 != '')
  {
    while($myrow43 = mysql_fetch_row($result43))
    {
      $found43 = 1;
      $debitamt43 = $myrow43[0];
      $creditamt43 = $myrow43[1];
      $crcptdr10201044tot = $crcptdr10201044tot + $debitamt43;
      $crcptcr10201044tot = $crcptcr10201044tot + $creditamt43;
    }
  }
  $result44 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.30.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result44 != '')
  {
    while($myrow44 = mysql_fetch_row($result44))
    {
      $found44 = 1;
      $debitamt44 = $myrow44[0];
      $creditamt44 = $myrow44[1];
      $crcptdr1030200tot = $crcptdr1030200tot + $debitamt44;
      $crcptcr1030200tot = $crcptcr1030200tot + $creditamt44;
    }
  }
/*  $result45 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result45 != '')
  {
    while($myrow45 = mysql_fetch_row($result45))
    {
      $found45 = 1;
      $debitamt45 = $myrow45[0];
      $creditamt45 = $myrow45[1];
      $crcptdrxxxxxxxtot = $crcptdrxxxxxxxtot + $debitamt45;
      $crcptcrxxxxxxxtot = $crcptcrxxxxxxxtot + $creditamt45;
    }
  } */
/*  $result46 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result46 != '')
  {
    while($myrow46 = mysql_fetch_row($result46))
    {
      $found46 = 1;
      $debitamt46 = $myrow46[0];
      $creditamt46 = $myrow46[1];
      $crcptdrxxxxxxxtot = $crcptdrxxxxxxxtot + $debitamt46;
      $crcptcrxxxxxxxtot = $crcptcrxxxxxxxtot + $creditamt46;
    }
  } */
  $result47 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.30.300\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result47 != '')
  {
    while($myrow47 = mysql_fetch_row($result47))
    {
      $found47 = 1;
      $debitamt47 = $myrow47[0];
      $creditamt47 = $myrow47[1];
      $crcptdr1030300tot = $crcptdr1030300tot + $debitamt47;
      $crcptcr1030300tot = $crcptcr1030300tot + $creditamt47;
    }
  }
  $result48 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"10.30.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result48 != '')
  {
    while($myrow48 = mysql_fetch_row($result48))
    {
      $found48 = 1;
      $debitamt48 = $myrow48[0];
      $creditamt48 = $myrow48[1];
      $crcptdr1030100tot = $crcptdr1030100tot + $debitamt48;
      $crcptcr1030100tot = $crcptcr1030100tot + $creditamt48;
    }
  }
  $result49 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.10.208\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result49 != '')
  {
    while($myrow49 = mysql_fetch_row($result49))
    {
      $found49 = 1;
      $debitamt49 = $myrow49[0];
      $creditamt49 = $myrow49[1];
      $crcptdr2010208tot = $crcptdr2010208tot + $debitamt49;
      $crcptcr2010208tot = $crcptcr2010208tot + $creditamt49;
    }
  }
  $result50 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.10.201\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result50 != '')
  {
    while($myrow50 = mysql_fetch_row($result50))
    {
      $found50 = 1;
      $debitamt50 = $myrow50[0];
      $creditamt50 = $myrow50[1];
      $crcptdr2010201tot = $crcptdr2010201tot + $debitamt50;
      $crcptcr2010201tot = $crcptcr2010201tot + $creditamt50;
    }
  }

  $result51 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.10.207\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result51 != '')
  {
    while($myrow51 = mysql_fetch_row($result51))
    {
      $found51 = 1;
      $debitamt51 = $myrow51[0];
      $creditamt51 = $myrow51[1];
      $crcptdr2010207tot = $crcptdr2010207tot + $debitamt51;
      $crcptcr2010207tot = $crcptcr2010207tot + $creditamt51;
    }
  }
  $result52 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.10.203\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result52 != '')
  {
    while($myrow52 = mysql_fetch_row($result52))
    {
      $found52 = 1;
      $debitamt52 = $myrow52[0];
      $creditamt52 = $myrow52[1];
      $crcptdr2010203tot = $crcptdr2010203tot + $debitamt52;
      $crcptcr2010203tot = $crcptcr2010203tot + $creditamt52;
    }
  }
  $result53 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.10.204\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result53 != '')
  {
    while($myrow53 = mysql_fetch_row($result53))
    {
      $found53 = 1;
      $debitamt53 = $myrow53[0];
      $creditamt53 = $myrow53[1];
      $crcptdr2010204tot = $crcptdr2010204tot + $debitamt53;
      $crcptcr2010204tot = $crcptcr2010204tot + $creditamt53;
    }
  }
  $result54 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.10.205\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result54 != '')
  {
    while($myrow54 = mysql_fetch_row($result54))
    {
      $found54 = 1;
      $debitamt54 = $myrow54[0];
      $creditamt54 = $myrow54[1];
      $crcptdr2010205tot = $crcptdr2010205tot + $debitamt54;
      $crcptcr2010205tot = $crcptcr2010205tot + $creditamt54;
    }
  }
  $result55 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.10.206\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result55 != '')
  {
    while($myrow55 = mysql_fetch_row($result55))
    {
      $found55 = 1;
      $debitamt55 = $myrow55[0];
      $creditamt55 = $myrow55[1];
      $crcptdr2010206tot = $crcptdr2010206tot + $debitamt55;
      $crcptcr2010206tot = $crcptcr2010206tot + $creditamt55;
    }
  }
  $result56 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.10.202\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result56 != '')
  {
    while($myrow56 = mysql_fetch_row($result56))
    {
      $found56 = 1;
      $debitamt56 = $myrow56[0];
      $creditamt56 = $myrow56[1];
      $crcptdr2010202tot = $crcptdr2010202tot + $debitamt56;
      $crcptcr2010202tot = $crcptcr2010202tot + $creditamt56;
    }
  }
  $result57 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.30.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result57 != '')
  {
    while($myrow57 = mysql_fetch_row($result57))
    {
      $found57 = 1;
      $debitamt57 = $myrow57[0];
      $creditamt57 = $myrow57[1];
      $crcptdr2030100tot = $crcptdr2030100tot + $debitamt57;
      $crcptcr2030100tot = $crcptcr2030100tot + $creditamt57;
    }
  }
  $result58 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.30.101\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result58 != '')
  {
    while($myrow58 = mysql_fetch_row($result58))
    {
      $found58 = 1;
      $debitamt58 = $myrow58[0];
      $creditamt58 = $myrow58[1];
      $crcptdr2030101tot = $crcptdr2030101tot + $debitamt58;
      $crcptcr2030101tot = $crcptcr2030101tot + $creditamt58;
    }
  }
  $result59 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.30.211\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result59 != '')
  {
    while($myrow59 = mysql_fetch_row($result59))
    {
      $found59 = 1;
      $debitamt59 = $myrow59[0];
      $creditamt59 = $myrow59[1];
      $crcptdr2030211tot = $crcptdr2030211tot + $debitamt59;
      $crcptcr2030211tot = $crcptcr2030211tot + $creditamt59;
    }
  }
  $result60 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.30.102\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result60 != '')
  {
    while($myrow60 = mysql_fetch_row($result60))
    {
      $found60 = 1;
      $debitamt60 = $myrow60[0];
      $creditamt60 = $myrow60[1];
      $crcptdr2030102tot = $crcptdr2030102tot + $debitamt60;
      $crcptcr2030102tot = $crcptcr2030102tot + $creditamt60;
    }
  }

  $result61 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.10.213\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result61 != '')
  {
    while($myrow61 = mysql_fetch_row($result61))
    {
      $found61 = 1;
      $debitamt61 = $myrow61[0];
      $creditamt61 = $myrow61[1];
      $crcptdr2010213tot = $crcptdr2010213tot + $debitamt61;
      $crcptcr2010213tot = $crcptcr2010213tot + $creditamt61;
    }
  }
  $result62 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.10.209\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result62 != '')
  {
    while($myrow62 = mysql_fetch_row($result62))
    {
      $found62 = 1;
      $debitamt62 = $myrow62[0];
      $creditamt62 = $myrow62[1];
      $crcptdr2010209tot = $crcptdr2010209tot + $debitamt62;
      $crcptcr2010209tot = $crcptcr2010209tot + $creditamt62;
    }
  }
  $result63 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"20.20.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result63 != '')
  {
    while($myrow63 = mysql_fetch_row($result63))
    {
      $found63 = 1;
      $debitamt63 = $myrow63[0];
      $creditamt63 = $myrow63[1];
      $crcptdr2020200tot = $crcptdr2020200tot + $debitamt63;
      $crcptcr2020200tot = $crcptcr2020200tot + $creditamt63;
    }
  }
  $result64 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"30.10.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result64 != '')
  {
    while($myrow64 = mysql_fetch_row($result64))
    {
      $found64 = 1;
      $debitamt64 = $myrow64[0];
      $creditamt64 = $myrow64[1];
      $crcptdr3010100tot = $crcptdr3010100tot + $debitamt64;
      $crcptcr3010100tot = $crcptcr3010100tot + $creditamt64;
    }
  }
  $result65 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"30.10.101\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result65 != '')
  {
    while($myrow65 = mysql_fetch_row($result65))
    {
      $found65 = 1;
      $debitamt65 = $myrow65[0];
      $creditamt65 = $myrow65[1];
      $crcptdr3010101tot = $crcptdr3010101tot + $debitamt65;
      $crcptcr3010101tot = $crcptcr3010101tot + $creditamt65;
    }
  }
  $result66 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"30.10.102\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result66 != '')
  {
    while($myrow66 = mysql_fetch_row($result66))
    {
      $found66 = 1;
      $debitamt66 = $myrow66[0];
      $creditamt66 = $myrow66[1];
      $crcptdr3010102tot = $crcptdr3010102tot + $debitamt66;
      $crcptcr3010102tot = $crcptcr3010102tot + $creditamt66;
    }
  }
/*  $result67 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result67 != '')
  {
    while($myrow67 = mysql_fetch_row($result67))
    {
      $found67 = 1;
      $debitamt67 = $myrow67[0];
      $creditamt67 = $myrow67[1];
      $crcptdrxxxxxxxtot = $crcptdrxxxxxxxtot + $debitamt67;
      $crcptcrxxxxxxxtot = $crcptcrxxxxxxxtot + $creditamt67;
    }
  } */
  $result68 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"30.10.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result68 != '')
  {
    while($myrow68 = mysql_fetch_row($result68))
    {
      $found68 = 1;
      $debitamt68 = $myrow68[0];
      $creditamt68 = $myrow68[1];
      $crcptdr3010200tot = $crcptdr3010200tot + $debitamt68;
      $crcptcr3010200tot = $crcptcr3010200tot + $creditamt68;
    }
  }
/*  $result69 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result69 != '')
  {
    while($myrow69 = mysql_fetch_row($result69))
    {
      $found69 = 1;
      $debitamt69 = $myrow69[0];
      $creditamt69 = $myrow69[1];
      $crcptdrxxxxxxxtot = $crcptdrxxxxxxxtot + $debitamt69;
      $crcptcrxxxxxxxtot = $crcptcrxxxxxxxtot + $creditamt69;
    }
  } */
/*  $result70 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result70 != '')
  {
    while($myrow70 = mysql_fetch_row($result70))
    {
      $found70 = 1;
      $debitamt70 = $myrow70[0];
      $creditamt70 = $myrow70[1];
      $crcptdrxxxxxxxtot = $crcptdrxxxxxxxtot + $debitamt70;
      $crcptcrxxxxxxxtot = $crcptcrxxxxxxxtot + $creditamt70;
    }
  } */

  $result71 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"50.10.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result71 != '')
  {
    while($myrow71 = mysql_fetch_row($result71))
    {
      $found71 = 1;
      $debitamt71 = $myrow71[0];
      $creditamt71 = $myrow71[1];
      $crcptdr5010000tot = $crcptdr5010000tot + $debitamt71;
      $crcptcr5010000tot = $crcptcr5010000tot + $creditamt71;
    }
  }
  $result72 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"50.10.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result72 != '')
  {
    while($myrow72 = mysql_fetch_row($result72))
    {
      $found72 = 1;
      $debitamt72 = $myrow72[0];
      $creditamt72 = $myrow72[1];
      $crcptdr5010200tot = $crcptdr5010200tot + $debitamt72;
      $crcptcr5010200tot = $crcptcr5010200tot + $creditamt72;
    }
  }
  $result73 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"50.10.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result73 != '')
  {
    while($myrow73 = mysql_fetch_row($result73))
    {
      $found73 = 1;
      $debitamt73 = $myrow73[0];
      $creditamt73 = $myrow73[1];
      $crcptdr5010100tot = $crcptdr5010100tot + $debitamt73;
      $crcptcr5010100tot = $crcptcr5010100tot + $creditamt73;
    }
  }
  $result74 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"60.00.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result74 != '')
  {
    while($myrow74 = mysql_fetch_row($result74))
    {
      $found74 = 1;
      $debitamt74 = $myrow74[0];
      $creditamt74 = $myrow74[1];
      $crcptdr6000000tot = $crcptdr6000000tot + $debitamt74;
      $crcptcr6000000tot = $crcptcr6000000tot + $creditamt74;
    }
  }
  $result75 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"70.00.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result75 != '')
  {
    while($myrow75 = mysql_fetch_row($result75))
    {
      $found75 = 1;
      $debitamt75 = $myrow75[0];
      $creditamt75 = $myrow75[1];
      $crcptdr7000000tot = $crcptdr7000000tot + $debitamt75;
      $crcptcr7000000tot = $crcptcr7000000tot + $creditamt75;
    }
  }
/*  $result76 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result76 != '')
  {
    while($myrow76 = mysql_fetch_row($result76))
    {
      $found76 = 1;
      $debitamt76 = $myrow76[0];
      $creditamt76 = $myrow76[1];
      $crcptdrxxxxxxxtot = $crcptdrxxxxxxxtot + $debitamt76;
      $crcptcrxxxxxxxtot = $crcptcrxxxxxxxtot + $creditamt76;
    }
  } */
  $result77 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE glcode=\"70.00.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result77 != '')
  {
    while($myrow77 = mysql_fetch_row($result77))
    {
      $found77 = 1;
      $debitamt77 = $myrow77[0];
      $creditamt77 = $myrow77[1];
      $crcptdr2010214tot = $crcptdr2010214tot + $debitamt77;
      $crcptcr2010214tot = $crcptcr2010214tot + $creditamt77;
    }
  }

// query tblfinjournal glcodes and compute month total
  $result01 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result01 != '')
  {
    while($myrow01 = mysql_fetch_row($result01))
    {
      $found01 = 1;
      $debitamt01 = $myrow01[0];
      $creditamt01 = $myrow01[1];
      $jbkdr1010100tot = $jbkdr1010100tot + $debitamt01;
      $jbkcr1010100tot = $jbkcr1010100tot + $creditamt01;
    }
  }
  $result02 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.201\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result02 != '')
  {
    while($myrow02 = mysql_fetch_row($result02))
    {
      $found02 = 1;
      $debitamt02 = $myrow02[0];
      $creditamt02 = $myrow02[1];
      $jbkdr1010201tot = $jbkdr1010201tot + $debitamt02;
      $jbkcr1010201tot = $jbkcr1010201tot + $creditamt02;
    }
  }
  $result03 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.202\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result03 != '')
  {
    while($myrow03 = mysql_fetch_row($result03))
    {
      $found03 = 1;
      $debitamt03 = $myrow03[0];
      $creditamt03 = $myrow03[1];
      $jbkdr1010202tot = $jbkdr1010202tot + $debitamt03;
      $jbkcr1010202tot = $jbkcr1010202tot + $creditamt03;
    }
  }
  $result04 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.209\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result04 != '')
  {
    while($myrow04 = mysql_fetch_row($result04))
    {
      $found04 = 1;
      $debitamt04 = $myrow04[0];
      $creditamt04 = $myrow04[1];
      $jbkdr1010209tot = $jbkdr1010209tot + $debitamt04;
      $jbkcr1010209tot = $jbkcr1010209tot + $creditamt04;
    }
  }
  $result05 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.211\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result05 != '')
  {
    while($myrow05 = mysql_fetch_row($result05))
    {
      $found05 = 1;
      $debitamt05 = $myrow05[0];
      $creditamt05 = $myrow05[1];
      $jbkdr1010211tot = $jbkdr1010211tot + $debitamt05;
      $jbkcr1010211tot = $jbkcr1010211tot + $creditamt05;
    }
  }
  $result06 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.207\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result06 != '')
  {
    while($myrow06 = mysql_fetch_row($result06))
    {
      $found06 = 1;
      $debitamt06 = $myrow06[0];
      $creditamt06 = $myrow06[1];
      $jbkdr1010207tot = $jbkdr1010207tot + $debitamt06;
      $jbkcr1010207tot = $jbkcr1010207tot + $creditamt06;
    }
  }
  $result07 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.204\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result07 != '')
  {
    while($myrow07 = mysql_fetch_row($result07))
    {
      $found07 = 1;
      $debitamt07 = $myrow07[0];
      $creditamt07 = $myrow07[1];
      $jbkdr1010204tot = $jbkdr1010204tot + $debitamt07;
      $jbkcr1010204tot = $jbkcr1010204tot + $creditamt07;
    }
  }
  $result08 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.203\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result08 != '')
  {
    while($myrow08 = mysql_fetch_row($result08))
    {
      $found08 = 1;
      $debitamt08 = $myrow08[0];
      $creditamt08 = $myrow08[1];
      $jbkdr1010203tot = $jbkdr1010203tot + $debitamt08;
      $jbkcr1010203tot = $jbkcr1010203tot + $creditamt08;
    }
  }
  $result09 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.300\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result09 != '')
  {
    while($myrow09 = mysql_fetch_row($result09))
    {
      $found09 = 1;
      $debitamt09 = $myrow09[0];
      $creditamt09 = $myrow09[1];
      $jbkdr1010300tot = $jbkdr1010300tot + $debitamt09;
      $jbkcr1010300tot = $jbkcr1010300tot + $creditamt09;
    }
  }
  $result10 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.400\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result10 != '')
  {
    while($myrow10 = mysql_fetch_row($result10))
    {
      $found10 = 1;
      $debitamt10 = $myrow10[0];
      $creditamt10 = $myrow10[1];
      $jbkdr1010400tot = $jbkdr1010400tot + $debitamt10;
      $jbkcr1010400tot = $jbkcr1010400tot + $creditamt10;
    }
  }

  $result11 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.400-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result11 != '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $debitamt11 = $myrow11[0];
      $creditamt11 = $myrow11[1];
      $jbkdr10104001tot = $jbkdr10104001tot + $debitamt11;
      $jbkcr10104001tot = $jbkcr10104001tot + $creditamt11;
    }
  }
  $result12 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.500\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result12 != '')
  {
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $debitamt12 = $myrow12[0];
      $creditamt12 = $myrow12[1];
      $jbkdr1010500tot = $jbkdr1010500tot + $debitamt12;
      $jbkcr1010500tot = $jbkcr1010500tot + $creditamt12;
    }
  }
  $result13 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.554\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result13 != '')
  {
    while($myrow13 = mysql_fetch_row($result13))
    {
      $found13 = 1;
      $debitamt13 = $myrow13[0];
      $creditamt13 = $myrow13[1];
      $jbkdr1010554tot = $jbkdr1010554tot + $debitamt13;
      $jbkcr1010554tot = $jbkcr1010554tot + $creditamt13;
    }
  }
  $result14 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.555\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result14 != '')
  {
    while($myrow14 = mysql_fetch_row($result14))
    {
      $found14 = 1;
      $debitamt14 = $myrow14[0];
      $creditamt14 = $myrow14[1];
      $jbkdr1010555tot = $jbkdr1010555tot + $debitamt14;
      $jbkcr1010555tot = $jbkcr1010555tot + $creditamt14;
    }
  }
  $result15 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.552\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result15 != '')
  {
    while($myrow15 = mysql_fetch_row($result15))
    {
      $found15 = 1;
      $debitamt15 = $myrow15[0];
      $creditamt15 = $myrow15[1];
      $jbkdr1010552tot = $jbkdr1010554tot + $debitamt15;
      $jbkcr1010552tot = $jbkcr1010554tot + $creditamt15;
    }
  }
  $result16 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.553\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result16 != '')
  {
    while($myrow16 = mysql_fetch_row($result16))
    {
      $found16 = 1;
      $debitamt16 = $myrow16[0];
      $creditamt16 = $myrow16[1];
      $jbkdr1010553tot = $jbkdr1010553tot + $debitamt16;
      $jbkcr1010553tot = $jbkcr1010553tot + $creditamt16;
    }
  }
  $result17 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.556\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result17 != '')
  {
    while($myrow17 = mysql_fetch_row($result17))
    {
      $found17 = 1;
      $debitamt17 = $myrow17[0];
      $creditamt17 = $myrow17[1];
      $jbkdr1010556tot = $jbkdr1010556tot + $debitamt17;
      $jbkcr1010556tot = $jbkcr1010556tot + $creditamt17;
    }
  }
/*  $result18 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result18 != '')
  {
    while($myrow18 = mysql_fetch_row($result18))
    {
      $found18 = 1;
      $debitamt18 = $myrow18[0];
      $creditamt18 = $myrow18[1];
      $jbkdrxxxxxxxtot = $jbkdrxxxxxxxtot + $debitamt18;
      $jbkcrxxxxxxxtot = $jbkcrxxxxxxxtot + $creditamt18;
    }
  } */
  $result19 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.551\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result19 != '')
  {
    while($myrow19 = mysql_fetch_row($result19))
    {
      $found19 = 1;
      $debitamt19 = $myrow19[0];
      $creditamt19 = $myrow19[1];
      $jbkdr1010551tot = $jbkdr1010551tot + $debitamt19;
      $jbkcr1010551tot = $jbkcr1010551tot + $creditamt19;
    }
  }
  $result20 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.700\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result20 != '')
  {
    while($myrow20 = mysql_fetch_row($result20))
    {
      $found20 = 1;
      $debitamt20 = $myrow20[0];
      $creditamt20 = $myrow20[1];
      $jbkdr1010700tot = $jbkdr1010700tot + $debitamt20;
      $jbkcr1010700tot = $jbkcr1010700tot + $creditamt20;
    }
  }

  $result21 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.706\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result21 != '')
  {
    while($myrow21 = mysql_fetch_row($result21))
    {
      $found21 = 1;
      $debitamt21 = $myrow21[0];
      $creditamt21 = $myrow21[1];
      $jbkdr1010706tot = $jbkdr1010706tot + $debitamt21;
      $jbkcr1010706tot = $jbkcr1010706tot + $creditamt21;
    }
  }
  $result22 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.707\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result22 != '')
  {
    while($myrow22 = mysql_fetch_row($result22))
    {
      $found22 = 1;
      $debitamt22 = $myrow22[0];
      $creditamt22 = $myrow22[1];
      $jbkdr1010707tot = $jbkdr1010707tot + $debitamt22;
      $jbkcr1010707tot = $jbkcr1010707tot + $creditamt22;
    }
  }
/*  $result23 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result23 != '')
  {
    while($myrow23 = mysql_fetch_row($result23))
    {
      $found23 = 1;
      $debitamt23 = $myrow23[0];
      $creditamt23 = $myrow23[1];
      $jbkdrxxxxxxxtot = $jbkdrxxxxxxxtot + $debitamt23;
      $jbkcrxxxxxxxtot = $jbkcrxxxxxxxtot + $creditamt23;
    }
  } */
  $result24 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.10.600\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result24 != '')
  {
    while($myrow24 = mysql_fetch_row($result24))
    {
      $found24 = 1;
      $debitamt24 = $myrow24[0];
      $creditamt24 = $myrow24[1];
      $jbkdr1010600tot = $jbkdr1010600tot + $debitamt24;
      $jbkcr1010600tot = $jbkcr1010600tot + $creditamt24;
    }
  }
  $result25 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.202\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result25 != '')
  {
    while($myrow25 = mysql_fetch_row($result25))
    {
      $found25 = 1;
      $debitamt25 = $myrow25[0];
      $creditamt25 = $myrow25[1];
      $jbkdr1020202tot = $jbkdr1020202tot + $debitamt25;
      $jbkcr1020202tot = $jbkcr1020202tot + $creditamt25;
    }
  }
  $result26 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.202-2\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result26 != '')
  {
    while($myrow26 = mysql_fetch_row($result26))
    {
      $found26 = 1;
      $debitamt26 = $myrow26[0];
      $creditamt26 = $myrow26[1];
      $jbkdr10202022tot = $jbkdr10202022tot + $debitamt26;
      $jbkcr10202022tot = $jbkcr10202022tot + $creditamt26;
    }
  }
  $result27 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.700\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result27 != '')
  {
    while($myrow27 = mysql_fetch_row($result27))
    {
      $found27 = 1;
      $debitamt27 = $myrow27[0];
      $creditamt27 = $myrow27[1];
      $jbkdr1020700tot = $jbkdr1020700tot + $debitamt27;
      $jbkcr1020700tot = $jbkcr1020700tot + $creditamt27;
    }
  }
  $result28 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result28 != '')
  {
    while($myrow28 = mysql_fetch_row($result28))
    {
      $found28 = 1;
      $debitamt28 = $myrow28[0];
      $creditamt28 = $myrow28[1];
      $jbkdr1020100tot = $jbkdr1020100tot + $debitamt28;
      $jbkcr1020100tot = $jbkcr1020100tot + $creditamt28;
    }
  }
  $result29 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.101-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result29 != '')
  {
    while($myrow29 = mysql_fetch_row($result29))
    {
      $found29 = 1;
      $debitamt29 = $myrow29[0];
      $creditamt29 = $myrow29[1];
      $jbkdr10201011tot = $jbkdr10201011tot + $debitamt29;
      $jbkcr10201011tot = $jbkcr10201011tot + $creditamt29;
    }
  }
  $result30 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.401\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result30 != '')
  {
    while($myrow30 = mysql_fetch_row($result30))
    {
      $found30 = 1;
      $debitamt30 = $myrow30[0];
      $creditamt30 = $myrow30[1];
      $jbkdr1020401tot = $jbkdr1020401tot + $debitamt30;
      $jbkcr1020401tot = $jbkcr1020401tot + $creditamt30;
    }
  }

  $result31 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.401-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result31 != '')
  {
    while($myrow31 = mysql_fetch_row($result31))
    {
      $found31 = 1;
      $debitamt31 = $myrow31[0];
      $creditamt31 = $myrow31[1];
      $jbkdr10204011tot = $jbkdr10204011tot + $debitamt31;
      $jbkcr10204011tot = $jbkcr10204011tot + $creditamt31;
    }
  }
  $result32 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.301\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result32 != '')
  {
    while($myrow32 = mysql_fetch_row($result32))
    {
      $found32 = 1;
      $debitamt32 = $myrow32[0];
      $creditamt32 = $myrow32[1];
      $jbkdr1020301tot = $jbkdr1020301tot + $debitamt32;
      $jbkcr1020301tot = $jbkcr1020301tot + $creditamt32;
    }
  }
  $result33 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.301-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result33 != '')
  {
    while($myrow33 = mysql_fetch_row($result33))
    {
      $found33 = 1;
      $debitamt33 = $myrow33[0];
      $creditamt33 = $myrow33[1];
      $jbkdr10203011tot = $jbkdr10203011tot + $debitamt33;
      $jbkcr10203011tot = $jbkcr10203011tot + $creditamt33;
    }
  }
  $result34 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result34 != '')
  {
    while($myrow34 = mysql_fetch_row($result34))
    {
      $found34 = 1;
      $debitamt34 = $myrow34[0];
      $creditamt34 = $myrow34[1];
      $jbkdr1020200tot = $jbkdr1020200tot + $debitamt34;
      $jbkcr1020200tot = $jbkcr1020200tot + $creditamt34;
    }
  }
  $result35 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.201-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result35 != '')
  {
    while($myrow35 = mysql_fetch_row($result35))
    {
      $found35 = 1;
      $debitamt35 = $myrow35[0];
      $creditamt35 = $myrow35[1];
      $jbkdr10202011tot = $jbkdr10202011tot + $debitamt35;
      $jbkcr10202011tot = $jbkcr10202011tot + $creditamt35;
    }
  }
  $result36 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.204\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result36 != '')
  {
    while($myrow36 = mysql_fetch_row($result36))
    {
      $found36 = 1;
      $debitamt36 = $myrow36[0];
      $creditamt36 = $myrow36[1];
      $jbkdr1020204tot = $jbkdr1020204tot + $debitamt36;
      $jbkcr1020204tot = $jbkcr1020204tot + $creditamt36;
    }
  }
  $result37 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.204-4\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result37 != '')
  {
    while($myrow37 = mysql_fetch_row($result37))
    {
      $found37 = 1;
      $debitamt37 = $myrow37[0];
      $creditamt37 = $myrow37[1];
      $jbkdr10202044tot = $jbkdr10202044tot + $debitamt37;
      $jbkcr10202044tot = $jbkcr10202044tot + $creditamt37;
    }
  }
  $result38 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.203\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result38 != '')
  {
    while($myrow38 = mysql_fetch_row($result38))
    {
      $found38 = 1;
      $debitamt38 = $myrow38[0];
      $creditamt38 = $myrow38[1];
      $jbkdr1020203tot = $jbkdr1020203tot + $debitamt38;
      $jbkcr1020203tot = $jbkcr1020203tot + $creditamt38;
    }
  }
  $result39 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.203-3\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result39 != '')
  {
    while($myrow39 = mysql_fetch_row($result39))
    {
      $found39 = 1;
      $debitamt39 = $myrow39[0];
      $creditamt39 = $myrow39[1];
      $jbkdr10202033tot = $jbkdr10202033tot + $debitamt39;
      $jbkcr10202033tot = $jbkcr10202033tot + $creditamt39;
    }
  }
  $result40 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.501\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result40 != '')
  {
    while($myrow40 = mysql_fetch_row($result40))
    {
      $found40 = 1;
      $debitamt40 = $myrow40[0];
      $creditamt40 = $myrow40[1];
      $jbkdr1020501tot = $jbkdr1020501tot + $debitamt40;
      $jbkcr1020501tot = $jbkcr1020501tot + $creditamt40;
    }
  }

  $result41 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.501-1\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result41 != '')
  {
    while($myrow41 = mysql_fetch_row($result41))
    {
      $found41 = 1;
      $debitamt41 = $myrow41[0];
      $creditamt41 = $myrow41[1];
      $jbkdr10205011tot = $jbkdr10205011tot + $debitamt41;
      $jbkcr10205011tot = $jbkcr10205011tot + $creditamt41;
    }
  }
  $result42 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.104\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result42 != '')
  {
    while($myrow42 = mysql_fetch_row($result42))
    {
      $found42 = 1;
      $debitamt42 = $myrow42[0];
      $creditamt42 = $myrow42[1];
      $jbkdr1020104tot = $jbkdr1020104tot + $debitamt42;
      $jbkcr1020104tot = $jbkcr1020104tot + $creditamt42;
    }
  }
  $result43 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.20.104-4\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result43 != '')
  {
    while($myrow43 = mysql_fetch_row($result43))
    {
      $found43 = 1;
      $debitamt43 = $myrow43[0];
      $creditamt43 = $myrow43[1];
      $jbkdr10201044tot = $jbkdr10201044tot + $debitamt43;
      $jbkcr10201044tot = $jbkcr10201044tot + $creditamt43;
    }
  }
  $result44 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.30.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result44 != '')
  {
    while($myrow44 = mysql_fetch_row($result44))
    {
      $found44 = 1;
      $debitamt44 = $myrow44[0];
      $creditamt44 = $myrow44[1];
      $jbkdr1030200tot = $jbkdr1030200tot + $debitamt44;
      $jbkcr1030200tot = $jbkcr1030200tot + $creditamt44;
    }
  }
/*  $result45 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result45 != '')
  {
    while($myrow45 = mysql_fetch_row($result45))
    {
      $found45 = 1;
      $debitamt45 = $myrow45[0];
      $creditamt45 = $myrow45[1];
      $jbkdrxxxxxxxtot = $jbkdrxxxxxxxtot + $debitamt45;
      $jbkcrxxxxxxxtot = $jbkcrxxxxxxxtot + $creditamt45;
    }
  } */
/*  $result46 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result46 != '')
  {
    while($myrow46 = mysql_fetch_row($result46))
    {
      $found46 = 1;
      $debitamt46 = $myrow46[0];
      $creditamt46 = $myrow46[1];
      $jbkdrxxxxxxxtot = $jbkdrxxxxxxxtot + $debitamt46;
      $jbkcrxxxxxxxtot = $jbkcrxxxxxxxtot + $creditamt46;
    }
  } */
  $result47 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.30.300\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result47 != '')
  {
    while($myrow47 = mysql_fetch_row($result47))
    {
      $found47 = 1;
      $debitamt47 = $myrow47[0];
      $creditamt47 = $myrow47[1];
      $jbkdr1030300tot = $jbkdr1030300tot + $debitamt47;
      $jbkcr1030300tot = $jbkcr1030300tot + $creditamt47;
    }
  }
  $result48 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"10.30.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result48 != '')
  {
    while($myrow48 = mysql_fetch_row($result48))
    {
      $found48 = 1;
      $debitamt48 = $myrow48[0];
      $creditamt48 = $myrow48[1];
      $jbkdr1030100tot = $jbkdr1030100tot + $debitamt48;
      $jbkcr1030100tot = $jbkcr1030100tot + $creditamt48;
    }
  }
  $result49 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.10.208\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result49 != '')
  {
    while($myrow49 = mysql_fetch_row($result49))
    {
      $found49 = 1;
      $debitamt49 = $myrow49[0];
      $creditamt49 = $myrow49[1];
      $jbkdr2010208tot = $jbkdr2010208tot + $debitamt49;
      $jbkcr2010208tot = $jbkcr2010208tot + $creditamt49;
    }
  }
  $result50 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.10.201\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result50 != '')
  {
    while($myrow50 = mysql_fetch_row($result50))
    {
      $found50 = 1;
      $debitamt50 = $myrow50[0];
      $creditamt50 = $myrow50[1];
      $jbkdr2010201tot = $jbkdr2010201tot + $debitamt50;
      $jbkcr2010201tot = $jbkcr2010201tot + $creditamt50;
    }
  }

  $result51 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.10.207\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result51 != '')
  {
    while($myrow51 = mysql_fetch_row($result51))
    {
      $found51 = 1;
      $debitamt51 = $myrow51[0];
      $creditamt51 = $myrow51[1];
      $jbkdr2010207tot = $jbkdr2010207tot + $debitamt51;
      $jbkcr2010207tot = $jbkcr2010207tot + $creditamt51;
    }
  }
  $result52 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.10.203\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result52 != '')
  {
    while($myrow52 = mysql_fetch_row($result52))
    {
      $found52 = 1;
      $debitamt52 = $myrow52[0];
      $creditamt52 = $myrow52[1];
      $jbkdr2010203tot = $jbkdr2010203tot + $debitamt52;
      $jbkcr2010203tot = $jbkcr2010203tot + $creditamt52;
    }
  }
  $result53 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.10.204\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result53 != '')
  {
    while($myrow53 = mysql_fetch_row($result53))
    {
      $found53 = 1;
      $debitamt53 = $myrow53[0];
      $creditamt53 = $myrow53[1];
      $jbkdr2010204tot = $jbkdr2010204tot + $debitamt53;
      $jbkcr2010204tot = $jbkcr2010204tot + $creditamt53;
    }
  }
  $result54 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.10.205\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result54 != '')
  {
    while($myrow54 = mysql_fetch_row($result54))
    {
      $found54 = 1;
      $debitamt54 = $myrow54[0];
      $creditamt54 = $myrow54[1];
      $jbkdr2010205tot = $jbkdr2010205tot + $debitamt54;
      $jbkcr2010205tot = $jbkcr2010205tot + $creditamt54;
    }
  }
  $result55 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.10.206\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result55 != '')
  {
    while($myrow55 = mysql_fetch_row($result55))
    {
      $found55 = 1;
      $debitamt55 = $myrow55[0];
      $creditamt55 = $myrow55[1];
      $jbkdr2010206tot = $jbkdr2010206tot + $debitamt55;
      $jbkcr2010206tot = $jbkcr2010206tot + $creditamt55;
    }
  }
  $result56 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.10.202\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result56 != '')
  {
    while($myrow56 = mysql_fetch_row($result56))
    {
      $found56 = 1;
      $debitamt56 = $myrow56[0];
      $creditamt56 = $myrow56[1];
      $jbkdr2010202tot = $jbkdr2010202tot + $debitamt56;
      $jbkcr2010202tot = $jbkcr2010202tot + $creditamt56;
    }
  }
  $result57 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.30.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result57 != '')
  {
    while($myrow57 = mysql_fetch_row($result57))
    {
      $found57 = 1;
      $debitamt57 = $myrow57[0];
      $creditamt57 = $myrow57[1];
      $jbkdr2030100tot = $jbkdr2030100tot + $debitamt57;
      $jbkcr2030100tot = $jbkcr2030100tot + $creditamt57;
    }
  }
  $result58 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.30.101\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result58 != '')
  {
    while($myrow58 = mysql_fetch_row($result58))
    {
      $found58 = 1;
      $debitamt58 = $myrow58[0];
      $creditamt58 = $myrow58[1];
      $jbkdr2030101tot = $jbkdr2030101tot + $debitamt58;
      $jbkcr2030101tot = $jbkcr2030101tot + $creditamt58;
    }
  }
  $result59 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.30.211\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result59 != '')
  {
    while($myrow59 = mysql_fetch_row($result59))
    {
      $found59 = 1;
      $debitamt59 = $myrow59[0];
      $creditamt59 = $myrow59[1];
      $jbkdr2030211tot = $jbkdr2030211tot + $debitamt59;
      $jbkcr2030211tot = $jbkcr2030211tot + $creditamt59;
    }
  }
  $result60 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.30.102\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result60 != '')
  {
    while($myrow60 = mysql_fetch_row($result60))
    {
      $found60 = 1;
      $debitamt60 = $myrow60[0];
      $creditamt60 = $myrow60[1];
      $jbkdr2030102tot = $jbkdr2030102tot + $debitamt60;
      $jbkcr2030102tot = $jbkcr2030102tot + $creditamt60;
    }
  }

  $result61 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.10.213\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result61 != '')
  {
    while($myrow61 = mysql_fetch_row($result61))
    {
      $found61 = 1;
      $debitamt61 = $myrow61[0];
      $creditamt61 = $myrow61[1];
      $jbkdr2010213tot = $jbkdr2010213tot + $debitamt61;
      $jbkcr2010213tot = $jbkcr2010213tot + $creditamt61;
    }
  }
  $result62 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.10.209\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result62 != '')
  {
    while($myrow62 = mysql_fetch_row($result62))
    {
      $found62 = 1;
      $debitamt62 = $myrow62[0];
      $creditamt62 = $myrow62[1];
      $jbkdr2010209tot = $jbkdr2010209tot + $debitamt62;
      $jbkcr2010209tot = $jbkcr2010209tot + $creditamt62;
    }
  }
  $result63 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"20.20.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result63 != '')
  {
    while($myrow63 = mysql_fetch_row($result63))
    {
      $found63 = 1;
      $debitamt63 = $myrow63[0];
      $creditamt63 = $myrow63[1];
      $jbkdr2020200tot = $jbkdr2020200tot + $debitamt63;
      $jbkcr2020200tot = $jbkcr2020200tot + $creditamt63;
    }
  }
  $result64 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"30.10.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result64 != '')
  {
    while($myrow64 = mysql_fetch_row($result64))
    {
      $found64 = 1;
      $debitamt64 = $myrow64[0];
      $creditamt64 = $myrow64[1];
      $jbkdr3010100tot = $jbkdr3010100tot + $debitamt64;
      $jbkcr3010100tot = $jbkcr3010100tot + $creditamt64;
    }
  }
  $result65 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"30.10.101\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result65 != '')
  {
    while($myrow65 = mysql_fetch_row($result65))
    {
      $found65 = 1;
      $debitamt65 = $myrow65[0];
      $creditamt65 = $myrow65[1];
      $jbkdr3010101tot = $jbkdr3010101tot + $debitamt65;
      $jbkcr3010101tot = $jbkcr3010101tot + $creditamt65;
    }
  }
  $result66 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"30.10.102\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result66 != '')
  {
    while($myrow66 = mysql_fetch_row($result66))
    {
      $found66 = 1;
      $debitamt66 = $myrow66[0];
      $creditamt66 = $myrow66[1];
      $jbkdr3010102tot = $jbkdr3010102tot + $debitamt66;
      $jbkcr3010102tot = $jbkcr3010102tot + $creditamt66;
    }
  }
/*  $result67 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result67 != '')
  {
    while($myrow67 = mysql_fetch_row($result67))
    {
      $found67 = 1;
      $debitamt67 = $myrow67[0];
      $creditamt67 = $myrow67[1];
      $jbkdrxxxxxxxtot = $jbkdrxxxxxxxtot + $debitamt67;
      $jbkcrxxxxxxxtot = $jbkcrxxxxxxxtot + $creditamt67;
    }
  } */
  $result68 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"30.10.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result68 != '')
  {
    while($myrow68 = mysql_fetch_row($result68))
    {
      $found68 = 1;
      $debitamt68 = $myrow68[0];
      $creditamt68 = $myrow68[1];
      $jbkdr3010200tot = $jbkdr3010200tot + $debitamt68;
      $jbkcr3010200tot = $jbkcr3010200tot + $creditamt68;
    }
  }
/*  $result69 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result69 != '')
  {
    while($myrow69 = mysql_fetch_row($result69))
    {
      $found69 = 1;
      $debitamt69 = $myrow69[0];
      $creditamt69 = $myrow69[1];
      $jbkdrxxxxxxxtot = $jbkdrxxxxxxxtot + $debitamt69;
      $jbkcrxxxxxxxtot = $jbkcrxxxxxxxtot + $creditamt69;
    }
  } */
/*  $result70 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result70 != '')
  {
    while($myrow70 = mysql_fetch_row($result70))
    {
      $found70 = 1;
      $debitamt70 = $myrow70[0];
      $creditamt70 = $myrow70[1];
      $jbkdrxxxxxxxtot = $jbkdrxxxxxxxtot + $debitamt70;
      $jbkcrxxxxxxxtot = $jbkcrxxxxxxxtot + $creditamt70;
    }
  } */

  $result71 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"50.10.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result71 != '')
  {
    while($myrow71 = mysql_fetch_row($result71))
    {
      $found71 = 1;
      $debitamt71 = $myrow71[0];
      $creditamt71 = $myrow71[1];
      $jbkdr5010000tot = $jbkdr5010000tot + $debitamt71;
      $jbkcr5010000tot = $jbkcr5010000tot + $creditamt71;
    }
  }
  $result72 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"50.10.200\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result72 != '')
  {
    while($myrow72 = mysql_fetch_row($result72))
    {
      $found72 = 1;
      $debitamt72 = $myrow72[0];
      $creditamt72 = $myrow72[1];
      $jbkdr5010200tot = $jbkdr5010200tot + $debitamt72;
      $jbkcr5010200tot = $jbkcr5010200tot + $creditamt72;
    }
  }
  $result73 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"50.10.100\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result73 != '')
  {
    while($myrow73 = mysql_fetch_row($result73))
    {
      $found73 = 1;
      $debitamt73 = $myrow73[0];
      $creditamt73 = $myrow73[1];
      $jbkdr5010100tot = $jbkdr5010100tot + $debitamt73;
      $jbkcr5010100tot = $jbkcr5010100tot + $creditamt73;
    }
  }
  $result74 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"60.00.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result74 != '')
  {
    while($myrow74 = mysql_fetch_row($result74))
    {
      $found74 = 1;
      $debitamt74 = $myrow74[0];
      $creditamt74 = $myrow74[1];
      $jbkdr6000000tot = $jbkdr6000000tot + $debitamt74;
      $jbkcr6000000tot = $jbkcr6000000tot + $creditamt74;
    }
  }
  $result75 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"70.00.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result75 != '')
  {
    while($myrow75 = mysql_fetch_row($result75))
    {
      $found75 = 1;
      $debitamt75 = $myrow75[0];
      $creditamt75 = $myrow75[1];
      $jbkdr7000000tot = $jbkdr7000000tot + $debitamt75;
      $jbkcr7000000tot = $jbkcr7000000tot + $creditamt75;
    }
  }
/*  $result76 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"xx.xx.xxx\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result76 != '')
  {
    while($myrow76 = mysql_fetch_row($result76))
    {
      $found76 = 1;
      $debitamt76 = $myrow76[0];
      $creditamt76 = $myrow76[1];
      $jbkdrxxxxxxxtot = $jbkdrxxxxxxxtot + $debitamt76;
      $jbkcrxxxxxxxtot = $jbkcrxxxxxxxtot + $creditamt76;
    }
  } */
  $result77 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE glcode=\"70.00.000\" AND glrefver=\"$glrefver\" AND date LIKE \"$wpgendate%\"", $dbh);
  if($result77 != '')
  {
    while($myrow77 = mysql_fetch_row($result77))
    {
      $found77 = 1;
      $debitamt77 = $myrow77[0];
      $creditamt77 = $myrow77[1];
      $jbkdr2010214tot = $jbkdr2010214tot + $debitamt77;
      $jbkcr2010214tot = $jbkcr2010214tot + $creditamt77;
    }
  }

// compute trial balance
  // query beginning balances from previous month
  $result111 = mysql_query("SELECT workpaperid, month, glcode, glrefver, begbalancedr, begbalancecr FROM tblfinworkpaper WHERE month=\"$wpgendate\"", $dbh);
  if($result111 != '')
  {
    while($myrow111 = mysql_fetch_row($result111))
    {
      $found111 = 1;
      $workpaperid111 = $myrow111[0];
      $month111 = $myrow111[1];
      $glcode111 = $myrow111[2];
      $glrefver111 = $myrow111[3];
      $begbalancedr111 = $myrow111[4];
      $begbalancecr111 = $myrow111[5];
    }
  }
  if($found111 == 1)
  {
    $result1010100 = mysql_query("SELECT workpaperid, begbalancedr, begbalancecr FROM tblfinworkpaper WHERE month=\"$wpgendate\" AND glcode=\"10.10.100\" AND glrefver=1", $dbh);
    if($result1010100 != '')
    {
      while($myrow1010100 = mysql_fetch_row($result1010100))
      {
	$found1010100 = 1;
	$workpaperid1010100 = $myrow1010100[0];
	$begbalancedr1010100 = $myrow1010100[1];
	$begbalancecr1010100 = $myrow1010100[2];
      }
    }
  }
  else
  {
    if($cutarrgenmonth == '1' || $cutarrgenmonth == '01')
    {
      $newcutyear = $cutarrgenyear - 1;
      $newcutmonth = 12;
      $wpgendate = $newcutyear."-".$newcutmonth."-"."1";
    }
    else
    {
      $result112 = ("SELECT workpaperid, month, glcode, glrefver, begbalancedr, begbalancecr FROM tblfinworkpaper WHERE month=\"$wpgendate\"", $dbh);
      if($result112 != '')
      {
	$found112 = 1;
	$workpaperid112 = $myrow112[0];
	$month112 = $myrow112[1];
	$glcode112 = $myrow112[2];
	$glrefver112 = $myrow112[3];
	$begbalancedr112 = $myrow112[4];
	$begbalancecr112 = $myrow112[5];
      }
    }
  }

// compute balance sheet

// income statement

// insert record to tblfinworkpaper

// insert log

echo "</table>";

echo "<p><a href=\"finvouchmain.php?loginid=$loginid\">Back</a></p>";



// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>

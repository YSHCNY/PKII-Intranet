<?php

// will detect the existing "to date" duration of group insurance

// start year of "to date"
     if ($toyear == '') { $toyear = "2011"; }
     echo "<input name=toyear size=4 value=\"$toyear\">";

// start month of "to date"
     if ($tomonth == "01") { $seltomm01 = "selected"; }
	else if ($tomonth == "02") { $seltomm02 = "selected"; }
	else if ($tomonth == "03") { $seltomm03 = "selected"; }
	else if ($tomonth == "04") { $seltomm04 = "selected"; }
	else if ($tomonth == "05") { $seltomm05 = "selected"; }
	else if ($tomonth == "06") { $seltomm06 = "selected"; }
	else if ($tomonth == "07") { $seltomm07 = "selected"; }
	else if ($tomonth == "08") { $seltomm08 = "selected"; }
	else if ($tomonth == "09") { $seltomm09 = "selected"; }
	else if ($tomonth == "10") { $seltomm10 = "selected"; }
	else if ($tomonth == "11") { $seltomm11 = "selected"; }
	else if ($tomonth == "12") { $seltomm12 = "selected"; }

     echo "<select name=tomonth>";
     echo "<option value=01 $seltomm01>Jan</option>";
     echo "<option value=02 $seltomm02>Feb</option>";
     echo "<option value=03 $seltomm03>Mar</option>";
     echo "<option value=04 $seltomm04>Apr</option>";
     echo "<option value=05 $seltomm05>May</option>";
     echo "<option value=06 $seltomm06>Jun</option>";
     echo "<option value=07 $seltomm07>Jul</option>";
     echo "<option value=08 $seltomm08>Aug</option>";
     echo "<option value=09 $seltomm09>Sep</option>";
     echo "<option value=10 $seltomm10>Oct</option>";
     echo "<option value=11 $seltomm11>Nov</option>";
     echo "<option value=12 $seltomm12>Dec</option>";
     echo "</select>";

// start day of "to date"
     if ($today == "01") { $seltodd01 = "selected"; }
	else if ($today == "02") { $seltodd02 = "selected"; }
	else if ($today == "03") { $seltodd03 = "selected"; }
	else if ($today == "04") { $seltodd04 = "selected"; }
	else if ($today == "05") { $seltodd05 = "selected"; }
	else if ($today == "06") { $seltodd06 = "selected"; }
	else if ($today == "07") { $seltodd07 = "selected"; }
	else if ($today == "08") { $seltodd08 = "selected"; }
	else if ($today == "09") { $seltodd09 = "selected"; }
	else if ($today == "10") { $seltodd10 = "selected"; }
	else if ($today == "11") { $seltodd11 = "selected"; }
	else if ($today == "12") { $seltodd12 = "selected"; }
	else if ($today == "13") { $seltodd13 = "selected"; }
	else if ($today == "14") { $seltodd14 = "selected"; }
	else if ($today == "15") { $seltodd15 = "selected"; }
	else if ($today == "16") { $seltodd16 = "selected"; }
	else if ($today == "17") { $seltodd17 = "selected"; }
	else if ($today == "18") { $seltodd18 = "selected"; }
	else if ($today == "19") { $seltodd19 = "selected"; }
	else if ($today == "20") { $seltodd20 = "selected"; }
	else if ($today == "21") { $seltodd21 = "selected"; }
	else if ($today == "22") { $seltodd22 = "selected"; }
	else if ($today == "23") { $seltodd23 = "selected"; }
	else if ($today == "24") { $seltodd24 = "selected"; }
	else if ($today == "25") { $seltodd25 = "selected"; }
	else if ($today == "26") { $seltodd26 = "selected"; }
	else if ($today == "27") { $seltodd27 = "selected"; }
	else if ($today == "28") { $seltodd28 = "selected"; }
	else if ($today == "29") { $seltodd29 = "selected"; }
	else if ($today == "30") { $seltodd30 = "selected"; }
	else if ($today == "31") { $seltodd31 = "selected"; }

     echo "<select name=today>";
     echo "<option value=01 $seltodd01>01</option>";
     echo "<option value=02 $seltodd02>02</option>";
     echo "<option value=03 $seltodd03>03</option>";
     echo "<option value=04 $seltodd04>04</option>";
     echo "<option value=05 $seltodd05>05</option>";
     echo "<option value=06 $seltodd06>06</option>";
     echo "<option value=07 $seltodd07>07</option>";
     echo "<option value=08 $seltodd08>08</option>";
     echo "<option value=09 $seltodd09>09</option>";
     echo "<option value=10 $seltodd10>10</option>";
     echo "<option value=11 $seltodd11>11</option>";
     echo "<option value=12 $seltodd12>12</option>";
     echo "<option value=13 $seltodd13>13</option>";
     echo "<option value=14 $seltodd14>14</option>";
     echo "<option value=15 $seltodd15>15</option>";
     echo "<option value=16 $seltodd16>16</option>";
     echo "<option value=17 $seltodd17>17</option>";
     echo "<option value=18 $seltodd18>18</option>";
     echo "<option value=19 $seltodd19>19</option>";
     echo "<option value=20 $seltodd20>20</option>";
     echo "<option value=21 $seltodd21>21</option>";
     echo "<option value=22 $seltodd22>22</option>";
     echo "<option value=23 $seltodd23>23</option>";
     echo "<option value=24 $seltodd24>24</option>";
     echo "<option value=25 $seltodd25>25</option>";
     echo "<option value=26 $seltodd26>26</option>";
     echo "<option value=27 $seltodd27>27</option>";
     echo "<option value=28 $seltodd28>28</option>";
     echo "<option value=29 $seltodd29>29</option>";
     echo "<option value=30 $seltodd30>30</option>";
     echo "<option value=31 $seltodd31>31</option>";
     echo "</select></td>";

?>

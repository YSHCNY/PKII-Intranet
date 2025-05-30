<?php

// will detect the existing "from date" duration of group insurance

// start year of "from date"
     if ($fromyear == '') { $fromyear = "2010"; }
     echo "<input name=fromyear size=4 value=\"$fromyear\">";

// start month of "from date"
     if ($frommonth == "01") { $selfrommm01 = "selected"; }
	else if ($frommonth == "02") { $selfrommm02 = "selected"; }
	else if ($frommonth == "03") { $selfrommm03 = "selected"; }
	else if ($frommonth == "04") { $selfrommm04 = "selected"; }
	else if ($frommonth == "05") { $selfrommm05 = "selected"; }
	else if ($frommonth == "06") { $selfrommm06 = "selected"; }
	else if ($frommonth == "07") { $selfrommm07 = "selected"; }
	else if ($frommonth == "08") { $selfrommm08 = "selected"; }
	else if ($frommonth == "09") { $selfrommm09 = "selected"; }
	else if ($frommonth == "10") { $selfrommm10 = "selected"; }
	else if ($frommonth == "11") { $selfrommm11 = "selected"; }
	else if ($frommonth == "12") { $selfrommm12 = "selected"; }

     echo "<select name=frommonth>";
     echo "<option value=01 $selfrommm01>Jan</option>";
     echo "<option value=02 $selfrommm02>Feb</option>";
     echo "<option value=03 $selfrommm03>Mar</option>";
     echo "<option value=04 $selfrommm04>Apr</option>";
     echo "<option value=05 $selfrommm05>May</option>";
     echo "<option value=06 $selfrommm06>Jun</option>";
     echo "<option value=07 $selfrommm07>Jul</option>";
     echo "<option value=08 $selfrommm08>Aug</option>";
     echo "<option value=09 $selfrommm09>Sep</option>";
     echo "<option value=10 $selfrommm10>Oct</option>";
     echo "<option value=11 $selfrommm11>Nov</option>";
     echo "<option value=12 $selfrommm12>Dec</option>";
     echo "</select>";

// start day of "from date"
     if ($fromday == "01") { $selfromdd01 = "selected"; }
	else if ($fromday == "02") { $selfromdd02 = "selected"; }
	else if ($fromday == "03") { $selfromdd03 = "selected"; }
	else if ($fromday == "04") { $selfromdd04 = "selected"; }
	else if ($fromday == "05") { $selfromdd05 = "selected"; }
	else if ($fromday == "06") { $selfromdd06 = "selected"; }
	else if ($fromday == "07") { $selfromdd07 = "selected"; }
	else if ($fromday == "08") { $selfromdd08 = "selected"; }
	else if ($fromday == "09") { $selfromdd09 = "selected"; }
	else if ($fromday == "10") { $selfromdd10 = "selected"; }
	else if ($fromday == "11") { $selfromdd11 = "selected"; }
	else if ($fromday == "12") { $selfromdd12 = "selected"; }
	else if ($fromday == "13") { $selfromdd13 = "selected"; }
	else if ($fromday == "14") { $selfromdd14 = "selected"; }
	else if ($fromday == "15") { $selfromdd15 = "selected"; }
	else if ($fromday == "16") { $selfromdd16 = "selected"; }
	else if ($fromday == "17") { $selfromdd17 = "selected"; }
	else if ($fromday == "18") { $selfromdd18 = "selected"; }
	else if ($fromday == "19") { $selfromdd19 = "selected"; }
	else if ($fromday == "20") { $selfromdd20 = "selected"; }
	else if ($fromday == "21") { $selfromdd21 = "selected"; }
	else if ($fromday == "22") { $selfromdd22 = "selected"; }
	else if ($fromday == "23") { $selfromdd23 = "selected"; }
	else if ($fromday == "24") { $selfromdd24 = "selected"; }
	else if ($fromday == "25") { $selfromdd25 = "selected"; }
	else if ($fromday == "26") { $selfromdd26 = "selected"; }
	else if ($fromday == "27") { $selfromdd27 = "selected"; }
	else if ($fromday == "28") { $selfromdd28 = "selected"; }
	else if ($fromday == "29") { $selfromdd29 = "selected"; }
	else if ($fromday == "30") { $selfromdd30 = "selected"; }
	else if ($fromday == "31") { $selfromdd31 = "selected"; }

     echo "<select name=fromday>";
     echo "<option value=01 $selfromdd01>01</option>";
     echo "<option value=02 $selfromdd02>02</option>";
     echo "<option value=03 $selfromdd03>03</option>";
     echo "<option value=04 $selfromdd04>04</option>";
     echo "<option value=05 $selfromdd05>05</option>";
     echo "<option value=06 $selfromdd06>06</option>";
     echo "<option value=07 $selfromdd07>07</option>";
     echo "<option value=08 $selfromdd08>08</option>";
     echo "<option value=09 $selfromdd09>09</option>";
     echo "<option value=10 $selfromdd10>10</option>";
     echo "<option value=11 $selfromdd11>11</option>";
     echo "<option value=12 $selfromdd12>12</option>";
     echo "<option value=13 $selfromdd13>13</option>";
     echo "<option value=14 $selfromdd14>14</option>";
     echo "<option value=15 $selfromdd15>15</option>";
     echo "<option value=16 $selfromdd16>16</option>";
     echo "<option value=17 $selfromdd17>17</option>";
     echo "<option value=18 $selfromdd18>18</option>";
     echo "<option value=19 $selfromdd19>19</option>";
     echo "<option value=20 $selfromdd20>20</option>";
     echo "<option value=21 $selfromdd21>21</option>";
     echo "<option value=22 $selfromdd22>22</option>";
     echo "<option value=23 $selfromdd23>23</option>";
     echo "<option value=24 $selfromdd24>24</option>";
     echo "<option value=25 $selfromdd25>25</option>";
     echo "<option value=26 $selfromdd26>26</option>";
     echo "<option value=27 $selfromdd27>27</option>";
     echo "<option value=28 $selfromdd28>28</option>";
     echo "<option value=29 $selfromdd29>29</option>";
     echo "<option value=30 $selfromdd30>30</option>";
     echo "<option value=31 $selfromdd31>31</option>";
     echo "</select></td>";

?>

<?php

// will detect the existing "effective date" from the current db

// start year of "effective date"
     if ($effectiveyear == '') { $effectiveyear = "2010"; }
     echo "<input name=effectiveyear size=4 value=\"$effectiveyear\">";

// start month of "effective date"
     if ($effectivemonth == "01") { $seleffectmm01 = "selected"; }
	else if ($effectivemonth == "02") { $seleffectmm02 = "selected"; }
	else if ($effectivemonth == "03") { $seleffectmm03 = "selected"; }
	else if ($effectivemonth == "04") { $seleffectmm04 = "selected"; }
	else if ($effectivemonth == "05") { $seleffectmm05 = "selected"; }
	else if ($effectivemonth == "06") { $seleffectmm06 = "selected"; }
	else if ($effectivemonth == "07") { $seleffectmm07 = "selected"; }
	else if ($effectivemonth == "08") { $seleffectmm08 = "selected"; }
	else if ($effectivemonth == "09") { $seleffectmm09 = "selected"; }
	else if ($effectivemonth == "10") { $seleffectmm10 = "selected"; }
	else if ($effectivemonth == "11") { $seleffectmm11 = "selected"; }
	else if ($effectivemonth == "12") { $seleffectmm12 = "selected"; }

     echo "<select name=effectivemonth>";
     echo "<option value=01 $seleffectmm01>Jan</option>";
     echo "<option value=02 $seleffectmm02>Feb</option>";
     echo "<option value=03 $seleffectmm03>Mar</option>";
     echo "<option value=04 $seleffectmm04>Apr</option>";
     echo "<option value=05 $seleffectmm05>May</option>";
     echo "<option value=06 $seleffectmm06>Jun</option>";
     echo "<option value=07 $seleffectmm07>Jul</option>";
     echo "<option value=08 $seleffectmm08>Aug</option>";
     echo "<option value=09 $seleffectmm09>Sep</option>";
     echo "<option value=10 $seleffectmm10>Oct</option>";
     echo "<option value=11 $seleffectmm11>Nov</option>";
     echo "<option value=12 $seleffectmm12>Dec</option>";
     echo "</select>";

// start day of "effective date"
     if ($effectiveday == "01") { $seleffectdd01 = "selected"; }
	else if ($effectiveday == "02") { $seleffectdd02 = "selected"; }
	else if ($effectiveday == "03") { $seleffectdd03 = "selected"; }
	else if ($effectiveday == "04") { $seleffectdd04 = "selected"; }
	else if ($effectiveday == "05") { $seleffectdd05 = "selected"; }
	else if ($effectiveday == "06") { $seleffectdd06 = "selected"; }
	else if ($effectiveday == "07") { $seleffectdd07 = "selected"; }
	else if ($effectiveday == "08") { $seleffectdd08 = "selected"; }
	else if ($effectiveday == "09") { $seleffectdd09 = "selected"; }
	else if ($effectiveday == "10") { $seleffectdd10 = "selected"; }
	else if ($effectiveday == "11") { $seleffectdd11 = "selected"; }
	else if ($effectiveday == "12") { $seleffectdd12 = "selected"; }
	else if ($effectiveday == "13") { $seleffectdd13 = "selected"; }
	else if ($effectiveday == "14") { $seleffectdd14 = "selected"; }
	else if ($effectiveday == "15") { $seleffectdd15 = "selected"; }
	else if ($effectiveday == "16") { $seleffectdd16 = "selected"; }
	else if ($effectiveday == "17") { $seleffectdd17 = "selected"; }
	else if ($effectiveday == "18") { $seleffectdd18 = "selected"; }
	else if ($effectiveday == "19") { $seleffectdd19 = "selected"; }
	else if ($effectiveday == "20") { $seleffectdd20 = "selected"; }
	else if ($effectiveday == "21") { $seleffectdd21 = "selected"; }
	else if ($effectiveday == "22") { $seleffectdd22 = "selected"; }
	else if ($effectiveday == "23") { $seleffectdd23 = "selected"; }
	else if ($effectiveday == "24") { $seleffectdd24 = "selected"; }
	else if ($effectiveday == "25") { $seleffectdd25 = "selected"; }
	else if ($effectiveday == "26") { $seleffectdd26 = "selected"; }
	else if ($effectiveday == "27") { $seleffectdd27 = "selected"; }
	else if ($effectiveday == "28") { $seleffectdd28 = "selected"; }
	else if ($effectiveday == "29") { $seleffectdd29 = "selected"; }
	else if ($effectiveday == "30") { $seleffectdd30 = "selected"; }
	else if ($effectiveday == "31") { $seleffectdd31 = "selected"; }

     echo "<select name=effectiveday>";
     echo "<option value=01 $seleffectdd01>01</option>";
     echo "<option value=02 $seleffectdd02>02</option>";
     echo "<option value=03 $seleffectdd03>03</option>";
     echo "<option value=04 $seleffectdd04>04</option>";
     echo "<option value=05 $seleffectdd05>05</option>";
     echo "<option value=06 $seleffectdd06>06</option>";
     echo "<option value=07 $seleffectdd07>07</option>";
     echo "<option value=08 $seleffectdd08>08</option>";
     echo "<option value=09 $seleffectdd09>09</option>";
     echo "<option value=10 $seleffectdd10>10</option>";
     echo "<option value=11 $seleffectdd11>11</option>";
     echo "<option value=12 $seleffectdd12>12</option>";
     echo "<option value=13 $seleffectdd13>13</option>";
     echo "<option value=14 $seleffectdd14>14</option>";
     echo "<option value=15 $seleffectdd15>15</option>";
     echo "<option value=16 $seleffectdd16>16</option>";
     echo "<option value=17 $seleffectdd17>17</option>";
     echo "<option value=18 $seleffectdd18>18</option>";
     echo "<option value=19 $seleffectdd19>19</option>";
     echo "<option value=20 $seleffectdd20>20</option>";
     echo "<option value=21 $seleffectdd21>21</option>";
     echo "<option value=22 $seleffectdd22>22</option>";
     echo "<option value=23 $seleffectdd23>23</option>";
     echo "<option value=24 $seleffectdd24>24</option>";
     echo "<option value=25 $seleffectdd25>25</option>";
     echo "<option value=26 $seleffectdd26>26</option>";
     echo "<option value=27 $seleffectdd27>27</option>";
     echo "<option value=28 $seleffectdd28>28</option>";
     echo "<option value=29 $seleffectdd29>29</option>";
     echo "<option value=30 $seleffectdd30>30</option>";
     echo "<option value=31 $seleffectdd31>31</option>";
     echo "</select></td>";

?>

<?php

// header

?>

<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title>PKII Intranet</title>
<link rel="icon" type="png/x-icon" href="./pictures/admin.ico">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<!-- datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.dataTables.min.css">
<script src="https:///cdn.datatables.net/2.0.4/js/dataTables.min.js"></script>
<style>
 


  .dataTables_length select,
.dataTables_paginate,
.dataTables_info {
    font-size: 12px !important; /* Adjust the font size as needed */
}

                /* Override bold font-weight for "Show entries" dropdown */
                .dataTables_wrapper .dataTables_length label {
    font-weight: normal !important;
}

/* Override bold font-weight for "Search" input */
.dataTables_wrapper .dataTables_filter input {
    font-weight: normal !important;
}
</style>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   

<STYLE TYPE="text/css">
#tblName_length{display: none;}
#tblName_filter{display: none;}
p{font-family: Helvetica; font-size: 10pt;}
b{font-family: Helvetica; font-size: 10pt;}
td{font-family: Helvetica; font-size: 10pt;}
label.error{color:red; font-size:11px;font-weight: 300; padding: 2rem;}

.page_break {
page-break-inside: avoid;
}

.modal-backdrop{
	display: none;
}


@media print {
    html, body {
        height: 99%;    
		font-family: 'Poppins', sans-serif;
    }

	
	.block {
	display: table-row;
	height: 1px;
	}
	
	.push {
	height: auto;
	}
	
	.block.push {
	border: 1px solid gray;
	display: table-cell;
	}
}
/* body > table.fin {
	background: #C6CEB0;
	border:1px solid gray;
	border-collapse:collapse;
	color:#fff;
	margin-left: 16%;
	margin-top:6%;
}
caption { 
	border:1px solid #5C443A;
	color:#5C443A;
	font-weight:bold;
	letter-spacing:20px;
	padding:6px 4px 8px 0px;
	text-align:center;
	text-transform:uppercase;
}
table.fin td, table.fin th {
	font-family: 'Poppins', sans-serif;
	color: black !important;
	border: 1px solid black !important;
}
table.fin th{
	height: 65px !important;
	vertical-align: middle !important;
	padding: 0 10px;
}
table.fin td{
	height: 50px !important;
	vertical-align: middle !important;
	padding: 0 10px;
}
tr { 
	border:1px dotted gray;
}
table.fin tbody td a { 
	color: black !important;
	text-decoration: none;
}
table.fin tbody td a:hover { 
	text-decoration:underline;
	font-weight: 600;
}
table.fin tbody th a { color:#363636;
 font-weight:normal;
 text-decoration:none;
}
table.fin tbody th a:hover {
	color:#363636;
}
table.fin tbody td+td+td+td a { background-image:url('bullet_blue.png');
 background-position:left center;
 background-repeat:no-repeat;
}
table.fin tbody td+td+td+td a:visited { background-image:url('bullet_white.png');
 background-position:left center;
 background-repeat:no-repeat;
}
table.fin tbody th, table.fin tbody td { vertical-align:top; }
table.fin tfoot td { 
	background:#5C443A;
 	color:#FFFFFF;
 	padding-top:3px;
}
.odd { 
	background:#fff; 
}
table.fin tbody tr:hover {
	background: #9bd9fe;
	border:1px solid #03476F;
	color: #000000;
}
body > table.fin2 {
	background:#C6CEB0;
	border:1px solid gray;
	border-collapse:collapse;
	color:#fff;
	font:normal 12px verdana, arial, helvetica, sans-serif;
	margin-left: 16%;
	margin-top:6%;
}
table.fin2 td, table.fin2 th { color:#363636;
}
table.fin2 thead th, table.fin2 tfoot th { background:#5C443A;
 color:#FFFFFF;
 text-align:left;
 text-transform:uppercase;
}
table.fin2 tbody td a { color:#363636;
 text-decoration:none;
}
table.fin2 tbody td a:hover { text-decoration:underline;
}
table.fin2 tbody th a { color:#363636;
 font-weight:normal;
 text-decoration:none;
}
table.fin2 tbody th a:hover { color:#363636;
}
table.fin2 tbody td+td+td+td a { background-image:url('bullet_blue.png');
 background-position:left center;
 background-repeat:no-repeat;
 color:#03476F;
}
table.fin2 tbody td+td+td+td a:visited { background-image:url('bullet_white.png');
 background-position:left center;
 background-repeat:no-repeat;
}
table.fin2 tbody th, table.fin2 tbody td { vertical-align:top; }
table.fin2 tfoot td { background:#5C443A;
 color:#FFFFFF;
}
.odd { background:#fff;
} */

/*file icons*/
 
a[href$='.zip'], a[href$='.rar'], a[href$='.gzip'], a[href$='.gz'], a[href$='.ZIP'], a[href$='.RAR'], a[href$='.GZIP'], a[href$='.GZ'] {
background:transparent url(./images/rar.png) center left no-repeat;
display:inline-block;
padding-left:20px;
line-height:18px;
}
a[href$='.txt'], a[href$='.TXT'], a[href$='.rtf'], a[href$='.RTF'] {
background:transparent url(./images/txt.png) center left no-repeat;
display:inline-block;
padding-left:20px;
line-height:18px;
}
a[href$='.doc'], a[href$='.docx'], a[href$='.DOC'], a[href$='.DOCX'] {
background:transparent url(./images/msdoc.png) center left no-repeat;
display:inline-block;
padding-left:20px;
line-height:18px;
}
a[href$='.xls'], a[href$='.xlsx'], a[href$='.XLS'], a[href$='.XLSX'] {
background:transparent url(./images/msxls.png) center left no-repeat;
display:inline-block;
padding-left:20px;
line-height:18px;
}
a[href$='.ppt'], a[href$='.pptx'], a[href$='.PPT'], a[href$='.PPTX'] {
background:transparent url(./images/msppt.png) center left no-repeat;
display:inline-block;
padding-left:20px;
line-height:18px;
}
a[href$='.pdf'], a[href$='.PDF'] {
background:transparent url(./images/pdf.png) center left no-repeat;
display:inline-block;
padding-left:20px;
line-height:18px;
}
a[href$='.png'], a[href$='.PNG'], a[href$='.jpg'], a[href$='.JPG'], a[href$='.tif'], a[href$='.TIF'], a[href$='.bmp'], a[href$='.BMP'] {
background:transparent url(./images/img.png) center left no-repeat;
display:inline-block;
padding-left:20px;
line-height:18px;
}

img#profimg {
    height: 20px;
    width: 20px;
    border-radius: 100%;
    border: 1px solid #ffffff;
}

.dropbtn {
    color: white;
    font-size: 18px;
    border: none;
    list-style: none;
}

.dropdown {
    position: relative;
    display: inline-block;
}


#uname {
	padding: 10px;
	text-align: center;
	transition: .3s ease-in-out;
}

#uname:hover, #upic:hover{
	cursor: pointer;
	transition: .3s ;
	color: orange;



}

.dropdown-content {
    display: none;
    top: 100%;
    position: absolute;
    right: -10px;
    background-color: #f9f9f9;
    min-width: 190px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    text-align: center;
	border-radius: 5px;
	border: 1px solid white;
}

.dropdown-content a {
	
    color: #191919;

	padding: 1rem;

    text-decoration: none;
    display: block;
	font-family: 'Poppins', sans-serif;
}

.dropdown a:hover{
	background: rgba(49, 49, 49, 0.5);
	text-decoration: none !important;
	color: white;
	
	background: #0a1d44;
}

.show {display:block;}

.header-container{
	width:100%;
	height: 6rem;	
	background: #0a1d44;
	position: fixed;
	z-index: 2;

}

.header-wrapper{
	width: 100%;
	height: 100%;
}
.header-wrapper2{
	width: 87%;
	height: 100%;
}

#sidebarLogo{
	height: 12%;
	margin-bottom: 15%;
}

.dropdownMenu{
	display: none;
	list-style: none;
	padding: 0;
	margin: 0 0 0 15px;
}
.vertical-line {
  height: 100%; /* Adjust the height as needed */
  transform: rotate(90deg); /* Rotate the horizontal line to make it vertical */
  border: none; /* Remove default border */
  border: 2px solid black; /* Add a border on the left side to create the line */
}
.dropdownMenu li{
	
    transition: all 0.2s ease;


	
}

.dropdownMenu li:hover{
	color: white;
	background: #0a1d44;
	
}
.dropdownMenu  a:hover{
	color: white;
	text-decoration: none !important;
}
.dropdownMenu  a{
	
	text-decoration: none !important;
	color: #4A4A4A;


}


.amainbgc{
	background-color:  #0a1d44 !important;
}

.dropdownMenuList{

	cursor: pointer;
	color: #0a1d44;

}


.dropdownMenuListsolo{

cursor: pointer;
color: #0a1d44;

}

#sidebar{
	
	width: 13%;
	height: 100%;
	position: fixed;
	top: 0;
	z-index: 2;
	font-family: 'Poppins', sans-serif;
}



/* ul#menuList {
    font-size: 15px;
    list-style: none;
    padding: 0;
} */


.mainbtnclr{
	background-color: #1e3b75 !important;
}
div#bodyContainer {
	background-color: white;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    z-index: 1;
}
div#bodyWrapper {
    padding-left: 14%;
    padding-top: 6.5%;
}
.dropdown {
    
    transition: all 0.7s ease;
    color:#2A3F54;
}
.dropdownMenuList:hover, .stay-hover{
    cursor: pointer;
    color: white;
	background: #0a1d44;
	border-radius: 5px;
}


.dropdownMenuListsolo:hover, .stay-hover{
    cursor: pointer;
    color: white;
	background: #0a1d44;
	border-radius: 5px;
}

.dropdownMenuListsolo i{   
	margin-right: 10px;
	height: 20px !important;
	width: 20px !important;
}

.dropdownMenuList i{   
	margin-right: 10px;
	height: 20px !important;
	width: 20px !important;
}


#dash{
	transition: transform 0.5s ease;
}
#dash:hover, #dash h4:hover{
	color: white;
}
#dash:hover path{
    fill: orange;
}
#notif{
	transition: transform 0.5s;
}
#notif:hover{

	cursor: pointer;
}
#notif:hover path {
    fill: orange;
}
.dropdownIcon{
	width: 16px;
}
.rotate{
    transform: rotate(180deg);
}

.btnbgc{
	color: white;
	background-color: #03476F;
}
#sc-up{
	font-size: 40px;
	cursor: pointer;
}

.flicker-container {
  overflow: hidden;
  width: 100%;
}

.flicker {
  animation: flicker 1.5s infinite;
}

@keyframes flicker {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.1;
  }
  100% {
    opacity: 1;
  }
}

</STYLE>
</head>
<body>
<?php 
    include ("addons.php");

	$sql = "SELECT * FROM tblcontact WHERE employeeid='$employeeid0' limit 1";
	$result = mysql_query($sql);
	$value = mysql_fetch_object($result);
	$profimg = '';
	if($value->picfn)
		{
			$profpic = $value->picfn;
			$profimg = "<img class='dropbtn' src='images/$profpic' id='profimg'/>";
		}
	else{$profimg = "<img class='dropbtn' src='images/default.gif' id='profimg'/>";}
?>
	<div class="header-container">
		
		<div class="header-wrapper  d-flex align-items-center justify-content-end">
		<div class="header-wrapper2 d-flex align-items-center justify-content-between px-4">


	<div class = 'ms-5 ps-5'>
				
				<div class="ms-5 ps-5">
						<button type="button" id="sidebarCollapse" class="btn btn-primary">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
	  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
	</svg>
			  
				</button>
			</div>
			
				</div>


			<div class="d-flex align-items-center gap-5">
				<!-- <a href="index2.php?loginid=<?php echo $loginid; ?>" id="dash" class="h-100 text-black text-decoration-none d-flex align-items-center gap-3"> -->
				<!-- <h4 class="h-100 fw-medium d-flex justify-content-center align-items-center m-0 pt-1"></h4> -->
				<!-- <svg width="20" height="20" viewBox="0 0 25 25" title = 'dashboard' ="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M13.8889 6.94444V1.38889C13.8889 0.99537 14.0222 0.665278 14.2889 0.398611C14.5546 0.13287 14.8843 0 15.2778 0H23.6111C24.0046 0 24.3343 0.13287 24.6 0.398611C24.8667 0.665278 25 0.99537 25 1.38889V6.94444C25 7.33796 24.8667 7.66759 24.6 7.93333C24.3343 8.2 24.0046 8.33333 23.6111 8.33333H15.2778C14.8843 8.33333 14.5546 8.2 14.2889 7.93333C14.0222 7.66759 13.8889 7.33796 13.8889 6.94444ZM0 12.5V1.38889C0 0.99537 0.133333 0.665278 0.4 0.398611C0.665741 0.13287 0.99537 0 1.38889 0H9.72222C10.1157 0 10.4458 0.13287 10.7125 0.398611C10.9782 0.665278 11.1111 0.99537 11.1111 1.38889V12.5C11.1111 12.8935 10.9782 13.2231 10.7125 13.4889C10.4458 13.7556 10.1157 13.8889 9.72222 13.8889H1.38889C0.99537 13.8889 0.665741 13.7556 0.4 13.4889C0.133333 13.2231 0 12.8935 0 12.5ZM13.8889 23.6111V12.5C13.8889 12.1065 14.0222 11.7764 14.2889 11.5097C14.5546 11.244 14.8843 11.1111 15.2778 11.1111H23.6111C24.0046 11.1111 24.3343 11.244 24.6 11.5097C24.8667 11.7764 25 12.1065 25 12.5V23.6111C25 24.0046 24.8667 24.3343 24.6 24.6C24.3343 24.8667 24.0046 25 23.6111 25H15.2778C14.8843 25 14.5546 24.8667 14.2889 24.6C14.0222 24.3343 13.8889 24.0046 13.8889 23.6111ZM0 23.6111V18.0556C0 17.662 0.133333 17.3319 0.4 17.0653C0.665741 16.7995 0.99537 16.6667 1.38889 16.6667H9.72222C10.1157 16.6667 10.4458 16.7995 10.7125 17.0653C10.9782 17.3319 11.1111 17.662 11.1111 18.0556V23.6111C11.1111 24.0046 10.9782 24.3343 10.7125 24.6C10.4458 24.8667 10.1157 25 9.72222 25H1.38889C0.99537 25 0.665741 24.8667 0.4 24.6C0.133333 24.3343 0 24.0046 0 23.6111Z" fill="white"/>
				</svg>
				</a> -->


				<!-- <svg id="notif" width="20" height="20" viewBox="0 0 30 35" fill="none" xmlns="http://www.w3.org/2000/svg" class="img-fluid">
					<path d="M15 35C17.3652 35 19.2837 33.0415 19.2837 30.625H10.7163C10.7163 33.0415 12.6348 35 15 35ZM29.4234 24.7659C28.1296 23.3468 25.7089 21.2119 25.7089 14.2187C25.7089 8.90723 22.0607 4.65527 17.1415 3.61211V2.1875C17.1415 0.97959 16.1826 0 15 0C13.8174 0 12.8585 0.97959 12.8585 2.1875V3.61211C7.93931 4.65527 4.2911 8.90723 4.2911 14.2187C4.2911 21.2119 1.87035 23.3468 0.576607 24.7659C0.174823 25.2068 -0.00330191 25.7339 4.62982e-05 26.25C0.00741235 27.3711 0.86924 28.4375 2.14959 28.4375H27.8504C29.1308 28.4375 29.9933 27.3711 30 26.25C30.0033 25.7339 29.8252 25.2062 29.4234 24.7659Z" fill="white"/>
				</svg> -->



				<div class="dropdown">
					<li class="dropbtn fs-5  gap-3" id="profname">
						<div id="uname" class="poppins"><?php echo $value->name_first.' '.$value->name_last; ?> <span id = 'upic' style="height = '16px !important'"><?php echo $profimg; ?></span></div>
					</li>
					<div id="myDropdown" class="dropdown-content">
					<?php 
					if(substr($level, -2, 1) == 1) {
						echo "<a href=admchgpw.php?loginid=$loginid>Change Password</a>";
					}
						echo "<a href=admlogout.php?admloginid=$loginid>Logout</a></li>";  
					?>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>

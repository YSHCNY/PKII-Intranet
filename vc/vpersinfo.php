<?php
//
// vpersinfo.php
// fr: vc/index.php
include("../m/qryvpersinfo.php");
?>


<!-- echo "<img src=\"$pathavatar/$picfn11\" height=\"150\">"; -->


<div class="mt-5 pe-5 ps-5 mainbgc">
    <div class="row justify-content-center align-items-center">
        <?php
			if($found11==1) {
        echo '<div class="col-md-12 text-center p-5 ">';
		echo "<img src=\"$pathavatar/$picfn11\" class=\"rounded-circle text-white border border-white mt-5\" alt=\"\" height=\"200\" width=\"200\">";
		// echo "<img src=\"img/hello.jpg\" class=\"rounded-circle text-white border border-white mt-5\" alt=\"No Image Available.\" height=\"200\" width=\"200\">";

        echo '</div>';

		echo '<div class="col-md-12 text-center">';
        echo '<h2 class = "text-white fw-bold mb-0 pb-0">'.strtoupper($name_first11)." ".strtoupper($name_middle11)." ".strtoupper($name_last11).'</h2>';
		echo '<h4 class = "text-white fw-medium mt-0 pt-0 mb-3">' .$department. '</h4>';
		echo '</div>';
		
		?>
		
			<div class="container flex">
				<div class="row mx-auto px-5 py-4">

					<div class="col-auto mx-auto">
					<p class = "text-white fs-5">
						<svg width="16" height="16" class = "mb-1" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="mask0_94_216" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
						<rect width="16" height="16" fill="#D9D9D9"/>
						</mask>
						<g mask="url(#mask0_94_216)">
						<path d="M2.66668 14.6666C2.30001 14.6666 1.98612 14.536 1.72501 14.2749C1.4639 14.0138 1.33334 13.6999 1.33334 13.3333V5.99992C1.33334 5.63325 1.4639 5.31936 1.72501 5.05825C1.98612 4.79714 2.30001 4.66659 2.66668 4.66659H6.00001V2.66659C6.00001 2.29992 6.13057 1.98603 6.39168 1.72492C6.65279 1.46381 6.96668 1.33325 7.33334 1.33325H8.66668C9.03334 1.33325 9.34723 1.46381 9.60834 1.72492C9.86945 1.98603 10 2.29992 10 2.66659V4.66659H13.3333C13.7 4.66659 14.0139 4.79714 14.275 5.05825C14.5361 5.31936 14.6667 5.63325 14.6667 5.99992V13.3333C14.6667 13.6999 14.5361 14.0138 14.275 14.2749C14.0139 14.536 13.7 14.6666 13.3333 14.6666H2.66668ZM2.66668 13.3333H13.3333V5.99992H10C10 6.36658 9.86945 6.68047 9.60834 6.94159C9.34723 7.2027 9.03334 7.33325 8.66668 7.33325H7.33334C6.96668 7.33325 6.65279 7.2027 6.39168 6.94159C6.13057 6.68047 6.00001 6.36658 6.00001 5.99992H2.66668V13.3333ZM4.00001 11.9999H8.00001V11.6999C8.00001 11.511 7.94723 11.336 7.84168 11.1749C7.73612 11.0138 7.5889 10.8888 7.40001 10.7999C7.17779 10.6999 6.95279 10.6249 6.72501 10.5749C6.49723 10.5249 6.25557 10.4999 6.00001 10.4999C5.74445 10.4999 5.50279 10.5249 5.27501 10.5749C5.04723 10.6249 4.82223 10.6999 4.60001 10.7999C4.41112 10.8888 4.2639 11.0138 4.15834 11.1749C4.05279 11.336 4.00001 11.511 4.00001 11.6999V11.9999ZM9.33334 10.9999H12V9.99992H9.33334V10.9999ZM6.00001 9.99992C6.27779 9.99992 6.5139 9.9027 6.70834 9.70825C6.90279 9.51381 7.00001 9.2777 7.00001 8.99992C7.00001 8.72214 6.90279 8.48603 6.70834 8.29158C6.5139 8.09714 6.27779 7.99992 6.00001 7.99992C5.72223 7.99992 5.48612 8.09714 5.29168 8.29158C5.09723 8.48603 5.00001 8.72214 5.00001 8.99992C5.00001 9.2777 5.09723 9.51381 5.29168 9.70825C5.48612 9.9027 5.72223 9.99992 6.00001 9.99992ZM9.33334 8.99992H12V7.99992H9.33334V8.99992ZM7.33334 5.99992H8.66668V2.66659H7.33334V5.99992Z" fill="white"/>
						</g>
						</svg> 

							<?php echo $employeeid0?></p>
					</div>


					<div class="col-auto mx-auto">
					<p class = "text-white fs-5">
					<svg width="16" height="16" viewBox="0 0 16 16" class = "mb-1" fill="none" xmlns="http://www.w3.org/2000/svg">
					<mask id="mask0_94_228" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
					<rect x="0.331177" y="0.0178223" width="16" height="16" fill="#D9D9D9"/>
					</mask>
					<g mask="url(#mask0_94_228)">
					<path d="M3.99783 14.6844V9.68441H2.99783V6.01774C2.99783 5.65107 3.12839 5.33719 3.3895 5.07607C3.65061 4.81496 3.9645 4.68441 4.33117 4.68441H6.33117C6.69783 4.68441 7.01172 4.81496 7.27283 5.07607C7.53394 5.33719 7.6645 5.65107 7.6645 6.01774V9.68441H6.6645V14.6844H3.99783ZM5.33117 4.01774C4.9645 4.01774 4.65061 3.88719 4.3895 3.62607C4.12839 3.36496 3.99783 3.05107 3.99783 2.68441C3.99783 2.31774 4.12839 2.00385 4.3895 1.74274C4.65061 1.48163 4.9645 1.35107 5.33117 1.35107C5.69783 1.35107 6.01172 1.48163 6.27283 1.74274C6.53394 2.00385 6.6645 2.31774 6.6645 2.68441C6.6645 3.05107 6.53394 3.36496 6.27283 3.62607C6.01172 3.88719 5.69783 4.01774 5.33117 4.01774ZM10.3312 14.6844V10.6844H8.33117L10.0312 5.58441C10.1201 5.29552 10.2839 5.0733 10.5228 4.91774C10.7617 4.76219 11.0312 4.68441 11.3312 4.68441C11.6312 4.68441 11.9006 4.76219 12.1395 4.91774C12.3784 5.0733 12.5423 5.29552 12.6312 5.58441L14.3312 10.6844H12.3312V14.6844H10.3312ZM11.3312 4.01774C10.9645 4.01774 10.6506 3.88719 10.3895 3.62607C10.1284 3.36496 9.99783 3.05107 9.99783 2.68441C9.99783 2.31774 10.1284 2.00385 10.3895 1.74274C10.6506 1.48163 10.9645 1.35107 11.3312 1.35107C11.6978 1.35107 12.0117 1.48163 12.2728 1.74274C12.5339 2.00385 12.6645 2.31774 12.6645 2.68441C12.6645 3.05107 12.5339 3.36496 12.2728 3.62607C12.0117 3.88719 11.6978 4.01774 11.3312 4.01774Z" fill="white"/>
					</g>
					</svg>
	
					<?php echo $contact_gender11?></p>
					</div>

					<div class="col-auto mx-auto">
					<p class = "text-white fs-5">
					<svg width="16" height="16" viewBox="0 0 16 16" class = "mb-1" fill="none" xmlns="http://www.w3.org/2000/svg">
					<mask id="mask0_11_1076" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
					<rect width="16" height="16" fill="#D9D9D9"/>
					</mask>
					<g mask="url(#mask0_11_1076)">
					<path d="M8 14.6666C6.82222 14.6666 5.86111 14.4805 5.11667 14.1083C4.37222 13.736 4 13.2555 4 12.6666C4 12.2777 4.16111 11.9388 4.48333 11.6499C4.80556 11.361 5.25 11.1333 5.81667 10.9666L6.2 12.2333C6.01111 12.2888 5.83889 12.3583 5.68333 12.4416C5.52778 12.5249 5.42222 12.5999 5.36667 12.6666C5.51111 12.8444 5.84444 12.9999 6.36667 13.1333C6.88889 13.2666 7.43333 13.3333 8 13.3333C8.56667 13.3333 9.11389 13.2666 9.64167 13.1333C10.1694 12.9999 10.5056 12.8444 10.65 12.6666C10.5944 12.5999 10.4889 12.5249 10.3333 12.4416C10.1778 12.3583 10.0056 12.2888 9.81667 12.2333L10.2 10.9666C10.7667 11.1333 11.2083 11.361 11.525 11.6499C11.8417 11.9388 12 12.2777 12 12.6666C12 13.2555 11.6278 13.736 10.8833 14.1083C10.1389 14.4805 9.17778 14.6666 8 14.6666ZM8 10.2166C8.2 9.84992 8.41111 9.51381 8.63333 9.20825C8.85556 8.9027 9.07222 8.61103 9.28333 8.33325C9.69444 7.79992 10.0222 7.31936 10.2667 6.89159C10.5111 6.46381 10.6333 5.93325 10.6333 5.29992C10.6333 4.56659 10.3778 3.94436 9.86667 3.43325C9.35556 2.92214 8.73333 2.66659 8 2.66659C7.26667 2.66659 6.64444 2.92214 6.13333 3.43325C5.62222 3.94436 5.36667 4.56659 5.36667 5.29992C5.36667 5.93325 5.48889 6.46381 5.73333 6.89159C5.97778 7.31936 6.30556 7.79992 6.71667 8.33325C6.92778 8.61103 7.14444 8.9027 7.36667 9.20825C7.58889 9.51381 7.8 9.84992 8 10.2166ZM8 12.6666C7.87778 12.6666 7.76667 12.6305 7.66667 12.5583C7.56667 12.486 7.49444 12.3888 7.45 12.2666C7.19444 11.4777 6.87222 10.8166 6.48333 10.2833C6.09444 9.74992 5.71667 9.23881 5.35 8.74992C4.99444 8.26103 4.68611 7.75547 4.425 7.23325C4.16389 6.71103 4.03333 6.06659 4.03333 5.29992C4.03333 4.18881 4.41667 3.24992 5.18333 2.48325C5.95 1.71659 6.88889 1.33325 8 1.33325C9.11111 1.33325 10.05 1.71659 10.8167 2.48325C11.5833 3.24992 11.9667 4.18881 11.9667 5.29992C11.9667 6.06659 11.8389 6.71103 11.5833 7.23325C11.3278 7.75547 11.0167 8.26103 10.65 8.74992C10.2944 9.23881 9.91945 9.74992 9.525 10.2833C9.13056 10.8166 8.80556 11.4777 8.55 12.2666C8.50556 12.3888 8.43333 12.486 8.33333 12.5583C8.23333 12.6305 8.12222 12.6666 8 12.6666ZM8 6.71658C8.38889 6.71658 8.72222 6.5777 9 6.29992C9.27778 6.02214 9.41667 5.68881 9.41667 5.29992C9.41667 4.91103 9.27778 4.5777 9 4.29992C8.72222 4.02214 8.38889 3.88325 8 3.88325C7.61111 3.88325 7.27778 4.02214 7 4.29992C6.72222 4.5777 6.58333 4.91103 6.58333 5.29992C6.58333 5.68881 6.72222 6.02214 7 6.29992C7.27778 6.5777 7.61111 6.71658 8 6.71658Z" fill="white"/>
					</g>
					</svg>
	
					<?php echo $contact_address111 , $contact_address211 , $contact_city11 , $contact_province11 , $contact_zipcode11 , $contact_country11?></p>
					</div>

					<div class="col-auto mx-auto">
					<p class = "text-white fs-5">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<mask id="mask0_11_1081" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
					<rect width="16" height="16" fill="#D9D9D9"/>
					</mask>
					<g mask="url(#mask0_11_1081)">
					<path d="M7.99998 14.6666C7.07776 14.6666 6.21109 14.4916 5.39998 14.1416C4.58887 13.7916 3.88331 13.3166 3.28331 12.7166C2.68331 12.1166 2.20831 11.411 1.85831 10.5999C1.50831 9.78881 1.33331 8.92214 1.33331 7.99992C1.33331 7.0777 1.50831 6.21103 1.85831 5.39992C2.20831 4.58881 2.68331 3.88325 3.28331 3.28325C3.88331 2.68325 4.58887 2.20825 5.39998 1.85825C6.21109 1.50825 7.07776 1.33325 7.99998 1.33325C8.9222 1.33325 9.78887 1.50825 10.6 1.85825C11.4111 2.20825 12.1166 2.68325 12.7166 3.28325C13.3166 3.88325 13.7916 4.58881 14.1416 5.39992C14.4916 6.21103 14.6666 7.0777 14.6666 7.99992V8.96658C14.6666 9.62214 14.4416 10.1805 13.9916 10.6416C13.5416 11.1027 12.9889 11.3333 12.3333 11.3333C11.9444 11.3333 11.5778 11.2499 11.2333 11.0833C10.8889 10.9166 10.6 10.6777 10.3666 10.3666C10.0444 10.6888 9.68054 10.9305 9.27498 11.0916C8.86942 11.2527 8.44442 11.3333 7.99998 11.3333C7.07776 11.3333 6.29165 11.0083 5.64165 10.3583C4.99165 9.70825 4.66665 8.92214 4.66665 7.99992C4.66665 7.0777 4.99165 6.29158 5.64165 5.64158C6.29165 4.99159 7.07776 4.66658 7.99998 4.66658C8.9222 4.66658 9.70831 4.99159 10.3583 5.64158C11.0083 6.29158 11.3333 7.0777 11.3333 7.99992V8.96658C11.3333 9.25547 11.4278 9.49992 11.6166 9.69992C11.8055 9.89992 12.0444 9.99992 12.3333 9.99992C12.6222 9.99992 12.8611 9.89992 13.05 9.69992C13.2389 9.49992 13.3333 9.25547 13.3333 8.96658V7.99992C13.3333 6.51103 12.8166 5.24992 11.7833 4.21659C10.75 3.18325 9.48887 2.66659 7.99998 2.66659C6.51109 2.66659 5.24998 3.18325 4.21665 4.21659C3.18331 5.24992 2.66665 6.51103 2.66665 7.99992C2.66665 9.48881 3.18331 10.7499 4.21665 11.7833C5.24998 12.8166 6.51109 13.3333 7.99998 13.3333H11.3333V14.6666H7.99998ZM7.99998 9.99992C8.55553 9.99992 9.02776 9.80547 9.41665 9.41658C9.80553 9.0277 9.99998 8.55547 9.99998 7.99992C9.99998 7.44436 9.80553 6.97214 9.41665 6.58325C9.02776 6.19436 8.55553 5.99992 7.99998 5.99992C7.44442 5.99992 6.9722 6.19436 6.58331 6.58325C6.19442 6.97214 5.99998 7.44436 5.99998 7.99992C5.99998 8.55547 6.19442 9.0277 6.58331 9.41658C6.9722 9.80547 7.44442 9.99992 7.99998 9.99992Z" fill="white"/>
					</g>
					</svg>
	
					<?php echo $email111?></p>
					</div>

					<div class="col-auto mx-auto">
					<p class = "text-white fs-5">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<mask id="mask0_11_1086" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
					<rect width="16" height="16" fill="#D9D9D9"/>
					</mask>
					<g mask="url(#mask0_11_1086)">
					<path d="M13.3 14C11.9111 14 10.5389 13.6972 9.18333 13.0917C7.82778 12.4861 6.59444 11.6278 5.48333 10.5167C4.37222 9.40556 3.51389 8.17222 2.90833 6.81667C2.30278 5.46111 2 4.08889 2 2.7C2 2.5 2.06667 2.33333 2.2 2.2C2.33333 2.06667 2.5 2 2.7 2H5.4C5.55556 2 5.69444 2.05278 5.81667 2.15833C5.93889 2.26389 6.01111 2.38889 6.03333 2.53333L6.46667 4.86667C6.48889 5.04444 6.48333 5.19444 6.45 5.31667C6.41667 5.43889 6.35556 5.54444 6.26667 5.63333L4.65 7.26667C4.87222 7.67778 5.13611 8.075 5.44167 8.45833C5.74722 8.84167 6.08333 9.21111 6.45 9.56667C6.79444 9.91111 7.15556 10.2306 7.53333 10.525C7.91111 10.8194 8.31111 11.0889 8.73333 11.3333L10.3 9.76667C10.4 9.66667 10.5306 9.59167 10.6917 9.54167C10.8528 9.49167 11.0111 9.47778 11.1667 9.5L13.4667 9.96667C13.6222 10.0111 13.75 10.0917 13.85 10.2083C13.95 10.325 14 10.4556 14 10.6V13.3C14 13.5 13.9333 13.6667 13.8 13.8C13.6667 13.9333 13.5 14 13.3 14ZM4.01667 6L5.11667 4.9L4.83333 3.33333H3.35C3.40556 3.78889 3.48333 4.23889 3.58333 4.68333C3.68333 5.12778 3.82778 5.56667 4.01667 6ZM9.98333 11.9667C10.4167 12.1556 10.8583 12.3056 11.3083 12.4167C11.7583 12.5278 12.2111 12.6 12.6667 12.6333V11.1667L11.1 10.85L9.98333 11.9667Z" fill="white"/>
					</g>
					</svg>
	
					<?php echo $num_mobile311, $num_mobile111 ?></p>
					</div>
				
					
					
					
			
				</div>
			</div>

	</div>
</div> 
<!-- end of header -->

<div class="container w-100 mb-5 py-5">
	<div class="header-title">
		<h2 class="fs-1  text-uppercase fw-bold text-center">More <span class = "submaintext2">Details</span></h2>
		
	</div>
    <div class="row flex-wrap   g-4">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card bg-white border-1 rounded-3 mb-4 h-100">
                <div class="card-header bg-white border-0">
                    <h4 class="text-center text-uppercase px-4 mt-5 fs-1 maintext">Employee</h4>
                </div>
                <div class="card-body px-4 pb-4 mx-auto">
				
					<div class = 'text-center py-3'>
					<p class="maintext mx-4 mb-0"><?php echo $date_hired11?></p>
                    <p class="fs-5 text-secondary">Date Hired</p>
					</div>

					<div class = 'text-center py-3'>
					<p class="maintext mx-4 mb-0"><?php echo $emp_birthdate11?></p>
                    <p class="fs-5 text-secondary">Birth Date</p>
					</div>

					<div class = 'text-center py-3'>
					<p class="maintext mx-4 mb-0"><?php echo $emp_birthplace11 ?></p>
                    <p class="fs-5 text-secondary">Birth Place</p>
					</div>

					<div class = 'text-center py-3'>
					<p class="maintext mx-4 mb-0"><?php echo $emp_civilstatus11 ?></p>
                    <p class="fs-5 text-secondary">Civil Status</p>
					</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card bg-white border-1 rounded-3 mb-4 h-100" >
                <div class="card-header bg-white border-0">
                    <h4 class="text-center  text-uppercase px-4 mt-5 fs-1 text-dark">Other</h4>
                </div>
                <div class="card-body px-4 pb-4 mx-auto">
					<div class = 'text-center py-3'>
                   
					<p class="text-dark mx-4 mb-0"><?php echo $url11 ?></p>
					<p class="fs-5 text-secondary ">Website</p>
					</div>

					<div class = 'text-center py-3'>
                   
					<p class="text-dark mx-4 mb-0"><?php echo $emp_skills11?></p>
										<p class="fs-5 text-secondary ">Skills</p>
					</div>

					<div class = 'text-center py-3'>
					<p class="text-dark mx-4 mb-0"><?php echo $emp_status11?></p>
					                    <p class="fs-5 text-secondary ">Status</p>
					</div>

					<div class = 'text-center py-3'>
					<p class="text-dark mx-4 mb-0"><?php echo $emp_remarks11 ?></p>
					                    <p class="fs-5 text-secondary ">Remarks</p>
					</div>
                </div>
            </div>
        </div>
    <!-- </div>
    <div class="row"> -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card bg-white border-1 rounded-3 mb-4 h-100">
                <div class="card-header bg-white border-0">
                    <h4 class="text-center  text-uppercase px-4 mt-5 fs-1 text-dark">Tax</h4>
                </div>
                <div class="card-body px-4 pb-4 mx-auto">

					<div class = 'text-center py-3'>             
					<p class="text-dark mx-4 mb-0"><?php echo $emp_tin11?></p>
					<p class="fs-5 text-secondary ">BIR TIN</p>
					</div>

					<div class = 'text-center py-3'>
					<p  class="text-dark mx-4 mb-0"><?php echo $emp_sss11?></p>
					<p class="fs-5 text-secondary ">SSS</p>
					</div>


					<div class = 'text-center py-3'>
					<p  class="text-dark mx-4 mb-0"><?php echo $emp_philhealth11?></p>
					<p class="fs-5 text-secondary ">Philhealth</p>
					</div>

					<div class = 'text-center py-3'>
					<p  class="text-dark mx-4 mb-0"><?php echo $emp_pagibig11 ?></p>	
					<p class="fs-5 text-secondary ">PAGIBIG</p>
					</div>

                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card bg-white border-1  rounded-3 mb-4 h-100">
                <div class="card-header bg-white border-0">
                    <h4 class="text-center  text-uppercase px-4 mt-5 fs-1 text-dark">Position</h4>
                </div>
                <div class="card-body px-4 pb-4 mx-auto">
					<div class = 'text-center py-3'>
					<p class="text-dark mx-4 mb-0"><?php echo $position ?></p>
                    <p class="fs-5 text-secondary ">Position</p>
					</div>

					<div class = 'text-center py-3'>
					<p class="text-dark mx-4 mb-0"><?php echo $department?></p>
                    <p class="fs-5 text-secondary">Department</p>
					</div>

					<div class = 'text-center py-3'>
					<p class="text-dark mx-4 mb-0"><?php echo $positionlevel?></p>
                    <p class="fs-5 text-secondary">Position Level</p>
					</div>

					<div class = 'text-center py-3'>
					<p class="text-dark mx-4 mb-0"><?php echo $salarygrade ?></p>
                    <p class="fs-5 text-secondary">Salary Grade</p>
					</div>


                </div>
            </div>
        </div>
    </div>
</div>

	<!-- end of details card -->

	

        <div class="text-center">
            <h1 class="fs-1 text-uppercase fw-bold text-center">My <span class = 'submaintext2'>Projects</span></h1>
        </div>

 

<style>
	.anyClass {
  height: 600px;
  overflow-y: scroll;
 
}

.anyClass::-webkit-scrollbar{
	background-color: white;
	width: 5px;
}
.anyClass::-webkit-scrollbar-thumb{
	background-color: lightgray;

	border-radius: 1rem;


}



</style>

	<!-- start of project assignment -->
<div class="container">
<div class="row bg-white  p-5">	
<div class="col-md-6 my-4 anyClass  p-5 " >	
	<h5  class = " m-2 text-muted fs-4">Project <span class = "maintext">Assignments</span></h4>

	<?php

											$param11 = count($ref_noArr);
											if($param11 == 0){
												echo '<h5 class = "text-secondary text-center p-5">You have no projects </h5>';
											}
											else{
											for ($x11 = 0; $x11 < $param11; $x11++) {
												echo "<div class='card my-5 py-3'>";
												echo "<div class='card-body p-3'>";
												echo "<div class = 'border-bottom'>";
											
												echo "<p class='card-text text-muted fs-6 pb-3 my-4 text-center' >Project Name <br><span class = 'fs-3 px-2  maintext fw-bold'>" . $proj_nameArr[$x11] . " " . $projname5aArr[$x11] . "</span></p>";
												echo "</div>";
												
												echo"<div class = 'row gap-2 gap-md-0 text-center pt-3'>";

												echo"<div class = 'col-md-6 col-sm-12 col-lg-3 my-2 '>";
												echo "<p class = 'text-muted fs-6 mb-1 pb-1'>Reference</p>";
												echo "<p class='card-text'><span class = 'mainboxbg text-white fst-italic fs-5 px-3 py-1 rounded-2'>" . $ref_noArr[$x11] . "</span></p>";
												echo"</div>";

												echo"<div class = 'col-md-6 col-sm-12 col-lg-3 my-2  '>";
												echo "<p class = 'text-muted fs-6 mb-1 pb-1'>Code</p>";
												echo "<p class='card-text '><span class = 'mainboxbg text-white fst-italic fs-5 px-3 py-1 rounded-2'>" . $proj_codeArr[$x11] . " " . $projcode5aArr[$x11] . "</span></p>";
												echo"</div>";

												
												echo"<div class = 'col-md-6 col-sm-12 col-lg-3 my-2 '>";
												if ($idhrpositionctgArr != 0) {
												if ($found8 == 1) {
													echo "<p class = 'text-muted fs-6 mb-0 pb-0'>Code</p>";
													echo "<p class='card-text'><span class = 'secondarybgc text-white fs-5 px-3 py-1 rounded-2'>" . $name8Arr[$x11] . "</span></p>";
													echo"</div>";

													echo"<div class = 'col-md-6 col-sm-12 col-lg-3 my-2 '>";
												}
												} else {
												echo "<p class = 'text-muted fs-6 mb-0 pb-0'>Position: </p>";
												echo "<p class='card-text'><span class = 'secondarybgc text-white fs-5 px-3 py-1 rounded-2'>" . $positionArr[$x11] . "</span></p>";
												echo"</div>";

												echo"<div class = 'col-md-6 col-sm-12 col-lg-3 my-2 ' >";
												}
												echo "<p class = 'text-muted fs-6 mb-0 pb-0'>Started</p>";
												echo "<p class='card-text'><span class = ' text-dark fst-italic fs-5 py-1 rounded-2'>" . $date_fromArr[$x11] . "</span></p>";
												echo"</div>";

												echo"<div class = 'col-md-6 col-sm-12 col-lg-3 my-2 '>";
												echo "<p class = 'text-muted fs-6 mb-0 pb-0'>Ended:</p>";
												echo "<p class='card-text'><span class = ' text-dark fst-italic fs-5 py-1 rounded-2'>" . $date_toArr[$x11] . "</span></p>";
												echo"</div>";


												echo"</div>";



												echo "</div>";
												echo "</div>";
											}
										}
											?>
			</div>
		
			
	<!-- end of project assignment -->
	
	
	<div class="col-md-6 my-4 anyClass  p-5">
	<h5  class = " m-2 text-muted fs-4">Temporary Project <span class = "maintext">Assignments</span></h4>
		
								<div class="card py-5  my-5 ">
									<div class="card-body px-4">
										<div class = 'border p-4 text-center'>

										<div class="row ">
											<div class="col-md-6">
												<p class="card-text fs-6 text-muted mb-1 pb-1">Project Name</p>
												<p class="card-text maintext fw-bold fs-4"><?php echo $proj_name1;?></p>
											</div>

											<div class="col-md-6">
											<p class="card-text fs-6 text-muted mb-0 pb-0">Code</p>
											<p class="card-text submaintext fs-4 py-1 rounded-2"><?php echo $proj_code1;?></p>
											</div>
										</div>
									
										</div>
									

											
										<div class="row gap-3 gap-md-0 text-center pt-3">
											<div class="col-md-6 col-sm-12 col-lg-3 my-2">
											<p class="card-text fs-6 text-muted mb-0 pb-0">Reference No</p>
											<p scope="row" class="card-text text-dark fst-italic fs-5 py-1 rounded-2" ><?php echo $ref_no1; ?></p>
											</div>

											


											<div class="col-md-6 col-sm-12 col-lg-3 my-2">
											<p class="card-text fs-6 text-muted mb-0 pb-0">Position</p>
											<p class="card-text text-dark fst-italic fs-5 py-1 rounded-2"><?php echo $position1;?></p>
											</div>

											<div class="col-md-6 col-sm-12 col-lg-3 my-2">
											<p class="card-text fs-6 text-muted mb-0 pb-0">Start</p>
											<p class="card-text text-dark fst-italic fs-5 py-1 rounded-2"><?php echo $durationfrom1;?></p>
											</div>

											<div class="col-md-6 col-sm-12 col-lg-3 my-2">
											<p class="card-text fs-6 text-muted mb-0 pb-0">End</p>
											<p class="card-text text-dark fst-italic fs-5 py-1 rounded-2"><?php echo $durationto1;?></p>
											</div>
										
										
										</div>
										


								
										
									
										
									
									</div>
									</div>

<!-- end of temp ass -->


	</div>
</div>
	
</div>							







           
      
	<table >
    </table>


	<h1 class="fs-1 text-uppercase fw-bold text-center">Employee <span class = 'submaintext2'>background</span></h1>

	
										
	<div class="table-responsive-sm my-5 flex">
	<table class=" w-75 table-white table-borderless mx-auto p-5 shadow table-hover caption-top">
		
	<caption class = " m-2 fs-4">Insurance <span class = "maintext">Details</span></caption>
        <thead class = 'border-bottom'>
            <tr class = 'fs-5'>
                <th scope="col" class="p-4 submaintext text-center">Insurance Name</th>
                <th scope="col" class="p-4 submaintext text-center">Group Policy No.</th>
                <th scope="col" class="p-4 submaintext text-center">Employee Policy No.</th>
                <th scope="col" class="p-4 submaintext text-center">Date Started</th>
                <th scope="col" class="p-4 submaintext text-center">Current Status</th>
				<th scope="col" class="p-4 submaintext text-center">Location</th>
				
            </tr>
        </thead>
        <tbody>
			
				
				<tr class = "text-center">
					<td class = "p-4"><?php echo $insurancename; ?></td>
					<td class = "p-4"><?php echo $policynum; ?></td>
					<td class = "p-4"><?php echo $emppolicynum; ?></td>
					<td class = "p-4"><?php echo $durationfrom2; ?></td>
					<td class = "p-4"><?php echo $durationto2; ?></td>
					<td class = "p-4"><?php echo $location2; ?></td>
				</tr>

        </tbody>
    </table>
	
	</div>

	


	
	<br>
<!-- end of insurance details -->

	
	<div class="table-responsive-sm my-5 flex">
	<table class="  w-75 table-white table-borderless mx-auto p-5 shadow table-hover caption-top">	
	<caption class = " m-2 fs-4">Professional License <span class = "text-dark">Details</span></caption>
        <thead class = 'border-bottom' >
            <tr class = ' fs-5'>
                <th scope="col" class="p-4 submaintext text-center">Regulatory Board</th>
                <th scope="col" class="p-4 submaintext text-center">Profession</th>
                <th scope="col" class="p-4 submaintext text-center">License Number</th>
                <th scope="col" class="p-4 submaintext text-center">Date from</th>
				<th scope="col" class="p-4 submaintext text-center">Date to</th>
				<th scope="col" class="p-4 submaintext text-center">Location</th>
		
            </tr>
        </thead>
        <tbody>	
		<tr class = "text-center">
			<td align="center" class = "p-4"><?php echo $insurancename; ?></td>
			<td align="center" class = "p-4"><?php echo $policynum; ?></td>
			<td align="center" class = "p-4"><?php echo $emppolicynum; ?></td>
			<td align="center" class = "p-4"><?php echo $durationfrom2; ?></td>
			<td align="center" class = "p-4"><?php echo "$durationto2"; ?></td>
			<td align="center" class = "p-4"><?php echo $location2; ?></td>
		</tr>

        </tbody>
    </table>
	</div>





	<!-- end of professional license details -->
	<br>

	<div class="table-responsive-sm my-5 flex">
	<table class="  w-75 table-sm table-white table-borderless mx-auto p-5 shadow table-hover caption-top">	
	<caption class = " m-2 fs-4">Educational <span class = "text-dark">Background</span></caption>
        <thead class = 'border-bottom'>
            <tr class = ' fs-5'>
				<th scope="col" class="p-4 submaintext text-center">Course</th>
                <th scope="col" class="p-4 submaintext text-center">Year Graduated</th>
                <th scope="col" class="p-4 submaintext text-center">University</th>
                <th scope="col" class="p-4 submaintext text-center">Date</th>
		
            </tr>
        </thead>
        <tbody>	
		<tr class = "text-center">
		
				<td class = "p-4"><?php echo $coursegraduated; ?></td>
				<td class = "p-4"><?php echo $yeargraduated; ?></td>
				<td class = "p-4"><?php echo $schoolgraduated; ?></td>
				<td class = "p-4"><?php echo $schooladdress; ?></td>


		</tr>

        </tbody>
    </table>
	</div>


	<!-- end of educationl background -->

	
	<br>
	
	<div class="table-responsive-sm my-5 flex">
	<table class="  w-75 table-sm table-white table-borderless mx-auto p-5 shadow table-hover caption-top">	

	<caption class = " m-2 fs-4">Bank Account <span class = "text-dark">Details</span></caption>
        <thead class = 'border-bottom'>
            <tr class = ' fs-5'>
             

				<th scope="col" class="p-4 submaintext text-center">Bank Name</th>
                <th scope="col" class="p-4 submaintext text-center">Branch</th>
                <th scope="col" class="p-4 submaintext text-center">Account No.</th>
                <th scope="col" class="p-4 submaintext text-center">Type</th>
				<th scope="col" class="p-4 submaintext text-center">Currency</th>
				<th scope="col" class="p-4 submaintext text-center">Account Name</th>
		
		
            </tr>
        </thead>
        <tbody>	
		<tr class = "text-center">
		
				<?php
				echo "<td class = 'p-4 '>$bank_name</td>";
				echo "<td class = 'p-4 '>$bank_branch</td>";
				echo "<td class = 'p-4 '>$acct_num</td>";
				echo "<td class = 'p-4 '>$acct_type</td>";
				echo "<td class = 'p-4 '>$acct_currency</td>";
				echo "<td class = 'p-4 '>$acct_name</td>";
				?>
		</tr>

        </tbody>
    </table>
	</div>




		<!-- end of Bank details -->
		
		<br>
	
	<div class="table-responsive-sm my-5 flex">
	<table class="  w-75 table-sm table-white table-borderless mx-auto p-5 shadow table-hover caption-top">	

	<caption class = " m-2 fs-4">Emergency Contact <span class = "text-dark">Information</span></caption>
        <thead class = 'border-bottom'>
            <tr class = 'fs-5' >
             

				<th scope="col" class="p-4 submaintext text-center">Name</th>
                <th scope="col" class="p-4 submaintext text-center">Relation</th>
                <th scope="col" class="p-4 submaintext text-center">Line</th>
                <th scope="col" class="p-4 submaintext text-center">Mobile</th>
				<th scope="col" class="p-4 submaintext text-center">Email</th>
				
		
		
            </tr>
        </thead>
        <tbody>	
		<tr class = "text-center">
		
				<?php
			echo "<td class = 'p-4'>$em_name_first $em_name_middle[0] $em_name_last</td>";
			echo "<td class = 'p-4'>$em_emergrelation</td>";
			echo "<td class = 'p-4'>$em_num_res1_cc $em_num_res1_ac $em_num_res1</td>";
			echo "<td class = 'p-4'>$em_num_mobile1_cc $em_num_mobile1_ac $em_num_mobile1</td>";
			echo "<td class = 'p-4'>$em_email1</td>";

				?>
		</tr>

        </tbody>
    </table>
	</div>




		<!-- end of emergency contact-->
		
		<br>
	
	<div class="table-responsive-sm my-5 flex">
	<table class="  w-75 table-sm table-white table-borderless mx-auto p-5 shadow table-hover caption-top">	

	<caption class = " m-2 fs-4">List of <span class = "text-dark">Dependents</span></caption>
        <thead class = "border-bottom" >
            <tr class = 'fs-5' >
             

				<th scope="col" class="p-4 submaintext text-center">Name</th>
                <th scope="col" class="p-4 submaintext text-center">Birthdate</th>
                <th scope="col" class="p-4 submaintext text-center">Relation</th>
       
				
		
		
            </tr>
        </thead>
        <tbody>	
		<tr class = "text-center">
		
				<?php
			echo "<td class = 'p-4'>$dependentfirst $dependentmiddle[0] $dependentlast</td>";
			echo "<td class = 'p-4'>$dependentbirthdate</td>";
			echo "<td class = 'p-4'>$dependentrelation</td>";

				?>
		</tr>

        </tbody>
    </table>
	</div>





<?php
}
?>


<?php
	// query tblemployee, tblcontact

	// if($found11==1) {
	// // display results
	// echo "<tr><td align=\"right\">Employee no.</td><th>$employeeid0</th></tr>";
	// if($picfn11!='') {
	// echo "<tr><td colspan=\"2\" align=\"center\"><img src=\"$pathavatar/$picfn11\" height=\"150\"></td></tr>";
	// } // if
	// echo "<tr><td align=\"right\">
	// Full name</td><th>".strtoupper($name_last11).", ".strtoupper($name_first11)." ".strtoupper($name_middle11)."</th></tr>";
	// echo "<tr><td align=\"right\">Gender</td><th>$contact_gender11</th></tr>";
	// echo "<tr><td align=\"right\">Address</td><th>";
	// 	if($contact_address111!='') {
	// 	echo "$contact_address111";
	// 		if($contact_address211!='') {
	// 		echo ",&nbsp;$contact_address211";
	// 		} // if
	// 		if($contact_city11!='') {
	// 		echo ",&nbsp;";
	// 		}// if
	// 	} // if
	// 	if($contact_city11!='') {
	// 	echo "$contact_city11";
	// 	} // if
	// 	if($contact_province11!='') {
	// 		if($contact_city11!='') {
	// 		echo ",&nbsp;";
	// 		} // if
	// 		echo "$contact_province11";
	// 	} // if
	// 	if($contact_zipcode11!='') {
	// 		echo "&nbsp;$contact_zipcode11&nbsp;";
	// 	} // if
	// 	if($contact_country11!='') {
	// 		if($contact_zipcode11!='') {
	// 		echo "$contact_country11";
	// 		} else {
	// 		echo ",&nbsp;$contact_country11";
	// 		} // if
	// 	} // if
	// 	echo "<tr><td align=\"right\">Email Address</td><th>$email111</th></tr>";
	// 	echo "<tr><td align=\"right\">Email Address</td><th>$email211</th></tr>";
	// 	echo "<tr><td align=\"right\">Landline</td><th>$num_mobile311</th></tr>";
	// 	echo "<tr><td align=\"right\">Mobile Number</td><th>$num_mobile111</th></tr>";
	// 	echo "<tr><td align=\"right\">Website</td><th>$url11</th></tr>";
	// 	echo "<tr><td align=\"right\">Remarks</td><th>$remarks_contact11</th></tr>";
	// 	echo "<tr valign=top><td colspan=2 bgcolor=lightgray>Employee Details</td></tr>";
	
	// 	echo "<tr><td align=\"right\">Date Hired</td><th>$date_hired11</th></tr>";
	// 	echo "<tr><td align=\"right\">Birthdate</td><th>$emp_birthdate11</th></tr>";
	// 	echo "<tr><td align=\"right\">Birthplace</td><th>$emp_birthplace11</th></tr>";
	// 	echo "<tr><td align=\"right\">Civil Status</td><th>$emp_civilstatus11</th></tr>";
	// 	echo "<tr><td align=\"right\">BIR TIN</td><th>$emp_tin11</th></tr>";
	// 	echo "<tr><td align=\"right\">SSS</td><th>$emp_sss11</th></tr>";
	// 	echo "<tr><td align=\"right\">Philhealth</td><th>$emp_philhealth11</th></tr>";
	// 	echo "<tr><td align=\"right\">Pag-IBIG</td><th>$emp_pagibig11</th></tr>";
	// 	if($emp_pagibig211!='') {
	// 		echo "<tr><td>Pag-IBIG 2</td><th>$emp_pagibig211</th></tr>";
	// 		}
		
	// 	echo "<tr><td align=\"right\">Skills</td><th>$emp_skills11</th></tr>";
	// 	echo "<tr><td align=\"right\">Employee Status</td><th>$emp_status11</th></tr>";
	// 	echo "<tr><td align=\"right\">Remarks</td><th>$emp_remarks11</th></tr>";
		
		
	// //Start of Employment Details
	
	// 	echo "<tr><td align=\"right\">Type</td><th>$employee_type11</th></tr>";
	// 	echo "<tr><td align=\"right\">Position</td><th>$position</th></tr>";
	// 	echo "<tr><td align=\"right\">Department</td><th>$department</th></tr>";
	// 	echo "<tr><td align=\"right\">Position Level</td><th>$positionlevel</th></tr>";
	// 	echo "<tr><td align=\"right\">Salary Grade</td><th>$salarygrade</th></tr>";
	 // if
	
	//Start of Project Assignments
		
		// echo "<tr valign=top><td colspan=2 bgcolor=lightgray>Project Assignment(s)</td></tr>";
	
		
		// echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
	    // echo "<tr><td align=center><font size=1>Reference #</font></td><td align=center><font size=1>Proj_Code&nbsp; : Project Name</font></td><td align=center><font size=1>Position</font></td>";
		// echo "<td align=center><font size=1>Duration</font></td>";
		// $param11=count($ref_noArr);
		// for($x11 = 0; $x11 < $param11; $x11++) {
		// $found2=1;
		// $ctr11=$ctr11+1;
		// echo "<tr><td><font size=1>".$ref_noArr[$x11]."<font size=1></td>";
		// echo "<td><font size=1>".$proj_codeArr[$x11]."&nbsp;-&nbsp;".$proj_nameArr[$x11]."</td>";
		// //echo "<td><font size=1>".$date_fromArr[$x11]."&nbsp; - &nbsp;".$date_toArr[$x11]."<font size=1></td>";
		
		// /*if($proj_codeArr[$x11]=='Select Pro') {
		// echo "";
		// } else {
		// echo "<td><strong>".$proj_codeArr[$x11]."&nbsp; - &nbsp;</td>";
		// } // if
		// if($proj_sname3 != '') {
		// 	echo "$proj_sname3";
		// } else if($proj_fname3 != '') {
		// 	$projfnamefin=strpos("$proj_fname3", 20, 0);
		// 	echo "$projfnamefin";
		// } else if($projname5aArr != '') {
		// 	echo "<td>".$projname5aArr[$x11]."</td>";
		// }*/
		// echo "<br>";
		
	// echo "<td><strong>".$projcode5aArr[$x11]."&nbsp; - &nbsp;".$projname5aArr[$x11]."</td>";
	// //echo "<td align=\"center\"><font size=1>$projcode5a - $projname5a</td>";
	// if($idhrpositionctgArr!=0) {
		
	// 	if($found8==1) { echo "<td align=\"center\"><font size=1>".$name8Arr[$x11]."</td>"; }
	// } else {
	// 	echo "<td>".$positionArr[$x11]."</td>";
	// } // if($idhrpositionctg!=0)

	// echo "<td><font size=1>".$date_fromArr[$x11]."&nbsp; - &nbsp;".$date_toArr[$x11]."</td>";
		// while($myrow2=$result2->fetch_assoc())
	// if($result2->num_rows>0)

		// }
	
	
	// start tmp.project assignments
		
		// }	
		
		
	//start of Insurance details
	

	//start of professional license details
		// echo "<tr><td colspan=2>";
		// echo "<tr valign=top><td colspan=10 bgcolor=lightgray>Professional License Details</td></tr>";
		// echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
		// echo "<tr><td align =center><font size=1>Regulatory Board</td><td align=center><font size=1>Profession</td><td align=center><font size=1>License Number</td><td align=center><font size=1>Date</td></tr>";
		
		// echo"<tr><td align=center><font size=1>$regulatoryboard</font></td><td align=center><font size=1>$profession</font></td><td align=center><font size=1>$licensenumber</font></td><td align=center><font size=1>$licensedate</font></td></tr>";
	//start of Educational Background
		// echo "<tr><td colspan=2>";
		// echo "<tr valign=top><td colspan=5 bgcolor=lightgray>Educational Background</td></tr>";
		// echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
		// echo "<tr><td align =center><font size=1>Course</td><td align=center><font size=1>Year Graduated</td><td align=center><font size=1>School / University</td><td align=center><font size=1>Date</td></tr>";
		
		// echo"<tr><td align=center><font size=1>$coursegraduated</font></td><td align=center><font size=1>$yeargraduated</font></td><td align=center><font size=1>$schoolgraduated</font></td><td align=center><font size=1>$schooladdress</font></td></tr>";
	//start of Bank Account Details
		// echo "<tr><td colspan=2>";
		// echo "<tr valign=top><td colspan=5 bgcolor=lightgray>Bank Account Details</td></tr>";
		// echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
		// echo "<tr><td align =center><font size=1>Bank Name</td><td align=center><font size=1>Branch</td><td align=center><font size=1>Acct Number</td><td align=center><font size=1>Type</td><td align=center><font size=1>Currency</font></td><td align=center><font size=1>Acct Name</font></td></tr>";
		
		// echo "<tr><td align =center><font size=1>$bank_name</td><td align=center><font size=1>$bank_branch</td><td align=center><font size=1>$acct_num</td><td align=center><font size=1>$acct_type</td><td align=center><font size=1>$acct_currency </font></td><td align=center><font size=1>$acct_name</font></td></tr>";
	//start of Emergency Contact Info
	// 	echo "<tr><td colspan=2>";
	// 	echo "<tr valign=top><td colspan=10 bgcolor=lightgray>Emergency Contact Info</td></tr>";
	// 	echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";

	// 	echo "<tr><td align =center><font size=1>Name</td><td align=center><font size=1>Relation</td><td align=center><font size=1>Line</td><td align=center><font size=1>Mobile</td><td align=center><font size=1>Email</font></td></tr>";
		
	// 	echo "<tr><td align =center><font size=1>$em_name_first  $em_name_middle[0] $em_name_last</td><td align=center><font size=1>$em_emergrelation</td><td align=center><font size=1>$em_num_res1_cc $em_num_res1_ac $em_num_res1</td><td align=center><font size=1>$em_num_mobile1_cc $em_num_mobile1_ac $em_num_mobile1</td><td align=center><font size=1>$em_email1</font></td></tr>";
	// //list of dependents
	// 	echo "<tr><td colspan=2>";
	// 	echo "<tr valign=top><td colspan=5 bgcolor=lightgray>List of Dependents</td></tr>";
	// 	echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
	// 	echo "<tr><td align =center><font size=1>Name</td><td align=center><font size=1>Birth Date</td><td align=center><font size=1>Relationship</td></tr>";
		
	// 	echo "<tr><td align =center><font size=1>$dependentfirst $dependentmiddle[0] $dependentlast</td><td align=center><font size=1>$dependentbirthdate</td><td align=center><font size=1>$dependentrelation</font></td></tr>";
		
	
	
	
	?>
	
	<!-- <td></td><td></td><td></td>

	


	</div>
 -->


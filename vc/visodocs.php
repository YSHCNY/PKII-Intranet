<?php
//
// visodocs.php
// fr: vc/index.php
//page 24

// get variables
$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

$disptyp = (isset($_POST['disptyp'])) ? $_POST['disptyp'] :'';

if($page=='') { $page=24; }

$filepath="../admin/transfers/iso";
$filepath2="../admin/transfers/iso/forms";
$filepath3="../admin/transfers/others";
$file1="isomanual.PDF";
$file2="isosysproc.PDF";
$file3="isojobdesc.PDF";
$file4="isoworkinst.PDF";
$file5="";
$file6="docempmanual.PDF";
$file7="docitpolicy.PDF";
$file8="docssemanual.PDF";
// $file8="";
// 20200129
// $file9="Att-1_NKcode_of_conduct_English.pdf";
// 20231219
$file9="1-1CodeofConductIDEnGroup.PDF";
$file10="NKCMGV1.0.pdf";
// 20200706
$file11="PKIIRegnAllocDuties07012020.PDF";
// 20200720
$file12 = "PKIIRisk&CrisisMgmtRegn.PDF";
// 20210701
$file13 = "PKIIBasicPoliciesDevtICSystem_20210128.PDF";
$file14 = "IOMRiskReportingtoClients30June2021rev1002.PDF";
// 20210804
$file15 = "PKIIBriberyPreventionRegn_20210530.PDF";
// 20220202
$file16 = "20220202PKIIWBR.PDF";
$file17 = "PKII_ITD_InfoSecDLP_V1.00.PDF";
?>
	<div class=" my-5 p-5 mainbgc" >
		
		<div class=""><h4 class = "ms-5 py-5  text-white">Guides and Policies</h4></div>
		</div>

<div class="container flex">
<!-- start tabs -->
<!-- <ul id="myTabs" class="nav nav-tabs nav-justified" role="tablist"> -->
<ul id="myTabs" class="nav nav-tabs border-0  text-center justify-content-center align-items-center mx-auto flex" role="tablist">
    <li role="presentation" class="dropdown rounded-3  ">
        <a class="dropdown-toggle border shadow-sm  rounded-3 drpdwniso" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Select to display content</a>
        <ul class="dropdown-menu ">
            <li role="presentation" class="active"><a href="#isomanual" class ='fs-5' id="isomanual-tab" role="tab" data-toggle="tab" aria-controls="isomanual" aria-expanded="true">ISO Manual</a></li>
            <li role="presentation"><a href="#isoproc" id="isoproc-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="isoproc" aria-expanded="false">ISO Procedures</a></li>
            <li role="presentation"><a href="#isojobdesc" id="isojobdesc-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="isojobdesc" aria-expanded="false">Job Description</a></li>
            <li role="presentation"><a href="#workinst" id="workinst-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="workinst" aria-expanded="false">Work Instructions</a></li>
            <li role="presentation"><a href="#isoforms" id="isoforms-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="isoforms" aria-expanded="false">Office Forms</a></li>
			<li role="presentation"><a href="#empmanual" id="empmanual-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="empmanual" aria-expanded="false">Employees' Manual</a></li>
			<li role="presentation"><a href="#itpolicy" id="itpolicy-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="itpolicy" aria-expanded="false">IT Policy</a></li>
			<li role="presentation"><a href="#ssemanual" id="ssemanual-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="ssemanual" aria-expanded="false">SSE Manual</a></li>
			<li role="presentation"><a href="#nkcodeoc" id="nkcodeoc-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="nkcodeoc" aria-expanded="false">ID&E Code of Conduct</a></li>
			<li role="presentation"><a href="#nkcorpmg" id="nkcorpmg-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="nkcorpmg" aria-expanded="false">NK Corp. Mgmt. Guideline</a></li>
			<li role="presentation"><a href="#pkregnallocdts" id="pkregnallocdts-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="pkregnallocdts" aria-expanded="false">Reg'n. on Allocation of Duties</a></li>
			<li role="presentation"><a href="#pkriskcrisismgtregn" id="pkriskcrisismgtregn-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="pkriskcrisismgtregn" aria-expanded="false">Risk & Crisis Mgmt. Reg'n.</a></li>
			<!-- <li role="presentation"><a href="#pkbasicpoldevics" id="pkbasicpoldevics-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="pkbasicpoldevics" aria-expanded="false">Basic Policies on the Dev't of Internal Control System</a></li> -->
			<li role="presentation"><a href="#pkbasicpoldevics" id="pkbasicpoldevics-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="pkbasicpoldevics" aria-expanded="false">Internal Control Policies</a></li>

			<li role="presentation"><a href="#pkiomriskrptcli" id="pkiomriskrptcli-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="pkiomriskrptcli" aria-expanded="false">Risk Reporting to Clients</a></li>
			<li role="presentation"><a href="#pkbriberypreventregn" id="pkbriberypreventregn-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="pkbriberypreventregn" aria-expanded="false">Bribery Prevention Reg'n.</a></li>
			<!-- <li role="presentation"><a href="#pkregnconswhistleblowing" id="pkregnconswhistleblowing-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="pkregnconswhistleblowing" aria-expanded="false">Whistleblowing Consultation and Reporting Reg'n.</a></li> -->
			<li role="presentation"><a href="#pkregnconswhistleblowing" id="pkregnconswhistleblowing-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="pkregnconswhistleblowing" aria-expanded="false">Whistleblowing Policy</a></li>
			<li role="presentation"><a href="#pkinfosecdlp" id="pkinfosecdlp-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="pkinfosecdlp" aria-expanded="false">Security Guidelines & Data Protection</a></li>

			<!-- <li role="presentation"><a href="#pkinfosecdlp" id="pkinfosecdlp-tab" class ='fs-5' role="tab" data-toggle="tab" aria-controls="pkinfosecdlp" aria-expanded="false">Information Security Guidelines and Data Loss/Leak Prevention</a></li> -->
        </ul>
    </li>
    
</ul>


</div>

<div class="container flex"> 
	<div class="mx-auto my-5 px-5 pb-4 shadow-lg">
<div id="myTabContent" class="tab-content">
	

<div role="tabpanel" class="tab-pane fade in active " id="isomanual" aria-labelledby="isomanual-tab">
    <p class="text-white text-center fs-4">ISO Manual</p>
    <div class="embed-responsive embed-responsive-16by9 ">
        <?php if ($file1 != '') : ?>
       
            <iframe class="embed-responsive-item" frameborder="0" src="<?php echo "$filepath/$file1?wmode=opaque"; ?>" type="application/pdf"></iframe>
            <object class="embed-responsive-item" data="<?php echo "$filepath/$file1#toolbar=0"; ?>" type="application/pdf"></object>
            <embed class="embed-responsive-item" src="<?php echo "$filepath/$file1#toolbar=0"; ?>" type="application/pdf" />
          
        <?php endif; ?>
    </div>
</div>





<div role="tabpanel" class="tab-pane fade" id="isoproc" aria-labelledby="isoproc-tab">
    <p class="text-white text-center fs-4">ISO Procedures</p>
    <div class="embed-responsive embed-responsive-16by9">
        <?php if ($file2 != '') : ?>
         
            <iframe class="embed-responsive-item" frameborder="0" src="<?php echo "$filepath/$file2?wmode=opaque"; ?>" type="application/pdf"></iframe>
         
            <object class="embed-responsive-item" data="<?php echo "$filepath/$file2#toolbar=0"; ?>" type="application/pdf"></object>
            <embed class="embed-responsive-item" src="<?php echo "$filepath/$file2#toolbar=0"; ?>" type="application/pdf" />
            
        <?php endif; ?>
    </div>
</div>



<div role="tabpanel" class="tab-pane fade" id="isojobdesc" aria-labelledby="isojobdesc-tab">
    <p class="text-white text-center fs-4">ISO Job Descriptions</p>
    <div class="embed-responsive embed-responsive-16by9">
        <?php if ($file3 != '') : ?> 
            <iframe class="embed-responsive-item" frameborder="0" src="<?php echo "$filepath/$file3?wmode=opaque"; ?>" type="application/pdf"></iframe>
            <object class="embed-responsive-item" data="<?php echo "$filepath/$file3#toolbar=0"; ?>" type="application/pdf"></object>
            <embed class="embed-responsive-item" src="<?php echo "$filepath/$file3#toolbar=0"; ?>" type="application/pdf" />
            
        <?php endif; ?>
    </div>
</div>









	
	<div role="tabpanel" class="tab-pane fade" id="workinst" aria-labelledby="workinst-tab">
	<p class = "text-white text-center fs-4">ISO Work Instructions</p>
	<div class="embed-responsive embed-responsive-16by9">
<?php
	if($file4!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath/$file4?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath/$file4#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath/$file4#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";
	echo "</object>";
	echo "<![endif]>";
	} // if
?>
	
</div>
	</div>








	

	<div role="tabpanel" class="tab-pane fade" id="isoforms" aria-labelledby="isoforms-tab">
	<p class = "text-white text-center fs-4">Office forms</p>
	<div class="embed-responsive embed-responsive-16by9">
<?php
  // display folders
  $dirArray = ReadFolderDirectory0("$filepath2");
  $ctr0 = 0; 
  foreach ($dirArray as $value0) {
    $dirname = urlencode($value0);
    echo "".$dirname."<br>";
  }
  
  // display files
  $fileArray = ReadFolderDirectory("$filepath2");
  sort($fileArray);
  $ctr = 0; 
  foreach ($fileArray as $value) {
    $filename = urlencode($value);
      if($filename != "index.htm") {
        echo "<a href=\"$filepath2/$value\" target=\"_blank\" class='text text-primary'>$value</a><br>";
      }
  }
?>
	
	</div>
</div>








	

	<div role="tabpanel" class="tab-pane fade" id="empmanual" aria-labelledby="empmanual-tab">
	<p class = "text-white text-center fs-4">Employees' Manual</p>
	<div class="embed-responsive embed-responsive-16by9">
<?php
	if($file6!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file6?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file6#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file6#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";
	echo "</object>";
	echo "<![endif]>";
	} // if
?>
	</p>
</div>
	</div>








	
	<div role="tabpanel" class="tab-pane fade" id="itpolicy" aria-labelledby="itpolicy-tab">
	<p class = "text-white text-center fs-4">IT Policy</p>
	<div class="embed-responsive embed-responsive-16by9">
<?php
	if($file7!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file7?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file7#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file7#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";
	echo "</object>";
	echo "<![endif]>";
	} // if
?>
	</p>
</div>
	</div>








	

	<!-- 20190130 updated below to include safety, security and environment manual -->
<!-- 20190215 updated below to remove sse manual doc as requested thru telegram by mmacadangdanga, as instructed by sir pss -->
<!-- 20190308 activate sse manual based on latest uploaded pdf file from mmacadangdang -->
	<div role="tabpanel" class="tab-pane fade" id="ssemanual" aria-labelledby="ssemanual-tab">
	<p class = "text-white text-center fs-4">Safety, Security and Environment (SSE) Manual</p>
	<div class="embed-responsive embed-responsive-16by9">
<?php
	if($file8!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file8?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file8#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file8#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";
	echo "</object>";
	echo "<![endif]>";
	} // if
 ?>
	</p>
</div>
	</div>








	
	
<!-- 20200129 nk code of conduct as required bdd/hrd for nk mgmt audit -->
	<div role="tabpanel" class="tab-pane fade" id="nkcodeoc" aria-labelledby="nkcodeoc-tab">
	<p class = "text-white text-center fs-4">ID&E Code of Conduct</p>
	<div class="embed-responsive embed-responsive-16by9">> 
<?php
	if($file9!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file9?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file9#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file9#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";
	echo "</object>";
	echo "<![endif]>";
	} // if
 ?>
	</p>
</div>
	</div>








	

<!-- 20200218 nk corp mgmt guideline as req by hrd (ipsanantonio) -->
	<div role="tabpanel" class="tab-pane fade" id="nkcorpmg" aria-labelledby="nkcorpmg-tab">
	<p class = "text-white text-center fs-4">NK Corp. Mgmt. Guideline</p>
	<div class="embed-responsive embed-responsive-16by9">
<?php
	if($file10!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file10?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file10#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file10#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";
	echo "</object>";
	echo "<![endif]>";
	} // if
 ?>
	</p>
</div>
	</div>








	

<!-- 20200706 PKII regulations on the allocation of duties as req thru email by hrd (cdvitug) -->
	<div role="tabpanel" class="tab-pane fade" id="pkregnallocdts" aria-labelledby="pkregnallocdts-tab">
	<p class = "text-white text-center fs-4">PKII Regulations on the Allocation of Duties</p>
	<div class="embed-responsive embed-responsive-16by9">
<?php
	if($file11!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file11?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file11#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file11#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";
	echo "</object>";
	echo "<![endif]>";
	} // if
 ?>
	</p>
	</div>
	</div>








	
	
<!-- 20200720 PKII Risk & Crisis Mgmt Reg'n -->
	<div role="tabpanel" class="tab-pane fade" id="pkriskcrisismgtregn" aria-labelledby="pkriskcrisismgtregn-tab">
	<p class = "text-white text-center fs-4">PKII Risk & Crisis Management Regulations</p>
	   <div class="embed-responsive embed-responsive-16by9">
<?php
	if($file12!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file12?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file12#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file12#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";
	echo "</object>";
	echo "<![endif]>";
	} // if
 ?>
	</p>
	</div>
</div>







	

<!-- 20200701 PKII Basic Policies on the Development of Internal Control System -->
	<div role="tabpanel" class="tab-pane fade" id="pkbasicpoldevics" aria-labelledby="pkbasicpoldevics-tab">
	<p class = "text-white text-center fs-4">PKII Basic Policies on the Development of Internal Control System</p>
	   <div class="embed-responsive embed-responsive-16by9"> 
<?php
	if($file13!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file13?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file13#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file13#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";
	echo "</object>";
	echo "<![endif]>";
	} // if
 ?>
	</p>
	</div>
</div>







	

<!-- 20210701 PKII Memo - Risk Reporting to Clients -->
	<div role="tabpanel" class="tab-pane fade" id="pkiomriskrptcli" aria-labelledby="pkiomriskrptcli-tab">
	<p class = "text-white text-center fs-4">PKII Memo - Risk Reporting to Clients</p>
	   <div class="embed-responsive embed-responsive-16by9"> 
<?php
	if($file14!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file14?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file14#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file14#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";
	echo "</object>";
	echo "<![endif]>";
	} // if
 ?>
	</p>
	</div>
</div>







	

<!-- 20210804 PKII Bribery PRevention Regulations -->
	<div role="tabpanel" class="tab-pane fade" id="pkbriberypreventregn" aria-labelledby="pkbriberypreventregn-tab">
	<p class = "text-white text-center fs-4">PKII Bribery Prevention Regulations</p>
	   <div class="embed-responsive embed-responsive-16by9"> 
<?php
	if($file15!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file15?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file15#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file15#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";
	echo "</object>";
	echo "<![endif]>";
	} // if
 ?>
	</p>
	</div>
</div>







	

<!-- 20220202 PKII Regulations relating to Consultation and Whistleblowing System  -->
	<div role="tabpanel" class="tab-pane fade" id="pkregnconswhistleblowing" aria-labelledby="pkregnconswhistleblowing-tab">
	<p class = "text-white text-center fs-4">Whistleblowing Consultation and Reporting Regulation</p>
	   <div class="embed-responsive embed-responsive-16by9"> 
<?php
	if($file15!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file16?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file16#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file16#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";

	echo "</object>";
	echo "<![endif]>";
	} // if
 ?>
	</p>
	</div>
</div>







	

<!-- 2022822 PKII ITD InfoSec Regulations and Data Loss/Leak Prevention -->
	<div role="tabpanel" class="tab-pane fade" id="pkinfosecdlp" aria-labelledby="pkinfosecdlp-tab">
	<p class = "text-white text-center fs-4">Information Security Guidelines and Data Loss/Leak Prevention</p>
	   <div class="embed-responsive embed-responsive-16by9"> 
<?php
	if($file17!='') {
	echo "<!--[if IE]>";
	echo "<iframe frameborder=\"0\" height=\"600\" src=\"$filepath3/$file17?wmode=opaque\" type=\"application/pdf\" width=\"900\">";
	echo "</iframe>";
	echo "<![endif]-->";

	echo "<![if !IE]>";
	echo "<object data=\"$filepath3/$file17#toolbar=0\" type=\"application/pdf\" WIDTH=\"900\" HEIGHT=\"600\">";
  echo "<param name=\"WMode\" value=\"transparent\" /></param>";
  echo "<embed src=\"$filepath3/$file17#toolbar=0\" wmode=\"transparent\" type=\"application/pdf\" />";

	echo "</object>";
	echo "<![endif]>";
	} // if
 ?>
	</p>
	</div>
</div>







	

</div>
</div>

</div>	<!-- <div role="tabpanel" class="tab-pane fade" id="dropdown1" aria-labelledby="dropdown1-tab">
		Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney’s organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven’t heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.
	</div>
	<div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown2-tab">
		Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.
	</div> -- >
<!-- end tabs -->
		

<?php
function ReadFolderDirectory0($dir0)
{
        $listDir0 = array();

        if($handler0 = opendir($dir0))
        {
            while (($sub0 = readdir($handler0)) !== FALSE)
            {
                if ($sub0 != "." && $sub0 != ".." && $sub0 != "Thumb.db")
                {
                    if(is_file($dir0."/".$sub0))
                    {
//                        $listDir[] = $sub0;
                    }
                    elseif(is_dir($dir0."/".$sub0))
                    {
                        $listDir0[] = $sub0;
		    }
                }
            }   
            closedir($handler0);
        }
        return $listDir0;   
} 

function ReadFolderDirectory($dir)
{
        $listDir = array();

        if($handler = opendir($dir))
        {
            while (($sub = readdir($handler)) !== FALSE)
            {
                if ($sub != "." && $sub != ".." && $sub != "Thumb.db")
                {
                    if(is_file($dir."/".$sub))
                    {
                        $listDir[] = $sub;
                    }
                    elseif(is_dir($dir."/".$sub))
                    {
//                        $listDir[$sub] = $this->ReadFolderDirectory($dir."/".$sub);
//                        $listDir[] = $sub;
		    }
                }
            }   
            closedir($handler);
        }
        return $listDir;   
}
?>

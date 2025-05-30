<?php 

include("db1.php");
include("datetimenow.php");
include("addons.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
  include ("header.php");
  include ("sidebar.php");
?>
<style>
    #hov{
         transition: transform 0.3s ease;
    }
    #hov:hover{
         color: white !important;
         transform: translateY(-5px);
    }
    #hovb:hover{
        color: white !important;
    }
</style>
<div class="poppins shadow p-5">

  <div class="text-center">
    <h1 class="mt-2 mb-5">Finance Reports</h1>
  </div>

  <div>
    <form action="finrptprojdisb.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Project Disbursement</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Displays cash disbursement per project</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="finrptprojcrv.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Project Cash Receipts</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Cash receipts per project</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="finrptprojjournal.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Project Journal</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Journal entries per project</h4>
      </div>
    </form>
  </div>

  <div class="d-flex justify-content-between align-items-center">
    <div class="w-50">
      <form action="finrptcshdisbbk.php?loginid=<?php echo $loginid; ?>" method="post">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Cash Disbursement Book</button>
      </form>
    </div>
    <div class="w-50">
    <form action="finrptotheracctssummcdb.php?loginid=<?php echo $loginid; ?>" method="post">
      <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">CDB: Summary of Other Accounts</button>
    </form>
    </div>
  </div>
  <div class="d-flex justify-content-between align-items-center">
    <div class="w-50">
      <form action="finrptacctspayable.php?loginid=<?php echo $loginid; ?>" method="post">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Accounts Payable Book</button>
      </form>
    </div>
    <div class="w-50">
      <form action="finrptotheracctssummapb.php?loginid=<?php echo $loginid; ?>" method="post">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">APB: Summary of Other Accounts</button>
      </form>
    </div>
  </div>
  <div class="d-flex justify-content-between align-items-center">
    <div class="w-50">
      <form action="finrptcshrcptbk.php?loginid=<?php echo $loginid; ?>" method="post">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Cash Receipts Book</button>
      </form>
    </div>
    <div class="w-50">
      <form action="finrptotheracctssummcrb.php?loginid=<?php echo $loginid; ?>" method="post">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">CRB: Summary of Other Accounts</button>
      </form>
    </div>
  </div>
  <div class="d-flex justify-content-between align-items-center">
    <div class="w-50">
      <form action="finrptjournalbk.php?loginid=<?php echo $loginid; ?>" method="post">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Journal Book</button>
      </form>
    </div>
    <div class="w-50">
      <form action="finrptotheracctssummjb.php?loginid=<?php echo $loginid; ?>" method="post">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">JB: Summary of Other Accounts</button>
      </form>
    </div>
  </div>
  <div>
    <form action="finrptbalsht.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Balance Sheet (Main)</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">PKII's Balance sheet and Income statement</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="finrptdirectprofitproj.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Direct Profit (Projects)</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Statement of Direct Profit / Loss for Each Project</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="finrptgaenk.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Gen. and Admin. Expenses(NK)</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">General and Administrative Expenses of Nippon Koei ltd.</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="finrptgae.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Gen. and Admin. Expenses(PKII)</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">General and Administrative Expenses of PKII</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="reportsubsidiaryledgers.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Subsidiary - Ledgers</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">PKII's Subsidiary Ledgers</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="reportledger.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">General Ledger</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">PKII's General Ledger</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="finrptdcnk.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Direct Cost (NK)</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Direct Cost of Nippon Koei ltd.</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="reportdirectcost.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Direct Cost</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Statement of Direct Cost</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="directcostsummary.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Direct Cost Summary</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Direct Cost Summarized</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="directcostsummaryproject.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Direct Cost Summary Per Project</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Direct Cost Per Project</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="reportothers.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Other Reports</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Other Reports per project</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="stravis.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Correlate Account Codes</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">NK Correlation NK and PKII Account codes</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="projectreports.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Project Reports</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">PKII Project Reports</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="requestedbymamcathy.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Disbursement Book Annual</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Disbursement Book Layout Requested by Ma'am Cathy</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="requestedbysirian.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Journal Book Annual</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Journal Book Layout Requested by Sir Ian</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="requestedbysirmykel.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Cash Receipt Book Annual</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Cash Receipt Book Layout Requested by Sir Michael Auditor</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="companyincomestatement.php?loginid=<?php echo $loginid; ?>" method="post" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Company Income Statement</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Company Budget, Actual and Variance</h4>
      </div>
    </form>
  </div>
  <div>
    <form action="finrptstfinpos.php?loginid=<?php echo $loginid; ?>" method="post" name="finrptstfinpos" class="d-flex justify-content-between align-items-center">
      <div class="w-50">
        <button id="hov" type="submit" class="w-75 btn btn-outline-primary border border-1 border-primary p-3 fs-4 fw-medium" role="button">Statement of Financial Position</button>
      </div>
      <div class="w-50">
        <h4 class="fs-3">Company Statement of Financial Position</h4>
      </div>
    </form>
  </div>
  
</div>

<div class="my-5 d-flex justify-content-end">
     <a href="index2.php?loginid=<?php echo $loginid; ?>" id="hovb" class="poppins fw-semibold text-black border border-1 border-primary btn btn-outline-primary" style="padding: 10px 60px;" role="button">Back</a>
</div>

<?php
     $resquery="UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result=$dbh2->query($resquery);

     include ("footer.php");
} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?>
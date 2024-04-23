<?php
	include ("addons.php");
?>
<style>
    #links{
		cursor: pointer;
        transition: transform 0.5s ease;
    }
	#links:hover{
        background-color: #0a1d44 !important;
		color: white !important;
		font-weight: 600 !important;
    }
	#links:active{
		transform: scale(0.95);
	}
	.d{
		width: 99%;
	}
</style>
<div class="poppins">
    <div class="fin2-column">
        <div class="fin2-container">
            <div class="text-center mb-5">
                <h3 class="text-black fw-semibold">ISO Documents <span class="text-primary">&</span> Others</h3>
            </div>
            <div class="d d-flex gap-5">
                <form action="dirisodocs.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post" style="width: 16.5%;>
                    <input type="hidden" name="doctyp" value="isomanual">
                    <input type="hidden" name="fn" value="isomanual.PDF">
                    <input type="hidden" name="fp" value="./transfers/iso/">
                    <input type="submit" value="ISO Manual" id="links" class="w-100 bg-white text-black fw-medium border border-1 border-black rounded-3" style="height: 35px;">
                </form>
                <form action="dirisodocs.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post" style="width: 16.5%;>
                    <input type="hidden" name="doctyp" value="isosysproc">
                    <input type="hidden" name="fn" value="isosysproc.PDF">
                    <input type="hidden" name="fp" value="./transfers/iso/">
                    <input type="submit" value="System Procedures" id="links" class="w-100 bg-white text-black fw-medium border border-1 border-black rounded-3" style="height: 35px;">
                </form>
                <form action="dirisodocs.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post" style="width: 16.5%;>
                    <input type="hidden" name="doctyp" value="isojobdesc">
                    <input type="hidden" name="fn" value="isojobdesc.PDF">
                    <input type="hidden" name="fp" value="./transfers/iso/">
                    <input type="submit" value="Job Descriptions" id="links" class="w-100 bg-white text-black fw-medium border border-1 border-black rounded-3" style="height: 35px;">
                </form>
                <form action="dirisodocs.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post" style="width: 16.5%;>
                    <input type="hidden" name="doctyp" value="isoworkinst">
                    <input type="hidden" name="fn" value="isoworkinst.PDF">
                    <input type="hidden" name="fp" value="./transfers/iso/">
                    <input type="submit" value="Work Instructions" id="links" class="w-100 bg-white text-black fw-medium border border-1 border-black rounded-3" style="height: 35px;">
                </form>
                <form action="dirisoforms.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post" style="width: 16.5%;>
                    <input type="hidden" name="doctyp" value="isoforms">
                    <input type="hidden" name="fp" value="./transfers/iso/forms">
                    <input type="submit" value="ISO Forms" id="links" class="w-100 bg-white text-black fw-medium border border-1 border-black rounded-3" style="height: 35px;">
                </form>
				<form action="diritpolicy.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post" style="width: 16.5%;>
                    <input type="hidden" name="doctyp" value="docitpolicy">
                    <input type="hidden" name="fn" value="docitpolicy.PDF">
                    <input type="hidden" name="fp" value="./transfers/others/">
                    <input type="submit" value="IT Policy" id="links" class="w-100 bg-white text-black fw-medium border border-1 border-black rounded-3" style="height: 35px;">
                </form>
            </div>
        </div>
    </div>
</div>
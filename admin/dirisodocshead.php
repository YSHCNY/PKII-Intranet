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
<div class="">
    <div class="">
        <div class="">
            <div class=" mb-5 shadow p-4">
                <h4 class="mb-0 pb-0 ">Philkoei Documents</h4>
                <p class="">View and Learn Philkoei Documents</p>

            </div>
            <div class="row shadow text-center p-4 mb-4 mx-1">
                <form class = 'col col-lg-2 col-12' action="dirisodocs.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post">
                    <input type="hidden" name="doctyp" value="isomanual">
                    <input type="hidden" name="fn" value="isomanual.PDF">
                    <input type="hidden" name="fp" value="./transfers/iso/">
                    <input type="submit" value="ISO Manual" id="links" class="btn w-100 border-dark" >
                </form>
                <form class = 'col col-lg-2 col-12' action="dirisodocs.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post">
                    <input type="hidden" name="doctyp" value="isosysproc">
                    <input type="hidden" name="fn" value="isosysproc.PDF">
                    <input type="hidden" name="fp" value="./transfers/iso/">
                    <input type="submit" value="System Procedures" id="links" class="btn w-100 border-dark" >
                </form>
                <form class = 'col col-lg-2 col-12' action="dirisodocs.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post">
                    <input type="hidden" name="doctyp" value="isojobdesc">
                    <input type="hidden" name="fn" value="isojobdesc.PDF">
                    <input type="hidden" name="fp" value="./transfers/iso/">
                    <input type="submit" value="Job Descriptions" id="links" class="btn w-100 border-dark" >
                </form>
                <form class = 'col col-lg-2 col-12' action="dirisodocs.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post">
                    <input type="hidden" name="doctyp" value="isoworkinst">
                    <input type="hidden" name="fn" value="isoworkinst.PDF">
                    <input type="hidden" name="fp" value="./transfers/iso/">
                    <input type="submit" value="Work Instructions" id="links" class="btn w-100 border-dark" >
                </form>
                <!-- <form class = 'col col-lg-2 col-12' action="dirisoforms.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post">
                    <input type="hidden" name="doctyp" value="isoforms">
                    <input type="hidden" name="fp" value="./transfers/iso/forms">
                    <input type="submit" value="ISO Forms" id="links" class="btn w-100 border-dark" >
                </form> -->
				<form class = 'col col-lg-2 col-12' action="diritpolicy.php?loginid=<?php echo $loginid; ?>&docsw=1" method="post">
                    <input type="hidden" name="doctyp" value="docitpolicy">
                    <input type="hidden" name="fn" value="docitpolicy.PDF">
                    <input type="hidden" name="fp" value="./transfers/others/">
                    <input type="submit" value="IT Policy" id="links" class="btn w-100 border-dark" >
                </form>
            </div>
        </div>
    </div>
</div>
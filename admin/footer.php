<?php
    include ("addons.php");
?>





</div> <!-- bodyWrapper -->
</div> <!-- bodyContainer -->


</body>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.GlobalSelect').select2({
        placeholder: 'Select an option',
  
    });


	$('.GlobalSelectWx').select2({
        placeholder: 'Select an option',
        allowClear: true 
    });
});
</script>
<footer >
	<!-- <hr class="border border-1 border-black">
	<center class="w-100 poppins pb-1 d-flex justify-content-center align-items-center gap-1">
		<h4 class="m-0 text-muted fs-6">&copy;</h4>
		<h5 class="m-0 text-muted fs-6">Copyright Philkoei International Inc.</h5>
	</center> -->
</footer>
</html>

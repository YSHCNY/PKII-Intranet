
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<!-- Include JS -->


</head>
<body>
     
<?php 


// start add bank details


	echo "<div class = 'px-4'>";
	echo "<div class = ' mt-3' >Bank Name<input class = 'form-control' placeholder ='Input Bank name here...' name='bank_name'></div>";
	echo "<div class = ' mt-3'>Branch<input class = 'form-control' placeholder ='Input Branch name here...' name='bank_branch'></div>";
	echo "<div class = ' mt-3'>Account Number<input class = 'form-control' placeholder ='Input Account Number here...' name='acct_num'></div>";

	echo "<div class = 'row px-2 mt-3'>";
	echo "<div class = 'col'>";

	echo "Type";
	echo "<select class = 'inputselect4' name='acct_type'>";
	echo "<option name=savings selected>Savings</option>";
	echo "<option name=current>Current</option>";
	echo "<option name=others>Others</option>";
	echo "</select>";
	echo "</div>";

	echo "<div class = 'col'>";

	echo "Currency";
	echo "<select class = 'inputselect5' name='acct_currency'>";
	echo "<option name=\"Phil. Pesos\" selected>Phil. Pesos</option>";
	echo "<option name=\"US Dollars\">US Dollars</option>";
	echo "<option name=\"Others\">Others</option>";
	echo "</select>";
	echo "</div>";

	echo "</div>";

	echo "<div class = ' mt-3' >Account Name<input class = 'form-control' placeholder = 'Account name here...' name='acct_name' value=\"$acct_name\"></div>";
	echo "<div class = ' mt-3' >Remarks<textarea class = 'form-control' placeholder = 'Remarks here...'  name='bankacctremarks'>$bankacctremarks</textarea></div>";



	echo "</div>";


     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 



?> 
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect4');
        new Choices(element, { searchEnabled: true });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const element = document.querySelector('.inputselect5');
        new Choices(element, { searchEnabled: true });
    });
</script>
</body>
</html>

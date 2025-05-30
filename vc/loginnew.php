<br>

	<div class="wrapper">
<?php echo "<form class=\"form-signin\" method=\"POST\" action=\"loginverify.php\">" ?>       
<div class="form-group">
			<img src="img/pkiilogo1.png">
</div>
<div class="form-group">
      <h3 class="form-signin-heading">Intranet Login</h3>
</div>
<div class="form-group">
<?php echo "<input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"username\" required=\"\" autofocus=\"\" />"; ?>
</div>
<div class="form-group">
      <?php echo "<input type=\"password\" class=\"form-control\" name=\"password\" placeholder=\"password\" required=\"\"/>"; ?>
</div>
<div class="form-group">
      <!-- <label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
      </label> -->
</div>
<div class="form-group">
      <?php echo "<button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">Login</button>"; ?>   
</div>

<style>
            .stylebgc{
                border: #081e6a 1px solid;
            }
            .stylebgc:hover{
                /* background-color: #0A1D44; */
                color: white !important;
                background-color: #081e6a;
             
                }
        </style>
           <div class="text-center">
        <a href="https://192.168.0.223/pkii/vc"  class = 'stylebgc fs-4 rounded-4 px-5 py-3'>Intranet Version 2</a>
        </div>
    <?php echo "</form>"; ?>
  </div> <!-- <div class="wrapper"> -->


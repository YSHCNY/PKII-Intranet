<?php
include("header.php");
?>

<div class="container my-5">
<div class = ' shadow bg-white p-5 rounded-2'>
<p class = 'fw-bold fs-5 mb-0 '>Password Reset</p>
<p class="fs-5 text-italic">input your email to reset your password.</p>


<div>
    <form action="resetmethod.php" method = 'post' class = ''>

    <div class="mb-3">
        <p class="form-label text-normal fs-5">Enter your email address:</p>
        <input type="email" class="form-control" id="email" name="email" placeholder="youremail@email.com" required>
    </div>

    <div class="mb-3">
        <p class="form-label text-normal fs-5">Enter your username:</p>
        <input type="text" class="form-control" id="uname" name="uname" placeholder="username" required>
    </div>
    <div class="text-end">
    <a href = 'index.php'  class="mx-3 btn  ">Cancel</a>
    <button type="submit" class="mx-3 btn secondarybgc text-white">Send Reset Link</button>
    </div>
    </form>
</div>


</div>
</div>
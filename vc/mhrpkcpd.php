<?php
//
// mhrpkcpd.php
// fr: vc/index.php
// indexlinks: $page==38

require '../includes/config.inc';
require '../includes/dbh.php';
require 'addons.php';

// get variables
$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

?>
  <div class="row">
    <div class="col-md-12"><h3 style="color:#003479;">PKII-CPD</h3><br><p style="color:#003479;">Continuing Professional Development Program</p></div>
  </div>

  <div class="row">
    <div class="col-md-12">
<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    <!--  <li data-target="#myCarousel" data-slide-to="3"></li> -->
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <!-- <img src="./images/Carousel_1.png" alt="Bridge" width="460" height="345"> -->
        <img src="./images/Carousel_1.png" alt="Bridge" style="display: block; margin-left: auto; margin-right: auto; width: 50%;">
    <!--    <div class="carousel-caption">
          <h3>Bridge Seminar</h3>
          <p>Bridge Analysis and Design Seminar</p>
        </div> -->
      </div>

      <div class="item">
        <!-- <img src="./images/Carousel_2.png" alt="Geo5" width="460" height="345"> -->
        <img src="./images/Carousel_2.png" alt="Geo5" style="display: block; margin-left: auto; margin-right: auto; width: 50%;">
    <!--    <div class="carousel-caption">
          <h3>GEO5 Software</h3>
          <p>GEO5 Software Hands-on Training</p>
        </div> -->
      </div>
    
      <div class="item">
        <!-- <img src="./images/Carousel_3.png" alt="Retaining" width="460" height="345"> -->
        <img src="./images/Carousel_3.png" alt="Retaining" style="display: block; margin-left: auto; margin-right: auto; width: 50%;">
    <!--    <div class="carousel-caption">
          <h3>Leaning-type Retaining Wall</h3>
          <p>Design of Leaning-type Retaining Wall</p>
        </div> -->
      </div>

    <!--  <div class="item">
        <img src="img_flower2.jpg" alt="Flower2" width="460" height="345">
        <div class="carousel-caption">
          <h3>Flowers2</h3>
          <p>Beautiful flowers in Kolymbari, Crete.</p>
        </div>
      </div> -->
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
    </div>
  </div>

<br>

  <div class="row">
    <div class="col-md-1"></div>

    <div class="col-md-2"><?php echo "<a href=\"./index.php?lst=1&lid=$loginid&sess=$session&p=381.php\"><img src=\"./images/Icon_blue_latest_announcements.png\" alt=\"Latest_announcement\" width=\"80\" height=\"80\"><br><p style=\"color:#003479;\">Latest Announcements</p></a>"; ?></div>

    <div class="col-md-2"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=382.php\"><img src=\"./images/Icon_blue_CPD_101.png\" alt=\"Reference_materials\" width=\"80\" height=\"80\"><br><p style=\"color:#003479;\">CPD 101: Reference Materials</p></a>"; ?></div>

    <div class="col-md-2"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=383.php\"><img src=\"./images/Icon_blue_CPD_Program_Catalogue.png\" alt=\"Program_catalogue\" width=\"80\" height=\"80\"><br><p style=\"color:#003479;\">CPD Program Cataloque</p></a>"; ?></div>

    <div class="col-md-2"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=384.php\"><img src=\"./images/Icon_blue_apply_for_programs.png\" alt=\"Apply_cpd_programs\" width=\"80\" height=\"80\"><br><p style=\"color:#003479;\">Apply for CPD Programs</p>"; ?></div>

    <div class="col-md-2"><?php echo "<a href=\"index.php?lst=1&lid=$loginid&sess=$session&p=385.php\"><img src=\"./images/Icon_blue_Contact_team.png\" alt=\"Contact_zen_team\" width=\"80\" height=\"80\"><br><p style=\"color:#003479;\">Contact PKIIzen Team</p>"; ?></div>

    <div class="col-md-1"></div>
  </div>

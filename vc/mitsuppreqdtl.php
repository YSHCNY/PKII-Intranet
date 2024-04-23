<?php
// mitsuppreqdtl.php
// fr: vc/index.php
// indexlinks: $page==342

require '../includes/config.inc';

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';
$srid = (isset($_GET['srid'])) ? $_GET['srid'] :'';

$iditsupportreq = (isset($_POST['idsr'])) ? $_POST['idsr'] :'';
$actor = (isset($_POST['ctgactor'])) ? $_POST['ctgactor'] :'';

if($srid!='') { $iditsupportreq=$srid; }

?>


    <div class="mainbgc ">
        <div class="col p-5">
            <h3 class="mt-4 p-5 fs-4 text-white fw-bold">IT Support Request - Details</h3>
        </div>
		</div>
   
		<div class="container">
    <div class="row">
        <div class="col">
            
        <?php
            	if (isset($_SESSION['ratescore']) && $_SESSION['ratescore']) {
                    // Display success alert
                    echo '<div class = "container"><div id="success-alert-ratescore" class="alert-warning my-4 text-warning rounded-4 border transition delay-200 px-4 py-4 relative" role="alert">
                            <strong class="font-bold">Excellent! rating submitted!</strong>
                            <span class="block sm:inline">Thank you for rating our service!</span>
                          </div></div>';
                    // Unset the session variable to prevent displaying the alert again on page refresh
                    unset($_SESSION['ratescore']);
                
                    
                }
                ?>
                <script>
                          
                            const successAlerteditratescore = document.getElementById('success-alert-ratescore');
                            setTimeout(function() {
                                successAlerteditratescore.style.opacity = '0';
                                setTimeout(function() {
                                    successAlerteditratescore.style.display = 'none';
                                },300); 
                            }, 3000);
                        </script>





<?php
            	if (isset($_GET['approved']) && $_GET['approved'] == 'true') {
                

                    echo '<div class = "container"><div id="success-alert-approve" class="alert-success my-4 text-success rounded-4 border transition delay-200 px-4 py-4 relative" role="alert">
                            <strong class="font-bold">Approved</strong>
                            <span class="block sm:inline">Client Request has been approved!</span>
                          </div></div>';
                    // Unset the session variable to prevent displaying the alert again on page refresh
                   
                
                    
                }
                ?>
                <script>
                          
                            const successAlertedit = document.getElementById('success-alert-approve');
                            setTimeout(function() {
                                successAlertedit.style.opacity = '0';
                                setTimeout(function() {
                                    successAlertedit.style.display = 'none';
                                },300); 
                            }, 3000);
                        </script>
            <div class="card my-4">
            <div class = 'text-end mb-0 pb-0'>
                        <button onclick="goBack()" class="border-0 px-3 py-3 bg-danger rounded"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/></svg></button>
                        </div>
                            <script>
                            function goBack() {
                            window.history.back();
                            }
                            </script>

                <div class="card-body px-5 py-2">
          
                <?php include '../m/qrymitsuppreq5.php'; ?>
            
                        <div class="row w-100 my-4">
                        <div class="col-md-6">
                            <?php include '../m/qrymitsuppreq6.php'; ?>

                  
                            <p class=" p-2 text-secondary"><span class = 'maintext'>Date of request:  </span><?php echo  date("Y-M-d H:i:s", strtotime($stamprequest16)); ?></p>
                           
                            </div>

                     


                            <div class="col-md-6 text-start text-md-end">
                     
                                    <?php if($ticketnum16==0): ?>
                                        <p class=""><span class = ' maintext rounded-3 text-center p-3'>NO ticket number assigned</span></p>
                                    <?php else: ?>
                                        <p class = '' ><span class = 'secondarybgc  text-white rounded-3 text-center p-3'><?php echo $ticketnum16; ?></span></p>
                                    <?php endif; ?>
                          
                                        
                            </div>
                           
                        </div>
                 

                    

<!-- requests -->
                   
                    <div class = 'border-top px-5 py-2'>
                    <h4 class = 'fw-bold maintext text-center'> Requestor -    
                        <?php echo " $name_first17 $name_middle17[0]  $name_last17 "; ?> <span class = 'fw-normal'>of</span>
                            <?php if($empposition17!=''): ?>
                                <?php echo $empposition17; ?>
                            <?php endif; ?>
                            
                            <?php if($empdepartment17!=''): ?>
                                 <?php echo $empdepartment17; ?>
                            <?php endif; ?></h4>
                    <div class="p-3">
                    <p class = 'text-muted mb-1 fs-6'>Request/s:</p>
                    <?php include '../m/qrymitsuppreq3.php';
                    $param14 = count($idctgsuppreq14Arr);
                    for($x2 = 0; $x2 < $param14; $x2++) {
                        if(preg_match("/".$code14Arr[$x2]."/", "$requestctg16")) {
                            ?>
                        
                        <p class = 'fs-5 fw-bold my-2'><span class="maintext"><?php echo $name14Arr[$x2];?></span></p> 
                      


                        <?php
                        } // if
                    } // for?>
                    </div>

<!-- details -->    <div class = 'p-3'>
                    <p class = 'text-muted mb-1 fs-6'>Details:</p>
                    <p><span class = 'maintext fs-5 '><?php echo nl2br($details16); ?></span></p>
                    </div>
<!-- status --> 
                    <div class = 'p-3'>
                    <p class = 'text-muted mb-1 fs-6'>Approval status:</p>
                    <p class = 'fs-5'>
                    <?php echo ($approvectr16 == 0) ? '<span class="maintext">Pending for approval</span>' : '<span class="text-success">Request Approved ' . date("Y-M-d H:i:s", strtotime($approvestamp16)) . '</span>'; ?>
                    </p>
                    </div>



                    <div class="p-3">
                    <p class = 'text-muted pb-0 fs-6 mb-1'>Approver:</p>
                    <?php if($approvectr16==1) {
                            // query tblcontact for approveempid16
                            include '../m/qrymitsuppreq8a.php';
                            echo "<p><span class = 'fs-5'>$name_last18a, $name_first18a  $empposition18a</span></p>";
                            } else if($approvectr16==0) {
                            if($employeeid16==$employeeid0) {
                            echo "<form method=\"POST\" action=\"mitsuppreq2.php?lst=1&lid=$loginid&sess=$session&p=342\" name=\"mitsuppreq2\">";
                            echo "<select  class = 'border rounded-3 p-2 bg-white fs-5' name=\"approver\">";
                            include '../m/qrymitsuppreq8b.php';
                            if($approver1empid18b!='') {
                                include '../m/qrymitsuppreq8c.php';
                                echo "<option value=\"$approver1empid18b\">$name_last18c, $name_first18c $name_middle18c[0]";
                                if($empposition18c!='') { echo " - $empposition18c"; } // if
                                if($empdepartment18c!='') { echo " - $empdepartment18c"; } // if
                                echo "</option>";
                            } // if
                            if($approver2empid18b!='') {
                                include '../m/qrymitsuppreq8d.php';
                                echo "<option value=\"$approver2empid18b\">$name_last18d, $name_first18d $name_middle18d[0]";
                                if($empposition18d!='') { echo " - $empposition18d"; } // if
                                if($empdepartment18d!='') { echo " - $empdepartment18d"; } // if
                                echo "</option>";
                            } // if
                            echo "</select>";
                            } else if($approveempid16==$employeeid0) {
                                // display approver readonly
                                include '../m/qrymitsuppreq8e.php';
                                echo "$name_last18e, $name_first18e";
                                if($empposition18e!='') { echo " - $empposition18e"; } // if
                                if($empdepartment18e!='') { echo " - $empdepartment18e"; } // if
                            } // if($employeeid15==$employeeid)
                            } // if($approvectr15==1) ?>
                    </div>


                    <?php if($employeeid16==$employeeid0): ?>
                        <?php $actor="REQ"; ?>
                        <?php if($approvectr16==0): ?>
                            <form method="POST" action="mitsuppreq2.php?lst=1&lid=<?php echo $loginid; ?>&sess=<?php echo $session; ?>&p=342" name="mitsuppreq2">
                                <input type="hidden" name="idsr" value="<?php echo $iditsupportreq; ?>">
                                <input type="hidden" name="ctgactor" value="<?php echo $actor; ?>">
                                <input type="hidden" name="requestctr" value="1">
                                <div class="text-lg-end text-center">
                                <button type="submit" class=" rounded-3 px-3 py-2  border-0 secondarybgc text-white mt-1">Request Reevaluation</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>


                    <div class="px-5 mt-2 py-2  flex">
               <div class = 'flex border-top'>
               <h4 class = 'fw-bold maintext text-center'>From Approver</h4>
                    <?php if($actionctg16!=''): ?>
           
                       
                        <?php include '../m/qrymitsuppreq9.php'; ?>
                        <?php if($found19==1): ?>
                            <?php if($actionctg16=='acc'): ?>
                                 <p class = 'text-muted pb-0 fs-6 mb-0'>Action taken:</p>
                                <p class="text-success fs-5 mb-5"><strong><?php echo $name19; ?></strong></p>
                            <?php elseif($actionctg16=='rqd'): ?>
                                 <p class = 'text-muted pb-0 fs-6 mb-0'>Action taken:</p>
                                <p class="text-danger fs-5 mb-5"><strong><?php echo $name19; ?></strong></p>
                            <?php else: ?>
                                 <p class = 'text-muted pb-0 fs-6 mb-0'>Action taken:</p>
                                <p class="text-warning fs-5 mb-5"><strong><?php echo $name19; ?></strong></p>
                            <?php endif; ?>
                        <?php endif; ?>
                      
                        <?php if($actiondetails16!=''): ?>
                            <p class = 'text-muted pb-0 mb-0 fs-6 mb-0'>Comment from approver:</p>
                            <p class = 'maintext fs-5 mb-5'><?php echo nl2br($actiondetails16); ?></p><?php endif; ?>
                    <?php endif; ?>
                    </div>

                            <div class="flex ">
                          
                    <?php if($closeticketsw16==0): ?>
                        <?php if($ticketnum16==0): ?>
                            <!-- Display nothing -->
                        <?php else: ?>
                            <p class = 'text-muted pb-0 fs-6 mb-1'>Ticket status:</p>
                           <p class = 'fs-5 maintext'> OPEN</p> 
                        <?php endif; ?>
                    <?php elseif($closeticketsw16==1): ?>
                        <p class = 'text-muted pb-0 fs-6 mb-1'>Ticket status:</p>
                        <p class = 'fs-5  text-success'>CLOSED <?php echo date("Y-M-d H:i:s", strtotime($closestamp16)); ?></p>
                    <?php endif; ?>
                            </div>
                    </div>


                    
                    <div class=" px-5 py-2  flex">
                        <div class = ' '> 
                        <!-- <p class = 'fs-6 text-muted  mb-0'>Necessarry Actions</p> -->
                        <div>
                      
          
                    <?php endif; ?>



                 
                    <?php if($approveempid16==$employeeid0): ?>
                        <?php $actor="APP"; ?>
                        <?php if($approvectr16==0): ?>
                         
                            <form method="POST" action="mitsuppreq2.php?lst=1&lid=<?php echo $loginid; ?>&sess=<?php echo $session; ?>&p=342" name="mitsuppreq2">
                                <input type="hidden" name="idsr" value="<?php echo $iditsupportreq; ?>">
                                <input type="hidden" name="ctgactor" value="<?php echo $actor; ?>">
                                <input type="hidden" name="approvectr" value="1">
                                <?php

                                if($apprdurationsw16==1) { $apprdurationswval="checked"; } else {$apprdurationswval=""; }
                                if($apprdurationdt16!="") { $apprdurationswdtval="".date(Y-M-d, strtotime($apprdurationdt16)).""; } else { $apprdurationswdtval=$datenow; }
                                    echo "<p class = 'text-muted fs-6'>(optional) Allowed duration of request</p>";
                                echo "<div class=\"checkbox\">";

                                    echo "<label>";
                                        echo "<input type=\"checkbox\" name=\"apprdurationsw\" $apprdurationswval> Yes";
                                    echo "</label>";

                                    echo "<label>";
                                        echo "<input type=\"date\" class=\"form-control\" name=\"apprdurationdt\" value=\"$apprdurationswdtval\">";
                                    echo "</label>";

                                echo "</div>";

                             
                                ?>
                                <div class="text-end">
                                <button type="submit" class=" rounded-3 px-3 py-2  border-0 secondarybgc text-white mt-1">Approve Request</button>
                                </div>
                            </form>

                                

                        <?php 
                     
                    
                 
                    
                    
                    
                    
                    
                    
                    endif; ?>
                    <?php endif; ?>
                    </div>

                    </div>
                    </div>
                    <!-- Satisfaction rating -->
                  
                        <style>
                        .rating {
                            unicode-bidi: bidi-override;
                            direction: rtl;
                            text-align: center;
                        }
                        .rating input {
                            display: none;
                        }
                        .rating label {
                            display: inline-block;
                            padding: 0px;

                            font-size: 40px;
                            cursor: pointer;
                            color: #ccc;
                        }
                        .rating label:before {
                            content: '★';
                        }
                        .rating input:checked ~ label {
                            color: #ffcc00;
                         
                        }

                        
                        .rating label:hover:before,
                        .rating label:hover ~ label:before{
                            color: #826802;
                            transition: color 0.2s ease-in-out;
                        }
                    </style>


                        <?php if($approvectr16>=1): ?>
                        <?php if($employeeid16==$employeeid0): ?>
                            <?php if($actionctr16>=1 && $actionctg16=='acc'): ?>
                                <?php if($scoreval16==0 && $scoreempid16==''): ?>
                                    <div class="mx-3 my-2  p-5  flex shadow">
                        <div class = ' '> 
                                    <form method="POST" action="mitsuppreqscore.php?lst=1&lid=<?php echo $loginid; ?>&sess=<?php echo $session; ?>&p=342" name="mitsuppreqscore">
                                        <input type="hidden" name="idsr" value="<?php echo $iditsupportreq; ?>">
                                        <input type="hidden" name="ctgactor" value="<?php echo $actor; ?>">
                                     
                                        <p class = 'maintext text-center mb-0 fs-2'> What is your rating?</p>
                                        <p class = 'fs-5 text-secondary  text-center '>Your ticket has been approved, Help us improve our service by rating us!</p>
                                        <!-- <select name="scoreval">
                                            <option value=''>-</option>
                                            <option value="5">5 stars (100%)</option>
                                            <option value="4">4 stars (80%)</option>
                                            <option value="3">3 stars (60%)</option>
                                            <option value="2">2 stars (40%)</option>
                                            <option value="1">1 star (20%)</option>
                                        </select> -->

                                        <div class="rating">
                                            <p id="selectedRating" class="fw-bold fs-4 pb-0 mb-0 ">0%</p> 
                                                <input type="radio" id="star5" name="scoreval" value="5"><label for="star5"></label>
                                                <input type="radio" id="star4" name="scoreval" value="4"><label for="star4"></label>
                                                <input type="radio" id="star3" name="scoreval" value="3"><label for="star3"></label>
                                                <input type="radio" id="star2" name="scoreval" value="2"><label for="star2"></label>
                                                <input type="radio" id="star1" name="scoreval" value="1"><label for="star1"></label>
                                            </div>
                                        <br>

                                    <div  class = 'flex'>
                                        <h5 class = 'submaintext text-center'>Help us improve, Comment your thoughts on our service</h5>
                                        <textarea class = 'form-control w-75  mx-auto' placeholder = 'Comments here..' name="scoreremarks"></textarea> 
                                        <div class="flex mx-auto text-center mt-2 p-3">
                                        <button class="text-white secondarybgc px-4 py-3 border-0 rounded-3" type="submit">Submit score</button>
                                        </div>
                                        </div>
                                    </form>
                                <?php else: ?>

                                    
                                    <?php 
                                            $scoreText = '';
                                            $scoreColor = '';

                                            if ($scoreval16 == 1) {
                                                $scoreText = '20% satisfied';
                                                $scoreColor = 'text-dark';
                                            } elseif ($scoreval16 == 2) {
                                                $scoreText = '40% satisfied';
                                                $scoreColor = 'text-danger';
                                            } elseif ($scoreval16 == 3) {
                                                $scoreText = '60% satisfied';
                                                $scoreColor = 'text-warning';
                                            } elseif ($scoreval16 == 4) {
                                                $scoreText = '80% satisfied';
                                                $scoreColor = 'text-warning';
                                            } elseif ($scoreval16 == 5) {
                                                $scoreText = '100% satisfied';
                                                $scoreColor = 'text-success';
                                            }
                                            ?>
                                            <div class = 'mx-3 my-2 justify-content-center align-items-center text-center flex  p-5  flex shadow'>
                                            <div class="star-rating <?php echo $scoreColor; ?>">
                                            <p class = 'maintext text-center mb-0 fs-2'>Your Rate</p>
                                            <p class = 'fs-5 text-secondary  text-center '>Thank you for rating! It help us to be better!</p>
                                            <div class="ratingCont">
                                                <div class="stars-<?php echo $scoreval16; ?>">
                                                    <?php echo str_repeat('★', $scoreval16); ?>
                                                </div>
                                                </div>
                                                <span class="score-text"><?php echo $scoreText; ?></span>
                                            </div>
                                            <div class="mt-4">
                                            <?php if ($scorestamp16 != '0000-00-00 00:00:00'): ?>
                                                <p class="text-muted fs-6 mb-0">Date of Rating</p>
                                                <p class="maintext fs-5"><?php echo date("Y-M-d H:i:s", strtotime($scorestamp16)); ?></p>
                                            <?php endif; ?>

                                            <?php if ($scoreremarks16 != ''): ?>
                                                <p class="text-muted fs-6 mb-0">Your Comment</p>
                                                <p class = 'maintext fs-5' ><?php echo nl2br($scoreremarks16); ?></p>
                                            <?php endif; ?>
                                            </div>
                                            </div>

                              



                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                        
                        </div>
                        </div>
                   
<style>
    .star-rating {
    position: relative;
    display: inline-block;
    font-size: 0;
}

.ratingCont{
    unicode-bidi: bidi-override;
                            direction: rtl;
                            text-align: center;
}
.star-rating .stars-5,
.star-rating .stars-4,
.star-rating .stars-3,
.star-rating .stars-2,
.star-rating .stars-1 {
    font-size: 40px; /* Adjust font size as needed */
     /* Color of the stars */
}

.score-text {
    font-size: 16px;
    margin-left: 5px;
}

</style>

                        <script>
    const ratingInputs = document.querySelectorAll('.rating input');
    const selectedRating = document.getElementById('selectedRating');

    ratingInputs.forEach(input => {
        input.addEventListener('change', function() {
            const percentage = parseInt(this.value) * 20 + '%';
            selectedRating.textContent = percentage;

            if (this.checked) {
                selectedRating.textContent = percentage;
                selectedRating.classList.add('maintext');
            } else {
                selectedRating.textContent = '-';
                selectedRating.classList.remove('maintext');
            }
            
        });
    });
</script>




                    <!-- Comments area -->
                    <div class = 'border px-4 mb-4 py-2'>
                    <p class="mt-4 fs-6 text-muted">Comments/clarification area</p>
                    <?php if($closeticketsw16!=1): ?>
                        <form method="POST" action="mitsuppreqcomments.php?lst=1&lid=<?php echo $loginid; ?>&sess=<?php echo $session; ?>&p=342" name="mitsuppreqcomments">
                            <input type="hidden" name="idsr" value="<?php echo $iditsupportreq; ?>">
                            <input type="hidden" name="ctgactor" value="<?php echo $actor; ?>">
                            <div class="form-group">
                                <textarea class="form-control" rows="5" name="comments" placeholder = 'Type here..' ></textarea>
                            </div>
                            <div class="text-end">
                                    <button class=" rounded-3 px-3 py-2  border-0 secondarybgc text-white mt-1" type="submit">Send <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16"><path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/></svg> 
                                    </button>
                            </div>
                        </form>
                    <?php endif; ?>
                    <div class="mt-4">
                        <p class = 'fs-5 maintext'><?php echo nl2br($comments16); ?></p>
                    </div>
                    </div>





                </div>
            </div>
        </div>
    </div>
</div>

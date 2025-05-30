<?php

    include '../m/qryddashadm.php';
	session_start();

	// if(isset($_SESSION['username']) && isset($_SESSION['employeeid']) ) {
	// 	$username = $_SESSION['username']; // Retrieve the username from the session
	// 	$empid = $_SESSION['employeeid'];
	// } else {
	// 	// Redirect the user to the login page if not logged in
	// 	header("Location: index.php");
	// 	exit();
	// }

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css
">

<style>



    @keyframes typing {
        from {
            max-width: 0;
        }
        to {
            max-width: 100%;
        }
    }

    @keyframes blink {
        50% {
            border-color: transparent;
        }
    }



    .newbday {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    box-shadow: 0px 0px 15px 10px #48abe0;
    animation: shadows 1.5s infinite;
}

.newbday:hover {
    background: url('./img/bgbirthday.gif');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    box-shadow: 0px 0px 20px 15px #48abe0;
    color: white !important;
    transition: background 0.6s ease-in-out;

}

 
@keyframes shadows {
  0% {
    text-shadow: #48abe0 0 0 10px;
    box-shadow: 0px 0px 20px 10px #48abe0;
  }
  50% {
    text-shadow: blueviolet 0 0 10px;
    box-shadow: 0px 0px 20px 10px blueviolet;
  }
  75% {
    text-shadow: rebeccapurple 0 0 10px;
    box-shadow: 0px 0px 20px 10px rebeccapuprle;
  }
  100% {
    text-shadow: #48abe0 0 0 10px;
    box-shadow: 0px 0px 20px 10px #48abe0;
  }
}

    .bdaygreet {
	 animation: rotate-bg-color 10s infinite linear, confetti 10s infinite;
	}
	
	@keyframes rotate-bg-color {
	 0% {
	  background-color: #FFD700; /* Gold */
	 }
	 16.66% {
	  background-color: #FF69B4; /* Hot Pink */
	 }
	 33.33% {
	  background-color: #87CEEB; /* Sky Blue */
	 }
	 50% {
	  background-color: #FF4500; /* Orange Red */
	 }
	 66.66% {
	  background-color: #32CD32; /* Lime Green */
	 }
	 83.33% {
	  background-color: #9370DB; /* Medium Purple */
	 }
	 100% {
	  background-color: #FFD700; /* Back to Gold */
	 }
	}
	
	@keyframes confetti {
		0% {
		  box-shadow: 0 0 20px #B8860B; /* Dark Goldenrod */
		}
		16.66% {
		  box-shadow: 0 0 20px #C71585; /* Medium Violet Red */
		}
		33.33% {
		  box-shadow: 0 0 20px #4682B4; /* Steel Blue */
		}
		50% {
		  box-shadow: 0 0 20px #8B0000; /* Dark Red */
		}
		66.66% {
		  box-shadow: 0 0 20px #006400; /* Dark Green */
		}
		83.33% {
		  box-shadow: 0 0 20px #4B0082; /* Indigo */
		}
		100% {
		  box-shadow: 0 0 20px #B8860B; /* Back to Dark Goldenrod */
		}
	  }

</style>

<section class="container-fluid py-5 px-4 <?php echo $hero; ?>">

<style>
    .typed-out, .typed-out2 {
        overflow: hidden;
        display: inline-block;
        white-space: nowrap;
        border-right: 0.3em solid white;
        animation: blink 0.8s infinite;
        max-width: 0;
    }

    @keyframes typing {
        from { max-width: 0; }
        to { max-width: 100%; }
    }

    @keyframes blink {
        50% { border-color: transparent; }
    }

    .btn-custom {
        padding: 12px 20px;
        font-size: 1.3rem;
        width: 100%;
    }

    .btnlog {
     background-color: transparent;
     border: 2px solid white;
     color: white !important;
     text-decoration: none;
     cursor: pointer;
    }

    .btnlog:hover {
     background-color: white;
     border: 2px solid white;
     color: #000000 !important;
     text-decoration: none;
     letter-spacing: 1px;
    }


    .btninr {
     background-color: #0d6efd;
     border: 2px solid #0d6efd;
     color: white !important;
     text-decoration: none;
    }

    .btninr:hover {
     background-color: white;
     border: 2px solid white;
     color: #0d6efd !important;
     text-decoration: none;
     letter-spacing: 1px;
    }



    @media (min-width: 576px) {
        .btn-custom {
            width: auto;
        }
    }
</style>

<div class="container">
    <div class="row justify-content-center text-center text-sm-start">
        <div class="col-12 col-md-8">
            <div class="typed-out">
                <h1 id="typedText" class="text-white fw-bold ">Hello,</h1>
            </div>
            <br>
            <div class="typed-out2">
                <h1 id="typedText2" class="text-white fw-bold ">
                    <?php echo $name_first0 . " ". $name_last0 ; ?>
                </h1>
            </div>
            <p class="text-white ">Philkoei Intranet – Connect, collaborate, and be productive.</p>
            <div class="mt-3 d-flex flex-column flex-sm-row gap-2">
                <a data-toggle="modal" data-target="#staticBackdropActlog" 
                   class="btnlog rounded btn-custom">
                    Log your activity here
                </a>
                <a href="index.php?lst=1&lid=<?php echo $loginid; ?>&sess=<?php echo $session; ?>&p=43&title=Intra%20Feed" 
                   class="btninr btn-custom rounded">
                    Explore the Intra Feed
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function startTyping(element, textElement, nextCallback) {
            const textLength = textElement.textContent.length;
            element.style.visibility = "visible";
            element.style.animation = `typing ${textLength * 0.1}s steps(${textLength}, end) forwards, blink 0.8s infinite`;

            setTimeout(() => {
                if (nextCallback) nextCallback();
            }, textLength * 100);
        }

        const typedContainer1 = document.querySelector(".typed-out");
        const typedText1 = document.getElementById("typedText");

        const typedContainer2 = document.querySelector(".typed-out2");
        const typedText2 = document.getElementById("typedText2");

        startTyping(typedContainer1, typedText1, function () {
            startTyping(typedContainer2, typedText2);
        });
    });
</script>

</section>


<section id="myevents" class = 'my-5'>

<style>

@keyframes move {
    100% {
        transform: translate3d(0, 0, 1px) rotate(360deg);
    }
}

.background {
    position: relative;

    top: 0;
    left: 0;
    background: #121826;
    overflow: hidden;
}

.background span {
    width: 43vmin;
    height: 43vmin;
    border-radius: 43vmin;
    backface-visibility: hidden;
    position: absolute;
    animation: move;
    animation-duration: 46;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}


.background span:nth-child(0) {
    color: #004875;
    top: 79%;
    left: 62%;
    animation-duration: 42s;
    animation-delay: -30s;
    transform-origin: -14vw 20vh;
    box-shadow: -86vmin 0 11.282919925486443vmin currentColor;
}
.background span:nth-child(1) {
    color: #007e94;
    top: 26%;
    left: 1%;
    animation-duration: 41s;
    animation-delay: -21s;
    transform-origin: -10vw 5vh;
    box-shadow: 86vmin 0 11.05866177295756vmin currentColor;
}
.background span:nth-child(2) {
    color: #001c80;
    top: 100%;
    left: 61%;
    animation-duration: 21s;
    animation-delay: -18s;
    transform-origin: 1vw -16vh;
    box-shadow: -86vmin 0 11.654441870231372vmin currentColor;
}
.background span:nth-child(3) {
    color: #004875;
    top: 95%;
    left: 29%;
    animation-duration: 29s;
    animation-delay: -24s;
    transform-origin: -12vw 2vh;
    box-shadow: 86vmin 0 11.177919489987849vmin currentColor;
}
.background span:nth-child(4) {
    color: #001c80;
    top: 7%;
    left: 86%;
    animation-duration: 31s;
    animation-delay: -13s;
    transform-origin: -15vw -19vh;
    box-shadow: 86vmin 0 11.319116799945974vmin currentColor;
}
.background span:nth-child(5) {
    color: #001c80;
    top: 78%;
    left: 29%;
    animation-duration: 28s;
    animation-delay: -34s;
    transform-origin: 2vw -14vh;
    box-shadow: 86vmin 0 11.12714336158365vmin currentColor;
}
.background span:nth-child(6) {
    color: #004875;
    top: 70%;
    left: 9%;
    animation-duration: 31s;
    animation-delay: -33s;
    transform-origin: -12vw 25vh;
    box-shadow: -86vmin 0 11.26221278677362vmin currentColor;
}
.background span:nth-child(7) {
    color: #009e8c;
    top: 56%;
    left: 5%;
    animation-duration: 11s;
    animation-delay: -22s;
    transform-origin: 7vw 22vh;
    box-shadow: -86vmin 0 10.759388142608652vmin currentColor;
}
.background span:nth-child(8) {
    color: #009e8c;
    top: 99%;
    left: 21%;
    animation-duration: 8s;
    animation-delay: -29s;
    transform-origin: -24vw 8vh;
    box-shadow: -86vmin 0 10.901979983964909vmin currentColor;
}
.background span:nth-child(9) {
    color: #007e94;
    top: 80%;
    left: 81%;
    animation-duration: 39s;
    animation-delay: -15s;
    transform-origin: 7vw 4vh;
    box-shadow: 86vmin 0 11.449907629306926vmin currentColor;
}
.background span:nth-child(10) {
    color: #001c80;
    top: 99%;
    left: 21%;
    animation-duration: 32s;
    animation-delay: -5s;
    transform-origin: 25vw 16vh;
    box-shadow: -86vmin 0 11.261512122346742vmin currentColor;
}
.background span:nth-child(11) {
    color: #009e8c;
    top: 19%;
    left: 43%;
    animation-duration: 10s;
    animation-delay: -21s;
    transform-origin: 7vw 16vh;
    box-shadow: 86vmin 0 10.991925992265834vmin currentColor;
}
.background span:nth-child(12) {
    color: #004875;
    top: 44%;
    left: 85%;
    animation-duration: 21s;
    animation-delay: -29s;
    transform-origin: -8vw -13vh;
    box-shadow: 86vmin 0 10.922709019672325vmin 


}


    .mainbgforsec {
        /* background: linear-gradient(180deg, rgba(27, 50, 97, 0.8), rgba(27, 50, 97, 0.9)); */
   background-color: #121826 !important;
  
    }

    .glass {
        background: linear-gradient(180deg, rgba(50, 50, 60, 0.8), rgba(100, 180, 200, 0.3));
backdrop-filter: blur(15px);
-webkit-backdrop-filter: blur(15px);
border-radius: 20px;
border: 1px solid rgba(255, 255, 255, 0.2);

    }

    .scrollable-events {
        max-width: 100vw ;
        max-height: 190px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .scrollable-events::-webkit-scrollbar {
        width: 5px;
    }

    .scrollable-events::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.4);
        border-radius: 10px;
    }

    .scrollable-events::-webkit-scrollbar-track {
        background-color: transparent !important;
    }

    .event-item {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .event-item:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: scale(1.01);
    }


</style>

    <div class="mb-5">
    <div class="mb-4 text-center">
        <h4 class="<?php echo $subtext?> fw-semibold">My Schedule & Personal Engagements</h4>
    </div>

    <div class="mainbgforsec p-5 background">
    <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
   <span></span>
        <div class="container ">

            <div class="row align-items-start ">
   
                <div class="col-md-4 glass text-center p-4">
                    
                    <h3 class="fw-bold text-white text-Capitalize"><?php echo date("M d") ?></h3>
                    <h4 class=" text-white text-Capitalize"><?php echo date("l") ?></h4>

                </div>
    <?php 
                        require '../includes/dbh.php';
    
    ?>
                <div class="col-md-8 " id="eventsContainer" onclick='location.href="<?php echo "index.php?lst=1&lid=$loginid&sess=$session&p=44&title=My%20Event%20Planner"?>";'>
                    <div class=" scrollable-events">
                    <p class = 'text-secondary'>On going events.</p>

                        <?php 
                        $sql = "SELECT * FROM events 
                        WHERE employee_id = '$employeeid0' 
                        AND (CURDATE() BETWEEN DATE(start) AND DATE(end) OR end IS NULL) ORDER BY start ASC";
                        $result = $dbh->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $EventNow = $row['title'];
                                $timestart = date("H:i", strtotime($row['start']));
                                $timeend = date("H:i", strtotime($row['end']));
                        ?>
                   
                            <div class="event-item text-white p-3 m-2" >
                                <div class="px-4">
                                <h4 class = ''><?php echo htmlspecialchars($EventNow) ?></h4>
                                <p class="text-white fs-5"><?php echo htmlspecialchars($timestart) . " - " . htmlspecialchars($timeend) ?></p>
                                <p class="text-white fst-italic fw-lighter fs-5">Today</p>

                                </div>
                            </div>
                        
                        <?php
                            }
                        } else {
                            ?>

                                <div  onclick='location.href="<?php echo "index.php?lst=1&lid=$loginid&sess=$session&p=44&title=My%20Event%20Planner"?>";'>
                                    <p class='my-2 text-center text-white event-item'>No scheduled events at the moment. Add events to stay organized.</p>

                                </div>
<?php
                           
                        }
                        ?>
                            <?php
                        require '../includes/dbh.php';

                                $sql2 = "SELECT * FROM events WHERE employee_id = '$employeeid0' AND start BETWEEN CURDATE() + INTERVAL 1 DAY AND CURDATE() + INTERVAL 2 DAY";
                                $result2 = $dbh->query($sql2);
                                $got = 0;
                                
                                if($result2->num_rows > 0){
                                    echo " <p class = 'text-secondary mt-3'>Upcoming Events</p>";
                                    while($rows = $result2 -> fetch_assoc()){
                                        $EventNow2 = $rows['title'];
                                        $timestart2 = date("H:i", strtotime($rows['start']));
                                        $timeend2 = date("H:i", strtotime($rows['end']));
                                        $got = 1;

                                        ?>

                                    <div class="event-item text-white p-3 m-2" >
                                    <div class="px-4">
                                    <h4 class = ''><?php echo htmlspecialchars($EventNow2) ?></h4>
                                    <p class="text-white fs-5"><?php echo htmlspecialchars($timestart2) . " - " . htmlspecialchars($timeend2) ?></p>
                                    <p class="text-white fst-italic fw-lighter fs-5">Tomorrow</p>

                                    </div>
                                </div>
                                        <?php
                                    }
                                }
                                
                          
                            ?>
 </div>
                   
                    
                </div>
            </div>
        </div>
        

    </div>
    </div>
</section>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var eventsContainer = document.getElementById("eventsContainer");
        var eventItems = document.querySelectorAll(".event-item");

        if (eventItems.length >= 1) {
            eventsContainer.classList.add("scrollable-events");
        }
    });
</script>





<?php


// insert days left to change pw text and value
    // include query from ../m/qrylogin2.php
    // 20221011 update tblsysusracctmgt
    $res5query=""; $result5=""; $found5=0;
    $res5query="SELECT idtblsysusracctmgt, pwchangedt, skippwctr, skiplastdt FROM tblsysusracctmgt WHERE loginid=$loginid AND admloginid=0";
    $result5=$dbh->query($res5query);
    if($result5->num_rows>0) {
        while($myrow5=$result5->fetch_assoc()) {
        $found5=1;
        $idtblsysusracctmgt5=$myrow5['idtblsysusracctmgt'];
        $pwchangedt5 = $myrow5['pwchangedt'];
        $skippwctr5 = $myrow5['skippwctr'];
        $skiplastdt5 = $myrow5['skiplastdt'];
        } //while
    } //if
    // check condition and display days left of password
    if($pwchangedt5!="" || $skiplastdt5!="") {

        if($pwchangedt5=="0000-00-00 00:00:00") { $pwchangedt5=$datenow; }
        if($skiplastdt5=="0000-00-00 00:00:00") { $skiplastdt5=$datenow; }

        // set usrpwexpiry values
        if($empdepartment0!='FIN') { 
                $usrpwexpiry='P90D'; 
                $usrpwexpiry2=90; 
                $deptintmos=3; 
            } else { 
                $usrpwexpiry2=30; 
                $deptintmos=1; 
            }

        if($pwchangedt5!="0000-00-00 00:00:00" || $skiplastdt5!="0000-00-00 00:00:00") {

        if((strtotime($skiplastdt5) > strtotime($pwchangedt5)) && (strtotime($skiplastdt5) > strtotime($datenow))) {
            $daystochgpwprompt = round((strtotime($skiplastdt5) - strtotime($datenow)) / (60 * 60 * 24));
        } else {
            $daystochgpwprompt = round($usrpwexpiry2 - ((strtotime($datenow) - strtotime($pwchangedt5)) / (60 * 60 * 24)));
        }

            // echo "<span class=\"fs-3\">Days left to change your intranet login password:&nbsp;<strong>";

        // if($daystochgpwprompt<=5) {
        //     echo "<font color='red'>$daystochgpwprompt</font>";
        // } else {
        //     echo "$daystochgpwprompt";
        // }

            // echo "</strong></span>";
        }
    }
?>
<!-- <br>
 <span class="fs-3">Dashboard<?php echo "".$loginid.",".$empdepartment0.",".$pwchangedt5."|".strtotime($pwchangedt5).",".$skiplastdt5."|".strtotime($skiplastdt5).",".$datenow.",".$usrpwexpiry2.",".$daystochgpwprompt.""; ?></span></p> -->


 <section id="empnumbers"  class = 'my-5'>
		<div class="mx-auto w-75 py-5">
        <div class = 'mb-5 text-center'>
        <h4 class="<?php echo $subtext?> fw-semibold">PKII Workforce & Projects: By the Numbers!</h4>
    </div>
	<div class="row   row-cols-sm-1 row-cols-md-2 row-cols-lg-4  g-2 g-lg-3">

<div class="col-lg-3">
    <div class=" border-0 rounded-5 mx-auto p-5 mb-2 ">
        <div class="card-body py-0 px-4">
            <div class="row row-cols-lg-2 row-cols-md-2 ">
                <div class=" d-flex justify-content-center align-items-center">
                    <div class ='mb-3'>
                        <h3 class="card-subtitle  fw-bold <?php echo $maintext?> text-center "><?php echo "".number_format($ctrempactv, 0).""; ?></h3>
                        <h5 class="card-title fs-5 text-wrap <?php echo $maintext?>">Male</h5>
                    </div>
                </div>
                <div class=" d-flex justify-content-center align-items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="<?php echo $iconColordash?>" class="bi bi-gender-male" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8"/>
</svg>
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- card 1 end -->



	
<div class="col-lg-3">
    <div class=" border-0 rounded-5 mx-auto p-5 mb-2 ">
        <div class="card-body py-0 px-4">
            <div class="row row-cols-lg-2 row-cols-md-2 ">
                <div class=" d-flex justify-content-center align-items-center">
                    <div class ='mb-3'>
                        <h3 class="card-subtitle  fw-bold <?php echo $maintext?> text-center "><?php echo "".number_format($ctrempactvfem, 0).""; ?></h3>
                        <h5 class="card-title fs-5 text-wrap <?php echo $maintext?>">Female</h5>
                    </div>
                </div>
                <div class=" d-flex justify-content-center align-items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="<?php echo $iconColordash?>" class="bi bi-gender-female" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8M3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5"/>
</svg>
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- card 1 end -->

	
	<div class="col-lg-3">
    <div class=" border-0 rounded-5 mx-auto p-5 mb-2 ">
        <div class="card-body py-0 px-4">
            <div class="row row-cols-lg-2 row-cols-md-2 ">
                <div class=" d-flex justify-content-center align-items-center">
                    <div class ='mb-3'>
                        <h3 class="card-subtitle  fw-bold <?php echo $maintext?> text-center"><?php echo "".number_format($ctrconsactv, 0).""; ?></h3>
                        <h5 class="card-title fs-5 text-wrap <?php echo $maintext?>">Consultants</h5>
                    </div>
                </div>
                <div class=" d-flex justify-content-center align-items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="<?php echo $iconColordash?>" class="bi bi-headset" viewBox="0 0 16 16">
					<path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5"/>
					</svg>
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- card 2 end -->


	<div class="col-lg-3">
    <div class=" border-0 rounded-5 mx-auto p-5 mb-2 ">
        <div class="card-body py-0 px-4">
            <div class="row row-cols-lg-2 row-cols-md-2 ">
                <div class=" d-flex justify-content-center align-items-center">
                    <div class ='mb-3'>
                        <h3 class="card-subtitle  fw-bold <?php echo $maintext?> text-center"><?php echo $ctrprojactv; ?></h3>
                        <h5 class="card-title fs-5 text-wrap <?php echo $maintext?>">Projects</h5>
                    </div>
                </div>
                <div class=" d-flex justify-content-center align-items-center">
				<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="<?php echo $iconColordash?>" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
  <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5"/>
  <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85z"/>
</svg>
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- card 3 end -->





	
			

	</div>
</div>
</section>



<section id="intranews"  class = 'my-5'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <style>
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(27, 50, 97, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .overlay-text {
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .post-container:hover .overlay {
            opacity: 1;
        }
        
        .swiper-container {
            width: 100%;
            overflow: hidden;
            position: relative; /* Ensure buttons are positioned correctly */
        }
        .swiper-slide {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: auto;
            padding: 20px;
            cursor: pointer;
        }
        
        .post-image, .post-video {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .swiper-pagination {
            position: relative;
            margin-top: 10px;
            z-index: 1;
        }

        /* Navigation button styles */
        .swiper-button-next,
        .swiper-button-prev {
            color: white;
            background: rgb(27, 50, 97, 0.7);
            padding: 3rem;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            z-index: 1;
        }

        .swiper-button-next {
            right: 10px;
        }

        .swiper-button-prev {
            left: 10px;
        }

        @media (max-width: 768px) {
            .swiper-slide {
                padding: 10px;
            }
        }
    </style>

    <div class="container my-5">
        <div class='my-5 text-center'>
            <h4 class="<?php echo $subtext ?> fw-semibold">PKII Updates You Can’t Miss!</h4>
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper" id="latestPostsContainer"></div>

            <!-- Navigation inside swiper-container -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php
$host = "localhost";
$user = "root";
$pass = "sysad";
$dbname = "maindb";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT id, user, content, image, video, created_at FROM intranews ORDER BY created_at DESC LIMIT 4";
$result = $conn->query($query);

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}
?>

<div class="swiper-container">
    <div class="swiper-wrapper" id="latestPostsContainer">
        <?php foreach ($posts as $post): ?>
            <div class="swiper-slide <?php echo $mainbg; ?> rounded post-container" 
                onclick="window.location.href='index.php?lst=1&lid=<?php echo $loginid; ?>&sess=<?php echo $session; ?>&p=42&title=Intra%20News&postuid=<?php echo $post['id']; ?>'">

                <?php if (!empty($post['image'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>" class="post-image">
                <?php endif; ?>

                <?php if (!empty($post['video'])): ?>
                    <video class="post-video" autoplay muted playsinline>
                        <source src="uploads/<?php echo htmlspecialchars($post['video']); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>

                <div>
                    <h5 class='<?php echo $maintext; ?> text-uppercase fw-semibold'><?php echo htmlspecialchars($post['user']); ?></h5>
                    <p class='<?php echo $maintext; ?>'>
                        <?php echo htmlspecialchars(mb_substr($post['content'], 0, 100)); ?>...
                    </p>
                </div>

                <div class="overlay">
                    <div class="overlay-text">Read More</div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Swiper controls -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>

<script>
    function setEqualHeight() {
        let maxHeight = 0;
        document.querySelectorAll(".swiper-slide").forEach(el => {
            let h = el.offsetHeight;
            if (h > maxHeight) maxHeight = h;
        });
        document.querySelectorAll(".swiper-slide").forEach(el => {
            el.style.height = maxHeight + "px";
        });
    }

    var swiper = new Swiper(".swiper-container", {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 }
        },
        on: {
            init: function () {
                setTimeout(setEqualHeight, 500);
            }
        }
    });
</script>

</section>



	<div class="container my-5 ">
    
<?php if($found11==1) {
		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $emlbody, $urlpkhcarr);
		// print_r($urlpkhcarr[0]);
?>
	    <div class="row ">
<!-- <div class="jumbotron"> old -->
<div class="">

        <div class="col-md-6">
<?php
    $arrurlctr=0;
		foreach($urlpkhcarr as $val) {
			$arrurlctr++;
			$urlpkhc = $val[0];
			if($arrurlctr==1) {
			echo "<a href=\"$urlpkhc\" target=\"_blank\" class=\"btn btn-success btn-lg\" role=\"button\">PKII Health Check for ".date('D Y-M-d', strtotime($datenow))."<br>just in case you haven't filled-up for today.</a>";
			} //if
		} //foreach
?>
		</div>
        <div class="col-md-3">
		</div>
</div>
    </div> <!-- div class="row">
<?php } //if ?>

<!-- display dashboard stats -->
  


	<?php
		  $month = date('F');

	?>
<!-- <br> -->


<div class="row g-4 mt-4 ">


<div class = 'mt-5 text-center'>
        <h4 class="<?php echo $subtext?> fw-semibold">PKII Connect: Celebrations, Support & Important Dates Ahead!</h4>
    </div>

		<div class="col-md-4 px-5">
	<div class=" row">

		<div class="mt-5 rounded-2   <?php echo $mainbg?>">
		<p class = "<?php echo $maintext ?> px-5 pt-5"><?php echo "$month";?> Celebrants </p>
  <?php
    // query birthdays <5d to >30d of curr_date
    include("../m/qryddashbday.php");
    // display results
	$currentMonth = date("m");
	$currentDay = date("d");

	

    $param11 = count($employeeid11Arr);
    for ($x = 0; $x < $param11; $x++) {
		$empMonth = date("m", strtotime($emp_birthdate11Arr[$x]));
		$empDay = date("d", strtotime($emp_birthdate11Arr[$x]));

        
    if ($picfn11Arr[$x] == ''){
        $hasImage = "<img src='./img/noimage.png' class='rounded-circle  bg-white img-fluid border  $picborder ' height='70' width='70'>";
      } else {
        $hasImage = "<img src='$pathavatar/{$picfn11Arr[$x]}' class='rounded-circle bg-white img-fluid border  $picborder ' height='70' width='70'>";
      }


 
		if ($currentMonth == $empMonth && $currentDay == $empDay) {

            ?>
            <link
              rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
            />
                <?php

            echo "<div class='row newbday row-cols-md-2 row-cols-sm-1 row-cols-lg-3 p-5 $mainbg $maintext justify-content-center align-items-center text-center   mx-auto rounded-4 my-5 confetti-box' style = 'cursor: pointer;' onclick='throwConfetti()'>";

            // Image column
            echo "<div class='col-lg-4 col-md-12 col-sm-12 mt-0'>";
            echo " $hasImage  ";
            echo "</div>"; 
        
            // Name column
            echo "<div class='col-lg-4 col-md-12 col-sm-12 mt-0'>";
            echo "<p class='fs-5 fw-bold'>{$name_first11Arr[$x]} {$name_last11Arr[$x]}</p>";
            echo "</div>"; 
        

            // Birthdate column
            echo "<div class='col-lg-3 col-md-12 col-sm-12 mt-0'>";
            echo "<p class='fs-5 fw-bold'><span class='fs-2 fw-bold $maintext'> " . date("d", strtotime($emp_birthdate11Arr[$x])) . "</span><br><span class='fs-5 $mtext'>" . date("M", strtotime($emp_birthdate11Arr[$x])) . "</span></p>";
            echo "</div>"; 
        
        echo "</div>"; // row
        

		} else {
            echo "<div class='row row-cols-md-2 row-cols-sm-1 row-cols-lg-3 py-2 px-5 $maintext justify-content-center align-items-center text-center mx-auto rounded-4 my-5'>";
	
            // Image column
            echo "<div class='col-lg-4 col-md-12 col-sm-12  mt-0   '>";
            echo " $hasImage  ";
            echo "</div>"; // column
    
            // Name column
            echo "<div class='col-lg-4 col-md-12 col-sm-12 mt-0 '>";
            echo "<p class='fs-5 fw-bold'>{$name_first11Arr[$x]} {$name_last11Arr[$x]}</p>";
            echo "</div>"; // column
            
            // Birthdate column
            echo "<div class='col-lg-3 col-md-12 col-sm-12 mt-0  '>";
            echo "<p class='fs-5 fw-bol '><span class='fs-2 fw-bold $maintext'> " . date("d", strtotime($emp_birthdate11Arr[$x])) . "</span><br><span class='fs-5 $mtext'>" . date("M", strtotime($emp_birthdate11Arr[$x])) . "</span></p>";
            echo "</div>"; // column
            
            echo "</div>"; // row
		}

   
    }
?>

		</div><!-- <div class="col-md-4"> -->
	</div><!-- <div class="row"> -->
		</div><!-- <div class="col-md-4"><h4>Birthdays</h4> -->









        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.3.2/dist/confetti.browser.min.js"></script>
<script>
function throwConfetti() {
    confetti({
        particleCount: 100,
        spread: 70,
        origin: { y: 0.6 } // Confetti starts falling from the top
    });
}
</script>









		
<!-- notification rate -->





		<div class="col-md-4 px-5">
	<div class=" row">

		<div class="mt-5 rounded-2   <?php echo $mainbg?>">
		<p class = "<?php echo $maintext ?> px-5 pt-5">Rateable tickets</p>

	
	<?php
			require '../includes/config.inc';

					$yyyymm = (isset($_POST['monsel'])) ? $_POST['monsel'] :'';
					
					if($yyyymm=='') { $yyyymm="all"; }
					
					if($yyyymm != "all") {
						$cutstart = $yyyymm."-"."01";
						$cutstartarr = split("-", $yyyymm);
						$cutyear = $cutstartarr[0];
						$cutmonth = $cutstartarr[1];
						// $cutstart = date("Y-m-01", strtotime($datenow));
					} // if
					if($empdepartment0!='') {
				?>
			<?php
			include '../m/notification.php';

			$param12 = count($iditsupportreq12Arr);
			if ($param12 == 0) {
				// If there are no holidays
				echo "<h5 class = ' $subtext text-center p-5'>Great! You have rated everything! </h5>";
			} else {
			for ($x = 0; $x < $param12; $x++) {
				$found12 = 1;
				$ctr12 = $ctr12 + 1;
				
				?>
			
					<div class="row mx-auto p-4 my-4">
						<div class="col-md-12 col-lg-6 col-sm-12 text-left ">
			<?php
				
				echo "<p class = ' $subtext fs-5'> Your ticket <span class = '$maintext'>" . $ticketnum12Arr[$x] . "</span> has been approved!</p>";
				echo "<p class = ' $subtext fs-5'>Approve Date:  <span class = '$maintext'>". $closestamp12Arr[$x]."</span></p>";
				?>
						</div>
						<div class="col-md-12 col-lg-6 col-sm-12 text-left">
				<?php
				echo "<form action=\"index.php?lst=1&lid=$loginid&sess=$session&p=342\" class = 'py-3 ' method=\"POST\" name=\"mitsuppreqdtl\">";
				echo "<input type=\"hidden\" name=\"idsr\" value='" . $iditsupportreq12Arr[$x] . "'>";
				echo "<input type=\"hidden\" name=\"ctgactor\" value=\"$actor\">";
				echo "<button type=\"submit\" class=\"secondarybgc p-4 rounded-3 text-white border-0\">Rate Service</button>";
				echo "</form>";
				?>
						</div>	
						</div>	
				<?php
			}
		}

			?>
				
	

			<?php
				} else {
			?>
				<div class=""><h5 class="text-danger text-center">Sorry. No department defined on your profile.</h5></div>
			<?php
				} // if($empdepartment0!='')
			?>

	


		</div><!-- <div class="col-md-4"> -->
	</div><!-- <div class="row"> -->
		</div><!-- <div class="col-md-4"><h4>Birthdays</h4> -->





<!-- holidays -->

		<div class="col-md-4 px-5">
<div class="row">
<div class="">
   
    <div class="row">
        <div class="col-md-12 mt-5  <?php echo $mainbg?> rounded-2  ">
        <p class = "<?php echo $maintext ?> px-5 pt-5">Upcoming Holidays</p>
            <div class=' p-3 <?php echo $mainbg ?>  rounded-5'>
                <?php
                // query holidays of curr_year
					include("../m/qryddashhday.php");

					// display results
					$param12 = count($applic_date12Arr);

					if ($param12 == 0) {
						// If there are no holidays
						echo "<h5 class = ' $subtext text-center p-5' >No holiday</h5>";
					} else {
						// If there are holidays
						for($x = 0; $x < $param12; $x++) {
							echo '<div class="  border border-dark my-3 rounded p-4">';
							echo '<div class="card-body">';
							if (date("Y-m-d", strtotime($applic_date12Arr[$x])) == date("Y-m-d", strtotime($datenow))) {
								echo "<div class='row '>";
								echo '<div class="col-md-6 pt-2">';
								echo "<p class='fs-5 text-lg-start text-center $maintext'>" . $holidayname12Arr[$x] . '</p>';
								echo '</div>';
								echo '<div class="col-md-6 pt-2">';
								echo "<p class='fs-5 text-lg-end text-center  $subtext'>" . date("D Y-M-d", strtotime($applic_date12Arr[$x])) . '</p>';
								echo '</div>';
							} else {
								echo "<div class='row '>";
								echo '<div class="col-lg-6 col-md-12 col-sm-12 pt-2">';
								echo "<p class='fs-5 text-lg-start text-center $maintext'>" . $holidayname12Arr[$x] . '</p>';
								echo '</div>';
								echo '<div class="col-lg-6 col-md-12 col-sm-12 pt-2">';
								echo "<p class='fs-5 text-lg-end text-center  $subtext'>" . date("D Y-M-d", strtotime($applic_date12Arr[$x])) . '</p>';
								echo '</div>';
							} // if
							echo '</div>';
							echo '</div>';
							echo '</div>';
						}
					}

                ?> 
            </div>
        </div><!-- <div class="col-md-4"> -->
    </div><!-- <div class="row"> -->
</div><!-- <div class="col-md-4"><h4>Holidays</h4> -->







<div class="">
  
    <div class="row">
	<div class="col-md-12 mt-5  <?php echo $mainbg?> rounded-2  ">
		<p class =" <?php echo " $subtext "?> px-5 pt-5">Upcoming <?php echo "$empdepartment0"; ?> Schedule</p>
          <div class = "p-3 <?php echo " $mainbg "?> rounded-5">
				
                <?php
                    // query
                    include("../m/qryddashdsched.php");
                    // display
                    $param14 = count($idscheduler14Arr);
					if ($param14 == 0) {
						// If there are no holidays
						echo "<h5 class = ' $subtext text-center p-5'> No Schedule on your department</h5>";
					} else {
                    for ($x = 0; $x < count($datefrom14Arr); $x++) {
                        echo '<div class="col">';
                        echo '<div class=" my-3 rounded-4 px-3">';
                        echo '<div class="card-body ">';
						?>
						<div class="row">

						<div class="col-lg-6 col-md-12 col-sm-12 pt-2">
							<?php echo "<p class='card-text fs-5 text-lg-start text-center  $subtext '>" . $schedname14Arr[$x] . '</p>';?></div>
							<div class="col-lg-6 col-md-12 col-sm-12 pt-2">
						<?php
                        echo "<p class='card-text fs-5 text-lg-end text-center   $subtext'>";


                        if (date("Y-m-d", strtotime($datefrom14Arr[$x])) == date("Y-m-d", strtotime($dateto14Arr[$x]))) {
							
                            echo "<span class = '$maintext'>".date("D Y-M-d", strtotime($datefrom14Arr[$x]))."</span>";
                        } else {
                            echo "<span class = '$maintext'>".date("D Y-M-d", strtotime($datefrom14Arr[$x])) . '<br>-to-<br>' . date("D Y-M-d", strtotime($dateto14Arr[$x]))."</span>";
                        } // if
                        echo '</p>';
                      
						?>
						</div>
						

						</div>
						<?php
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
				}
                ?>
           </div>
        </div><!-- <div class="col-md-4"> -->
    </div><!-- <div class="row"> -->
</div><!-- <div class="col-md-4"><h4><?php echo "$empdepartment0"; ?> schedule</h4> -->

</div>
</div>







	
		</div>


	</div><!-- <div class="row"> -->
		</div><!-- <div class="container"> -->


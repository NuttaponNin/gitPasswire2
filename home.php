<?php session_start(); 
    if(!isset($_SESSION['username'])) {
        header('Location: index.html');
        die();
    }
$name = $_SESSION['masterUsername'];
$email = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Passwire Service</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">


    <script src="assets/js/chart-master/Chart.js"></script>
    
    <script type="text/javascript">
        //disable back button
        history.pushState(null, null, '');
        window.addEventListener('popstate', 
          function(event) {
            history.pushState(null, null, '');
          });
    </script>

  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
               <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Menu"></div>
              </div> 
            <!--logo start-->
            <a href="home.php" class="logo"><b><u>PASSWIRE</u></b><br>
                        <p>more effectiveness more simply</p>
            </a>
            <!--logo end-->
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><img src="assets/img/user.png" class="img-circle" width="80"></p>
                  <h5 class="centered"><?=$name?></h5>
                    
                  <li class="mt">
                      <a class="active" href="home.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Home</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>View Information</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="viewPassword.php">Password</a></li>
                          <li><a  href="viewNote.php">Note</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Wipe Data</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="wipePassword.php">Password</a></li>
                          <li><a  href="wipeNote.php">Note</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="#"data-toggle="modal" data-target="#popDis" >
                          <i class="fa fa-trash-o"></i>
                          <span>Disable Account</span>
                      </a>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="logout.php" >
                          <i class="fa fa-tasks"></i>
                          <span>Logout</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">              
            <div class="row">
                <div class="col-lg-9 main-chart">
                    <h3><i class="fa fa-angle-right"></i> Home</h3>
                    <br>
                    <div class="row">
                        <!-- PROFILE 02 PANEL -->
                            <div class="col-md-4 mb">
                                <div class="content-panel pn">
                                    <div id="profile-02">
          <div class="user">
                                            <img src="assets/img/user.png" class="img-circle" width="80">
            <h4><?=$name?></h4>
          </div>
                                    </div>
                                    <div class="centered">
          <h6><i class="fa fa-envelope"></i> <?=$email?></h6>
                                    </div>
                                </div><!--/panel -->
                            </div><!--/ col-md-4 -->
                                                
                            <!-- TWITTER PANEL -->
                            <div class="col-md-4 mb">
                                <div class="darkblue-panel pn">
                                
                                    <div class="darkblue-header">
                                        <h5>TEXT PASSWORD STRONG</h5>
                                    </div>
                                
                                    <canvas id="serverstatus02" height="120" width="120"></canvas>
                                
                                    <?php  
                                    include("connect.php");
                                    $password = "NULL";
                                    $percent_textPasword;                    
                                    $strSQL = "SELECT * FROM masteraccount WHERE email = '" . mysql_real_escape_string($email) . "'";
                                    $objQuery = mysql_query($strSQL);
                                    
                                    while ($info = mysql_fetch_array($objQuery)) {            
                                        $password = $info['masterTextPassword'];
                                        $percent_textPasword = $info['textScore'];
                                        
                                    }
                                    if ($password == '') {
                                        $password = "NULL";
                                    }

                                    //   $strong = 'STRONG';
                                    //   $percent = 0;
                                    //   $len = strlen($password);
                                    //   $upperCase = false;
                                    //   $lowerCase = false;
                                    //   $nubericCase = false;
                                    //   $otherCase = false;

                                      // if ($password == "NULL") {
                                      //   $percent = 0;
                                      //   $strong = 'NO Password';
                                      // }else{

                                      //   if($len < 7){
                                      //     $percent = $percent+10;

                                      //     if(preg_match("/[A-Z]/", $password)){
                                      //            $upperCase = true;
                                      //            $percent = $percent+10;
                                      //     }
                                      //     if(preg_match("/[a-z]/", $password)){
                                      //            $lowerCase = true;
                                      //            $percent = $percent+10;
                                      //     }if(preg_match("/[0-9]/", $password)){
                                      //            $nubericCase = true;
                                      //            $percent = $percent+10;
                                      //     }
                                      //     if (preg_match("/[^A-Za-z0-9]/", $password)) {
                                      //           $otherCase = true;
                                      //           $percent = $percent+20;
                                      //     }
                                          
                                      //   }elseif ($len == 7 || $len == 8 || $len == 9 || $len == 10 || $len == 11) {
                                      //     $percent = $percent+30;

                                      //     if(preg_match("/[A-Z]/", $password)){
                                      //            $upperCase = true;
                                      //            $percent = $percent+10;
                                      //     }
                                      //     if(preg_match("/[a-z]/", $password)){
                                      //            $lowerCase = true;
                                      //            $percent = $percent+10;
                                      //     }if(preg_match("/[0-9]/", $password)){
                                      //            $nubericCase = true;
                                      //            $percent = $percent+10;
                                      //     }
                                      //     if (preg_match("/[^A-Za-z0-9]/", $password)) {
                                      //           $otherCase = true;
                                      //           $percent = $percent+20;
                                      //     }

                                      //   }else{
                                      //     $percent = $percent+50;

                                      //     if(preg_match("/[A-Z]/", $password)){
                                      //            $upperCase = true;
                                      //            $percent = $percent+10;
                                      //     }
                                      //     if(preg_match("/[a-z]/", $password)){
                                      //            $lowerCase = true;
                                      //            $percent = $percent+10;
                                      //     }if(preg_match("/[0-9]/", $password)){
                                      //            $nubericCase = true;
                                      //            $percent = $percent+10;
                                      //     }
                                      //     if (preg_match("/[^A-Za-z0-9]/", $password)) {
                                      //           $otherCase = true;
                                      //           $percent = $percent+20;
                                      //     }
                                      //   }

                                        if ($percent_textPasword > 80) {
                                          $strong = 'STRONG';
                                        }elseif ($percent_textPasword > 60) {
                                          $strong = 'GOOD';
                                        }elseif ($percent_textPasword > 40) {
                                          $strong = 'NORMAL';
                                        }else {
                                          $strong = 'WEAK';
                                        }

                                      //}

                                    ?>

                                    <script>
                                        var per = <?=$percent_textPasword?>;
                                        var per2 = 100-per;
                                        var doughnutData = [
                                            {
                                                value: per,
                                                color:"#68dff0"
                                            },
                                            {
                                                value : per2,
                                                color : "#444c57"
                                            }
                                        ];
                                        var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
                                    </script>
        
                                    <!-- <p><font color="white">April 17, 2014</p> -->
                                   
                                    <footer>
        
                                        <div class="pull-left">
                                            <h5><i class="fa fa-hdd-o"></i> <?=$strong?></h5>
                                        </div>
                                    
                                        <div class="pull-right">
                                                <h5><?=$percent_textPasword?>%</h5>
                                        </div>
                                    
                                    </footer>
                                </div><!-- /darkblue panel -->
                            </div><!-- /col-md-4 -->

<!-- ****************************************************************************************************** -->

                            <!-- TWITTER PANEL -->
                            <div class="col-md-4 mb">
                                <div class="darkblue-panel pn">
                                
                                    <div class="darkblue-header">
                                        <h5>GRAPHICAL PASSWORD STRONG</h5>
                                    </div>
                                
                                    <canvas id="serverstatus03" height="120" width="120"></canvas>
                                
                                    <?php  
                                    include("connect.php");
                                    $graphical = "NULL";
                                    $percent_graphicPassword;
                                    $strGraphSQL = "SELECT * FROM masteraccount WHERE email = '" . mysql_real_escape_string($email) . "'";
                                    $objGraphQuery = mysql_query($strGraphSQL);                          

                                    while ($info = mysql_fetch_array($objGraphQuery)) {            
                                      $graphical = $info['masterGraphicalPassword'];
                                      $percent_graphicPassword = $info['graphicalScore'];           
                                    }

                                    if ($graphical == '') {
                                      $graphical = "NULL";
                                    }

                                    // $strong = 'STRONG';
                                    // $percent = 0;
                                    // $len = strlen($graphical);

                                    //   if ($graphical == "NULL") {
                                    //     $percent = 0;
                                    //     $strong = 'NO Password';
                                    //   }else{

                                    //     if($len < 7){
                                    //       $percent = $percent+10;

                                    //       if(preg_match("/[A-Z]/", $password)){
                                    //              $upperCase = true;
                                    //              $percent = $percent+10;
                                    //       }
                                    //       if(preg_match("/[a-z]/", $password)){
                                    //              $lowerCase = true;
                                    //              $percent = $percent+10;
                                    //       }if(preg_match("/[0-9]/", $password)){
                                    //              $nubericCase = true;
                                    //              $percent = $percent+10;
                                    //       }
                                    //       if (preg_match("/[^A-Za-z0-9]/", $password)) {
                                    //             $otherCase = true;
                                    //             $percent = $percent+20;
                                    //       }
                                          
                                    //     }elseif ($len == 7 || $len == 8 || $len == 9 || $len == 10 || $len == 11) {
                                    //       $percent = $percent+30;

                                    //       if(preg_match("/[A-Z]/", $password)){
                                    //              $upperCase = true;
                                    //              $percent = $percent+10;
                                    //       }
                                    //       if(preg_match("/[a-z]/", $password)){
                                    //              $lowerCase = true;
                                    //              $percent = $percent+10;
                                    //       }if(preg_match("/[0-9]/", $password)){
                                    //              $nubericCase = true;
                                    //              $percent = $percent+10;
                                    //       }
                                    //       if (preg_match("/[^A-Za-z0-9]/", $password)) {
                                    //             $otherCase = true;
                                    //             $percent = $percent+20;
                                    //       }

                                    //     }else{
                                    //       $percent = $percent+50;

                                    //       if(preg_match("/[A-Z]/", $password)){
                                    //              $upperCase = true;
                                    //              $percent = $percent+10;
                                    //       }
                                    //       if(preg_match("/[a-z]/", $password)){
                                    //              $lowerCase = true;
                                    //              $percent = $percent+10;
                                    //       }if(preg_match("/[0-9]/", $password)){
                                    //              $nubericCase = true;
                                    //              $percent = $percent+10;
                                    //       }
                                    //       if (preg_match("/[^A-Za-z0-9]/", $password)) {
                                    //             $otherCase = true;
                                    //             $percent = $percent+20;
                                    //       }
                                    //     }

                                        if ($percent_graphicPassword > 80) {
                                          $strong = 'STRONG';
                                        }elseif ($percent_graphicPassword > 60) {
                                          $strong = 'GOOD';
                                        }elseif ($percent_graphicPassword > 40) {
                                          $strong = 'NORMAL';
                                        }else {
                                          $strong = 'WEAK';
                                        }

                                      //}
                                      

                                    ?>

                                    <script>
                                        var per = <?=$percent_graphicPassword?>;
                                        var per2 = 100-per;
                                        var doughnutData = [
                                            {
                                                value: per,
                                                color:"#68dff0"
                                            },
                                            {
                                                value : per2,
                                                color : "#444c57"
                                            }
                                        ];
                                        var myDoughnut = new Chart(document.getElementById("serverstatus03").getContext("2d")).Doughnut(doughnutData);
                                    </script>
        
                                    <!-- <p><font color="white">April 17, 2014</p> -->
                                   
                                    <footer>
        
                                        <div class="pull-left">
                                            <h5><i class="fa fa-hdd-o"></i> <?=$strong?></h5>
                                        </div>
                                    
                                        <div class="pull-right">
                                                <h5><?=$percent_graphicPassword?>%</h5>
                                        </div>
                                    
                                    </footer>
                                </div><!-- /darkblue panel -->
                            </div><!-- /col-md-4 -->
            
                    </div><!-- /row --> 
          
                </div><!-- /col-lg-9 END SECTION MIDDLE -->             
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
            </div><! --/row -->
          </section>
      </section>

  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
  <script src="assets/js/zabuto_calendar.js"></script> 
  
  <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
     
   <!-- Modal popDis-->
  
        <div class="modal fade" id="popDis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <div class="modal-header" style="background-color: #ed8824 ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Disable Account!</h4>
              </div>

              <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-2">
                    <h5><b> Please comfirm your master password</b></h5>
                      <form class="form-signin" method="post" action="checkMasterPasswordForDisableAccount.php">
                          <input type="password" name="password" class="form-control" placeholder=" master password">
                          <br>
                          <button type="button" class="graphic" data-toggle="modal" data-target="#popGraphical"><span>Graphical </span></button>
                          <p> Your account will be deleted from the server.</p>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-warning" value ="Confirm">
                          </div>
                      </form>
                </div>
              </div>

            </div>
          </div>                  
        </div>
  <!-- END Modal popDis-->
  
 
<script>
    $( document ).ready(function() {
        
        $(".modalAccept").on('click',function(){
        
        
    });
});
</script>

<!-- About Function Graphical MasterPassword -->
<script type="text/javascript">

var password = '';

function addPasscode(key) {
  password += key;
}
function previewImage(elm) {
  var img = $('#uploadImg');
  if (elm.files[0]) {
    img.attr('src', URL.createObjectURL(elm.files[0]));
    img.show();
  }
  else {
    img.attr('src', null);
    img.hide();
  }
}
function uploadImage() {
  var fileObj = document.getElementById('selectFile').files[0];
  var imgPath = $('#uploadImg').attr('src');
  var fileName = $('#selectFile').val();
  if (imgPath) {
    var data = new FormData();
    data.append('file', fileObj);
    $.ajax({
      url : 'uploadImage.php',
      type: 'POST',
      data: data,
      contentType: false,
      processData: false,
      success: function(data) {        
        $.ajax({
           type: "POST",
            url: "checkGraphicalPassword.php",
            data : {'password': password},
            success: function(data) {
              // alert('login success');
              window.location = 'sendMail_for_disAccount.php?graphic='+password;
            },
            error: function() {
              alert('Wrong password. Try again.');
              password = '';
            }
          });
        // alert("upload image successfully");
        
      },    
      error: function() {
        alert("upload image failure");
      }
    });
  }

  console.log('graphical password is "' + password + '"');
}

function setGrid() {
  var row = 7;
  var col = 5;
  var img = $('#uploadImg');
  var width = parseInt(img.outerWidth(true)/col);
  var height = parseInt(img.outerHeight(true)/row);
  // img.width(width*col).height(height*row);
  console.log('width: ' + width);
  console.log('height: ' + height);

  var content = '<table style="margin:auto;">';
  for(var i=0;i<row;i++) {
    content += '<tr>';
    for(var j=0;j<col;j++) {
      var key = (i+1) + String.fromCharCode(65 + j);
      content += `<td style="width:${width}px; height:${height}px" onclick="addPasscode('${key}')"></td>`;
    }
    content += '</tr>';
  }
  content += '</table>';
  $('#imageGrid').empty();
  $('#imageGrid').append(content);
  password = '';
}
</script>
<!-- END About Function Graphical MasterPassword -->

<!-- Modal popGraphical-->
  
        <div class="modal fade" id="popGraphical" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <div class="modal-header" style="background-color: #ed8824 ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Graphical Password</h4>
              </div>

              <div class="row">
                <div class="col-sm-12">
                    <h5><b> Please enter your Graphical Password.</b></h5><br>
                    
                        <label style="margin-bottom: 10px;">
                          <input id="selectFile" name="myfile" type="file" size="30" onchange="previewImage(this)" />
                        </label>
                        <iframe id="uploadTarget" name="uploadTarget" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                        
                        <div style="position: relative; margin: auto; width: 250px; height: 350px;">
                            <!-- <embed id="UploadedFile" src="" width="390px" height="160px"> -->
                            <div id="imageGrid" ></div>
                            <img id="uploadImg" onload="setGrid()" />
                        </div>

                        <div class="modal-footer" style="margin-top: 15px;">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-warning" value ="Confirm" onclick="uploadImage()">
                        </div> 
                      <!-- </form> -->
                </div>
              </div>

            </div>
          </div>                  
        </div>
<!-- END Modal popGraphical-->

  </body>
</html>

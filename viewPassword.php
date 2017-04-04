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
    <script type="text/javascript" src="js/passwordGrapicalFunction.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
              
                  <p class="centered"><a href="profile.html"><img src="assets/img/user.png" class="img-circle" width="80"></a></p>
                  <h5 class="centered"><?=$name?></h5>
                    
                  <li class="mt">
                      <a href="home.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Home</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a class="active" href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>View Information</span>
                      </a>
                      <ul class="sub">
                          <li class="active"><a  href="viewPassword.php">Password</a></li>
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
                      <a href="#"data-toggle="modal" data-target="#popCheckPass" onclick="lnkDisableAccount()" >
                          <i class="fa fa-trash-o"></i>
                          <span>Disable Account</span>
                      </a>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="Logout.php" >
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
                    <h3><i class="fa fa-angle-right"></i> View Password Information</h3>
                    
                    <div class="row mt">                        
                    <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">	                  	  	  
                              <thead>
                              <tr>
                                  <th><i class="fa fa-bookmark"></i> Title</th>
                                  <th><i class="fa fa-user"></i> Username</th>
                                  <th><i class="fa fa-lock"></i> Password</th>
                                  <th><i class="fa fa-edit"></i> Description</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                            <?php
                            
                            // Connects to your Database
                            $username = $_SESSION['username'];
                            $accountID_masteracc_table = $_SESSION['masterID'];
                            // include("connect.php");
                            require "connect.php";
                            include ("cryptographyinitforweb.php");
                            $masterID = $_SESSION['masterID'];
                            $key = makeKey($masterID);

                            // $iv = "C.Tain,Miss you.";
                            // $key = "I want to see you so bad :/";

                            $data = mysql_query("SELECT * FROM `storedaccount` WHERE masterID = '"
                                    . mysql_real_escape_string($accountID_masteracc_table) . "'")
                                    or die(mysql_error());
                            while ($info = mysql_fetch_array($data)) {
                              $decrypted_title = openssl_decrypt($info['title'],"AES-256-CBC",$key, 0, $iv);
                            ?>
                                    <tr>
                                        <td><?=$decrypted_title?></td>                                        
                                        <!-- <td><?=$decrypted_username?></td> -->
                                        <?php $username = "cilk item to show"?>
                                        <td><?=$username?></td>                                        
                                        <?php $password = "xxxxxxxxxx"?>
                                        <td><?=$password?></td>
                                        
                                        <?php $description = "cilk item to show"?>
                                        <td><?=$description?></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#popCheckPass" onclick="viewButtonOnClick(<?=$info['accountID']?>)"><i class="fa fa-search"></i></button>
                                        </td>                                        
                                    </tr>  
                            <?php
                                }
                            ?>                          
                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
                  </div><!-- /row -->
                
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
            </div><! --/row -->
          </section>
      </section>
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jjquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
  

  <!-- Modal popCheckPass-->
  
        <div class="modal fade" id="popCheckPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <div class="modal-header" style="background-color: #ed8824 ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">View Password Information</h4>
              </div>

              <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-2">
                    <h5><b> Please comfirm your master password</b></h5>
                      <form class="form-signin" method="post" action="checkMasterPasswordForShowData.php">
                          <input type="password" name="password" class="form-control" placeholder=" master password">
                          <br>
                          <button type="button" class="graphic" data-toggle="modal" data-target="#popGraphical" onclick="resetImage()"><span>Graphical </span></button>
                          <p> Your information will be shown from the server.</p>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-warning" value ="Confirm">
                          </div>

                          <input type="hidden" name="passDataId" id='txtPassDataId' />
                      </form>
                </div>
              </div>

            </div>
          </div>                  
        </div>
<!-- END Modal #popCheckPass -->

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
                            <!-- <label>
                                <input type="submit" name="submitBtn" class="btn btn-success" value="Upload" />
                            </label> -->
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

<!-- About Function Graphical MasterPassword -->
<script type="text/javascript">

var password = '';

// function addPasscode(key) {
//   password += key;
// }
function resetImage(){
  var inputImage = document.getElementById('selectFile');
  inputImage.value = '';
  previewImage(inputImage);
  $('#imageGrid table').remove();
}
// function previewImage(elm) {
//   var img = $('#uploadImg');
//   if (elm.files[0]) {
//     img.attr('src', URL.createObjectURL(elm.files[0]));
//     img.show();
//   }
//   else {
//     img.attr('src', null);
//     img.hide();
//   }
// }
var cmd=null;
function lnkDisableAccount(){
  cmd=0;
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
             switch(cmd){
              case 0:
                window.location = 'sendMail_for_disAccount.php?graphic='+password;                
                break;
              case 1:
                //alert('go to showPassInformation');
                window.location = 'showPassInformation.php?passDataId='+document.getElementById('txtPassDataId').value;
                break;
              default:
                alert('unknown command');
                break;
            }
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

</script>
<!-- END About Function Graphical MasterPassword -->

<!-- Modal #popInformationPass -->
    <div class="modal fade" id="popInformationPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
    
      <!-- Modal content-->
        <div class="modal-content">

              <div class="modal-header" style="background-color: #ed8824 ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Password Information</h4>
              </div><!-- modal-header -->

              <div class="row">
                <div class="col-md-12">
                    <h5><b> Your Information</b></h5>
                      <form class="form-signin">
                          
                        <div class="row mt">                        
                          <div class="col-md-12">
                            <div class="content-panel">

                              <table class="table table-striped table-advance table-hover">                           
                                <thead>
                                  <tr>
                                    <th><i class="fa fa-bookmark"></i> Title</th>
                                    <th><i class="fa fa-user"></i> Username</th>
                                    <th><i class="fa fa-lock"></i> Password</th>
                                    <th><i class="fa fa-edit"></i> Description</th>
                                    <th><i class="fa fa-clock-o"></i> Update</th>
                                    <th></th>
                                  </tr>
                                </thead>

                                <tbody id='infomation'>
                                  <tr>

                                    <?php                            
                                      // Connects to your Database
                                      $username = $_SESSION['username'];
                                      $accountID_masteracc_table = $_SESSION['masterID'];
                                    ?>
                                                    
                                </tbody>

                              </table>

                            </div><!-- /content-panel -->
                          </div><!-- /col-md-12 -->
                        </div><!-- /row -->
                  
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>

                      </form>
                </div><!-- col-md-12 -->
              </div><!-- row -->

            </div><!-- modal-content -->
      <!-- END Modal content-->

      </div><!-- modal-dialog -->
    </div><!-- modal fade -->    
<!-- END Modal #popInformationPass -->

    <script type="text/javascript">
      function viewButtonOnClick(accountID){
        cmd=1;
        document.getElementById('txtPassDataId').value=accountID;
        var dataPost = { "accountID": accountID };
        $.ajax({
            type: "GET",
            //traditional: true,//สำหรับส่งค่าที่เป็น list ,array
            url: '/passwire/showPassInformation.php',
            data: dataPost,
            async: false,
            success: function (result, status, xhr) {
              document.getElementById('infomation').innerHTML=result;
                //alert("result: " + result +
                //    "\nstatus: " + status +
                //    "\nxhr" + xhr);

                //grid.removeRow(row);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }

        })
      }
    </script>  

   </body>
</html>

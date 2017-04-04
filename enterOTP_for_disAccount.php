<?php session_start(); 
    if(!isset($_SESSION['username'])) {
        header('Location: index.html');
        die();
    }
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
                      <a class="active" href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Wipe Data</span>
                      </a>
                      <ul class="sub">
                          <li  class="active"><a  href="wipePassword.php">Password</a></li>
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
                    <h3><i class="fa fa-angle-right"></i> ENTER OTP FOR DISABLE ACCOUNT</h3>
                    <form class="form-signin" method="post" action="otpcheck_and_disAccount.php">
                        <input type="text" name="yourotp" class="form-control" required autofocus><br>
                        <!--<?php
                          // echo '<input type="hidden" name="accountId" value="'.$_GET["accountId"].'"/>';
                        ?>-->
                        <button class="btn btn-lg btn-primary btn-block">SUBMIT</button>            
                    </form>

                    <p>
                        <div class="text-center description">
                            <font color="red">*OTP verification code is only valid for 30 minutes..*</font>
                        </div>
                    </p>
                    
                    
                
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
            </div><!--col-lg-9 main-chart -->
            </div><!--row -->
          </section><!-- wrapper -->
      </section><!-- main-content -->
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
  
   <!-- Modal -->
  
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

  <!-- Modal popCheckPass-->
  
        <div class="modal fade" id="popCheckPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

        var dataPost = { "accountID": accountID };
        $.ajax({
            type: "GET",
            //traditional: true,//สำหรับส่งค่าที่เป็น list ,array
            url: '/passwire/getInformation.php',
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

<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="90"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Passwire Service</title>
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/loginStyle.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> 
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>    
  </head>

  <body>
      <div class="logo">
                <h1><u>PASSWIRE</u></h1>
                <p>more effectiveness more simply</p>
      </div>
      
      <div class="container-fluid">      
        
        <div class="row">
          <div class="col-sm-6 col-md-4 col-md-offset-4">
              <div class="account-wall">
                <div class="text-center Title">Mobile Lost!</div>                   
                    
                    <form class="form-signin" action="backupData.php">
                       
                        <div class="cities">
                            <h5>
                                <b>OTP COMPLETE</b>
                            </h5>
                            
                            <p>                            
                                The system already backed up your information for you as an Email. 
                            </p>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block">OK</button>              
                    </form>
                    
                </div>
              </div>
          </div>
        </div>
      
<script>
    $( document ).ready(function() {
        
        $(".modalAccept").on('click',function(){
        
        
    });
});
   
</script>
      
        <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
          <!-- Wrapper f
            <div class="item">
              <h4>"You can Wipe Data."</h4>
            </div>or slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
              <h4>"You can Recover Data."</h4>
            </div>
            <div class="item">
              <h4>"You can Wipe Data."</h4>
            </div>
            <div class="item">
              <h4>"You can Disable Account."</h4>
            </div>
        </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">    
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />         
    <title>Techologys</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/worldicon.png" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css">    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>     
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/index.js"></script>    
 </head>
 <div class="TEST"></div>
 <?php
    //retrieve session data

    $base = '';
    //$base = 'https://secure.BlueHost.com/~techolo3/';
?>
<style>
ul li:hover{
    background-color: #E7E7E7;
}

.container .navbar-header, .container .collapse.navbar-collapse{
  padding-top: 0px;
}

.row-centered {
    text-align:center;
}
.col-centered {
    display:inline-block;
    float:none;
    /* reset the text-align */
    text-align:center;
    /* inline-block space fix */
    margin-right:-4px;
}

small{
  margin: 5px;
}

     input, .row a, h1{
      margin: 10px;
      padding: 10px;
      width:300px;
      display: inline-block;
     }
     .row li{
      list-style-type: none;
     }

  #footer{
    background-color: #f8f8f8;
  }
</style>
 <body>
     
     <div class ="navbar navbar-default" style="margin-bottom: 0px; margin-top: 0px">

             <div class="container">                                 
                <!-- .btn-navbar is used as the toggle for collapsed navbar content -->                 
                <!-- Be sure to leave the brand out there if you want it shown -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Techologys</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>                      
                </div>

                <div class="collapse navbar-collapse">
                   <ul class="nav navbar-nav">
                       <li><a href="<?php echo $base.Yii::app()->CreateUrl('Site/index')?>">Home</a></li>
                       <li><a href="<?php echo $base.Yii::app()->createUrl('Site/University')?>">Universities</a></li>
                       <li><a href="<?php echo $base.Yii::app()->createUrl('Site/Investor')?>">Investors</a></li>
                       <li><a href="<?php echo $base.Yii::app()->createUrl('Site/Mission')?>">Mission</a></li>
                        <?php       
                              if(!isset($_SESSION)){session_start();}
                                  if(array_key_exists('user', $_SESSION)){                         
                                      $id = (string)$_SESSION['user'];
                                      $id = strval($id);
                                      $userModel = User::model()->findByPk($id);
                                      if(isset($userModel)){                            
                                          if($userModel->ADMIN){
                                              echo "<li><a href='".Yii::app()->createUrl('Admin/index')."'>Admin</a></li>";
                                          }
                                      }                
                                  }       
                        ?>   
                   </ul>
               <!--    <form class="navbar-form navbar-right" role="search">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                      </div>
                      <button type="submit" class="btn btn-success">Search</button>
                    </form>-->
                   <ul class="nav navbar-nav navbar-right">
                              <?php       
                              if(!isset($_SESSION)){session_start();}
                                  if(array_key_exists('user', $_SESSION)){                         
                                      echo"<li><a href='".Yii::app()->createUrl('Site/Logout')."'>Sign Out</a></li>";            
                                      $id = (string)$_SESSION['user'];
                                      $id = strval($id);
                                      $userModel = User::model()->findByPk($id);
                                      if(isset($userModel)){                            
                                          if($userModel->ADMIN){
                                            //  echo "<li><a href='".Yii::app()->createUrl('Admin/index')."'>Admin</a></li>";
                                          }
                                      }                
                                  }
                                  else{
                                      echo'<li><a tabindex="-1" href="'.Yii::app()->CreateUrl('Site/LoginView').'">Sign In</a></li>';
                                  }            
                              ?>   
                   </ul>                     
                </div>
                



             </div><!-- container-->        
     </div><!-- navbar-->
     
       <?php      
           $mType = "alert";
           if(isset($message)){               
                if($message !==""){
                    if(isset($messageType)){
                        $mType = $messageType;
                    }
                    echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.
                    $message . '</div>';          
                }       
            }
        ?> 
    
  <script type="text/javascript">        
    $(document).ready(function () {
        $(function(){
            $('.nav li a').on('click', function(e){
               // e.preventDefault(); // prevent link click if necessary?

                var $thisLi = $(this).parent('li');
                var $ul = $thisLi.parent('ul');

                if (!$thisLi.hasClass('active'))
                {
                    $ul.find('li.active').removeClass('active');
                        $thisLi.addClass('active');
                }
            })
        })
    });
</script>
     
     
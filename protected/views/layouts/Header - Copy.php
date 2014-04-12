
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">    
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="en" />         
    <title>TechChute</title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>     
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
 </head>
 <body>
     
     <div class ="navbar">
         <div class="navbar-inner">
             <div class="container">                                 
                <!-- .btn-navbar is used as the toggle for collapsed navbar content -->                 
                <!-- Be sure to leave the brand out there if you want it shown -->
                <a class="brand" href="index.php">TechChute</a>
                  
                   <ul class="nav">
                       <li><a href="<?php echo Yii::app()->CreateUrl('Site/index')?>">Home</a></li>
                       <li><a href="<?php echo Yii::app()->createUrl('Site/University')?>">Post</a></li>
                       <li><a href="<?php echo Yii::app()->createUrl('Site/Investor')?>">Invest</a></li>
                       <li><a href="<?php echo Yii::app()->createUrl('Site/Mission')?>">Mission</a></li>
                   </ul>
                   <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
                        <ul class="dropdown-menu pull-right">
                        <!--<li><a tabindex="-1" href="#">Settings</a></li>-->
                        <?php           
                            if(!is_null(Yii::app()->request->cookies['user'])){                         
                                echo"<li><a href='".Yii::app()->createUrl('Site/Logout')."' class='navbar-btn'>Log Out</a></li>";            
                                $id = (string)Yii::app()->request->cookies['user'];
                                $id = strval($id);
                                if(!is_null(User::model()->findByPk($id))){
                                    $user = User::model()->findByPk($id);
                                    if($user->ADMIN){
                                        echo "<li><a href='".Yii::app()->createUrl('Admin/index')."' class='navbar-btn'>Admin</a></li>";
                                    }
                                }                
                            }
                            else{
                                echo'<li><a tabindex="-1" href="'.Yii::app()->CreateUrl('Site/Login').'">Sign In</a></li>';
                            }            
                        ?>    
                        <li><a tabindex="-1" href="#">Help</a></li>    
                        </ul>
                    </li>
                </ul>


                <div class="nav pull-right">
                    <a type="submit"class="btn btn-success .navbar-btn pull-right" href="#">Search</a>&nbsp             
                </div>

                <form class="navbar-search pull-right">
                    <input type="text" class="search-query" style="height: 30" placeholder="Search">
                </form>

                <div class="navbar-text pull-left"><i class="icon-globe"></i> Latest News...</div>

             </div><!-- container-->
          </div><!-- navbar inner-->
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

<div class="container">
  <div class="content">
    
  </div>
</div>

<div class="container">
    <p>
    <div style="" class="pagination-centered"><small>
        TechChute<br>
        Copyright 2013<br>
        All Rights Reserved</small>
    </div>    
    </p>
</div>  
<!--   <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>-->
</html>

     
<?php include 'protected/views/layouts/HeaderSecure.php';?>
     <style>
     input, .row a, h1{
      margin: 10px;
      padding: 10px;
      width:300px;
      display: inline-block;
     }
     .row li{
      list-style-type: none;
     }
     </style>
     <div class ="container">
      <div class="row row-centered">
       <div class="col-md-4 col-centered"><h1>Sign In</h1></div>      
         <form method="post" id="signin" action="<?php echo Yii::app()->createUrl('site/SignIn')?>">
          <ul class="col-md-4 col-centered">
             <li><input type="text" name="email" placeholder="email"></li>
             <li><input type="password" name="password" placeholder="password"></li>
             <li><input type="submit" class="btn btn-success" value="Sign In"></li>
             <li><a href="#">forgot password?</a>                  
             <li><a class='btn btn-primary btn-large'>Sign in with Twitter</a></li>       
             <li><a class='btn btn-primary btn-large'>Sign in with Facebook</a></li>
             <li><a class='btn btn-primary btn-large'>Sign in with LinkedIn</a></li>        
             <li><a class="btn btn-success" href="<?php echo Yii::app()->createUrl('Site/CreateAccountView')?>">Create Account</a></li>                          
          </ul>
        </form>
      </div><!-- row -->
    </div><!-- container -->

<?php include 'protected/views/layouts/Footer.php'?>
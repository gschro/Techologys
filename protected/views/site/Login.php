<?php include 'protected/views/layouts/Header.php';?>
     
     <div class ="container">
       <div class="pagination-centered"><h1>Sign In</h1></div><br>
       <div class="pagination-centered">
         <form method="post" id="signin" action="<?php echo Yii::app()->createUrl('site/SignIn')?>">
            <input type="text" name="email" placeholder="email"><br>
            <input type="password" name="password" placeholder="password"><br>
            <input type="submit" class="btn btn-success" value="Sign In"><br><br>
            <a href="#">forgot password?</a>
         </form>
       </div><br><br>
       <p>
       <div class ="pagination-centered">
         <a class='btn btn-primary btn-large'>Sign in with Twitter</a><br><br>
         <a class='btn btn-primary btn-large'>Sign in with Facebook</a><br><br>
         <a class='btn btn-primary btn-large'>Sign in with LinkedIn</a><br><br>         
         <a class="btn btn-success" href="<?php echo Yii::app()->createUrl('Site/CreateAccountView')?>">Create Account</a>                  
       </div>
       </p>
    </div>

<?php include 'protected/views/layouts/Footer.php'?>
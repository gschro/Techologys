<?php include 'protected/views/layouts/Header.php'?>

     
     <div class ="container">
         <form method="post" id="form" action="<?php echo Yii::app()->createUrl('Site/createAccount')?>">
         <div class="row">
             <div class="pagination-centered">
                 <p>
                 <ul class="media-list">
                 <li><input type="text" placeholder="First Name" name="firstName"></li>
                 <li><input type="text" placeholder="Last Name" name="lastName"></li>                 
                 <li><input type="text" placeholder="University/Company" name="universityCompany"></li>                 
                 <li><input type="text" placeholder="ex. person@univ.edu" name="email"></li>
                 <li><input type="password" placeholder="password" name="password"></li>
                 <li><input type="password" placeholder="confirm password" name="confirmPassword"></li>                 
                 </ul>
                 <input type = "submit" class="btn btn-success" value="Create Account"/>
                 </p>
             </div>
         </div>
         </form>
     </div>

<?php include 'protected/views/layouts/Footer.php'?>
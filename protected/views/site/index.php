<?php 
 //   if(isset($_SESSION['user'])){
        include 'protected/views/layouts/HeaderSecure.php';
     // }
     // else{
     //    include 'protected/views/layouts/Header.php';
     // }http://media-cache-ak0.pinimg.com/736x/c6/cb/9d/c6cb9d373ef77afffed01ce74e814b0f.jpg
?>
<style>

#start1, #start2, #start3, #start4{
    height: 400px;
    padding-top: 0px;
    margin-top: 0px;
}
#start1 {
    background-image: url("http://www.dgipl.com/corpstarter/jiangsu/images/banner_history.jpg");
}

#start1 img{
    margin-top: 20px
}
#start1 p{
    color: white;
    padding-top: 20px;
    margin-top: 0px;
}
#start1 a{
    padding-top: 10px;
    margin-top: 10px;
}

#start3 {
    background-color: black;
    color: #f8f8f8;
}

#start2{
    background-color: #f8f8f8
}
#start4{
    background-color: #f8f8f8;
}

h1{
    margin-top: 0px;
    font-size: 56px;
}

.container div{
    padding-top: 20px;
    margin-top: 0px;    
}

.container div p{
    padding-top: 20px;
    margin-top: 0px;  

}

.footer{
    padding-top:20px;
}

.glyphicon{
    font-size: 1500%;
    margin: 20px;
}

.glyphicon-road{
    color: black;
}

.glyphicon-magnet{
    font-size: 1800%;
    color: #f8f8f8;
    margin-left: 0px;
}

.glyphicon-usd{
        font-size: 1800%;
    color: black;
    margin-left: -10px;
}
.row p{
    margin: 20px;
    padding: 10px;
}

.row p a{
    margin-left: -10px;
    padding-left: 0px;
}

</style>



    <div id="start1">

        <div class="container">
        <div class ="row">
            <div class="col-md-8">
                <img src="images\Techologys-Logo.gif" />
                <p>Connecting Universities and Investors</p>         
                <a href="<?php echo Yii::app()->createUrl('Site/LoginView'); ?>" class="btn btn-success btn-large">Sign Up &raquo;</a>                                
            </div>
        </div>
    </div>
    </div>
<div id="start2">
<div class ="container">
    <div class="row">
            <div class="col-md-8">
                <h1>Mission</h1>
                <p>Our mission is to provide an environment that allows investors and universities to benefit from each other</p>
                <p>We pride ourselves on helping everyone achieve their financial goals</p>
                <p><a class="btn btn-success" href="<?php echo Yii::app()->createUrl('Site/Mission') ?>">Learn More</a></p>
            </div>                
            <div class="col-md-4 hidden-xs">
                <span class="glyphicon glyphicon-road"></span>
            </div>
        <div class="col-md-6">

        </div><!-- .col-md-4 -->
    </div>
</div>
</div>
    <div id="start3">
        <div class="container">
    <div class="row">
            <div class="col-md-8">
                <h1>Universities</h1>
                <p>Attract investors on a level playing field</p>
                <p>Learn how to leverage existing research to bring funding and prestige to your school</p>                
                <p><a href="<?php echo Yii::app()->createUrl('Site/University')?>" class="btn btn-success">Go</a></p>
            </div>                
            <div class="col-md-4 hidden-xs">
                <span class="glyphicon glyphicon-magnet"></span>
            </div>
 </div><!-- .row -->

</div><!-- container-->
</div>
<div id="start4">
        <div class="container">
 <div class="row">             
            <div class="col-md-8">
                <h1>Investors</h1>
                <p>Find the technologies that will make the greatest return on investment</p>                    
                <p>Partner with Universities for steady streams of outside research</p>                                    
                <p><a href="<?php echo Yii::app()->createUrl('Site/Investor')?>" class="btn btn-success">Go</a></p>               </div>                
            <div class="col-md-4 hidden-xs">
                <span class="glyphicon glyphicon-usd"></span>
            </div>
 </div><!-- .row -->
   </div><!-- container-->
</div>
</div>

</body>

<?php include 'protected/views/layouts/Footer.php' ?>
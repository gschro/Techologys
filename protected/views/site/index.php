<?php 
    if(isset($_SESSION['user'])){
        include 'protected/views/layouts/HeaderSecure.php';
     }
     else{
        include 'protected/views/layouts/Header.php';
     }
?>


<div class ="container">

    <div>
        <img src="images\Techologys-Logo.gif" />
    </div>
    <div class ="hero-unit">
        <!--<h1>TechChute</h1>-->    <p><a href="<?php echo Yii::app()->createUrl('Site/LoginView'); ?>" class="btn btn-primary btn-large pull-right">Sign Up &raquo;</a><p/>
        <p>Welcome to Techologys, connecting technology and investors</p>         
    </div>

    <div class="row">
    <!-- -->
    <div id="this-carousel-id" class="carousel slide span6"><!-- class of slide for animation -->
        <div class="carousel-inner">
            <div class="item active"><!-- class of active since it's the first item -->
                <img src="http://www.seewithsound.com/upload/pics/pic5108df017bb56.jpg"alt="" />
                <div class="carousel-caption">
                    <p><b>Universities</b><br>
                        Post your universities technology</p>
                </div>
            </div>
            <div class="item">
                <img src="http://www.ebuzz.co.kr/static/news/issue/__icsFiles/thumbnail/2012/01/16/c_bk010601_91431_1.jpg" alt="" />
                <div class="carousel-caption">
                    <p><b>Investors</b><br>
                        Find the perfect technology for you</p>
                </div>
            </div>
            <div class="item">
                <img href="<?php echo Yii::app()->createUrl('Site/Mission') ?>"src="http://media-cache-ak0.pinimg.com/736x/c6/cb/9d/c6cb9d373ef77afffed01ce74e814b0f.jpg" alt="" />
                <div class="carousel-caption">
                    <p><b>Our Mission</b><br>
                        Matching technology, education, and business</p>
                </div>
            </div>
            <div class="item">
                <img src="http://placehold.it/1200x480" alt="" />
                <div class="carousel-caption">
                    <p><b>News</b><br>
                        New developments</p>
                </div>
            </div>
        </div><!-- /.carousel-inner -->
        <!--  Next and Previous controls below
              href values must reference the id for this carousel -->
        <a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->
    <!-- -->         
        <div class="span6">
            <h2>Mission</h2>
            <p>Our mission is to unite technology and investors through lots of good stuff like this website</p>
            <p>We pride ourselves on this and that and that other stuff</p>
            <p><a class="btn" href="<?php echo Yii::app()->createUrl('Site/Mission') ?>">Learn More</a></p>
        </div><!-- .span4 -->
    </div>
    <div class="row">
        <ul class="thumbnails">
            <li class="span6">
                <a href="<?php echo Yii::app()->createUrl('Site/University')?>" class="thumbnail">
                    <img src="http://ts1.mm.bing.net/th?id=H.4788967052673700&pid=1.7" alt="">
                </a>
                <h3>Universities</h3>
                <p>Sign in to the university portal</p>
                <p><a href="<?php echo Yii::app()->createUrl('Site/University')?>" class="btn btn-success">Go</a></p>
            </li>    
            <li class="span6">
                <a href="<?php echo Yii::app()->createUrl('Site/Investor')?>" class="thumbnail">
                    <img src="http://ts3.mm.bing.net/th?id=H.4890968199136582&pid=1.7" alt="">
                </a>
                <h3>Investors</h3>
                <p>Sign in to the investor portal</p>                    
                <p><a href="<?php echo Yii::app()->createUrl('Site/Investor')?>" class="btn btn-success">Go</a></p>                
            </li> 
        </ul>

 </div><!-- .row -->


   

</div><!-- container-->
</body>

<?php include 'protected/views/layouts/Footer.php' ?>
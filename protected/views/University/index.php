<?php include 'protected/views/layouts/Header.php' ?>


<div class ="container">
    <div class="row">
        <div class="span8">
            <div class="row">
                <h2>Welcome, person!</h2>                                    
            </div>     
            <div class="row">
                Messages<br>
                News<br>
            </div>
            <div class="row">
                <a href="<?php echo Yii::app()->createUrl('site/TechList') ?>" class="btn btn-primary">View All Technologies</a>
            </div>
        </div>
        <div class="span3 offset9">
            <h3>My Technologies</h3>
            <ul class="nav nav-tabs nav-stacked">
                <li><a href="">Tech1</a></li>
                <li><a href="">Tech2</a></li>
                <li><a href="">Tech3</a></li>                
            </ul>            
        <a class="btn btn-success" href="<?php echo Yii::app()->createUrl('site/AddTech') ?>">List a Technology</a>        
        </div>
    </div>
</div>
             </div>

             <?php include 'protected/views/layouts/Footer.php' ?>
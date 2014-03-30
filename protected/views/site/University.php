<?php include 'protected/views/layouts/Header.php' ?>


<div class ="container">
    <div class="row">
        <div class="span8">
            <div class="row">
                <h2>Welcome, <?php 
                    $ea = EmailAccount::model()->findByPK(Yii::app()->request->cookies['user']->value);
                    echo $ea->FIRSTNAME;
                ?>!</h2>                                    
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
                <?php 
                    $listings = Listing::model()->findAllByAttributes(array("USERID"=>$ea->USERID));
                    foreach($listings as $list){
                        echo "<li><a href='".Yii::app()->createUrl('Site/TechView',array('name'=>$list->ID))."'>".$list->NAME."</a></li>";
                    }
                ?>
            </ul>            
        <a class="btn btn-success" href="<?php echo Yii::app()->createUrl('site/AddTech') ?>">List a Technology</a>        
        </div>
    </div>
</div>
             </div>

             <?php include 'protected/views/layouts/Footer.php' ?>
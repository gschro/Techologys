<?php include 'protected/views/layouts/Header.php' ?>
       <?php  
            if($message !==""){
             echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.
              $message . '</div>';          
            }       
        ?> 


<div class ="container">
    <div class="row">
        <ul class="thumbnails">
            <li class="span4 well">
                <a href="http:\\www.google.com" class="thumbnail">
                    <img src="http://ts3.mm.bing.net/th?id=H.4740790399207214&pid=1.7" alt="">
                </a>
                <h3>Life Science</h3>
                <p>This section is all about life science</p>
                <p><a href="http:\\www.google.com" class="btn btn-success">Go</a></p>
            </li>    
            <li class="span6 offset4 well">
                <a href="http:\\www.google.com" class="thumbnail">
                    <img src="http://ts1.mm.bing.net/th?id=H.5005124157112668&pid=1.7" alt="">
                </a>
                <h3>Computing and Wireless</h3>
                <p>Computing and wireless technologies are found here</p>                    
                <p><a href="http:\\www.google.com" class="btn btn-success">Go</a></p>                
            </li> 
        </ul>
    </div>
    <div class="row">
        <ul class="thumbnails">
            <li class="span2 offset4 well">
                <a href="http:\\www.google.com" class="thumbnail">
                    <img src="http://ts2.mm.bing.net/th?id=H.4899536643426513&pid=1.7" alt="">
                </a>
                <h3>Nano Technology</h3>
                <p>All of your nano technology here</p>                    
                <p><a href="http:\\www.google.com" class="btn btn-success">Go</a></p>                      
            </li>       
            <li class="span8 offset4 well">
                <a href="http:\\www.google.com" class="thumbnail">
                    <img src="http://www.mrg-online.com/images/solarsystem.jpg" alt="">
                </a>
                <h3>Physical Science</h3>
                <p>All of your physical science technology here</p>                    
                <p><a href="http:\\www.google.com" class="btn btn-success">Go</a></p>                      
            </li>                   
        </ul>
    </div>

    <div class=""><a href="<?php echo Yii::app()->createUrl('Site/TechList') ?>" class="btn btn-primary">View All Technologies</a></div><br>
</div>

<?php include 'protected/views/layouts/Footer.php' ?>
<?php include 'protected/views/layouts/HeaderSecure.php' ?>


<div class ="container">
    <div class="row">
    	<p>
        	<a class="btn" href="<?php echo Yii::app()->createUrl('Admin/Questions')?>">Questions</a>        
    	</p>
        <p>
        	<a class="btn" href="<?php echo Yii::app()->createUrl('Admin/GetStocksByIndustry')?>">Get Stocks By Industry</a>        
    	</p>
    </div>
</div>
             </div>

<?php include 'protected/views/layouts/Footer.php' ?>
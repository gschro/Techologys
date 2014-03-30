
<?php include 'protected/views/layouts/Header.php';?>
<script type="text/javascript">
    <?php include 'js/jquery.cookie.js';?>

    <?php include 'js/AddTech.js';?>
</script>

     
     <div class ="container">
         <form method="post" action="<?php echo Yii::app()->createUrl('Site/PreviewTech')?>">
            <fieldset>
                <div class="row">
                    <div class="span9">
                        <legend>Create Listing</legend>
                        <label>Name</label>
                        <input type="text" id="name" name="name" class="span4" placeholder="Name">                            
                   <?php  
                   $listing = null;
                       if(isset(Yii::app()->request->cookies['jsonListing'])){
                           $listing = json_decode(Yii::app()->request->cookies['jsonListing']->value);
                           echo $listing->NAME;
                       }
                   ////$name = Yii::app()->request->cookies['listingname']->value;
                    // echo $name;?>
                        <label>Project Summary</label>
                            <textarea rows="4" name="desc" class="span8" placeholder="Project Summary"></textarea>
                            <span class="help-block">Please answer the following questions about your listing</span>                                                  
                        <label class="checkbox">
                        <h4>Questions</h4>
                        <span class="help-block">Rate from 1 to 5, 5 being most positive</span>                                                                                                              
                        <div class="row">
                            <div class="span4">
                                <?php questions($questionsLeft);?>
                            </div>
                            <div class="span4">
                                <?php questions($questionsRight);?>
                            </div>
                        </div>
                        </label>
                        <div class="row text-center">
                            <input type="submit" id="preview" class="btn btn-large btn-primary" value="Preview Listing"/>                                                    
                        </div>
                    </div>
                    <div class="span3">
                        <br><br><br>
                        <div class="well">
                            <label>Main Category</label>
                            <select class="input-medium" id="mainCat" name="mainCat">
                        <?php 
                            $cats = MainCategory::model()->findAll();
                            foreach($cats as $cat){
                                echo "<option value='".$cat->ID."'>".$cat->CATEGORY."</option>";
                            }
                        ?>
                            </select><br>     
                            <label>Sub Category</label>
                            <select class="input-medium" name="subCat" id="subCat">
                            </select>  
                                                      
                        </div>     
                                                
                        <div class="well">
                            <label class="radio">
                              <input type="radio" name="patent" id="optionsRadios1" value="Patent" checked>
                              Patented
                            </label>
                            <label class="radio">
                              <input type="radio" name="patent" id="optionsRadios2" value="Pending">
                              Patent Pending
                            </label>                        
                            <label class="radio">
                              <input type="radio" name="patent" id="optionsRadios2" value="No">
                              No Patent
                            </label>   
                        </div>
                        <div class="well text-center">
                            <p>
                                Are there pre-existing rights associated with this listing?
                            </p>
                            <label class="radio inline">
                              <input type="radio" name="rights" id="rights" value="1" checked/>
                              Yes
                            </label>
                            <label class="radio inline">
                              <input type="radio" name="rights" id="rights" value="0"/>
                              No
                            </label>  
                            <br><br>
                            <textarea rows="4" class="input-medium" name="details" value=" " id="details" placeholder="Details"></textarea>
                        </div>
                        <div class="well text-center">
                            <p>
                            <h4>Listing Agreement</h4>
                                <a href="">view</a><br>
                                I have read the agreement and accept the terms
                            </p>
                            <label class="radio inline">
                              <input type="radio" name="agreement" id="agreement" value="1">
                              Yes
                            </label>
                            <label class="radio inline">
                              <input type="radio" name="agreement" id="agreement" value="0" checked>
                              No
                            </label>                              
                        </div>
                    </div>
                </div>                               
              </fieldset>             
         </form>
     </div>

<?php include 'protected/views/layouts/Footer.php'?>

<?php 
function question($name, $question){
    $question = '<label>'.$question.'</label>
        <div class="well text-center">';
    for($i=1; $i<6; $i++){
        $question .= '   
        <label class="radio inline">
            <input type="radio" name="'.$name.'" id="'.$name.'" value="'.$i.'">
            '.$i.'
        </label>   ';
    } 
    $question .= '</div>';
    return $question;
}
?>

<?php 
function questions($questions){
    foreach($questions as $question){
        echo question($question->NAME,$question->QUESTION);       
    }
}?>

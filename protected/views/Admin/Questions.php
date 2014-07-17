<?php include 'protected/views/layouts/HeaderSecure.php'?>
<script><?php include 'js/Questions.js'?></script>
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<style>
 .multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    /overflow:auto;    
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
    color:#ffffff;
    background-color:#000099;
}
select{
    width: 205px;
}
</style>

     <div class ="container">
         <div class="row">
             <div class="span6">
                <legend>Listing Questions</legend>
                <form class="well" name="cform" id="cform">
                    <h4>Add a Listing Question Category</h4>
                    <label>Category</label>
                    <input type="text" class="span4" id="qcategory" name="qcategory" placeholder="Category">                    
                    <br>
                    <input type="button" id="addQCat" class="btn btn-success" value="Add"/>                    
                    <input type="button" id="qcat" class="btn btn-default pull-right" value="View All"/>                                 
                       <div id="removeQuestionCategory"><br>
                            <label>Current Categories</label>
                                <select  multiple="multiple" id="listofqcategories" class="span5">                        
                                </select>                    
                                <div id="removeQCategory" class="btn btn-danger">Remove</div>
                        </div>                                        
                </form>
                <form class="well" id="qform" name="qform">
                    <h4>Add a Listing Question</h4>
                    <label>Question</label>
                        <input type="text" class="span5" id="question" name="question" placeholder="Question">
                        <label>Category</label>
                                <select id="category" name="category">
                                    <?php 
                                        $cats = QuestionCategory::model()->findAll();
                                        $first = 1;
                                        foreach($cats as $cat){
                                            if($first == 1){
                                                echo "<option value='".$cat->ID." selected'>".$cat->CATEGORY."</option>";
                                            }
                                            else{
                                                echo "<option value='".$cat->ID."'>".$cat->CATEGORY."</option>";                                                
                                            }
                                            $first++;
                                        }
                                    ?>
                                </select><br>
                                <div id="addLQ" class="btn btn-success" value="Add">Add</div>
                                <input type="button" id="qlist" class="btn btn-default pull-right" value="View All"/> 
                       <div id="removeListingQuestion"><br>
                            <label>Current Questions</label>
                                <select  multiple="multiple" id="listofquestions" class="span5" hidden>                        
                                </select>                    
                                <div id="remove" class="btn btn-danger">Remove</div>
                        </div>                    
                </form>
                <form class="well" id="qpform" name="qpform">
                    <h4>Add a Category Pair</h4>
                        <label>Categories</label>
                      <!--  <table style='width:370px;'>
                            <tr>PLEASE
                                <td style='width:160px;'>
                                    <b>Not Available</b><br/>
                                   <select multiple="multiple" size="15" id='lstBox1' class='listBox'>
                                    <?php 
                            //    ?    $question = QuestionCategory::model()->findAll();
                            //          foreach($question as $quest){
                                        ?>
                                       <option value="<?php //echo $quest->ID; ?>"><?php //echo $quest->CATEGORY; ?></option>  
                                        <?php
           //                           }
                                    ?>
                                </select>
                            </td>
                            <td style='width:50px;text-align:center;vertical-align:middle;'>
                                <input type='button' id='btnRight' value ='  >  '/>
                                <br/><input type='button' id='btnLeft' value ='  <  '/>
                            </td>
                            <td style='width:160px;'>
                                <b>Available </b><br/>
                                <select multiple="multiple" size="15" id='lstBox2' name="question[]" class='listBox'></select>
                            </td>
                        </tr>
                        </table>-->
                        <div>
                                <select id="cp1">
                                    <?php 
                                    $category = QuestionCategory::model()->findAll();
                                      foreach($category as $cat){
                                        ?>
                                          <option value="<?php echo $cat->ID; ?>"><?php echo $cat->CATEGORY; ?></option>  
                                        <?php
                                      }
                                    ?>
                                </select>
                                <select id="cp2">
                                    <?php 
                                      foreach($category as $cat){
                                        ?>
                                          <option value="<?php echo $cat->ID; ?>"><?php echo $cat->CATEGORY; ?></option>  
                                        <?php
                                      }
                                    ?>
                                </select>
                                <p>
                                    <div id="addCP" class="btn btn-success" value="Add">Add</div>                                
                                    <input type="button" id="cplist" class="btn btn-default pull-right" value="View All"/>                                     
                                </p>
                            </div>
                       <div id="removeCategoryPair"><br>
                            <label>Current Question Pairs</label>
                                <select  multiple="multiple" id="listofcategorypairs" class="span5" hidden>                        
                                </select>                    
                                <div id="removeCP" class="btn btn-danger">Remove</div>
                        </div>                    
                </form>                    
                <legend>Security Questions</legend>
                <form class="well" id="sqform" name="sqform">
                    <h4>Add a Security Question</h4>
                    <label>Question</label>
                    <input type="text" class="span4" id="securityquestion" name="securityquestion" placeholder="Question">                    
                    <br>
                    <input type="button" id="addSQ" class="btn btn-success" value="Add"/>   
                    <input type="button" id="squestion" class="btn btn-default pull-right" value="View All"/>                                                       
                       <div id="removeSecurityQuestion"><br>
                            <label>Security Questions</label>
                                <select  multiple="multiple" id="listofsquestions" class="span5" hidden>                        
                                </select>                    
                                <div id="removeSq" class="btn btn-danger">Remove</div>
                        </div>                                        
                </form>
                
             </div>
             <div class="span6">
                 <legend>Listing Categories</legend>
                 <form class="well" id="mform" name="mform" method="post" action="<?php echo Yii::app()->createUrl('Admin/AddMainCategory')?>">
                    <h4>Add a Listing Main Category</h4>
                    <label>Category</label>
                    <input type="text" class="span4" id="maincategory" name="maincategory" placeholder="Category"><br>                    
                    <input type="button" id="addMCat" class="btn btn-success" value="Add"> 
                    <input type="button" id="maincats" class="btn btn-default pull-right" value="View All"/>                                   
                       <div id="removeMainCat"><br>
                            <label>Main Categories</label>
                                <select  multiple="multiple" id="listofmcats" class="span5" hidden>                        
                                </select>                    
                                <div id="removeMCat" class="btn btn-danger">Remove</div>
                        </div>                                                            
                 </form>
                 <form class="well" id="mform" name="mform" method="post" action="<?php echo Yii::app()->createUrl('Admin/AddSubCategory')?>">
                    <h4>Add a Listing Sub Category</h4>
                    <label>Main Category</label>
                    <select name="maincat" id="maincat" class="span3 offset5">
                        <?php 
                            $cats = MainCategory::model()->findAll();
                            foreach($cats as $cat){
                                echo "<option value='".$cat->ID."'>".$cat->CATEGORY."</option>";
                            }
                        ?>
                    </select><br>
                    <label>Sub Category</label>                    
                    <input type="text" id="subcategory" class="span4" name="subcategory" placeholder="Sub Category"><br>
                    <input type="button" id="addSCat" class="btn btn-success" value="Add"> 
                    <input type="button" id="subcats" class="btn btn-default pull-right" value="View All"/>                                                       
                       <div id="removeSubCat"><br>
                            <label>Sub Categories</label>
                                <select  multiple="multiple" id="listofscats" class="span5" hidden>                        
                                </select>                    
                                <div id="removeSCat" class="btn btn-danger">Remove</div>
                        </div>                                                            
                 </form>

                <legend>Sub Category Stocks</legend>
                <form class="well" id="stockform" name="stockform">
                    <h4>Add a Stock to a Sub Category</h4>
                    <label>Main Category</label>
                    <select name="maincatstock" id="maincatstock" class="span3 offset5">
                        <?php 
                            $cats = MainCategory::model()->findAll();                            
                            foreach($cats as $cat){
                                echo "<option value='".$cat->ID."'>".$cat->CATEGORY."</option>";
                            }
                        ?>
                    </select><br>
                    <label>Sub Category</label>                    
                    <select name="subcatstock" id="subcatstock" class="span3 offset5">
                    </select><br> 
                    <label for="stock">Stock Symbol</label>                                        
                    <input type="text" id="stock" class="span3" name="stock" placeholder="Stock Symbol"><br>                    
                    <input type="button" id="addSCatStock" class="btn btn-success" value="Add"> 
                    <input type="button" id="subcatstocks" class="btn btn-default pull-right" value="View All"/>                                                       
                       <div id="removeSubCatStock"><br>
                            <label>Stocks</label>
                                <select  multiple="multiple" id="listofstocks" class="span5" hidden>                        
                                </select>                    
                                <div id="removeSCatStock" class="btn btn-danger">Remove</div>
                        </div>                                           
                </form>
             </div>
         </div>
     </div>

<?php include 'protected/views/layouts/Footer.php'?>
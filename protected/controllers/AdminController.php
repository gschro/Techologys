<?php

class AdminController extends Controller
{
        public $type = "";
        
        public function actionIndex(){
            $this->render('index');            
        }
        
        public function actionQuestions(){
            $this->render('Questions');
        }

        public function actionMaps(){
            $this->render('maps');
        }        

        public function actionAddListingCategory(){
            $message = "Please enter a category";
            if(isset($_POST['category'])){
                $Category = new QuestionCategory();
                $Category->CATEGORY = $_POST['category'];
                $message = $this->saveModel($Category, "Category");                                
            }
                $this->render("Questions",array('message'=>$message, "messageType"=>$this->type));
        }
        
        public function actionAddListingQuestion(){
            $message = "Please enter a Question and a Category";
           
         //   if(isset($_POST['question']) && isset($_POST["category"])){
            try{
                $message = "set";
                $Question = new Question();
                $Question->QUESTIONCATEGORYID = $_POST['category'];
                $Question->QUESTION = $_POST['question'];
                //find all for each category and then increment name                                    
                $questions = Question::model()->findByAttributes(array("QUESTIONCATEGORYID"=>$Question->QUESTIONCATEGORYID));
                $qNum = count($questions);
                $cat = QuestionCategory::model()->findByPK($Question->QUESTIONCATEGORYID);
                $name = str_replace(" ","",$cat->CATEGORY);
                $Question->NAME = $name.$qNum;
                $message = $this->saveModel($Question, "Question");   
                //$message ="set";
            }
            catch(Exception $e){
                $message = $e->getMessage();
            }
        //    }
          //  else{$message = "not set";}
            
                //$this->render("Questions",array('message'=>$message, "messageType"=>$this->type));
                echo CJSON::encode(array("message"=>$message, "messageType"=>$this->type));
        }
                      
        public function actionAddSecurityQuestion(){
            $message = "Please enter a security question";
            try{         
                $SecurityQuestion = new SecurityQuestion();
                $SecurityQuestion->SECURITYQUESTION = $_POST['question'];                
                $message = $this->saveModel($SecurityQuestion, "Security Question");
            }
            catch(Exception $e){
                $message = "Failed to create the question :".$e->getMessage();
            }
            echo CJSON::encode(array("message"=>$message));
        }
        
//        public function actionGetCats(){
//            if(isset($_POST["catId"])){
//                $test = $_POST["catId"];
//                $subCats = SubCategory::model()->findAllByAttributes(array("MAINCATEGORYID"=>$_POST["catId"]));
//                echo CJSON::encode(array('subcats'=>$subCats));
//            }
//        }
        
       public function saveModel($model, $name){
           $message = "";
               if($model->save()){
                    $message = $name . " successfully created";
                    $this->type = "alert alert-success";}
               else{
//print_r($model->getErrors());
      //exit();
                    $message = "Failed to create the " . $name. " ";
                    $this->type = "alert alert-error";
               }
           return $message;
       }
       
    public function actionGetListingQuestions(){                        
        $questions = Question::model()->findAll();
        echo CJSON::encode(array('questions'=>$questions));            
    }
    
    public function actionGetSecurityQuestions(){
        $questions = SecurityQuestion::model()->findAll();
        echo CJSON::encode(array('questions'=>$questions));
    }
    
    public function actionRemoveListingQuestion(){
        $result = "";
        $question = Question::model()->findByPK($_POST['qId']);
        if($question->delete()){
            $result = "Success";
        }
        echo CJSON::encode(array('message'=>$result));
    }
    
    public function actionGetListingCategories(){
        $categories = QuestionCategory::model()->findAll();
        echo CJSON::encode(array('categories'=>$categories));
    }
    
    public function actionAddQuestionCategory(){
        try{
            $Category = new QuestionCategory();            
            $Category->CATEGORY = $_POST['qcategory'];
            $message = $this->saveModel($Category, "Category");              
        }
        catch(Exception $e){
            $message = "Please enter a category";
        }
        echo CJSON::encode(array("message"=>$message, "messageType"=>$this->type));
    }
    
    public function actionRemoveQuestionCategory(){
        $result = "";
        $category = QuestionCategory::model()->findByPK($_POST['catId']);
        if($category->delete()){
            $result = "Success";
        }
        echo CJSON::encode(array('message'=>$result));        
    }
    
    public function actionRemoveSecurityQuestion(){
        $result = "";
        $sq = SecurityQuestion::model()->findByPK($_POST['sqId']);
        if($sq->delete()){
            $result = "Success";
        }
        echo CJSON::encode(array('message'=>$result));        
    }
    
    public function actionGetMainCategories(){
        $categories = MainCategory::model()->findAll();
        echo CJSON::encode(array('categories'=>$categories));        
    }
    
    public function actionAddMainCategory(){
        try{
            $Category = new MainCategory();            
            $Category->CATEGORY = $_POST['mc'];
            $message = $this->saveModel($Category, "Category");              
        }
        catch(Exception $e){
            $message = "Please enter a category";
        }
        echo CJSON::encode(array("message"=>$message, "messageType"=>$this->type));
    }
    
    public function actionGetSubCategories(){
        $id = $_POST['mcId'];
        $categories = SubCategory::model()->findAllByAttributes(array("MAINCATEGORYID"=>$id));
        if(isset($categories)){
            echo CJSON::encode(array('categories'=>$categories));                    
        }
        else{
            $categories = "no good";
            echo CJSON::encode(array('categories'=>$categories));
        }
    }
    
    public function actionAddSubCategory(){
            $message = "Please enter a sub category and select a main category";
            try{            
                $SubCategory = new SubCategory();
                $SubCategory->CATEGORY = $_POST['sc'];
                $SubCategory->MAINCATEGORYID = $_POST['mc'];
                $message = $this->saveModel($SubCategory, "Sub Category");            
            }
            catch(Exception $e){
                $message = "Failed to create the Sub Category";
            }
            echo CJSON::encode(array("message"=>$message));
    }
    
    public function actionRemoveSubCategory(){
        $result = "";
        $sc = SubCategory::model()->findByPK($_POST['sc']);
        if($sc->delete()){
            $result = "Success";
        }
        echo CJSON::encode(array('message'=>$result));                
    }
    
    public function actionRemoveMainCategory(){
        $result = "";
        $mc = MainCategory::model()->findByPK($_POST['mc']);
        if($mc->delete()){
            $result = "Success";
        }
        echo CJSON::encode(array('message'=>$result));        
    }

    
}

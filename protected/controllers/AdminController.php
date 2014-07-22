<?php
ini_set('max_execution_time', 300);
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
                $questions = Question::model()->findAllByAttributes(array("QUESTIONCATEGORYID"=>$Question->QUESTIONCATEGORYID));
                $qNum = count($questions);
                $cat = QuestionCategory::model()->findByPK($Question->QUESTIONCATEGORYID);
                $name = str_replace(" ","",$cat->CATEGORY);
                $Question->NAME = $name.$qNum;
             //   $Question->validate();
             //   $message=CJSON::encode($Question->getErrors());
              //  $message  = $Question->QUESTIONCATEGORYID;
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

        public function actionAddCategoryPair(){
            $message = "Please enter a Category and a Category";
           
            try{
                $Pairing = new Pairing();
                $Pairing->save();

                for($i = 1; $i<3; $i++){
                    $CategoryPair = new CategoryPair();

                    $CategoryPair->PAIRINGID = $Pairing->ID;
                    $CategoryPair->CATEGORYID = $_POST['cp'.$i.'id'];
                    if($CategoryPair->save()){
                        $message = "Category Pair successfully created!";
                    }
                    else{
         //               $message = " validate ". CJSON::encode($CategoryPair->validate())." ". CJSON::encode($CategoryPair->getErrors());
                        $message = "Failed to create Category Pair: " . CJSON::encode($CategoryPair->getErrors());                    
                    }
                }
            }
            catch(Exception $e){
                $message = "fail ".$e->getMessage();
            }
            echo CJSON::encode(array("message"=>$message, "messageType"=>$this->type));            
        }

        public function actionGetCategoryPairs(){    
            $categoryPairs = [];
          // // $category = "test";

            $pairings = Pairing::model()->findAll();
            foreach($pairings as $p){
          //       $catpairs = CategoryPair::model()->findAllByAttributes(array("PAIRINGID"=>$p->ID));
          //       $catArray = [];
          //       $i = 1;
          //           foreach($catpairs as $cp){
          //               $catArray["category".$i] = $cp->category->CATEGORY;
          //               $i++;
          //           }                
          //           $catArray["ID"] = $p->ID;
          //           $categoryPairs[] = $catArray;                
             }

          // $categorys = Category::model()->findAll();
            $categoryPairs[] = "Test1";
            $categoryPairs[] = "Test2";

            echo CJSON::encode(array('categorypairs'=>$categoryPairs));            
        }

        function actionRemoveCategoryPair(){
           $result = "";
         //  $result = $_POST['cpId'];
            $catpairings = CategoryPair::model()->findAllByAttributes(array("PAIRINGID"=>$_POST['cpId']));
          //  $transaction = Yii::app()->db->beginTransaction();            

            foreach($catpairings as $cp){
                if(!$cp->delete()){
                    $result .= " ".CJSON::encode($cp->getErrors());                    
                }
            }
            $pairing = Pairing::model()->findByPK($_POST['cpId']);

            if($pairing->delete()){
              // $result = CJSON::encode($pairing->getErrors());
                $result = "success";
            }
            else{
                $result = CJSON::encode($pairing->getErrors());
            }            

            // $transaction->commit();
            //    $transaction->rollBack();
        //  $result =$pairing->ID;
            echo CJSON::encode(array('message'=>$result));
        }
        // ADD SKELETON
        // public function actionAddQuestionPair(){
        //     $message = "Please enter a Question and a Category";
           
        //  //   if(isset($_POST['question']) && isset($_POST["category"])){
        //     try{

        //     }
        //     catch(Exception $e){
        //         $message = $e->getMessage();
        //     }
        //     echo CJSON::encode(array("message"=>$message, "messageType"=>$this->type));            
        // }        
                      
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
                    $message = "Failed to create the " . $name. " "; //.CJSON::encode($model->getErrors())
                    $this->type = "alert alert-error";
               }
           return $message;
       }
       
    public function actionGetListingQuestions(){    
       
      // $category = "test";
        $questions = Question::model()->findAllByAttributes(array("QUESTIONCATEGORYID"=>$_POST['category']));
      // $questions = Question::model()->findAll();
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
        $stocks = Stocks::model()->findAllByAttributes(array("SUBCATEGORYID"=>$sc->ID));
        foreach($stocks as $stock){
            $stock->delete();
        }
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

    public function actionGetSubCatStocks(){
       // $id = $_POST['mcId'];
        $scId = $_POST['subcatstock'];
       // $sId = 1;
        $stocks = Stocks::model()->findAllByAttributes(array("SUBCATEGORYID"=>$scId));
        //$categories = SubCategory::model()->findAllByAttributes(array("MAINCATEGORYID"=>$id));
        if(!isset($stocks)){
            $stocks = "no good";            
        }
        //$stocks=[["ID"=>1,"CATEGORY"=>$sId],["ID"=>2,"CATEGORY"=>"TEST"]];
        echo CJSON::encode(array('stocks'=>$stocks));        
    }

    public function actionAddSubCatStock(){
            $message = "Please enter a stock symbol";
            try{            
                $stock = new Stocks();
                $stock->SYMBOL = $_POST['stock'];
                $stock->SUBCATEGORYID = $_POST['scId'];
                $stock->LASTUPDATED = "0000-00-00";
                $stock->PRICE = 0;
                $stock->NAME = $_POST['stock'];
                $message = $this->saveModel($stock, "Stock");            
            }
            catch(Exception $e){
                $message = "Failed to create the stock1";
            }
            echo CJSON::encode(array("message"=>$message));            
    }

    public function actionRemoveSubCatStock(){
        $result = "";
        $stock = Stocks::model()->findByPK($_POST['catId']);
        if($stock->delete()){
            $result = "Success";
        }
        echo CJSON::encode(array('message'=>$result));                
    }

    public function actionGetStocksByIndustry(){
        $url = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.industry%20where%20id%20in%20(select%20industry.id%20from%20yahoo.finance.sectors)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
        $response = file_get_contents($url);
       // echo $response;
        $industries = json_decode($response, true);        
        //$json = json_decode($response, true);
        //$query = $json['query'];
        //$industries = $query;
      //  $test = $industries['query']['results']['industry'];
     //   echo $test;
        foreach($industries['query']['results']['industry'] as $industry){
            $newIndustry = new Industry();
            $newIndustry->ID = $industry['id'];
            $newIndustry->Name = $industry['name'];
         //   $curInd = Industry::model()->findByPK($newIndustry->ID);
         //   if(is_null($curInd)){
         //       if($newIndustry->save()){
                    if(array_key_exists("company",$industry)){
                    $companies = $industry['company'];            
                    foreach($companies as $company){
                        try{
                        $newCompany = new Company();
                      //  $newCompany->NAME = $company['name'];
                        $newCompany->SYMBOL = $company['symbol'];
                        $newCompany->INDUSTRYID = $newIndustry->ID;
                        $curComp = Company::model()->findByAttributes(array("SYMBOL"=>$newCompany->SYMBOL));
                        if(is_null($curComp)){                        
                            if(!$newCompany->save()){
                                $message = "Company ".$newCompany->NAME." could not be saved";                        
                                echo $message;
                            }
                        }
                        else{
                            $message = $newCompany->NAME.' already exists';
                            echo $message;
                        }
                    }catch(Exception $e){}
            //        }
           //     }
            //    else{
           //         $message = $newIndustry->Name." industry could not be saved";
          //          echo $message;
         //       }
            }
            }
        }
    }

    public function actionGetStockInfo(){
        //YHOO%22%2C%22AAPL%22%2C%22GOOG%22%2C%22MSFT%22%2C%22HPQ%22
        $stocks = Stocks::model()->findAll();
        $stocksSymbols = "%22";        
        $x = 0;
        foreach($stocks as $stock){
            if($x > 0){
            $stocksSymbols .= "%22%2C%22".$stock->SYMBOL;            
            }
            else{
                $stocksSymbols .= $stock->SYMBOL;
                $x++;                
            }
        }
        $stocksSymbols .= "%22";
        $url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(".$stocksSymbols.")&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=";
        $response = file_get_contents($url);
        $stockInfo = json_decode($response, true);
        //save stock info here      
      //  echo $response ;
        foreach($stockInfo['query']['results']['quote'] as $stock){
            //echo $stock['symbol'];
            $stockUpdate = Stocks::model()->findByAttributes(array("SYMBOL"=>$stock["symbol"]));
            //query results quote {symbol}
            $stockUpdate->PRICE = $stock['LastTradePriceOnly'];
            $stockUpdate->CHANGE = $stock['PercentChange']; //PercentChangeFromFiftydayMovingAverage
            $stockUpdate->NAME = $stock['Name'];
            $stockUpdate->LASTUPDATED = new CDbExpression('NOW()');
            $stockUpdate->save();
            //LastTradePriceOnly
            //PercentChange
        }
    }
}

<?php
require 'protected/3rd Party/passwordLib/passwordLib.php';
class SiteController extends Controller
{
        public $message = "";
        public $help = "";
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

        

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

        public function actionDashboard()
        {
            $this->render('dashboard',array(''));
        }
        
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Logs the user in
	 */
	// public function actionLogin()
	// {
 //        session_start('ses');
 //        $user = $_POST['user'];
 //        $user = EmailAccount::model()->findByPk($user);
 //        if(isset($user)){
 //            $_SESSION['user'] = $user->ID;
 //            $page = $_POST['page'];
 //            $this->render($page,array("message"=>""));            
 //        }else{
 //            $this->render('Login',array("message"=>"Incorrect Email/Password combination"));            
 //        }
	// }
    //5.4.28 vs 5.5.9

    public function signedIn($page, $data = null){
        session_start();
        if(array_key_exists('user', $_SESSION)){
            $dataArray = array();
            if(isset($data)){
                foreach($data as $key=>$value){
                    $dataArray[$key] = $value;
                }
            }
            $this->render($page,$dataArray);  
        }
        else{
            $url = Yii::app()->createUrl('site/LoginView');      
            $this->redirect($url, array("message"=>"Please Login to Continue"));
        }       
    }

    /**
     * Displays the login page
     */
    public function actionLoginView(){
        $this->render('Login',array("message"=>""));        
    }
        
    public function actionMission()
    {
        $this->render('Mission');
    }

    public function actionUniversity(){
        $this->signedIn('University');
        //$this->render('University');          
    }
        
    public function actionInvestor(){
        $this->signedIn('Investor');        
        //$this->render('Investor');
    }
        
    public function actionManageAccount(){
        $this->signedIn('ManageAccount');        
        //$this->render('ManageAccount');
    }

    public function actionEditTech(){
        $this->signedIn('EditTech');        
      //  $this->render('EditTech');
    }    

    public function actionSignIn()
	{
        try{
        $email = $_POST['email'];
        $user = EmailAccount::model()->findByAttributes(array('EMAIL'=>$email));
        //$transaction = Yii::app()->db->beginTransaction();
        if(!is_null($user->EMAIL)){

            $password = $_POST['password'];
            //$test1 = password_verify($password,$user->HASHPASS);

            if(password_verify($password,$user->HASHPASS)){

                session_start();
                $_SESSION['user'] = $user->ID;
              //  echo 'session started';
                if(isset($_POST['page'])){
                    $page = $_POST['page'];                    
                }
                else{
                    $page = "index";
                }
                $this->render($page,array("message"=>"login successful"));      //"data"=>$page,                               
            }
            else{
              $this->render('Login',array("message"=>"Incorrect Email/Password combination"));
            }
        }
        else{
            $this->render('Login',array("message"=>"Incorrect Email/Password combination"));
        }
        }
        catch(Exception $e){
                $message = "Could not create account ".$e->getMessage();
             //   $transaction->rollBack(); 
                $this->render('CreateAccount', array("message"=>$message));
            }
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
        session_start();
        unset($_SESSION['user']);        
        session_destroy();
		$this->redirect(Yii::app()->homeUrl);
	}
        
    public function actionCreateAccountView()
    {
        $this->render('CreateAccount');
    }

    public function actionCreateAccount(){

        $message = "test";
        $email = $_POST['email'];
        $emailExists = EmailAccount::model()->findbyAttributes(array('EMAIL'=>$email));
        if(empty($emailExists->EMAIL)){
            $transaction = Yii::app()->db->beginTransaction();

            try{
                    $newUser = new User();
                    $newUser->TYPE = "EMAIL";
                    $newUser->ADMIN = 0;
                    $newUser->save();

                    $newEmailAccount = new EmailAccount();
                    $newEmailAccount->EMAIL = $email;
                    $newEmailAccount->FIRSTNAME = $_POST['firstName'];
                    $newEmailAccount->LASTNAME = $_POST['lastName'];
                    $newEmailAccount->HASHPASS = password_hash($_POST['password'],PASSWORD_DEFAULT);

                    //$newEmailAccount->COMPANY = $_POST['firstName'];                    
                    $newEmailAccount->USERID = $newUser->ID;
                    //$newEmailAccount->save();

                    if($newEmailAccount->save()){

                    $secItem1 = new SecurityItem();
                    $secItem1->EMAILACCOUNTID = $newEmailAccount->ID;
                    $secItem1->SECURITYQUESTIONID = $_POST['secQuest1'];
                    $secItem1->ANSWER = $_POST['answer1'];
                    $secItem1->save();

                    $secItem2 = new SecurityItem();
                    $secItem2->EMAILACCOUNTID = $newEmailAccount->ID;
                    $secItem2->SECURITYQUESTIONID = $_POST['secQuest2'];
                    $secItem2->ANSWER = $_POST['answer2'];
                    $secItem2->save();
                    
                    $transaction->commit();
                    //Yii::app()->request->cookies['user'];
                    session_start();
                    $_SESSION['user'] = $newUser->ID;
                    //Yii::app()->request->cookies['user'] = new CHttpCookie('user', $newUser->ID);

                    $this->render('Investor', array("message"=>$message));
                    }
                    else{

                   $message = "Could not create account ".CJSON::Encode($newEmailAccount->getErrors());
                   $transaction->rollBack(); 
                   $this->render('CreateAccount', array("message"=>$message));

                    }
            }
            catch(Exception $e){
                   $message = "Could not create account ".$e->getMessage();
                   $transaction->rollBack(); 
                   $this->render('CreateAccount', array("message"=>$message));
            }    
        }
        else{
            $message = "Account with this email already exists";
            $this->render('CreateAccount', array("message"=>$message));
        }

    //java script checks if password and confirm password are the same.        
    }
        
	public function actionTechList()
	{
        $html = '<ul class="media-list">';
        $model=Listing::model()->findAll();
        foreach($model as $val){
            if($val->VISIBLE == 1){
                 $html .= '
                 <li class="media">'.
                    '<a class="pull-left" href="'.Yii::app()->createUrl('Site/TechView',array('name'=>$val->ID)).'">more</a>'.
                    '<div class="media-body">'.
                        '<h4 class="media-heading">'.$val->NAME.'</h4>'.
                    '</div>'.
                 '</li>';                
                $html .= "</ul>";
            }
        }
        $this->signedIn('TechList',array("data"=>$html));
		//$this->render('TechList', array("data"=>$html));
	}
        
        public function actionTechView(){
            $pk = "";            
            if(array_key_exists('name', $_GET)){
                $pk = $_GET['name'];
            }
            else{
                session_start();
                $pk = $_SESSION['techViewId'];                    
            }
           
            $model = null;
            if(is_null($pk)){
                $this->render('TechList', array("message"=>"Error loading page"));
            }
            else{
                $model = Listing::model()->findByPK($pk);            
                 $listingcountry = ListingCountry::model()->findAllByAttributes(array("LISTINGID"=>$model->ID));

                 $mapData = array();
                 $mapData[] = ["Country"];
                 foreach($listingcountry as $lc){
                     $country = Country::model()->findByPK($lc->COUNTRYID);
                     $temp = array();
                     $temp[] = $country->NAME;
                     $mapData[] = $temp;
                 }

                $pairings = Pairing::model()->findAll();
                $categories = [];
                $scorePairs = [];
                
                foreach($pairings as $pair){
                    $cats = [];
                    $categoryPairs = CategoryPair::model()->findAllByAttributes(array("PAIRINGID"=>$pair->ID));
                    $catTotals = [];
                    $catTotals[] = "";
                    $catColumns = []; 
                    $catColumns[] = "ID";
                    foreach($categoryPairs as $cp){
                        //go through each q category
                      //  $cats[] = $cpNew;
                        $catQuestValues = QuestionValue::model()->findAllByAttributes(array("LISTINGID"=>$model->ID));
                        //$cat2QuestValues = QuestionValue::model()->findAllByAttributes(array("LISTINGID"=>$model->ID));
                        
                        //at2Total = 0;
                        $catTotal = 0;
                        $k = 1;
                        foreach($catQuestValues as $cqv){
                            $quest = Question::model()->findByPk($cqv->QUESTIONID);
                            if($quest->QUESTIONCATEGORYID === $cp->CATEGORYID){
                                $catTotal += $cqv->VALUE;
                                $k++;
                            }                                                    
                        }                        

                        $cat = QuestionCategory::model()->findByPk($cp->CATEGORYID);  
                        $catColumns[] = $cat->CATEGORY;                      
                        $catTotals[] = floatval(number_format((float)$catTotal/$k, 2, '.', ''));
                    }

                    // $scorePairs[] = $catColumns;
                    // $scorePairs[] = $catTotals;
                    //$catColumns[] = "";
                   // $catTotals[] = 1;
                    $scorePairs[] = [$catColumns, $catTotals];           
                }                 
                
                $totalScore = 0;
                $allQVs = QuestionValue::model()->findAllByAttributes(array("LISTINGID"=>$model->ID));
                foreach($allQVs as $qv){
                    $totalScore += $qv->VALUE;
                }
                $questions = Question::model()->findAll();
                $totalScore = $totalScore/count($allQVs);
                $totalScore = intval($totalScore/count($questions));
//                $totalScore = number_format((float)$totalScore, 2, '.', '');

                $this->render('TechView', array("tech"=>$model,"map"=>$mapData, "scorepairs"=>$scorePairs,"totalscore"=>$totalScore));               
            }
        }

        public function validateQuestion($questions, $Id){
            $found = false;
            foreach($questions as $q){
                if($q->ID = $Id){
                    $found = true;
                }
            }
            return $found;
        }
        
        public function actionAddTech($message=""){
            $questions = Question::model()->findAll();
            $ql = []; 
            $qr = [];
            for($i=0;$i<count($questions);$i++){
                $displayVals = [];
                $dVals = QuestionDisplay::model()->findAllByAttributes(array("QUESTIONID"=>$questions[$i]->ID));                
                $displayVals["Question"] = $questions[$i];
                $displayVals["Values"] = $dVals;
                if($i%2===0){
                    $ql[] = $displayVals;
                    //$questions[$i];
                }
                else{
                    $qr[] = $displayVals;
                    //$questions[$i];                    
                }
            }//"Please fill out all required fields"
            $this->render('AddTech',array("questionsLeft"=>$ql,"questionsRight"=>$qr,"message"=>$message));
        }
        
        public function actionPreviewTech(){
            $message = "";
            try{
                session_start();
               // $message = "something";
                $listing = new Listing();
               // $message = "start tech";
                $listing->NAME = $_POST['name'];
                $listing->DESC = $_POST['desc'];
                $listing->SUBCATEGORYID = $_POST['subCat'];
                $listing->PATENTSTATUS = $_POST['patent'];
                $listing->RIGHTS = $_POST['rights'];
                $rd = $_POST['details'];
                if($rd === ""){
                    $rd = "Not Applicable";
                }
                $listing->RIGHTSDETAILS = $rd;
                $listing->LISTAGREEMENT = $_POST['agreement'];                
                $listing->USERID = $_SESSION['user'];

                //$listing->COUNTRIES =

                $jsonListing = CJSON::Encode($listing);
                $_SESSION['listing'] = $jsonListing;
                
                //$listing->TECHID = 1234;
              //  $message = $listing->genGUID();
              //  $message = "before questions";
                $questions = Question::model()->findAll();
                $details = array();

                $countries = $_POST['countries'];
                array_unshift($countries,'Country');
                //$countries = CJSON::Encode($countries);
             //   $message = $countries;
                // $countriesAr = array();
                // foreach($_POST['countries'] as $val){
                //     $countriesAr[] = $val;
                // }
                // $countries = CJSON::Encode($countriesAr);

              //  $message = "this far";
                $score = 0;
                foreach($questions as $question){
                    if(isset($question)){
                        $displayVal = QuestionDisplay::model()->findByPk($_POST[$question->NAME]);
                        $qv = $this->createQuestionValue($listing->ID,$displayVal->ACTUALVALUE,$question->NAME);
                //    $details[] = $this->createQuestionValue($listing->ID,$_POST[$question->NAME],$question->NAME);
                        $details[] = $qv;
                    $score += $qv->VALUE;

                }

//////////////////////////////

                    $pairings = Pairing::model()->findAll();
                    $categories = [];
                    $scorePairs = [];
                    
                    foreach($pairings as $pair){
                        $cats = [];
                        $categoryPairs = CategoryPair::model()->findAllByAttributes(array("PAIRINGID"=>$pair->ID));
                        $catTotals = [];
                        $catTotals[] = '';
                        $catColumns = []; 
                        $catColumns[] = 'ID';
                        foreach($categoryPairs as $cp){
                            $catTotal = 0;
                            $k = 1;
                            foreach($details as $cqv){
                             
                                $quest = Question::model()->findByAttributes(array("NAME"=>$cqv->QUESTIONID));
                                //echo $quest->QUESTIONCATEGORYID;
                                if($quest->QUESTIONCATEGORYID === $cp->CATEGORYID){
                                    $catTotal += $cqv->VALUE;
                                    $k++;
                                }
                                //$catTotal = $cqv->QUESTIONID;
                            }                        
                            $cat = QuestionCategory::model()->findByPk($cp->CATEGORYID);  
                         //   $tempScore = $catTotal/(float)$k;                                      
                            $catColumns[] = $cat->CATEGORY." s".$score;  
                                     
                            $catTotals[] = floatval(number_format($catTotal/(float)$k, 2, '.', ''));
                         //   $score += $tempScore;
                        }
                        $scorePairs[] = [$catColumns, $catTotals];           
                    }                 

                }

                $jsonDetails = CJSON::Encode($details);
                $this->render('PreviewTech',array("tech"=>$listing,"jsonDetails"=>$jsonDetails,"message"=>$message, "jsonListing"=>$jsonListing, "score"=>$score, "countries"=>$countries, "scorepairs"=>CJSON::Encode($scorePairs)));
            }
            catch(Exception $e){
                //$this->render('AddTech');            
                $this->actionAddTech($message);
            }
        }
        
        public function createQuestionValue($listing, $val, $question){
            $QV = new QuestionValue();
            $QV->LISTINGID = $listing;
            $QV->VALUE = $val;
            $QV->QUESTIONID = $question;
            return $QV;
        }
        
        public function actionListTech(){
//            $message = "";
                session_start();

            $good = true;
            //$jlisting = json_decode($_POST['jsonListing']);
            //$details = json_decode($_POST['jsonDetails']);            
            $jlisting = json_decode($_SESSION['jsonListing']);
            $details = json_decode($_SESSION['jsonDetails']);

            $countries = $_SESSION['countries'];

            $transaction = Yii::app()->db->beginTransaction();
            $message = "";
            try{
                $listing = new Listing();
                $listing->USERID = $_SESSION['user'];
                $listing->NAME = $jlisting->NAME;
                $listing->DESC = $jlisting->DESC;
                $listing->RIGHTS = $jlisting->RIGHTS;
                $listing->SUBCATEGORYID = $jlisting->SUBCATEGORYID;
                $listing->PATENTSTATUS = $jlisting->PATENTSTATUS;
                $listing->LISTAGREEMENT = $jlisting->LISTAGREEMENT;
                $listing->RIGHTSDETAILS = $jlisting->RIGHTSDETAILS;
                $listing->TOTALSCORE = 0;
                if($listing->save()){      
                    $message .= " listing saved ";
                                                echo "list tech 2";

                    for($i = 0; $i< count($details); $i++){
                        $qval = new QuestionValue();
                        $qval->LISTINGID = $listing->ID;
                        $qval->VALUE = $details[$i]->VALUE;
                       // $message .= " |".$qv->QUESTIONID."| ";
                        $q = Question::model()->findByAttributes(array("NAME"=>$details[$i]->QUESTIONID));
                        $qval->QUESTIONID = (int)$q->ID;
                        
//                        $test = Yii::app()->db->createCommand('select * from question')->queryAll();
//Yii::app()->db->createCommand('insert into questionvalue(LISTINGID, VALUE, QUESTIONID) VALUES (30,1,10000007))->execute();'); 
//echo "<br><br><br> ". CJSON::Encode($test);
                        
                        if($qval->save()){
                     //       $message .= " qv saved ";
                      //      $message .= " ". CJSON::Encode($qval->getErrors());
                        }
                        else{
                        //    $message .= " |%".$qval->QUESTIONID."%| ";
                            //.CJSON::Encode($qval->getErrors())." "
                            $good = false;                            
                        }
                        unset($qval);
                    }
                                echo "list tech 3";

                    if($good){
                        foreach($countries as $val){
                            //echo "this far 1";
                            if($val !== "Country"){
                            $listingCountry = new ListingCountry();
                            $listing->refresh();
                            //echo "this far 2";
                            $listingCountry->LISTINGID = $listing->ID;
                            //echo "this far 3 ". $val;                            
                            $country = Country::model()->findByAttributes(array("NAME"=>$val));
                            //echo "this far 4";           
                            $id = $country->ID;                 
                            $listingCountry->COUNTRYID = $id;
                            
                        //    echo "this far 5";                                                        
                            if($listingCountry->save()){
                        //    echo "this far 6";                            
                            }
                            else{
                                $good = false;
                            }
                            }
                        }
                   //     $message .= CJSON::Encode($listing->getErrors())." GOOD!";
                        $this->render('TechListed', array("message"=>$message));               
                        $transaction->commit();
                        }
                    else{
                        
                       $transaction->rollBack();
                        $jsonListing = CJSON::Encode($listing);
                        $jsonDetails = CJSON::Encode($details);
                        $message .= " Failed to list the technology";
             //           $this->render('PreviewTech', array("jsonListing"=>$jsonListing, "jsonDetails"=>$jsonDetails,"message"=>$message));               
                        
                    }
                }
                else{
                    $message = "hyelp ".CJSON::Encode($listing->getErrors());
                    echo $message;
                    $message .= " listing wouldn't save ";
                    $jsonListing = CJSON::Encode($listing);
                    $jsonDetails = CJSON::Encode($details);
                    $transaction->rollBack();
         //           $this->render('PreviewTech', array("jsonListing"=>$jsonListing, "jsonDetails"=>$jsonDetails,"message"=>$message));
                }
              //  unset(Yii::app()->request->cookies['listing']);               
            }
            catch(Exception $e){
               $message = "couldn't create the listing ".$e->getMessage();
               $transaction->rollBack(); 
               $jsonListing = CJSON::Encode($listing);
               $jsonDetails = CJSON::Encode($details);               
       //        $this->render('PreviewTech', array("jsonListing"=>$jsonListing, "jsonDetails"=>$jsonDetails,"message"=>$message));
            }
        }

    public function actionDeleteTech(){
        session_start();
        $techId = $_SESSION['techViewId'];
        $result = "";
        $listingCountries = ListingCountry::model()->findAllByAttributes(array("LISTINGID"=>$techId));
        foreach($listingCountries as $val){
            $val->delete();
        }
        $questionValues = QuestionValue::model()->findAllByAttributes(array("LISTINGID"=>$techId));
        foreach($questionValues as $val){
            $val->delete();
        }
        $listing = Listing::model()->findByPK($techId);
        if($listing->delete()){
            $result = "Listing successfully deleted";
            $this->render('University', array("message"=>$result));                    
        }else{
            $result = "Listing could not be deleted";
            $this->render('TechView', array("message"=>$result));                    
        }
        //echo CJSON::encode(array('message'=>$result));
    }

    public function actionUnlistTech(){
        session_start();
        $techId = $_SESSION['techViewId'];
        $result = "";
        $listing = Listing::model()->findByPk($techId);
        $listing->VISIBLE = 0;
        if($listing->save()){
            $result = "Tech successfully unlisted";
        }
        else{
            $result = "Tech could not be unlisted";
        }
        echo CJSON::encode(array('result'=>$result,'title'=>'List'));                
   //     $this->render('TechView', array("message"=>$result));
    }

    public function actionShowTech(){
        session_start();
        $techId = $_SESSION['techViewId'];
        $result = "";
        $listing = Listing::model()->findByPk($techId);
        $listing->VISIBLE = 1;
        if($listing->save()){
            $result = "Tech successfully listed";
        }
        else{
            $result = "Tech could not be listed";
        }
        echo CJSON::encode(array('result'=>$result,'title'=>'Unlist'));        
    //    $this->render('TechView', array("message"=>$result));        
    }

    public function actionGetCountries(){
        $listingId = $_POST['listingid'];
    }

}

<?php

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
	 * Displays the login page
	 */
	public function actionLogin()
	{
//		$model=new LoginForm;
//
//		// if it is ajax validation request
//		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
//		{
//			echo CActiveForm::validate($model);
//			Yii::app()->end();
//		}
//
//		// collect user input data
//		if(isset($_POST['LoginForm']))
//		{
//			$model->attributes=$_POST['LoginForm'];
//			// validate user input and redirect to the previous page if valid
//			if($model->validate() && $model->login())
//				$this->redirect(Yii::app()->user->returnUrl);
//		}
//		// display the login form
		$this->render('Login',array("message"=>""));
                //,array('model'=>$model)
	}
        
        public function actionMission()
        {
            $this->render('Mission');
        }

        public function actionUniversity(){
            $signedIn = null;
            Yii::app()->request->cookies['page'] = new CHttpCookie('page','University');
            if(!is_null(Yii::app()->request->cookies['user'])){
            $signedIn = Yii::app()->request->cookies['user']->value;}
            if(!is_null($signedIn)){
                $this->render('University');
            }
            else{
                $message = "Please Sign In";
                $this->render('Login',array("message"=>$message));
            }            
        }
        
        public function actionInvestor(){
            $signedIn = null;
            Yii::app()->request->cookies['page'] = new CHttpCookie('page','Investor');            
            if(!is_null(Yii::app()->request->cookies['user'])){            
            $signedIn = Yii::app()->request->cookies['user']->value;
            }
            if(!is_null($signedIn)){
                $this->render('Investor');
            }
            else{
                $message = "Please Sign In";
                $this->render('Login',array("message"=>$message));
            }            
        }
        
        	public function actionSignIn()
	{
                $email = $_POST['email'];
                $user = EmailAccount::model()->findByAttributes(array('EMAIL'=>$email));
                if(!is_null($user)){
                    if(password_verify($_POST['password'],$user->HASHPASS)){
                        Yii::app()->request->cookies['user'] = new CHttpCookie('user', $user->ID);
                        $page = Yii::app()->request->cookies['page']->value;
                        $this->render($page,array("data"=>$page, "message"=>"login successful"));                                    
                    }
                    else{
                      $this->render('Login',array("message"=>"Incorrect email/password"));
                    }
                }
                else{
                    $this->render('Login',array("message"=>"Incorrect email/password"));
                }
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
        //$thing->Save();
		unset(Yii::app()->request->cookies['user']);
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
                    $message = "Commit";
                    $transaction->commit();
                    $message .= "not commit";
                    //Yii::app()->request->cookies['user'];
                    Yii::app()->request->cookies['user'] = new CHttpCookie('user', $newUser->ID);

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
                 $html .= '
                 <li class="media">'.
                    '<a class="pull-left" href="'.Yii::app()->createUrl('Site/TechView',array('name'=>$val->ID)).'">more</a>'.
                    '<div class="media-body">'.
                        '<h4 class="media-heading">'.$val->NAME.'</h4>'.
                    '</div>'.
                 '</li>';
                }
                $html .= "</ul>";
		$this->render('TechList', array("data"=>$html));
	}
        
        public function actionTechView(){
            $pk = $_GET['name'];
            $model = null;
            if(is_null($pk)){
                $this->render('TechList', array("message"=>"Error loading page"));
            }
            else{
                $model = Listing::model()->findByPK($pk);            
                $this->render('TechView', array("tech"=>$model));               
            }
        }
        
        public function actionAddTech($message=""){
            $questions = Question::model()->findAll();
            $ql = array(); 
            $qr = array();
            for($i=0;$i<count($questions);$i++){
                if($i%2===0){
                    $ql[] = $questions[$i];
                }
                else{
                    $qr[] = $questions[$i];                    
                }
            }//"Please fill out all required fields"
            $this->render('AddTech',array("questionsLeft"=>$ql,"questionsRight"=>$qr,"message"=>$message));
        }
        
        public function actionPreviewTech(){
            $message = "";
            try{
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
                $listing->USERID = Yii::app()->request->cookies['user'];
                $jsonListing = CJSON::Encode($listing);
                Yii::app()->request->cookies['listing'] = new CHttpCookie('listing', $jsonListing);
                
                //$listing->TECHID = 1234;
              //  $message = $listing->genGUID();
              //  $message = "before questions";
                $questions = Question::model()->findAll();
                $details = array();
              //  $message = "this far";
                foreach($questions as $question){
                    if(isset($question)){
                    $details[] = $this->createQuestionValue($listing->ID,$_POST[$question->NAME],$question->NAME);}
                //    $message ="further";
                }
                $jsonDetails = CJSON::Encode($details);
                $this->render('PreviewTech',array("tech"=>$listing,"jsonDetails"=>$jsonDetails,"message"=>$message, "jsonListing"=>$jsonListing));
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
//            $list = new Listing();
//            $list->USERID = 1;
//            $list->SUBCATEGORYID = 3; 
//            $list->NAME = "TEST NAME";
//            $list->DESC = "TEST DESC";
//            $list->PATENTSTATUS = "TEST PATENT";
//            $list->LISTAGREEMENT = 1;
//            $list->RIGHTS = 1;
//            $list->RIGHTSDETAILS = "NONE";
//            $list->save();
//            
//            if($list->save()){
//                $message .= " LISTINGSAVED!!!! ";
//            }
//            else{
//                $message .= " LISTINGHELP!!! ".CJSON::Encode($quest->getErrors());
//            }            
//            
//            $quest = new QuestionValue();
//            $quest->QUESTIONID = 10000007;
//            $quest->LISTINGID = 33; 
//            $quest->VALUE = 1;
//            if($quest->save()){
//                $message .= "SAVED!!!! ";
//            }
//            else{
//                $message .= " HELP!!! ".CJSON::Encode($quest->getErrors());
//            }
            $good = true;
            $jlisting = json_decode($_POST['jsonListing']);
            $details = json_decode($_POST['jsonDetails']);            
            $transaction = Yii::app()->db->beginTransaction();
            $message = "";
            try{
                $listing = new Listing();
                $listing->USERID = 1;//Yii::app()->request->cookies['user']->value;
                $listing->NAME = $jlisting->NAME;
                $listing->DESC = $jlisting->DESC;
                $listing->RIGHTS = $jlisting->RIGHTS;
                $listing->SUBCATEGORYID = $jlisting->SUBCATEGORYID;
                $listing->PATENTSTATUS = $jlisting->PATENTSTATUS;
                $listing->LISTAGREEMENT = $jlisting->LISTAGREEMENT;
                $listing->RIGHTSDETAILS = $jlisting->RIGHTSDETAILS;
                if($listing->save()){      
                    $message .= " listing saved ";
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
                            $message .= " qv saved ";
                            $message .= " ". CJSON::Encode($qval->getErrors());
                        }
                        else{
                            $message .= " |%".$qval->QUESTIONID."%| ";
                            //.CJSON::Encode($qval->getErrors())." "
                            $good = false;                            
                        }
                        unset($qval);
                    }
                    if($good){
                        $message .= CJSON::Encode($listing->getErrors())." GOOD!";
                        $this->render('TechListed', array("message"=>$message));               
                        $transaction->commit();
                        }
                    else{
                        
                       $transaction->rollBack();
                        $jsonListing = CJSON::Encode($listing);
                        $jsonDetails = CJSON::Encode($details);
                        $message .= " Failed to list the technology";
                        $this->render('PreviewTech', array("jsonListing"=>$jsonListing, "jsonDetails"=>$jsonDetails,"message"=>$message));               
                        
                    }
                }
                else{
                    $message = "hyelp ".CJSON::Encode($listing->getErrors());

                    $message .= " listing wouldn't save ";
                    $jsonListing = CJSON::Encode($listing);
                    $jsonDetails = CJSON::Encode($details);
                    $transaction->rollBack();
                    $this->render('PreviewTech', array("jsonListing"=>$jsonListing, "jsonDetails"=>$jsonDetails,"message"=>$message));
                }
              //  unset(Yii::app()->request->cookies['listing']);               
            }
            catch(Exception $e){
               $message = "couldn't create the listing ".$e->getMessage();
               $transaction->rollBack(); 
               $jsonListing = CJSON::Encode($listing);
               $jsonDetails = CJSON::Encode($details);               
               $this->render('PreviewTech', array("jsonListing"=>$jsonListing, "jsonDetails"=>$jsonDetails,"message"=>$message));
            }
        }
}
<?php

class LoginController extends Controller
{
    
	public function actionLogin()
	{
        $email = "";
        Yii::app()->request->cookies['user'] = new CHttpCookie('user', $email);
        $page = Yii::app()->request->cookies['page']->value;
		$this->render('University');
	}

        public function signedIn(){
            if(is_null(Yii::app()->request->cookies['user'])){
                return null;
            }
            else{
                return Yii::app()->request->cookies['user']->value;
            }
        }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
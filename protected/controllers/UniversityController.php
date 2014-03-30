<?php

class UniversityController extends Controller
{
        public function actionIndex(){
            $signedIn = null;
            Yii::app()->request->cookies['page'] = new CHttpCookie('page','University');
            if(!is_null(Yii::app()->request->cookies['user'])){
            $signedIn = Yii::app()->request->cookies['user']->value;}
            if(!is_null($signedIn)){
                $this->render('index');
            }
            else{
                $message = "Please Sign In";                
               // $this->render('Site/Login',array("message"=>$message));
                $this->redirect(array('Site/Login', "message"=>$message));
            }            
        }

}
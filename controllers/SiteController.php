<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\RecordForm;
use app\models\UpdateForm;
use app\models\User;
use app\models\Listing;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('error', "You need to login or register");
            return $this->redirect(['site/login']); 
        }
        
        $model = new RecordForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $list = new Listing();
            $list->user = User::findOne(Yii::$app->user->id)->username;
            $list->start = date('d.m.Y', strtotime($model->start));
            $list->end = date('d.m.Y', strtotime($model->end));;
            $list->locking = false;
            if($list->save()){
                Yii::$app->session->setFlash('success', "Add success.");  
                return $this->goHome();
            }
        }
        $model2 = new UpdateForm();
        if (Yii::$app->request->isAjax && $model2->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model2);
        }
        if($model2->load(\Yii::$app->request->post()) && $model2->validate()){
           $upList = Listing::findOne($model2->id);
           $upList->start = date('d.m.Y', strtotime($model2->start));
           $upList->end = date('d.m.Y', strtotime($model2->end));;
           if($upList->update()){
            Yii::$app->session->setFlash('success', "Update success.");  
            return $this->goHome();
        }
        }

        $listing = Listing::find()->all();
        $isAdmin = User::findOne(\Yii::$app->user->id)->role=='admin';
        $getName = User::findOne(\Yii::$app->user->id)->username;
        return $this->render('index', compact('model','model2','listing','isAdmin','getName'));  
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }

    public function actionSignup(){
        $model = new SignupForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $user = new User();
            $user->username = $model->username;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            if(!empty($model->adminPass)){
                $user->role = 'admin';
            }
            if($user->save()){
                return $this->redirect(['site/login']);
            }

        }
        return $this->render('signup', compact('model'));
    }
    public function actionEdit($id){
        $l = Listing::findOne($id);
        $l->locking = !$l->locking;
        if($l->update()){
            return $this->goHome();
        }
    }
    public function actionDelete($id){
        Listing::findOne($id)->delete();
        return $this->goHome();
    }

}

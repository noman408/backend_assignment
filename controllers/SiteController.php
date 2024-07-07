<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\VerificationForm;
use app\models\User;
use app\models\Post;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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
        if (Yii::$app->user->isGuest) {
            return $this->render('index');
        } else {
            // $userId = Yii::$app->user->id;
            $posts = Post::find()->all();
            return $this->render('/post/index', [
                'posts' => $posts,
            ]);
        }
     }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            if ($model->hasErrors('password')) {
                $user = $model->getUser();
                if ($user && $user->status == User::STATUS_INACTIVE) {
                    return $this->redirect(['site/verify-email', 'email' => $model->username]);
                }
            }
    
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['site/verify-email']);
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionVerifyEmail()
    {
        $verificationForm = new VerificationForm();
    
        if ($verificationForm->load(Yii::$app->request->post()) && $verificationForm->validate()) {
            $user = User::findByVerificationToken($verificationForm->verification_token);
            
            if ($user) {
                $user->status = User::STATUS_ACTIVE;
                $user->save(false);
                Yii::$app->session->setFlash('success', 'Email verification successful. You can now login.');

                return $this->redirect(['dashboard']);
            } else {
                Yii::$app->session->setFlash('error', 'Invalid verification code.');
            }
        }
        return $this->render('verify', [
            'model' => $verificationForm,
        ]);
    }
    
    public function actionDashboard()
    {
        return $this->redirect(['site/login']);
    }

    public function actionValidateEmail()
    {
        $model = new SignupForm(); //
        $model->load(Yii::$app->request->post());
    
        if ($model->validate()) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return  $model->errors;
        }
    }
    

}

<?php


namespace app\controllers;

use Yii;
use app\models\Post;
use yii\web\Controller;
use app\models\Like;
use yii\web\Response;
use yii\filters\AccessControl;

class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create','like', 'unlike'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->post_status = $model->post_status;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');

            if ($model->save()) {
                return $this->redirect('/site/index');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Post::findOne($id);
        
        if (!$model) {
            throw new \yii\web\NotFoundHttpException('The requested post does not exist.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->title = $model->title;
            $model->description = $model->description;
            $model->post_status = $model->post_status;
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();

            Yii::$app->session->setFlash('success', 'Post updated successfully.');
            return $this->redirect('/site/index');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionLike($id)
    {
        $userId = Yii::$app->user->id;
        $post = $this->findModel($id);

        if ($post->isLikedBy($userId)) {
            return $this->asJson(['success' => false, 'message' => 'You have already liked this post.', 'likesCount' => $post->getLikesCount()]);
        }

        $like = new Like();
        $like->post_id = $id;
        $like->user_id = $userId;
        if ($like->save()) {
            return $this->asJson(['success' => true, 'likesCount' => $post->getLikesCount()]);
        }

        return $this->asJson(['success' => false, 'message' => 'Failed to like the post.']);
    }

    public function actionUnlike($id)
    {
        $userId = Yii::$app->user->id;
        $like = Like::find()->where(['post_id' => $id, 'user_id' => $userId])->one();

        if ($like && $like->delete()) {
            $post = $this->findModel($id);
            return $this->asJson(['success' => true, 'likesCount' => $post->getLikesCount()]);
        }

        return $this->asJson(['success' => false, 'message' => 'Failed to unlike the post.']);
    }

    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

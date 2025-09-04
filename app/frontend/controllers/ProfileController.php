<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use frontend\models\ProfileForm;
use common\models\User;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['index','update'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // logged-in only
                    ],
                ],
            ],
        ];
    }

    private function currentUser(): User
    {
        /** @var User|null $u */
        $u = User::findOne(Yii::$app->user->id);
        if (!$u) {
            throw new NotFoundHttpException('User not found.');
        }
        return $u;
    }

    // GET /profile
    public function actionIndex()
    {
        $user = $this->currentUser();
        return $this->render('index', ['user' => $user]);
    }

    // GET|POST /profile/update
    public function actionUpdate()
    {
        $user = $this->currentUser();
        $model = new ProfileForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Profile updated.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'user'  => $user,
        ]);
    }
}

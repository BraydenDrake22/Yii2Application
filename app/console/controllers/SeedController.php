<?php
namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;
use common\models\User;

class SeedController extends Controller
{
    public function actionIndex()
    {
        echo "Seeding database...\n";
        $defaults = [
            ['admin',   'admin@example.com',   'admin123'],
            ['manager', 'manager@example.com', 'manager123'],
            ['demo',    'demo@example.com',    'secret123'],
        ];
        foreach ($defaults as [$u,$e,$p]) {
            if (!User::find()->where(['username'=>$u])->exists()) {
                $user = new User();
                $user->username = $u;
                $user->email = $e;
                $user->setPassword($p);
                $user->generateAuthKey();
                $user->status = 10;
                if ($user->save()) echo "✔ created $u\n";
                else echo "✘ failed $u: ".json_encode($user->errors)."\n";
            }
        }
        return ExitCode::OK;
    }
}

<?php


namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacStartController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // добавляем роль "user"
        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $auth->add($user);

        // добавляем роль "admin"
        $personal = $auth->createRole('moderator');
        $personal->description = 'Модератор';
        $auth->add($personal);

        // добавляем роль "admin"
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $auth->add($admin);
        $auth->addChild($admin, $user);
        $auth->addChild($admin, $personal);
    }
}

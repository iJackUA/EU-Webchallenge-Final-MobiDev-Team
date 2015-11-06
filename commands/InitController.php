<?php

namespace app\commands;

use app\models\User;
use Yii;
use yii\console\Controller;

/**
 * This command inits basic data
 */
class InitController extends Controller
{
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;
        $time = microtime(true);


        //Create admin user
        echo "    > create admin user admin/admin admin@mobidev.biz\n";
        $connection = Yii::$app->db;
        $connection->createCommand()->insert('{{%user}}', [
            'username' => "admin",
            'email' => "admin@mobidev.biz",
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'confirmed_at' => time(),
            'created_at' => time(),
            'updated_at' => time(),
        ])->execute();
        $adminId = $connection->getLastInsertID('user_id_seq');

        //Create profile
        $connection->createCommand()->insert('{{%profile}}', [
            'user_id' => $adminId,
        ])->execute();

        //Create admin role
        echo "    > create admin role ...\n";
        $adminRole = $auth->createRole('Administrator');
        $adminRole->description = 'Super administrator of the system';
        $auth->add($adminRole);

        //Assign admin role to admin user
        echo "    > assign admin role to admin user ...\n";
        $manager = Yii::$app->authManager;
        $manager->assign($adminRole, $adminId);



        echo " done (time: " . sprintf('%.3f', microtime(true) - $time) . "s)\n";
    }
}

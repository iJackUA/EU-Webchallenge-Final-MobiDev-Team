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


        //Create example Survey
        echo "    > Create example survey ...\n";
        $connection->createCommand()->insert('{{%survey}}', [
            'title' => "Do you like Tea in our shop?",
            'desc' => "We would like to provide the best service to our customer, so our goal is to get every opinion. Please answer several questions to make us better.",
            'startDate' => '2015-09-01 00:00:00',
            'expireDate' => '2015-10-06 00:00:00',
            'createdBy' => $adminId,
            'created_at' => '2015-09-01 00:00:00',
            'updated_at' => '2015-09-01 00:00:00',
        ])->execute();
        $surveyId = $connection->getLastInsertID('survey_id_seq');

        //Questions
        $connection->createCommand()->insert('{{%question}}', [
            'survey_id' => $surveyId,
            'title' => "Did you like our tea?",
            'type' => "radio",
            'position' => 1,
            'meta' => '{"options":[{"id":"e5657a38-32b1-46d2-9c8d-3c0e3411302f","text":"Yes"},{"id":"db509385-2ce5-424b-8f9a-d3faa55cc4f8","text":"No"}]}',
            'uuid' => '1e860c8f-ed7d-4421-8265-0bfb9ad8b520',
            'created_at' => '2015-09-01 00:00:00',
            'updated_at' => '2015-09-01 00:00:00',
        ])->execute();
        $connection->createCommand()->insert('{{%question}}', [
            'survey_id' => $surveyId,
            'title' => "What tea did you like the most?",
            'type' => "checkboxes",
            'position' => 2,
            'meta' => '{"options":[{"id":"16d2dbf8-47c4-4747-b7aa-da9a7fc100e6","text":"Green"},{"id":"50549d5a-b83c-4a7e-b6de-162f738fdd37","text":"Black"},{"id":"9af0532d-393a-49d8-8250-173c9f6868e1","text":"Fruit"}]}',
            'uuid' => '9a89cb60-172f-4fab-a1b4-312f5831e006',
            'created_at' => '2015-09-01 00:00:00',
            'updated_at' => '2015-09-01 00:00:00',
        ])->execute();
        $connection->createCommand()->insert('{{%question}}', [
            'survey_id' => $surveyId,
            'title' => "Please describe the taste of our tea:",
            'type' => "textfield",
            'position' => 3,
            'meta' => '{"placeholder":"Awesome, tasty, normal..."}',
            'uuid' => '86586530-d034-4d34-848c-3e8031d757b0',
            'created_at' => '2015-09-01 00:00:00',
            'updated_at' => '2015-09-01 00:00:00',
        ])->execute();
        $connection->createCommand()->insert('{{%question}}', [
            'survey_id' => $surveyId,
            'title' => "How good is our service from 1 to 100?",
            'type' => "slider",
            'position' => 4,
            'meta' => '{"from":1,"to":"100","default":"70"}',
            'uuid' => '11d9bf19-1270-4910-b3d7-226e903d693d',
            'created_at' => '2015-09-01 00:00:00',
            'updated_at' => '2015-09-01 00:00:00',
        ])->execute();

        //Answers
        $connection->createCommand()->insert('{{%answer}}', [
            'survey_id' => $surveyId,
            'email' => "test@example.com",
            'meta' => '{"1e860c8f-ed7d-4421-8265-0bfb9ad8b520":"e5657a38-32b1-46d2-9c8d-3c0e3411302f","9a89cb60-172f-4fab-a1b4-312f5831e006":["16d2dbf8-47c4-4747-b7aa-da9a7fc100e6","50549d5a-b83c-4a7e-b6de-162f738fdd37"],"86586530-d034-4d34-848c-3e8031d757b0":"wow!","11d9bf19-1270-4910-b3d7-226e903d693d":"39"}',
            'created_at' => '2015-09-01 00:00:00',
            'updated_at' => '2015-09-01 00:00:00',
        ])->execute();
        $connection->createCommand()->insert('{{%answer}}', [
            'survey_id' => $surveyId,
            'email' => "test2@example.com",
            'meta' => '{"1e860c8f-ed7d-4421-8265-0bfb9ad8b520":"e5657a38-32b1-46d2-9c8d-3c0e3411302f","9a89cb60-172f-4fab-a1b4-312f5831e006":["50549d5a-b83c-4a7e-b6de-162f738fdd37","9af0532d-393a-49d8-8250-173c9f6868e1"],"86586530-d034-4d34-848c-3e8031d757b0":"haha","11d9bf19-1270-4910-b3d7-226e903d693d":"70"}',
            'created_at' => '2015-09-01 00:00:00',
            'updated_at' => '2015-09-01 00:00:00',
        ])->execute();

        //Participants
        $connection->createCommand()->insert('{{%participant}}', [
            'survey_id' => $surveyId,
            'email' => "test@example.com",
            'secretCode' => '12345678',
            'status' => 1,
            'created_at' => '2015-09-01 00:00:00',
            'updated_at' => '2015-09-01 00:00:00',
        ])->execute();
        $connection->createCommand()->insert('{{%participant}}', [
            'survey_id' => $surveyId,
            'email' => "test2@example.com",
            'secretCode' => '87654321',
            'status' => 1,
            'created_at' => '2015-09-01 00:00:00',
            'updated_at' => '2015-09-01 00:00:00',
        ])->execute();
        $connection->createCommand()->insert('{{%participant}}', [
            'survey_id' => $surveyId,
            'email' => "test3@example.com",
            'secretCode' => '87651234',
            'status' => 0,
            'created_at' => '2015-09-01 00:00:00',
            'updated_at' => '2015-09-01 00:00:00',
        ])->execute();

        echo " done (time: " . sprintf('%.3f', microtime(true) - $time) . "s)\n";
    }
}

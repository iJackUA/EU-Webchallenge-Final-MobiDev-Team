<?php

namespace app\modules\admin\controllers;

use app\components\AdminBehavior;
use dektrium\user\controllers\AdminController as BaseUsersController;

class UsersController extends BaseUsersController
{
    use AdminBehavior;
}

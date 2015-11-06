<?php

namespace app\modules\admin\controllers;

use app\components\AdminBehavior;
use dektrium\rbac\controllers\PermissionController as BasePermissionController;

class PermissionController extends BasePermissionController
{
    use AdminBehavior;
}

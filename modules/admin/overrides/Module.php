<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace app\modules\admin\overrides;

use app\components\AdminBehavior;
use Yii;
use dektrium\rbac\Module as BaseModule;

class Module extends BaseModule
{
    use AdminBehavior;
}

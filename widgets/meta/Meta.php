<?php

/**
 * @file      Meta.php
 * @date      9/5/2015
 * @time      3:10 AM
 * @author    Agiel K. Saputra <13nightevil@gmail.com>
 * @copyright Copyright (c) 2015 WritesDown
 * @license   http://www.writesdown.com/license/
 */

namespace widgets\meta;

use Yii;
use yii\widgets\Menu;
use common\components\BaseWidget;

class Meta extends BaseWidget
{
    /**
     * @var string
     */
    public $text;

    /**
     * @inheritdoc
     */
    public function init()
    {
        echo $this->beforeWidget;
        echo $this->beforeTitle . $this->title . $this->afterTitle;
        echo Menu::widget([
            'items' => [
                [
                    'label' => 'Admin',
                    'url'   => Yii::$app->urlManagerBack->baseUrl,
                    'visible' => !Yii::$app->user->isGuest
                ],
                [
                    'label'   => 'Login',
                    'url'     => Yii::$app->urlManagerBack->createUrl(['/site/login']),
                    'visible' => Yii::$app->user->isGuest
                ],
            ],
        ]);
        echo $this->afterWidget;

    }
}
<?php
/**
 * @link http://www.writesdown.com/
 * @author Agiel K. Saputra <13nightevil@gmail.com>
 * @copyright Copyright (c) 2015 WritesDown
 * @license http://www.writesdown.com/license/
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['/site/search']),
    'method' => 'get',
    'options' => ['class' => 'form-search'],
]) ?>

<div class="input-group">
    <?= Html::textInput('s', null, ['class' => 'form-control', 'placeholder' => 'Search...']) ?>

    <span class="input-group-btn">
        <?= Html::submitButton(
            '<span class="glyphicon glyphicon-search"></span>',
            ['class' => ' btn btn-default']
        ) ?>

    </span>
</div>
<?php ActiveForm::end() ?>

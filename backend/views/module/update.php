<?php
/**
 * @file      update.php
 * @date      9/1/2015
 * @time      8:45 PM
 * @author    Agiel K. Saputra <13nightevil@gmail.com>
 * @copyright Copyright (c) 2015 WritesDown
 * @license   http://www.writesdown.com/license/
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Module */

$this->title = Yii::t('writesdown', 'Update Module: {module_name}', ['module_name' => $model->module_name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('writesdown', 'Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->module_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('writesdown', 'Update');
?>

<div class="module-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use ymaker\email\templates\Module as TemplatesModule;

/**
 * View file for CRUD backend controller.
 *
 * @var \yii\web\View
 * @var \yii\data\ActiveDataProvider $dataProvider
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @since 1.0
 */
$session = Yii::$app->getSession();
?>
<div class="container">
    <div class="row">
        <?php if ($session->hasFlash('yii2-email-templates')): ?>
            <div class="col-md-12">
                <div class="alert alert-success"><?php echo $session->getFlash('yii2-email-templates'); ?></div>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <h1>
                <?php echo \Yii::t('email-templates/backend','Email templates'); ?>
                <small><?php echo \Yii::t('email-templates/backend','list of templates'); ?></small>
                <?php if (Yii::$app->controller->module->canCreate()) : ?>
                    <?php echo Html::a(
    \Yii::t('email-templates/backend','Create template'),
    Url::toRoute(['create']),
    ['class' => 'btn btn-success pull-right']
); ?>
                <?php endif; ?>

            </h1>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-12">
            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns'      => [
                    ['class' => SerialColumn::class],
                    'key',
                    [
                        'class'    => ActionColumn::class,
                        'template' => '{view} {update}' . (Yii::$app->controller->module->canDelete() ? ' {delete}' : null),
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use ymaker\email\templates\Module as TemplatesModule;

/*
 * View file for CRUD backend controller.
 *
 * @var \yii\web\View $this
 * @var \ymaker\email\templates\entities\EmailTemplate $model
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */

$this->params['breadcrumbs'][] = [
    'label' => TemplatesModule::t('Email templates list'),
    'url'   => ['default/index'],
];
$this->params['breadcrumbs'][] = TemplatesModule::t('email template - {key}', [
    'key' => $model->key,
]);

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                <?php echo TemplatesModule::t('Email templates'); ?>
                <small><?php echo TemplatesModule::t('view template'); ?></small>
            </h1>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-12">
            <div class="pull-right">
                <?php echo Html::a(
    TemplatesModule::t('Update'),
    Url::toRoute(['update', 'id' => $model->id]),
    ['class' => 'btn btn-warning']
); ?>
                <?php if (Yii::$app->controller->module->canDelete()) : ?>
                    <?php echo Html::a(
    TemplatesModule::t('Delete'),
    Url::toRoute(['delete', 'id' => $model->id]),
    ['class' => 'btn btn-danger']
); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-12">
            <?php echo \yii\widgets\ListView::widget([
                'dataProvider' => new \yii\data\ArrayDataProvider([
                    'allModels' => $model->translations,
                ]),
                'itemView' => function ($model, $key, $index, $widget) {
                    return DetailView::widget([
                        'model'      => $model,
                        'attributes' => [
                            'subject',
                            'body:html',
                            'hint',
                        ],
                    ]);
                },
            ]); ?>
        </div>
    </div>
</div>

<?php

use motion\i18n\helpers\LanguageHelper;
use yii\helpers\Html;
use yii\imperavi\Widget as ImperaviRedactor;
use yii\widgets\ActiveForm;
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
$this->params['breadcrumbs'][] = TemplatesModule::t('Update email template - {key}', [
    'key' => $model->key,
]);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                <?php echo TemplatesModule::t('Email templates'); ?>
                <small><?php echo TemplatesModule::t('update template'); ?></small>
            </h1>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(); ?>
            <?php echo $form->field($model, 'key')
                ->textInput(['disabled' => true]); ?>
            <?php foreach (LanguageHelper::getInstance()->getLocales() as $language): ?>
                <?php $translation = $model->getTranslation($language); ?>
                <?php echo $form->field($translation, 'subject')
                    ->textInput(); ?>
                <?php if (\class_exists(ImperaviRedactor::class)): ?>
                    <?php echo $form->field($translation, 'body')
                        ->widget(ImperaviRedactor::class); ?>
                <?php else: ?>
                    <?php echo $form->field($translation, 'body')->textarea(); ?>
                <?php endif; ?>
                <?php echo $form->field($translation, 'hint')
                    ->textInput(['disabled' => true]); ?>
            <?php endforeach; ?>
            <?php echo Html::submitButton(
                        TemplatesModule::t('Save'),
                        ['class' => 'btn btn-success']
                    ); ?>
            <?php $form->end(); ?>
        </div>
    </div>
</div>

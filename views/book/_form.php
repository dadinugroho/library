<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use app\models\Author;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'publisher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'published_date')->widget(DatePicker::className(), [
        'readonly' => true,
        'options' => ['placeholder' => Yii::t('app', 'Select published date')],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
        ],
    ])
    ?>

    <?=
    $form->field($model, 'authorFk')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Author::find()->active()->all(), 'id', 'fullName'),
        'options' => ['placeholder' => Yii::t('app', 'Select an author ...')],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'status')->widget(SwitchInput::classname(), [
        'pluginOptions' => [
            'onText' => Yii::t('app', 'Active'),
            'offText' => Yii::t('app', 'Inactive'),
        ]
    ]);
    ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

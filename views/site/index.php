<?php
/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Gotham City Public Library Syetem');

use yii\helpers\Html;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <p class="lead">Gotham City Public Library System</p>

        <p><?= Html::a('Search author', ['/author'], ['class' => 'btn btn-lg btn-info']); ?> | <?= Html::a('Search book', ['/book'], ['class' => 'btn btn-lg btn-success']); ?></p>
    </div>
    
</div>
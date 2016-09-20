<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Author */
?>
<div class="author-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fullName',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => $model->status ?
                        '<span class="label label-success">' . Yii::t('app', 'Active') . '</span>' :
                        '<span class="label label-danger">' . Yii::t('app', 'Inactive') . '</span>',
            ],
        ],
    ])
    ?>

    <legend><?= Yii::t('app', 'Books list') ?></legend>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
        <th><?= Yii::t('app', 'No') ?></th>
        <th><?= Yii::t('app', 'Title') ?></th>
        <th><?= Yii::t('app', 'ISBN') ?></th>
        </thead>
        <tbody>
            <?php
            if (null == $model->books || 0 == count($model->books)) {
                echo '<tr><td colspan="3">' . Yii::t('app', 'No information available.') . '</td></tr>';
            } else {
                foreach ($model->books as $idx => $myBook) {
                    echo '<tr>';
                    echo '<td>' . ++$idx . '</td>';
                    echo '<td>' . $myBook->title . '</td>';
                    echo '<td>' . $myBook->isbn . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>

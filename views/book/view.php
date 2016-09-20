<?php

use kartik\detail\DetailView;
use app\models\Book;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
?>
<div class="book-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:ntext',
            'publisher',
            'isbn',
            'published_date',
            [
                'attribute' => 'authorFk',
                'value' => $model->author->fullName
            ],
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

    <legend><?= Yii::t('app', 'Other books by this author') ?></legend>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
        <th><?= Yii::t('app', 'No') ?></th>
        <th><?= Yii::t('app', 'Title') ?></th>
        <th><?= Yii::t('app', 'ISBN') ?></th>
        </thead>
        <tbody>
            <?php
            $otherBooks = Book::find()->otherBooks($model->authorFk, $model->id)->all();
            if (null == $otherBooks || 0 == count($otherBooks)) {
                echo '<tr><td colspan="3">' . Yii::t('app', 'No information available.') . '</td></tr>';
            } else {
                foreach ($otherBooks as $idx => $myBook) {
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

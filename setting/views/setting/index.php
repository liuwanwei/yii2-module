<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;
use buddysoft\modules\setting\SettingHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\setting\models\SettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$setting = SettingHelper::defaultSetting();
$viewSetting = $setting['setting']['views']['index'];
if (isset($viewSetting['title'])) {
    $this->title = $viewSetting['title'];
}else{
    $this->title = '系统参数';
}

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="setting-index">

    <?php if ($viewSetting['showTitle'] === true): ?>
        <h1><?= Html::encode($this->title) ?></h1>    
    <?php endif ?>    

    <?php if ($viewSetting['showCreateButton'] === true): ?>
        <p>
            <?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
        </p>    
    <?php endif ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            // 'key',
            // 'value:ntext',
            [
                'attribute' => 'value',
                'value' => function($model){
                    return StringHelper::truncate($model->value, 8);
                }
            ],
            [
                'attribute' => 'description',
                'value' => function($model){
                    return StringHelper::truncate($model->description, 16);
                }
            ],
            'updatedAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
        //'options'=>['class'=>'hidden']//关闭分页
        'firstPageLabel' => "首页",
        'prevPageLabel' => '<<',
        'nextPageLabel' => '>>',
        'lastPageLabel' => '末页',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        // 数据提供者中所含数据所定义的简单的列
        // 使用的是模型的列的数据
        ['label'=>'用户账号','value' => 'username'],
        ['label'=>'最后登录时间','value' => 'logintime'],
        ['label'=>'创建时间','value' => 'createtime'],
        [
            //动作列yii\grid\ActionColumn 
            //用于显示一些动作按钮，如每一行的更新、删除操作。
           'class' => 'yii\grid\ActionColumn',
           'header' => '操作', 
           'template' => '{audit}',//操作权限
           'buttons' => [
           'audit' => function ($url, $model, $key) {
                return Html::a('<span class="glyphicon glyphicon-user"></span>', $url, ['title' => '用户权限'] ); 
            },
        ],
            'headerOptions' => ['width' => '80'],
        ],
    ],
    'summary' => '{begin}-{end}，共{totalCount}条数据，共{pageCount}页'
]);

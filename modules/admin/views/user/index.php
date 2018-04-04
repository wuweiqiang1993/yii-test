<?php

use yii\helpers\Html;
use yii\grid\GridView;
echo Html::jsFile('@web/My97DatePicker/WdatePicker.js');
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'pager' => [
        //'options'=>['class'=>'hidden']//关闭分页
        'firstPageLabel' => "首页",
        'prevPageLabel' => '<<',
        'nextPageLabel' => '>>',
        'lastPageLabel' => '末页',
    ],
    'columns' => [
        // 数据提供者中所含数据所定义的简单的列
        // 使用的是模型的列的数据
        [
            'class' => 'yii\grid\DataColumn',
            'attribute'=>'username',
            'label'=>'账号',
            'headerOptions' => ['width' => '120'],
        ],
        [
            'class' => 'yii\grid\DataColumn',
            'attribute'=>'logintime',
            'label'=>'最后登录时间',
            'headerOptions' => ['width' => '200'],
            'filterInputOptions'=>['class'=>'form-control','id'=>'logintime']
        ],
        [
            'class' => 'yii\grid\DataColumn',
            'attribute'=>'createtime',
            'label'=>'创建时间',
            'headerOptions' => ['width' => '200'],
            'filterInputOptions'=>['class'=>'form-control','id'=>'createtime']
        ],
        [
            //动作列yii\grid\ActionColumn 
            //用于显示一些动作按钮，如每一行的更新、删除操作。
           'class' => 'yii\grid\ActionColumn',
           'header' => '管理用户权限', 
           'template' => '{audit}',//操作权限
           'buttons' => [
                'audit' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-user"></span>', $url, ['title' => '用户权限'] ); 
                },
            ],
        ],
    ],
    'summary' => '{begin}-{end}，共{totalCount}条数据，共{pageCount}页'
]);
?>
<script>
$(function(){
    $('#logintime').click(function(){
        WdatePicker({el:'logintime',dateFmt:'yyyy-MM-dd HH:mm'})
    });
    $('#createtime').click(function(){
        WdatePicker({el:'createtime',dateFmt:'yyyy-MM-dd HH:mm'})
    })
})
    
</script>
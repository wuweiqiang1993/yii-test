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
            'attribute'=>'name',
            'label'=>'权限/角色',
        ],
        [
            'header'=>'类型',
            'value' => function($data) {
                switch ($data->type) {
                    case '1';
                        return '角色';
                        break;
                    case '2';
                        return '权限';
                        break;
                    default:
                        return '未知状态';
                        break;
                }
            }
        ],
        [
            'class' => 'yii\grid\DataColumn',
            'attribute'=>'rule_name',
            'label'=>'规则',
        ],
        [
            'class' => 'yii\grid\DataColumn',
            'attribute'=>'updated_at',
            'label'=>'最后修改时间',
            'filterInputOptions'=>['class'=>'form-control','id'=>'logintime']
        ],
        [
            'class' => 'yii\grid\DataColumn',
            'attribute'=>'description',
            'label'=>'描述',
            'filterInputOptions'=>['class'=>'form-control','id'=>'createtime']
        ],
        [
            //动作列yii\grid\ActionColumn 
            //用于显示一些动作按钮，如每一行的更新、删除操作。
           'class' => 'yii\grid\ActionColumn',
           'header' => '管理  '.Html::a('[增加权限/角色]', ['auth/additem'], ['class' => 'profile-link']), 
           'template' => '{audit}',//操作权限
           'buttons' => [
                'audit' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-user"></span>', $url, ['title' => '用户权限'] ); 
                },
            ],
        ],
    ],
    'summary' => '{begin}-{end}，共{totalCount}条数据，共{pageCount}页',
    'emptyText'=>'没有符合搜索项的数据',
    'layout'=>"{items}\n{pager}\n{summary}",
]);
?>
<script>
$(function(){
    $('.wDate').click(function(){
        WdatePicker({el:$(this).attr('id'),dateFmt:'yyyy-MM-dd HH:mm'})
    });
})
    
</script>
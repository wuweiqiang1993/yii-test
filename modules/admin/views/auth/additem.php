<?php

use app\models\AuthItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    "action"=> Url::toRoute(['auth/additem']),
    "method"=>"POST",
]);
echo $form->field($model, 'type')->dropdownList(
    [1=>'角色',2=>'权限'],
    ['prompt'=>'选择新增类型']
)->label('新增类型');
echo $form->field($model, 'name')->textInput()->label('角色/权限名');
echo $form->field($model, 'rule_name')->dropdownList(
    $rule->getRuleList(),
    ['prompt'=>'选择规则类型']
)->label('规则类型');?>
<div class="form-group">
    <div class="col-lg-12">
        <?= Html::submitButton('新增', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
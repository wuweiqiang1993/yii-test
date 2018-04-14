<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class AuthItem extends ActiveRecord 
{
    /**
     * @return string AR 类关联的数据库表名称
     */
    public static function tableName()
    {
        return '{{auth_item}}';
    }

    public function rules()
    {
        return [
            ['name','required','message' => '角色/权限不能为空'],
            ['type','required','message' => '类型不能为空'],
            ['name','unique','message' => '角色/权限已存在'],
            // 登录、创建时间为安全字段
        ];
    }

    public function search($params)
    {
        $query = AuthItem::find();
        
        if(!Yii::$app->request->get('sort')){
            $query->orderBy('created_at desc');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                    'pageSize' => 15,
                ],
        ]);

        // 从参数的数据中加载过滤条件，并验证
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        // 增加过滤条件来调整查询对象
        $query->andFilterWhere(['LIKE', 'name', $this->name]);
        $query->andFilterWhere(['LIKE', 'rule_name', $this->rule_name]);
        $query->andFilterWhere(['LIKE', 'description', $this->description]);
        return $dataProvider;
    }

    public function saveNewItem()
    {
        $auth = Yii::$app->authManager;
        if($this->type==1){
            $newitem = $auth->createRole($this->name);
        }else{
            $newitem = $auth->createPermission($this->name);
        }
        if($this->rule_name){
            $newitem->ruleName = $this->rule_name;
        }
        $auth->add($newitem);
    }
}

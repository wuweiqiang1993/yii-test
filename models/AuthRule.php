<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class AuthRule extends ActiveRecord 
{
    /**
     * @return string AR 类关联的数据库表名称
     */
    public static function tableName()
    {
        return '{{auth_rule}}';
    }

    public function rules()
    {
        return [
            // 安全字段
            [['name','data','created_at','updated_at'], 'safe']
        ];
    }

    public function getRuleList()
    {
        $rulelist = AuthRule::find()->select(['name'])->asArray()->all();
        $result = [];
        array_walk($rulelist,function ($value) use(&$result){
            $result[$value['name']] = $value['name'];
        });
        return $result;
    }

    public function search($params)
    {
        $query = AuthRule::find();
        
        if(!Yii::$app->request->get('sort')){
            $query->orderBy('id desc');
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
        $query->andFilterWhere(['LIKE', 'data', $this->data]);
        $query->andFilterWhere(['LIKE', 'create_at', $this->create_at]);
        return $dataProvider;
    }
}

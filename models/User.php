<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii;

class User extends ActiveRecord implements yii\web\IdentityInterface
{
    /**
     * @return string AR 类关联的数据库表名称
     */
    public static function tableName()
    {
        return '{{User}}';
    }

    public function rules()
    {
        return [
            // 登录、创建时间为安全字段
            [['username','logintime','createtime'], 'safe']
        ];
    }

    static public function findByUsername($username)
    {
        return User::find()
        ->where(['username' => $username])
        ->one();
    }

    public function validatePassword($username,$password)
    {
        $validatapass = md5(sha1('wwq'.$password));
        return User::find()
        ->where(['username' => $username,'password'=>$validatapass])
        ->one();
    }

    public function login($username)
    {
        $userInfo = User::find()->where(['username' => $username])->one();
        $userInfo->logintime = date('Y-m-d H:i:s');
        return $userInfo->save();
    }

    public function register($username,$password)
    {
        $newUser = new User();
        $newUser->username = $username;
        $newUser->password = md5(sha1('wwq'.$password));
        $newUser->createtime = date('Y-m-d H:i:s');
        $newUser->authKey = $username.time();
        return $newUser->save();
    }
    
    static public function validateUsername($username)
    {
        $userInfo = User::find()->where(['username' => $username])->one();
        return $userInfo;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function search($params)
    {
        $query = User::find();
        
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
        $query->andFilterWhere(['LIKE', 'username', $this->username]);
        $query->andFilterWhere(['>=', 'logintime', $this->logintime]);
        $query->andFilterWhere(['>=', 'createtime', $this->createtime]);
        return $dataProvider;
    }
}

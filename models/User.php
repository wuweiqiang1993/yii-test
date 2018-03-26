<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
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
            // username and password are both required
            [['logintime','createtime'], 'safe']
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
        $validatapass = md5(sha1('wwq',$password));
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
        $newUser->password = md5(sha1('wwq',$password));
        $newUser->createtime = date('Y-m-d H:i:s');
        return $newUser->save();
    }
}

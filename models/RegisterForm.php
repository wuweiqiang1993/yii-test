<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * User is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $password;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['username', 'required','message' => '用户名不能为空'],
            ['password', 'required','message' => '密码不能为空'],
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            return $user->register($this->username,$this->password);
        }
        return false;
    }
}

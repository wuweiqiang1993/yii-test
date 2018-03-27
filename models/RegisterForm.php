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
            [['username'], 'trim'],
            ['username', 'required','message' => '用户名不能为空'],
            ['username', 'validateUsername'],
            ['password', 'required','message' => '密码不能为空'],
            ['password', 'match', 'pattern' => '/^[a-zA-Z]\w{11,19}$/i','message' => '密码格式为字母开头的12~20位数字或字母'],
        ];
    }
    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (User::validateUsername($this->username)) {
                $this->addError($attribute, '该账号已存在，请重新输入账号');
            }
        }
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

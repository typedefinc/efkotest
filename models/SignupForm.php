<?php

namespace app\models;
use yii\base\Model;
 
class SignupForm extends Model{
    
    public $username;
    public $password;
    public $admin = false;
    public $adminPass;
    
    public function rules() {
        return [
            [['username', 'password','admin'], 'required'],
            ['adminPass','validateAdminPassword'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
    public function validateAdminPassword($attribute)
    {
            if ($this->adminPass!='SSXdqV0b1U') {
                $this->addError($attribute, 'Incorrect admin password.');
            }
    }
}
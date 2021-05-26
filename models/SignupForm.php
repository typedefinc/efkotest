<?php

namespace app\models;
use yii\base\Model;
 
class SignupForm extends Model{
    
    public $username;
    public $password;
    
    public function rules() {
        return [
            [['username', 'password'], 'required'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
    
}
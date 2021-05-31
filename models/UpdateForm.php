<?php

namespace app\models;
use yii\base\Model;

 
class UpdateForm extends Model{
    
    public $start;
    public $end;
    public $id;
    
    public function rules() {
        return [
            [['start', 'end','id'], 'required'],
            ['start','startDate'],
            ['end','endDate'],
        ];
    }
    
    
    public function attributeLabels() {
        return [
            'start' => 'Начало',
            'end' => 'Конец',
            'id' =>'',
        ];
    }
    public function startDate($attribute) {
        $start=strtotime($this->$attribute);
        $now=strtotime(date('d.m.Y 00:00:00',time()));
        if ($start < $now){
            $this->addError($attribute,  'Начальная дата не может быть меньше текущей.');
        }
    }
    public function endDate($attribute) {
        $end=strtotime($this->end);
        $start=strtotime($this->start);
        if ($end < $start){
            $this->addError($attribute,  'Конечная дата не может быть меньше начальной.');
        }
    }
}
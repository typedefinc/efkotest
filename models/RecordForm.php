<?php

namespace app\models;
use yii\base\Model;

 
class RecordForm extends Model{
    
    public $start;
    public $end;
    
    public function rules() {
        return [
            [['start', 'end'], 'required'],
            ['start','startDate'],
            ['end','endDate'],
        ];
    }
    
    
    public function attributeLabels() {
        return [
            'start' => 'Start',
            'end' => 'End',
        ];
    }
    public function startDate($attribute) {
        $start=strtotime($this->$attribute);
        $now=strtotime(date('d.m.Y 00:00:00',time()));
        if ($start < $now){
            $this->addError($attribute,  'Start date cannot be less than current');
        }
    }
    public function endDate($attribute) {
        $end=strtotime($this->end);
        $start=strtotime($this->start);
        if ($end < $start){
            $this->addError($attribute,  'End date cannot be less than start date');
        }
    }
}
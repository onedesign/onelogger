<?php

namespace onedesign\onelogger\models;

use craft\base\Model;

class Settings extends Model
{
  public $logLevels = [
    'warning',
    'error',
    'info',
    'profile',
    'trace'
  ];

  public function rules()
  {
    return [
      [['logLevels'], 'required']
    ];
  }
}

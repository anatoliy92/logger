<?php

namespace Avl\Logger\Models;

use Illuminate\Database\Eloquent\Model;

class AvlUser extends Model
{

  protected $table = 'users';


  public function getFioAttribute()
  {
      $fio = '';
      $fio .= !empty($this->surname)    ? $this->surname : '';
      $fio .= !empty($this->name)       ? ' ' . $this->name : '';
      $fio .= !empty($this->patronymic) ? ' ' . $this->patronymic : '';
      return $fio;
  }
}

<?php

namespace Avl\Logger\Models;

use Illuminate\Database\Eloquent\Model;

class AvlLogs extends Model
{

  protected $table = 'avl-logs';

  protected $guarded = [];

  protected $casts = [
    'previous' => 'array',
    'following' => 'array',
    'headers' => 'array'
  ];

  public function user ()
  {
    return $this->belongsTo('Avl\Logger\Models\AvlUser');
  }

  public function section ()
  {
    return $this->belongsTo('Avl\Logger\Models\AvlSections', 'section_id', 'id');
  }
}

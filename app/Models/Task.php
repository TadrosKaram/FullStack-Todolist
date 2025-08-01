<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  protected $fillable = [
    'title',
    'description',
    'urgent',
    'start_type',
    'start_date',
    'due_date',
    'estimated_minutes',
    'completed',
];


    protected $casts = [
    'start_date' => 'datetime:Y-m-d',
    'due_date' => 'datetime:Y-m-d',
];

}

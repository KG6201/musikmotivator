<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
      ];
    
      // 🔽 追加
      public static function getAllOrderBystart()
      {
        return self::orderBy('start', 'desc')->get();
      }
}

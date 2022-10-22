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
    
    public static function getAllOrderBystart()
    {
        return self::orderBy('start', 'asc')->get();
    }

    public function scheduleActions()
    {
        return $this->hasMany(Action::class);
    }
}

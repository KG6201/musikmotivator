<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    // 🔽 追加
    public static function getAllOrderByFinish()
    {
        return self::orderBy('finish', 'desc')->get();
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}

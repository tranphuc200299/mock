<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'greff_jobs';
    const STATUS = [
        'DISABLE' => 0,
        'HIRING' => 1,
        'FINISH' => 2,
        'CANCEL' => 3,
    ];
    public static function getStatus($key): string
    {
        switch ($key){
            case 0:
                return 'Disable';
            case 1:
                return 'Hiring';
            case 2:
                return 'Finish';
            case 3:
                return 'Cancel';
            default:
                return 'Not found';
        }

    }
    public $guarded = [];

    public function occupation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Occupation');
    }
}

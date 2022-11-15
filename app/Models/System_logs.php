<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System_logs extends Model
{
    use HasFactory;

    protected $table = 'system_logs';
    protected $guarded = array();

    /*
    protected $fillable = [
        'log_source', 'log_level', 'user_id', 'controller', 'method', 'url', 'user_agent', 'ip_address'
    ];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];
    */

    function addToLog($log_source, $log_level, $controller, $method){

        static::create([
            'log_source' => $log_source,
            'log_level' => $log_level,
            'url' => request()->fullUrl(),
            'controller' => $controller,
            'method' => $method,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'user_id' => auth()->check() ? auth()->user()->id : 0
        ]);

        return true;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

<?php

namespace App\Http\Controllers;

use App\Enum\LogLevel;
use App\Enum\LogSource;
use App\Models\System_logs;
use Illuminate\Support\Facades\Auth;

trait Logger
{
    public static function system_log(LogLevel $log_level, string $payload = '')
    {
        System_logs::create([
            'log_source' => LogSource::CONTROLLER,
            'log_level' => $log_level,
            'user_id' => Auth::user()->id,
            'controller' => get_calling_class(),
            'method' => get_calling_method(),
            'payload' => $payload,
            'user_agent' => request()->header('User-Agent'),
            'ip_address' => request()->ip()
        ]);
    }

    public static function database_log(LogLevel $log_level, string $sql_user, string $table, string $columns, string $old_value, string $new_value)
    {
        System_logs::create([
            'log_source' => LogSource::SQL,
            'log_level' => $log_level,
            'sql_user' => $sql_user,
            'table' => $table,
            'columns' => $columns,
            'old_value' => $old_value,
            'new_value' => $new_value
        ]);
    }
}

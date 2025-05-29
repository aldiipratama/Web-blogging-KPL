<?php

class Log {
    private static $log_file = '../app/logs/app.log'; 

    public static function init() {
        
        $log_dir = dirname(self::$log_file);
        if (!is_dir($log_dir)) {
            mkdir($log_dir, 0777, true);
        }
    }

    public static function write($message, $level = 'INFO')
    {
        self::init(); 
        $timestamp = date('Y-m-d H:i:s');
        $log_entry = "[$timestamp] [$level] $message\n";
        file_put_contents(self::$log_file, $log_entry, FILE_APPEND);
    }

    public static function info($message)
    {
        self::write($message, 'INFO');
    }

    public static function warning($message)
    {
        self::write($message, 'WARNING');
    }

    public static function error($message)
    {
        self::write($message, 'ERROR');
    }

    
    public static function userActivity($user_id, $username, $activity_description)
    {
        $message = "User ID: $user_id | Username: $username | Activity: $activity_description";
        self::info($message);
    }
}
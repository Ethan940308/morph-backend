<?php

namespace App\Enums;

enum ResponseMessage: int
{
    case CREATE = 1;
    case READ = 2;
    case UPDATE = 3;
    case DELETE = 4;
    
    public static function getDescription($data): string
    {
        return match($data) {
            self::CREATE => 'create',
            self::READ => 'read',
            self::UPDATE => 'update',
            self::DELETE => 'delete'
        };
    }
}

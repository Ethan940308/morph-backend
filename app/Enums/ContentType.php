<?php

namespace App\Enums;

enum ContentType: string
{
    case ABOUT_US = 'about_us';
    case CONTACT_US = 'contact_us';

    public function description(): string
    {
        return match($this) {
            self::ABOUT_US => 'About Us',
            self::CONTACT_US => 'Contact Us',
        };
    }
}

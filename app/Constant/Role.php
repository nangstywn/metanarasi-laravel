<?php

namespace App\Constant;

class Role
{
    const ADMIN = 1;
    const USER = 2;

    public static function label($id = false): string
    {
        if ($id === false) {
            return '';
        }

        return static::labels()[$id] ?? '';
    }

    public static function labels(): array
    {
        return [
            self::ADMIN => "Admin",
            self::USER => "User"
        ];
    }

    public static function htmlLabels(): array
    {
        return [
            self::ADMIN => 'success',
            self::USER => 'primary',
        ];
    }

    public static function toHTML($id)
    {
        $label = self::htmlLabels()[$id];
        $text = self::label($id);
        return '<span style="display:inline; color: white" class="badge badge-' . $label . '">' . $text . '</span>';
    }
    public static function html($id)
    {
        $label = self::htmlLabels()[$id];
        $text = self::label($id);
        return '<span class="badge badge-sm bg-' . $label . '">' . $text . '</span>';
    }
}

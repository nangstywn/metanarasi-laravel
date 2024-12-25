<?php

namespace App\Constant;

class Status
{
    const DRAFT = 1;
    const APPROVED = 2;

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
            self::DRAFT => "Draft",
            self::APPROVED => "Approved"
        ];
    }

    public static function htmlLabels(): array
    {
        return [
            self::DRAFT => 'primary',
            self::APPROVED => 'success',

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

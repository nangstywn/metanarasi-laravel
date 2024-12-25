<?php

namespace App\Constant;

class IsActive
{
    const NO = 0;
    const YES = 1;

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
            self::NO => "Non Active",
            self::YES => "Active"
        ];
    }

    public static function htmlLabels(): array
    {
        return [
            self::NO => 'danger',
            self::YES => 'success',
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

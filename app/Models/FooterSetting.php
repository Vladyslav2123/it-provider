<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];
    
    /**
     * Отримати значення налаштування за ключем
     *
     * @param string $key
     * @param string|null $default
     * @return string|null
     */
    public static function getValue(string $key, ?string $default = null): ?string
    {
        $setting = self::where('key', $key)->first();
        
        return $setting ? $setting->value : $default;
    }
    
    /**
     * Встановити значення налаштування
     *
     * @param string $key
     * @param string|null $value
     * @return void
     */
    public static function setValue(string $key, ?string $value): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}

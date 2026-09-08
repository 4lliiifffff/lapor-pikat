<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];

    /**
     * Cache key for storing all settings array.
     */
    public const CACHE_KEY = 'app_system_settings';

    /**
     * Retrieve a setting value by key with optional default fallback.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = Cache::rememberForever(self::CACHE_KEY, function () {
            try {
                return static::pluck('value', 'key')->toArray();
            } catch (\Throwable $e) {
                return [];
            }
        });

        if (array_key_exists($key, $settings) && ! is_null($settings[$key])) {
            return $settings[$key];
        }

        return $default;
    }

    /**
     * Set/update a setting value by key and flush cache.
     */
    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
            ]
        );

        Cache::forget(self::CACHE_KEY);

        return $setting;
    }

    /**
     * Flush all cached settings.
     */
    public static function flushCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}

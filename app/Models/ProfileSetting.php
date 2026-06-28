<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'value'])]
class ProfileSetting extends Model
{
    protected $primaryKey = 'key';
    
    public $incrementing = false;
    
    protected $keyType = 'string';

    /**
     * Get a setting value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return string|null
     */
    public static function getValue(string $key, $default = null): ?string
    {
        $setting = self::find($key);
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value by key.
     *
     * @param string $key
     * @param string|null $value
     * @return self
     */
    public static function setValue(string $key, ?string $value): self
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}

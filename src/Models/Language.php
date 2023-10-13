<?php

namespace LaravelLiberu\Localisation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelLiberu\Helpers\Contracts\Activatable;
use LaravelLiberu\Helpers\Traits\ActiveState;
use LaravelLiberu\Tables\Traits\TableCache;

class Language extends Model implements Activatable
{
    use ActiveState;
    use HasFactory;
    use TableCache;

    private const FlagClassPrefix = 'flag-icon flag-icon-';

    protected $guarded = ['id'];

    protected $casts = ['is_rtl' => 'boolean', 'is_active' => 'boolean'];

    public function updateWithFlagSufix($attributes, string $sufix)
    {
        $this->fill($attributes);

        $this->flag = self::FlagClassPrefix.$sufix;

        $this->update();
    }

    public function storeWithFlagSufix($attributes, string $sufix)
    {
        $this->fill($attributes);

        $this->flag = self::FlagClassPrefix.$sufix;

        return tap($this)->save();
    }

    public function scopeExtra($query)
    {
        return $query->where('name', '<>', config('app.fallback_locale'));
    }
}

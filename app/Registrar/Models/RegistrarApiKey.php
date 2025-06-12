<?php
namespace App\Registrar\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RegistrarApiKey extends Model
{
    protected $fillable = ['registrar_id','label','key','secret','ip_whitelist','is_active','scopes'];

    protected $casts = [
        'ip_whitelist' => 'array',
        'is_active' => 'boolean',
        'scopes' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->key = $model->key ?? 'rgp_' . Str::random(40);
            $model->secret = $model->secret ?? Str::random(64);
            $model->scopes = $model->scopes ?? ['*'];
        });
    }

    public function registrar()
    {
        return $this->belongsTo(Registrar::class);
    }
}

<?php
namespace App\Registrar\Models;

use Illuminate\Database\Eloquent\Model;

class Registrar extends Model
{
    protected $fillable = [
        'handle','legal_name','website','status',
        'allowed_tlds','credit_limit',
        'abuse_email','abuse_phone',
        'registrant_verify_deadline',
        'is_data_retention_opt_out',
        'is_essential_entity',
        'incident_webhook_url'
    ];

    protected $casts = [
        'allowed_tlds' => 'array',
        'registrant_verify_deadline' => 'datetime',
        'is_data_retention_opt_out' => 'boolean',
        'is_essential_entity' => 'boolean',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(RegistrarUser::class);
    }

    public function apiKeys()
    {
        return $this->hasMany(RegistrarApiKey::class);
    }

    public function balance()
    {
        return $this->hasOne(RegistrarBalance::class);
    }

    public function contacts()
    {
        return $this->hasMany(RegistrarContact::class);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }
}

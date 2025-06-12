<?php
namespace App\Registrar\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['registrar_id','action','payload'];

    protected $casts = ['payload'=>'array'];

    public static function log(Registrar $registrar, string $action, array $payload = [])
    {
        self::create([
            'registrar_id'=>$registrar->id,
            'action'=>$action,
            'payload'=>$payload
        ]);
    }
}

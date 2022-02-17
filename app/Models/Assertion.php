<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assertion extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $primaryKey = 'uuid';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) \Str::orderedUuid();
            $model->entity_id = (string) \Str::random(16);
        });
    }

    protected $casts = [
        'issued_on' => 'datetime',
        'expires_on' => 'datetime',
    ];

    public function setIssuedOnAttribute($value)
    {
        $this->attributes['issued_on'] = \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setExpiresOnAttribute($value)
    {
        $this->attributes['expires_on'] = \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}

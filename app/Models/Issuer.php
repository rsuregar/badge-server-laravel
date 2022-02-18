<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Issuer extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function badges()
    {
        return $this->hasMany(BadgeClass::class, 'issuer_uuid', 'uuid');
    }
}

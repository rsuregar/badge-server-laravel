<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BadgeClass extends Model
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

    public function issuer()
    {
        return $this->belongsTo(Issuer::class, 'issuer_uuid', 'uuid');
    }


}

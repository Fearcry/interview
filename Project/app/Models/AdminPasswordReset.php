<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPasswordReset extends Model
{
    use HasFactory;
    protected $table = 'admin_password_resets';
    protected $fillable = ['user_id', 'token'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Admin', 'user_id');
    }
}

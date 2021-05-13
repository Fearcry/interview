<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class passwordReset extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'password_resets';
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
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}

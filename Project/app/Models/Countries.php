<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany('App\Models\Cities', 'country_id', 'id');
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($country) {
            $country->cities()->delete();
        });
    }
}

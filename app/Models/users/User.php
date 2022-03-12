<?php

namespace App\Models\users;

use App\Traits\SlugTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use  HasFactory,SlugTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'slug',
        'password',
    ];

    protected static function boot()
    {
        parent::boot();


        static::created(function ($user) {

            //create slug for new user when creating new one
            $user->update(['slug' =>$user->generateUniqueSlug($user->full_name)]);

        });
    }


}

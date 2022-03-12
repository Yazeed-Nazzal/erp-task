<?php

namespace App\Models\users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;


    /**
     * return user data that belong to this merchant
     *
     * @return User
     */
    public function user () {
        return $this->belongsTo(User::class);
    }
}

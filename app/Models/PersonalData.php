<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    //
    protected $fillable = ['user_id', 'first_name', 'last_name', 'address', 'gender', 'date_of_birth'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

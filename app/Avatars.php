<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatars extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetitionUsers extends Model
{
    use HasFactory;
    protected $table = "petition_users";

    public function users(){
        return $this->belongsTo(User::class, 'userID');
    }

    public function petition(){
        return $this->belongTo(petition::class, 'petitionID');
    }
}

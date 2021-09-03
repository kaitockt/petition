<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;

    protected $table = 'petition';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'created_by'];

    public function signers(){
        return $this->belongsToMany(User::class, 'petition_users', 'petitionID', 'userID');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }
}

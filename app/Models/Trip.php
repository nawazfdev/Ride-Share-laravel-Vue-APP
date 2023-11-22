<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function user(){
        return $this->belongTo(User::class);
     }
     public function driver(){
        return $this->belongTo(Driver::class);
     }
}

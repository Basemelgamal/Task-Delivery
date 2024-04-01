<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'assign_by_id',
        'assign_to_id',
    ];

    public function admin(){
        return   $this->belongsTo(User::class, 'assign_to_id');
    }

    public function user(){
        return   $this->belongsTo(User::class, 'assign_by_id');
    }
}

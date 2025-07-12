<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

protected $fillable = [
    'building',
    'room',
    'equipment',
    'description',
    'email',
    'phone',
    'image_path',
    'status',
    'admin_reply'
];

}

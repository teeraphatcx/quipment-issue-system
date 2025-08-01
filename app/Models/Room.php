<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
    public function room() {
    return $this->belongsTo(Room::class);
}

}

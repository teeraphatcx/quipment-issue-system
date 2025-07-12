<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    // บอก Laravel ว่าใช้ตารางชื่อ equipments
    protected $table = 'equipments';

    protected $fillable = ['name'];
    public function room() {
    return $this->belongsTo(Room::class);
}

}

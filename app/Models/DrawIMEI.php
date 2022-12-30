<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrawImei extends Model
{
    use HasFactory;

    protected $fillable=['imei_sn','draw_date','draw_by', 'draw_store'];

    public function drawPresent(){
        
        
    }
}

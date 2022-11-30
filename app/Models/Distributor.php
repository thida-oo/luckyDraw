<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = ['distributor_code','distributor_name','superior_distributor', 'type', 'price_system', 'status'];
}

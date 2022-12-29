<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Present extends Model
{
    use HasFactory;

    public function createPresentCode(){
        $date = date('Ymdhms',strtotime(now()));
        $code = "P-". $date;
                
        return $code;
    }
}

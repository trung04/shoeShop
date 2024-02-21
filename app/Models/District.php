<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Province;

class District extends Model
{
    use HasFactory;
    public function district()
    {
        return $this->beLongsTo(Province::class);
    }

}

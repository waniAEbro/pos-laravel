<?php

namespace App\Models;

use App\Models\Sell;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reseller extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    public function sells()
    {
        return $this->hasMany(Sell::class);
    }
}

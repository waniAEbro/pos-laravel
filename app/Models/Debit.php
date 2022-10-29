<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\Reseller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Debit extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];

    protected $with = ["user", "reseller", "products"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class)->withTrashed();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot("jumlah", "harga")->withTrashed();
    }
}

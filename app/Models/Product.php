<?php

namespace App\Models;

use App\Models\Debit;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ["id"];
    protected $with = ["category", "materials"];

    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class)->withPivot("jumlah")->withTrashed();
    }

    public function debits()
    {
        return $this->belongsToMany(Debit::class)->withTrashed();
    }
}

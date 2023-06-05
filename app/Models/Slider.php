<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function slider_items()
    {
        return $this->hasMany(SliderItem::class, 'slider_id', 'id')->orderBy('position', 'asc');
    }
}

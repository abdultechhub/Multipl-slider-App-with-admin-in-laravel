<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Slider;

class SliderItem extends Model
{
    use HasFactory;

    protected $guarded = [];



    public static function getSlider($sliderSlug)
    {
        // Retrieve the slider by its slug
        $slider = Slider::where('slug', $sliderSlug)->first();

        // Check if the slider exists
        if ($slider) {
            // Retrieve the slider items related to the slider
            $sliderItems = self::where('slider_id', $slider->id)->get();

            return $sliderItems;
        }

        return null;
    }

}

<?php use App\Models\SliderItem; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.css">
    <style>
        /* body {
            background-color: #2f3640;
        } */
        * {
            margin: 0px;
            padding: 0px;
        }

        .c_slider {
            width: 100%;
            max-width: 100%;
        }

        .c_slider-c_slider {
            width: 100%;
            height: auto;
            margin: 0 0 10px 0;
        }

        .c_slider-c_slider .swiper-slide {
            width: 100%;
            /* height: 400px; */
        }

        .c_slider-c_slider .swiper-slide img {
            display: block;
            width: auto;
            height: 100%;
            margin: 0 auto;
            max-width: 100%;
        }

        .c_slider-thumbs {
            width: 230px;
            padding: 0;
            overflow: hidden;
            max-width: 100%;
            margin-top: -50px;
        }

        .c_slider-thumbs .swiper-slide {
            width: 30px;
            height: 30px;
            text-align: center;
            overflow: hidden;
            opacity: .4;
            border-radius: 50%;
            border: 2px solid rgb(255 255 255);
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, .3);
        }

        .c_slider-thumbs .swiper-slide-active {
            opacity: 1;
        }

        .c_slider-thumbs .swiper-slide img {
            width: auto;
            height: 100%;
        }

        .c_slider .swiper-button-next,
        .c_slider .swiper-button-prev {
            background: #fff;
            width: 30px;
            height: 30px;
            overflow: hidden;
            border-radius: 50%;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, .3);
        }

        .c_slider .swiper-button-next:hover,
        .c_slider .swiper-button-prev:hover {
            background: rgb(124 67 255);
            color: #fff;
        }

        .c_slider .swiper-button-next:after,
        .c_slider .swiper-button-prev:after {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="c_slider">
        @php
            $sliderSlug = 'home-slider';
            $sliderItems = SliderItem::getSlider($sliderSlug);
        @endphp
        @if ($sliderItems)
            <div class="swiper-container c_slider-c_slider">
                <div class="swiper-wrapper">
                    @foreach ($sliderItems as $sliderItem)
                        <div class="swiper-slide">
                            <picture>
                                <source media="(max-width: 767px)"
                                    srcset="{{ url('/upload/slider/small/' . $sliderItem->slider_image_mobile) }}">
                                <source media="(max-width: 968px)"
                                    srcset="{{ url('/upload/slider/medium/' . $sliderItem->slider_image_tab) }}">
                                <img src="{{ url('/upload/slider/large/' . $sliderItem->slider_image_desk) }}"
                                    alt="Sweeteners">
                            </picture>

                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            <div class="swiper-container c_slider-thumbs">
                <div class="swiper-wrapper">
                    @foreach ($sliderItems as $sliderItem_thumb)
                        <div class="swiper-slide" {{ $sliderItem_thumb->slider_image_desk }}>
                            <img src="{{ url('/upload/slider/large/' . $sliderItem_thumb->slider_image_desk) }}"
                                alt="Sweeteners">
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <p>No slider items found for the given slug.</p>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.js"></script>

    <script>
        var c_slider = new Swiper('.c_slider-c_slider', {
            slidesPerView: 1,
            centeredSlides: true,
            loop: true,
            loopedSlides: 6,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });


        var thumbs = new Swiper('.c_slider-thumbs', {
            slidesPerView: 'auto',
            spaceBetween: 10,
            centeredSlides: true,
            loop: true,
            slideToClickedSlide: true,
        });


        c_slider.controller.control = thumbs;
        thumbs.controller.control = c_slider;
    </script>
</body>

</html>

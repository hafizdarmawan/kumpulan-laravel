<?php

// link contoh helper laravel 8
//https://www.itsolutionstuff.com/post/laravel-8-create-custom-helper-functions-tutorialexample.html 

function changeDateFormat($date, $date_format)
{
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
}


function productImagePath($image_name)
{
    return public_path('images/products/' . $image_name);
}

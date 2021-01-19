<?php
function presentPrice($price)
{
    return '$' . sprintf('%01.2f', $price);
}

function setActiveCategory($category)
{
    return request()->category == $category ? 'font-weight-bold' : '';
}

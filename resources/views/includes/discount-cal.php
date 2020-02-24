<?php
$disc = $cart->discount;

$rate = $cart->discount;
$percent = $rate/100;
$discount_price = $percent * $cart->price;
$total = $cart->price - $discount_price;
$total_price = $total;
?>
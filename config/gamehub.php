<?php
return [
    'disk_delivery_status' => [
        0 => 'pending',
        1 => 'completed',
        2 => 'arrived at checkpoint',
        3 => 'delivered',
        4 => 'rejected',
        5 => 'processing',
    ],
    'order_delivery_status' => [
        0 => 'pending',
        1 => 'completed',
        2 => 'delivered',
        3 => 'rejected',
        4 => 'processing',

    ],
    'date_format' => 'd M Y',
    'disk_type' => [
        'digital_copy' => 0,
        'physical_copy' => 1,
    ],
    'mail_to' => 'contact@augnitive.com',
    'rent_limit' => 1, // user rent limit set on user create
    'pagination' => 20,
    'referred_amount' => 50,

    'delivery_charge' => 60,
    'commission' => 0.15,
    'commission_amount' => 15, // calculate in percentage

    'discount_on_commission' => true,
    'digital_game_discount' => 20,

    'offer_discount' => true,
    'offer_discount_amount' => 15, // calculate in percentage
    'offer_reference' => 'gamehub launch discount',

    'offer_on_digital_game' => true,
    'offer_percentage_digital_game' => 100, // calculate in percentage


];

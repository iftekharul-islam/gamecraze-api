<?php
return [
    'disk_delivery_status' => [
        0 => 'pending',
        1 => 'completed',
        2 => 'arrived at checkpoint',
        3 => 'delivered',
        4 => 'rejected',
        5 => 'processing',
        6 => 'postponed'
    ],
    'order_delivery_status' => [
        0 => 'pending',
        1 => 'completed',
        2 => 'delivered',
        3 => 'rejected',
        4 => 'processing',
        5 => 'postponed'

    ],
    'date_format' => 'd M Y',
    'disk_type' => [
        'digital_copy' => 0,
        'physical_copy' => 1,
    ],
    'rent_limit' => 1, // user rent limit set on user create
    'pagination' => 20,
    'referred_amount' => 50,

    'delivery_charge' => 60,
    'commission' => 0.20,
    'commission_amount' => 20, // calculate in percentage

    'discount_on_commission' => true,
    'digital_game_discount' => 20,

    'offer_discount' => true,
    'offer_on_digital_game' => true,
    'offer_on_physical_game' => true,

    'offer_discount_amount' => 15, // calculate in percentage
    'offer_percentage_digital_game' => 15, // calculate in percentage
    'offer_reference' => 'Regular discount',

    'promo_code' => 'abc',
    'promo_amount' => 100,
//    'offer_percentage_digital_game' => 100, // previous calculate in percentage
//    'offer_reference' => 'gamehub launch discount', // previous reference

    'amount_type' => [
        'flat' => 1,
        'percentage' => 2
    ],

    'user_type' => [
        'rookie' => 1,
        'elite' => 2
    ]
];

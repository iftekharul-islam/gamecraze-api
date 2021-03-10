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
    'order_delivery_status'    => [
        0 => 'pending',
        1 => 'completed',
        2 => 'delivered',
        3 => 'rejected',
        4 => 'processing',

    ],
    'date_format' => 'd M Y',
    'commission' => 0.15,
    'disk_type' => [
        'digital_copy' => 0,
        'physical_copy' => 1,
    ]
];

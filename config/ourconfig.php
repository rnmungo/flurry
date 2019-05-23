<?php

return [
	'products' => [
        'default_image' => 'DefaultProduct.png',
    ],
    'users' => [
    	'default_avatar' => 'default.png',
    ],
    'international_codes' => [
    	'default_id' => 1,
    ],
    'location' => [
        'latitude'  => env('LATITUDE', -34.6037389),
    	'longitude' => env('LONGITUDE', -58.3837591),
        'province'  => env('PROVINCE', 'Buenos Aires'),
        'country'   => env('COUNTRY', 'Argentina'),
    ],
    'user_default_config' => [
        'refresh_time' => '60',
        'days_back_cancelled' => '3',
        'acceptable_delay' => '40',
        'orders_per_page' => '8',
        'pending_orders_alerts' => '1',
    ],
    'default_location' => env('DEFAULT_LOCATION', 'Buenos Aires, Argentina'),
];

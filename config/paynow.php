<?php

return [
    'integration_id' => env('PAYNOW_INTEGRATION_ID'),
    'integration_key' => env('PAYNOW_INTEGRATION_KEY'),
    'return_url' => env('PAYNOW_RETURN_URL', 'http://example.com/gateways/paynow/update'),
    'result_url' => env('PAYNOW_RESULT_URL', 'http://example.com/return?gateway=paynow'),
];

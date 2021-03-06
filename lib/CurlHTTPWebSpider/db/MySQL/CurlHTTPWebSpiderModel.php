<?php

namespace HTTPTestingUtilities\lib\CurlHTTPWebSpider\db\MySQL;

use common\db\MySQL;
use HTTPTestingUtilities\lib\CurlHTTPWebSpider\filters\SanResponseBody;

class CurlHTTPWebSpiderModel extends MySQL\MySQLModel {

    protected $id;
    protected $url;
    protected $http_status_code;
    protected $response_time;
    protected $redirect_count;
    protected $response_length;
    protected $response_body;
    protected $binary_response_body;
    protected $content_type;
    protected $config = [
        'id' => [
            FILTER_VALIDATE_INT
        ],
        'url' => [
            FILTER_VALIDATE_URL
        ],
        'http_status_code' =>
        [
            FILTER_VALIDATE_INT,
            [
                'options' => [
                    'min_range' => 100,
                    'max_range' => 599
                ]
            ],
            'message' => 'http_status_code values must be between 100 and 599, %s returned'
        ],
        'response_time'=> [
            FILTER_VALIDATE_FLOAT
        ],
        'redirect_count'=> [
            FILTER_VALIDATE_INT
        ],
        'response_length' => [
            FILTER_VALIDATE_INT
        ],
        'content_type' => [
            FILTER_SANITIZE_STRING
        ],
        'response_body' => [
            FILTER_CALLBACK,
            [
                'options' => 
                'HTTPTestingUtilities\lib\CurlHTTPWebSpider\filters\SanResponseBody::validate'
            ]
        ],
        'binary_response_body' => [
            FILTER_UNSAFE_RAW
        ]
    ];
    protected $tables = ['ss' => 'spidered_site'];
    protected $table = 'spidered_site';

}

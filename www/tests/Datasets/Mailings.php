<?php

dataset('payloads_ok',
    [
        'With 9 Contacts' => [
            [
                ['cod' => 1, 'name' => 'John Doe', 'phones' => ['123456789', '987654321']],
                ['cod' => 2, 'name' => 'Jane Smith', 'phones' => ['097896875']],
                ['cod' => 3, 'name' => 'Bob Johnson', 'phones' =>
                    ['111111111', '222222222', '333333333', '444444444', '555555555', '666666666', '777777777', '888888888', '999999999'],
            ],
            ],
            9
        ],
        'With 8 Contacts' => [
            [
                ['cod' => 1, 'name' => 'John Doe', 'phones' => ['123456789', '987654321']],
                ['cod' => 2, 'name' => 'Jane Smith', 'phones' => ['097896875']],
                ['cod' => 3, 'name' => 'Bob Johnson', 'phones' =>
                    ['111111111', '222222222', '333333333', '444444444', '555555555', '666666666', '777777777', '888888888' ],
                ],
            ],
            8
        ],
        'With 6 Contacts' =>[
            [
                ['cod' => 1, 'name' => 'John Doe', 'phones' => ['123456789', '987654321']],
                ['cod' => 2, 'name' => 'Jane Smith', 'phones' => ['097896875']],
                ['cod' => 3, 'name' => 'Bob Johnson', 'phones' =>
                    ['111111111', '222222222', '333333333', '444444444', '555555555', '666666666'],
                ],
            ],
            6
        ],
        'With 4 Contacts' => [
            [
                ['cod' => 1, 'name' => 'John Doe', 'phones' => ['123456789', '987654321']],
                ['cod' => 2, 'name' => 'Jane Smith', 'phones' => ['097896875']],
                ['cod' => 3, 'name' => 'Bob Johnson', 'phones' =>
                    ['111111111', '222222222', '333333333', '444444444']
                ],
            ],
            4
        ],
        'COD is missing With 2 Contacts' => [
            [
                ['name' => 'John Doe', 'phones' => ['123456789', '987654321']],
                ['cod' => 2, 'name' => 'Jane Smith', 'phones' => ['097896875']],
                ['cod' => 3, 'name' => 'Bob Johnson', 'phones' =>
                    ['111111111', '222222222']
                ],
            ],
            2
        ],
        'NAME is missing With 3 Contacts' => [
            [
                ['code' => 22, 'phones' => ['123456789', '987654321']],
                ['cod' => 2, 'name' => 'Jane Smith', 'phones' => ['097896875']],
                ['cod' => 3, 'name' => 'Bob Johnson', 'phones' =>
                    ['111111111', '222222222', '333333333']
                ],
            ],
            3
        ],
        'PHONES is missing With 3 Contacts' => [
            [
                ['code' => 22, 'name' => "AAAAA"],
                ['cod' => 2, 'name' => 'Jane Smith', 'phones' => ['097896875']],
                ['cod' => 3, 'name' => 'Bob Johnson', 'phones' =>
                    ['111111111', '222222222', '333333333']
                ],
            ],
            3
        ],
    ]
);

dataset('config_fields', [
    "1 phone column" => [
        1,
        '{"col0":"cod","col1":"name","col2":"phone"}'
    ],
    "2 phone column" => [
        2,
        '{"col0":"cod","col1":"name","col2":"phone","col3":"phone"}'
    ],
    "10 phone column" => [
        10,
        '{"col0":"cod","col1":"name","col2":"phone","col3":"phone","col4":"phone","col5":"phone","col6":"phone","col7":"phone","col8":"phone","col9":"phone","col10":"phone","col11":"phone"}'
    ]
]);

dataset('file_path_strings', [
    "extension is csv.csv"     => ['api/api_carga_2022-01-01_12345.csv.csv'],
    "path is missing"          => ['api_carga_2022-01-01_12345.csv.csv'],
    "extension is missing"     => ['api/api_carga_2022-01-01_12345'],
    "slash is missing"         => ['apiapi_carga_2022-01-01_12345.csv'],
    "dot is missing"           => ['api/api_carga_2022-01-01_12345csv'],
    "random number is missing" => ['api/api_carga_2022-01-01.csv'],
    "date is missing"          => ['api/api_carga_12345.csv'],
]);

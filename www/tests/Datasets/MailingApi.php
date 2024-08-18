<?php

$contact_item = [
    'cod' => '5561981234567',
    'name' => '5561987654321',
    'phones' => ['5561987654321', '5561981234567'],
];

dataset('payload_api_ok',[
    'Payload Ok' => [
        [
            'description' => 'Test Mailing',
            'data' => [
                $contact_item,
                $contact_item,
                $contact_item,
                $contact_item,
                $contact_item
            ]
        ]
    ]
]);
dataset('payload_api_missing',[
    'Payload missing one contact' => [
        [
            'description' => 'Test Mailing',
            'data' => [
                $contact_item,
                $contact_item,
                $contact_item,
                $contact_item
            ]
        ],
        [
            "message" => "Os dados devem conter pelo menos 5 contatos.",
            "errors" => [
                "data" => [
                    "Os dados devem conter pelo menos 5 contatos."
                ]
            ]
        ]
    ],
    'Payload missing description' => [
         [
            [
                'data' => [
                    $contact_item,
                    $contact_item,
                    $contact_item,
                    $contact_item,
                    $contact_item
                ]
            ]
        ],
        [
            "message" => "A descrição é obrigatória. (and 1 more error)",
            "errors" => [
                "description" => [
                    "A descrição é obrigatória."
                ],
                "data" => [
                    "Os dados são obrigatórios."
                ]
            ]
        ]
    ],
    'Payload description (null)' => [
         [
            [
                'description' => null,
                'data' => [
                    $contact_item,
                    $contact_item,
                    $contact_item,
                    $contact_item,
                    $contact_item
                ]
            ]
        ],
        [
            "message" => "A descrição é obrigatória. (and 1 more error)",
            "errors" => [
                "description" => [
                    "A descrição é obrigatória."
                ],
                "data" => [
                    "Os dados são obrigatórios."
                ]
            ]
        ]
    ],
    'Payload description integer' => [
         [
            [
                'description' => 1,
                'data' => [
                    $contact_item,
                    $contact_item,
                    $contact_item,
                    $contact_item,
                    $contact_item
                ]
            ]
        ],
        [
            "message" => "A descrição é obrigatória. (and 1 more error)",
            "errors" => [
                "description" => [
                    "A descrição é obrigatória."
                ],
                "data" => [
                    "Os dados são obrigatórios."
                ]
            ]
        ]
    ],
    'Payload description empty string' => [
         [
            [
                'description' => '',
                'data' => [
                    $contact_item,
                    $contact_item,
                    $contact_item,
                    $contact_item,
                    $contact_item
                ]
            ]
        ],
        [
            "message" => "A descrição é obrigatória. (and 1 more error)",
            "errors" => [
                "description" => [
                    "A descrição é obrigatória."
                ],
                "data" => [
                    "Os dados são obrigatórios."
                ]
            ]
        ]
    ],
    'Payload description empty array' => [
         [
            [
                'description' => [],
                'data' => [
                    $contact_item,
                    $contact_item,
                    $contact_item,
                    $contact_item,
                    $contact_item
                ]
            ]
        ],
        [
            "message" => "A descrição é obrigatória. (and 1 more error)",
            "errors" => [
                "description" => [
                    "A descrição é obrigatória."
                ],
                "data" => [
                    "Os dados são obrigatórios."
                ]
            ]
        ]
    ],
    'Payload misssing data' => [
         [
            [
                'description' => 'Test Mailing',
            ]
        ],
        [
            "message" => "A descrição é obrigatória. (and 1 more error)",
            "errors" => [
                "description" => [
                    "A descrição é obrigatória."
                ],
                "data" => [
                    "Os dados são obrigatórios."
                ]
            ]
        ]
    ],
]);

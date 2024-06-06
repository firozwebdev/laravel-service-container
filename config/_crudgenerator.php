<?php

return [
    'tables' => [

        'Category' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string',
                'description' => 'text',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
            ],
        ],
        'Post' => [
            'columns' => [
                'id' => 'increments',
                'title' => 'string',
                'description' => 'text',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
            ],
        ],

        // Add more models here...
    ],
];

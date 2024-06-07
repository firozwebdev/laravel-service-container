<?php
return [
    'tables' => [
        'Category' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,30',
                'description' => 'text',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
            ],
        ],
        'Post' => [
            'columns' => [
                'id' => 'increments',
                'category_id' => 'foreignId',
                'title' => 'string',
                'post_status' => 'enum,[Active,Inactive,Pending,Deleted]|default:Active',
                'description' => 'text|nullable',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
            ],
        ],
        'Order' => [
            'columns' => [
                'id' => 'increments',
                'title' => 'string,25',
                'price' => 'float,4,2',
                'description' => 'text',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp',
            ],
        ],
        // Add more models here...
    ],
];

<?php
return [
    'tables' => [
        // Existing tables
        'Category' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,30',
                'description' => 'text',
                'status' => 'enum,[Active,Inactive,Pending]|default:Active',
                
            ],
        ],
        'Post' => [
            'columns' => [
                'id' => 'increments',
                'category_id' => 'foreignId',
                'title' => 'string',
                'post_status' => 'enum,[Active,Inactive,Pending,Deleted]',
                'description' => 'text|nullable',
                
            ],
        ],
        'Order' => [
            'columns' => [
                'id' => 'increments',
                'title' => 'string,25',
                'price' => 'float,4,2',
                'description' => 'text',
                
            ],
        ],

        // New tables for e-commerce
        'Customer' => [
            'columns' => [
                'id' => 'increments',
                'first_name' => 'string,50',
                'last_name' => 'string,50',
                'email' => 'string,100|unique',
                'phone' => 'string,20|nullable',
                'address' => 'text|nullable',
                
            ],
        ],
        'Product' => [
            'columns' => [
                'id' => 'increments',
                'user_id' => 'foreignId',
                'name' => 'string,100',
                'description' => 'text',
                'price' => 'float,4,2',
                'stock' => 'integer',
                'category_id' => 'foreignId',
                
            ],
        ],
        'OrderItem' => [
            'columns' => [
                'id' => 'increments',
                'order_id' => 'foreignId',
                'product_id' => 'foreignId',
                'quantity' => 'integer',
                'price' => 'float,8,2',
                
            ],
        ],
        'Payment' => [
            'columns' => [
                'id' => 'increments',
                'order_id' => 'foreignId',
                'amount' => 'float,8,2',
                'payment_method' => 'string,50',
                'payment_status' => 'enum,[Pending,Completed,Failed]|default:Pending',
                
            ],
        ],

        // New tables for CRM
        'Lead' => [
            'columns' => [
                'id' => 'increments',
                'first_name' => 'string,50',
                'last_name' => 'string,50',
                'email' => 'string,100|unique',
                'phone' => 'string,20|nullable',
                'status' => 'enum,[New,Contacted,Qualified,Lost]|default:New',
                'source' => 'string,50|nullable',
                
            ],
        ],
        'Opportunity' => [
            'columns' => [
                'id' => 'increments',
                'lead_id' => 'foreignId',
                'name' => 'string,100',
                'amount' => 'float,8,2',
                'stage' => 'enum,[Qualification,Needs Analysis,Proposal,Negotiation,Closed Won,Closed Lost]|default:Qualification',
                'close_date' => 'date|nullable',
                
            ],
        ],
        'Contact' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string',
                'first_name' => 'string,50',
                'last_name' => 'string,50',
                'email' => 'string,100|unique',
                'phone' => 'string,20|nullable',
                'company' => 'string,100|nullable',
                'position' => 'string,50|nullable',
                
            ],
        ],
        'Task' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,100',
                'description' => 'text|nullable',
                'status' => 'enum,[Not Started,In Progress,Completed,Deferred]|default:Not Started',
                'due_date' => 'date|nullable',
                'assigned_to' => 'foreignId|nullable',
                
            ],
        ],
    ],
];

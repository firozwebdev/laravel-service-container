<?php

return [
    'crm' => [
        'Contact' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Product model
            'api' => true,
            'location' => null,
        ],
        'Task' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Category model
            'api' => true,
            'location' => null,
        ],
        
        'Supplier' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Category model
            'api' => true,
            'location' => null,
        ], 
        'Employee' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Category model
            'api' => true,
            'location' => null,
        ],
        // Add more models with options as needed
    ],
    // Add more systems as needed
];

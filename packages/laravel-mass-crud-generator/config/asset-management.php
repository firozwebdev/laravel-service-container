<?php

return [
    'asset-management' => [
        'Asset' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Product model
            'api' => true,
            'location' => null,
        ],
        'AssetType' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Category model
            'api' => true,
            'location' => null,
        ],
        
        'AssetCategory' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Category model
            'api' => true,
            'location' => null,
        ], 
        'AssetMaintenance' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Category model
            'api' => true,
            'location' => null,
        ],
        'AssetDepreciation' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Category model
            'api' => true,
            'location' => null,
        ],
        
        'AssetLocation' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Category model
            'api' => true,
            'location' => null,
        ],
        'Supplier' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Category model
            'api' => true,
            'location' => null,
        ],
        'AssetPurchaseOrder' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Category model
            'api' => true,
            'location' => null,
        ],
        'PurchaseOrderItem' => [
            'options' => ['mi', 'm', 'c', 's', 'f', 'r'], // Define options for the Category model
            'api' => true,
            'location' => null,
        ],
        // Add more models with options as needed
    ],
    // Add more systems as needed
];

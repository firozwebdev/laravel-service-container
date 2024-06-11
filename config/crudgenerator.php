<?php
return [
    'tables' => [
        // New table for user
        'User' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,100',
                'email' => 'string,100|unique',
                'password' => 'string',
            ],
        ],

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
                'image' => 'image',
                'status' => 'enum,[Active,Inactive,Pending,Deleted]|default:Pending',
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
                'product_image' => 'image',
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

        // New tables for Inventory Management
        'Supplier' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,100',
                'email' => 'string,100|unique',
                'phone' => 'string,20|nullable',
                'address' => 'text|nullable',
            ],
        ],
        'Inventory' => [
            'columns' => [
                'id' => 'increments',
                'product_id' => 'foreignId',
                'quantity' => 'integer',
                'location' => 'string,100|nullable',
                'status' => 'enum,[In Stock,Out of Stock,Pending]|default:In Stock',
            ],
        ],
        'Shipment' => [
            'columns' => [
                'id' => 'increments',
                'order_id' => 'foreignId',
                'shipment_date' => 'date',
                'status' => 'enum,[Pending,Shipped,Delivered,Cancelled]|default:Pending',
                'tracking_number' => 'string,50|nullable',
            ],
        ],

        // New tables for HR Management
        'Employee' => [
            'columns' => [
                'id' => 'increments',
                'first_name' => 'string,50',
                'last_name' => 'string,50',
                'email' => 'string,100|unique',
                'phone' => 'string,20|nullable',
                'address' => 'text|nullable',
                'position' => 'string,50',
                'salary' => 'float,8,2',
                'hire_date' => 'date',
                'status' => 'enum,[Active,Inactive,Terminated]|default:Active',
            ],
        ],
        'Department' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,100',
                'description' => 'text|nullable',
                'status' => 'enum,[Active,Inactive]|default:Active',
            ],
        ],
        'Attendance' => [
            'columns' => [
                'id' => 'increments',
                'employee_id' => 'foreignId',
                'date' => 'date',
                'status' => 'enum,[Present,Absent,On Leave]|default:Present',
                'remarks' => 'text|nullable',
            ],
        ],
        'Leave' => [
            'columns' => [
                'id' => 'increments',
                'employee_id' => 'foreignId',
                'leave_type' => 'string,50',
                'start_date' => 'date',
                'end_date' => 'date',
                'status' => 'enum,[Pending,Approved,Rejected]|default:Pending',
                'reason' => 'text|nullable',
            ],
        ],
    ],
    // Table for Assets
    'Asset' => [
        'columns' => [
            'id' => 'increments',
            'asset_name' => 'string,100',
            'asset_type_id' => 'foreignId',
            'serial_number' => 'string,100|unique',
            'purchase_date' => 'date',
            'warranty_expiration_date' => 'date|nullable',
            'status' => 'enum,[Active,In Maintenance,Retired]|default:Active',
            'assigned_to' => 'foreignId|nullable',
            'location' => 'string,100|nullable',
            'price' => 'float,8,2',
            'description' => 'text|nullable',
        ],
    ],

    // Table for Asset Types
    'AssetType' => [
        'columns' => [
            'id' => 'increments',
            'type_name' => 'string,100|unique',
            'description' => 'text|nullable',
        ],
    ],

    // Table for Asset Categories
    'AssetCategory' => [
        'columns' => [
            'id' => 'increments',
            'category_name' => 'string,100|unique',
            'description' => 'text|nullable',
        ],
    ],

    // Table for Asset Maintenance
    'AssetMaintenance' => [
        'columns' => [
            'id' => 'increments',
            'asset_id' => 'foreignId',
            'maintenance_date' => 'date',
            'maintenance_type' => 'enum,[Scheduled,Unscheduled]|default:Scheduled',
            'description' => 'text|nullable',
            'cost' => 'float,8,2|nullable',
            'status' => 'enum,[Pending,Completed,In Progress]|default:Pending',
        ],
    ],

    // Table for Asset Depreciation
    'AssetDepreciation' => [
        'columns' => [
            'id' => 'increments',
            'asset_id' => 'foreignId',
            'depreciation_date' => 'date',
            'depreciation_amount' => 'float,8,2',
            'description' => 'text|nullable',
        ],
    ],

    // Table for Asset Assignments
    'AssetAssignment' => [
        'columns' => [
            'id' => 'increments',
            'asset_id' => 'foreignId',
            'assigned_to' => 'foreignId',
            'assigned_date' => 'date',
            'due_date' => 'date|nullable',
            'status' => 'enum,[Assigned,Returned,Lost,In Repair]|default:Assigned',
            'remarks' => 'text|nullable',
        ],
    ],

    // Table for Asset Locations
    'AssetLocation' => [
        'columns' => [
            'id' => 'increments',
            'location_name' => 'string,100|unique',
            'description' => 'text|nullable',
        ],
    ],

    // Table for Suppliers (providing assets)
    'Supplier' => [
        'columns' => [
            'id' => 'increments',
            'name' => 'string,100',
            'email' => 'string,100|unique|nullable',
            'phone' => 'string,20|nullable',
            'address' => 'text|nullable',
        ],
    ],

    // Table for Asset Purchase Orders
    'AssetPurchaseOrder' => [
        'columns' => [
            'id' => 'increments',
            'supplier_id' => 'foreignId',
            'order_date' => 'date',
            'delivery_date' => 'date|nullable',
            'status' => 'enum,[Pending,Completed,Cancelled]|default:Pending',
            'total_amount' => 'float,8,2',
            'remarks' => 'text|nullable',
        ],
    ],

    // Table for Purchase Order Items
    'PurchaseOrderItem' => [
        'columns' => [
            'id' => 'increments',
            'purchase_order_id' => 'foreignId',
            'asset_id' => 'foreignId|nullable',
            'quantity' => 'integer',
            'price' => 'float,8,2',
            'total' => 'float,8,2',
        ],
    ],
    // Table for Contacts
    'Contact' => [
        'columns' => [
            'id' => 'increments',
            'first_name' => 'string,50',
            'last_name' => 'string,50',
            'email' => 'string,100|unique',
            'phone' => 'string,20|nullable',
            'company' => 'string,100|nullable',
            'position' => 'string,50|nullable',
            'source' => 'string,50|nullable',
            'status' => 'enum,[Active,Inactive]|default:Active',
            'address' => 'text|nullable',
            'notes' => 'text|nullable',
        ],
    ],

    // Table for Companies
    'Company' => [
        'columns' => [
            'id' => 'increments',
            'name' => 'string,100|unique',
            'industry' => 'string,100|nullable',
            'size' => 'enum,[Small,Medium,Large]|default:Medium',
            'email' => 'string,100|nullable',
            'phone' => 'string,20|nullable',
            'website' => 'string,100|nullable',
            'address' => 'text|nullable',
            'description' => 'text|nullable',
        ],
    ],

    // Table for Leads
    'Lead' => [
        'columns' => [
            'id' => 'increments',
            'first_name' => 'string,50',
            'last_name' => 'string,50',
            'email' => 'string,100|unique',
            'phone' => 'string,20|nullable',
            'status' => 'enum,[New,Contacted,Qualified,Lost]|default:New',
            'source' => 'string,50|nullable',
            'notes' => 'text|nullable',
        ],
    ],

    // Table for Opportunities
    'Opportunity' => [
        'columns' => [
            'id' => 'increments',
            'name' => 'string,100',
            'lead_id' => 'foreignId',
            'amount' => 'float,8,2',
            'stage' => 'enum,[Prospecting,Qualification,Proposal,Negotiation,Closed Lost,Closed Won]|default:Prospecting',
            'close_date' => 'date|nullable',
            'probability' => 'integer|nullable',
            'notes' => 'text|nullable',
        ],
    ],

    // Table for Tasks
    'Task' => [
        'columns' => [
            'id' => 'increments',
            'title' => 'string,100',
            'description' => 'text|nullable',
            'status' => 'enum,[Not Started,In Progress,Completed,Deferred]|default:Not Started',
            'due_date' => 'date|nullable',
            'assigned_to' => 'foreignId|nullable',
            'related_to' => 'string,50|nullable',
            'priority' => 'enum,[Low,Medium,High]|default:Medium',
        ],
    ],

    // Table for Deals
    'Deal' => [
        'columns' => [
            'id' => 'increments',
            'title' => 'string,100',
            'amount' => 'float,8,2',
            'stage' => 'enum,[Prospecting,Qualification,Proposal,Negotiation,Closed Lost,Closed Won]|default:Prospecting',
            'close_date' => 'date|nullable',
            'probability' => 'integer|nullable',
            'notes' => 'text|nullable',
        ],
    ],

    // Table for Meetings
    'Meeting' => [
        'columns' => [
            'id' => 'increments',
            'title' => 'string,100',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'location' => 'string,100|nullable',
            'description' => 'text|nullable',
            'notes' => 'text|nullable',
        ],
    ],
    // Table for Students
    'Student' => [
        'columns' => [
            'id' => 'increments',
            'first_name' => 'string,50',
            'last_name' => 'string,50',
            'date_of_birth' => 'date',
            'gender' => 'enum,[Male,Female,Other]|default:Other',
            'email' => 'string,100|unique',
            'phone' => 'string,20|nullable',
            'address' => 'text|nullable',
            'guardian_name' => 'string,100|nullable',
            'guardian_phone' => 'string,20|nullable',
            'class_id' => 'foreignId',
            'section_id' => 'foreignId',
            'roll_number' => 'string,20|nullable',
            'admission_date' => 'date',
            'status' => 'enum,[Active,Inactive]|default:Active',
        ],
    ],

    // Table for Teachers
    'Teacher' => [
        'columns' => [
            'id' => 'increments',
            'first_name' => 'string,50',
            'last_name' => 'string,50',
            'date_of_birth' => 'date',
            'gender' => 'enum,[Male,Female,Other]|default:Other',
            'email' => 'string,100|unique',
            'phone' => 'string,20|nullable',
            'address' => 'text|nullable',
            'qualification' => 'string|nullable',
            'joining_date' => 'date',
            'status' => 'enum,[Active,Inactive]|default:Active',
        ],
    ],

    // Table for Classes
    'Class' => [
        'columns' => [
            'id' => 'increments',
            'name' => 'string,50|unique',
            'description' => 'text|nullable',
        ],
    ],

    // Table for Sections
    'Section' => [
        'columns' => [
            'id' => 'increments',
            'name' => 'string,50|unique',
            'description' => 'text|nullable',
        ],
    ],

    // Table for Subjects
    'Subject' => [
        'columns' => [
            'id' => 'increments',
            'name' => 'string,50|unique',
            'description' => 'text|nullable',
        ],
    ],

    // Table for Assignments
    'Assignment' => [
        'columns' => [
            'id' => 'increments',
            'title' => 'string,100',
            'description' => 'text|nullable',
            'due_date' => 'date|nullable',
            'subject_id' => 'foreignId',
            'teacher_id' => 'foreignId',
        ],
    ],

    // Table for Exams
    'Exam' => [
        'columns' => [
            'id' => 'increments',
            'name' => 'string,100',
            'description' => 'text|nullable',
            'date' => 'date',
        ],
    ],

    // Table for Grades
    'Grade' => [
        'columns' => [
            'id' => 'increments',
            'name' => 'string,50|unique',
            'min_score' => 'integer',
            'max_score' => 'integer',
        ],
    ],

    // Table for Results
    'Result' => [
        'columns' => [
            'id' => 'increments',
            'student_id' => 'foreignId',
            'exam_id' => 'foreignId',
            'subject_id' => 'foreignId',
            'grade_id' => 'foreignId',
            'score' => 'float,5,2',
        ],
    ],

    // Table for Attendance
    'Attendance' => [
        'columns' => [
            'id' => 'increments',
            'date' => 'date',
            'student_id' => 'foreignId',
            'status' => 'enum,[Present,Absent,Leave]|default:Present',
        ],
    ],

    // Table for Fees
    'Fee' => [
        'columns' => [
            'id' => 'increments',
            'student_id' => 'foreignId',
            'amount' => 'float,8,2',
            'description' => 'text|nullable',
            'payment_date' => 'date',
        ],
    ],
    // Table for Employees
    'Employee' => [
        'columns' => [
            'id' => 'increments',
            'first_name' => 'string,50',
            'last_name' => 'string,50',
            'date_of_birth' => 'date',
            'gender' => 'enum,[Male,Female,Other]|default:Other',
            'email' => 'string,100|unique',
            'phone' => 'string,20|nullable',
            'address' => 'text|nullable',
            'department' => 'string,100|nullable',
            'designation' => 'string,100|nullable',
            'joining_date' => 'date',
            'status' => 'enum,[Active,Inactive]|default:Active',
        ],
    ],

    // Table for Tasks
    'Task' => [
        'columns' => [
            'id' => 'increments',
            'title' => 'string,100',
            'description' => 'text|nullable',
            'due_date' => 'date|nullable',
            'status' => 'enum,[Not Started,In Progress,Completed,Deferred]|default:Not Started',
            'assigned_to' => 'foreignId|nullable',
        ],
    ],

    // Table for Events
    'Event' => [
        'columns' => [
            'id' => 'increments',
            'title' => 'string,100',
            'description' => 'text|nullable',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'location' => 'string,100|nullable',
        ],
    ],

    // Table for Notes
    'Note' => [
        'columns' => [
            'id' => 'increments',
            'title' => 'string,100',
            'content' => 'text|nullable',
            'category' => 'string,50|nullable',
            'priority' => 'enum,[Low,Medium,High]|default:Medium',
        ],
    ],

    // Table for Expenses
    'Expense' => [
        'columns' => [
            'id' => 'increments',
            'title' => 'string,100',
            'amount' => 'float,8,2',
            'description' => 'text|nullable',
            'date' => 'date',
        ],
    ],

    // Table for Contacts
    'Contact' => [
        'columns' => [
            'id' => 'increments',
            'name' => 'string,100',
            'email' => 'string,100|unique',
            'phone' => 'string,20|nullable',
            'address' => 'text|nullable',
            'company' => 'string,100|nullable',
            'position' => 'string,50|nullable',
            'notes' => 'text|nullable',
        ],
    ],

    // Table for Projects
    'Project' => [
        'columns' => [
            'id' => 'increments',
            'title' => 'string,100',
            'description' => 'text|nullable',
            'start_date' => 'date|nullable',
            'end_date' => 'date|nullable',
            'status' => 'enum,[Not Started,In Progress,Completed,On Hold,Canceled]|default:Not Started',
        ],
    ],

    // Table for Reminders
    'Reminder' => [
        'columns' => [
            'id' => 'increments',
            'title' => 'string,100',
            'description' => 'text|nullable',
            'date' => 'datetime',
            'is_completed' => 'boolean|default:false',
        ],
    ],
    // Table for Customers
    'Customer' => [
        'columns' => [
            'id' => 'increments',
            'first_name' => 'string,50',
            'last_name' => 'string,50',
            'email' => 'string,100|unique',
            'phone' => 'string,20|nullable',
            'address' => 'text|nullable',
            'city' => 'string,50|nullable',
            'state' => 'string,50|nullable',
            'zip_code' => 'string,20|nullable',
        ],
    ],

    // Tables for Loan management system
    'Loan' => [
        'columns' => [
            'id' => 'increments',
            'customer_id' => 'foreignId',
            'amount' => 'decimal,10,2',
            'interest_rate' => 'decimal,5,2',
            'term' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
            'status' => 'enum,[Pending,Active,Completed,Defaulted]|default:Pending',
        ],
    ],

    // Table for Payments
    'Payment' => [
        'columns' => [
            'id' => 'increments',
            'loan_id' => 'foreignId',
            'amount' => 'decimal,10,2',
            'payment_date' => 'date',
        ],
    ],

    // Table for Transactions
    'Transaction' => [
        'columns' => [
            'id' => 'increments',
            'loan_id' => 'foreignId',
            'type' => 'enum,[Disbursement,Repayment]|default:Disbursement',
            'amount' => 'decimal,10,2',
            'transaction_date' => 'date',
        ],
    ],

    // Table for Documents
    'Document' => [
        'columns' => [
            'id' => 'increments',
            'loan_id' => 'foreignId',
            'title' => 'string,100',
            'file_path' => 'string,255',
            'description' => 'text|nullable',
            'uploaded_by' => 'foreignId',
            'uploaded_at' => 'datetime',
        ],
    ],

    // Table for Collateral
    'Collateral' => [
        'columns' => [
            'id' => 'increments',
            'loan_id' => 'foreignId',
            'name' => 'string,100',
            'description' => 'text|nullable',
            'value' => 'decimal,10,2',
        ],
    ],

    // Table for Borrowers
    'Borrower' => [
        'columns' => [
            'id' => 'increments',
            'first_name' => 'string,50',
            'last_name' => 'string,50',
            'email' => 'string,100|unique',
            'phone' => 'string,20|nullable',
            'address' => 'text|nullable',
            'city' => 'string,50|nullable',
            'state' => 'string,50|nullable',
            'zip_code' => 'string,20|nullable',
            'company' => 'string,100|nullable',
            'position' => 'string,50|nullable',
        ],
    ],
    // Table for Users
    'User' => [
        'columns' => [
            'id' => 'increments',
            'name' => 'string,100',
            'email' => 'string,100|unique',
            'password' => 'string',
        ],
    ],

    // Tables for File Management System
    // Table for Files
    'File' => [
        'columns' => [
            'id' => 'increments',
            'user_id' => 'foreignId',
            'name' => 'string,255',
            'description' => 'text|nullable',
            'file_path' => 'string,255',
            'file_size' => 'integer',
            'file_type' => 'string,50',
            'uploaded_at' => 'timestamp',
        ],
    ],

    // Table for Folders
    'Folder' => [
        'columns' => [
            'id' => 'increments',
            'user_id' => 'foreignId',
            'parent_id' => 'integer|nullable',
            'name' => 'string,255',
            'description' => 'text|nullable',
        ],
    ],

    // Table for Shared Files
    'SharedFile' => [
        'columns' => [
            'id' => 'increments',
            'file_id' => 'foreignId',
            'shared_with' => 'integer',
            'shared_at' => 'timestamp',
        ],
    ],

    // Table for Tags
    'Tag' => [
        'columns' => [
            'id' => 'increments',
            'name' => 'string,100',
        ],
    ],

    // Pivot Table for File-Tag Relationship
    'FileTag' => [
        'columns' => [
            'file_id' => 'integer',
            'tag_id' => 'integer',
        ],
    ],

    // Table for File Versions
    'FileVersion' => [
        'columns' => [
            'id' => 'increments',
            'file_id' => 'foreignId',
            'version' => 'integer',
            'file_path' => 'string,255',
            'file_size' => 'integer',
            'created_at' => 'timestamp',
        ],
    ],

];

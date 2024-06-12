<?php
return [
    'tables' => [
        'User' => [
            'columns' => [
                'id' => 'increments',
                'username' => 'string,100',
                'email' => 'string,100|unique',
                'password' => 'string',
                'role' => 'enum,[Admin,Instructor,Student]|default:Student',
            ],
        ],
        'Student' => [
            'columns' => [
                'id' => 'increments',
                'user_id' => 'foreignId',
                'first_name' => 'string,50',
                'last_name' => 'string,50',
                'dob' => 'date',
                'gender' => 'enum,[Male,Female,Other]',
                'address' => 'text|nullable',
                'city' => 'string,50|nullable',
                'state' => 'string,50|nullable',
                'zip_code' => 'string,20|nullable',
                'enrollment_date' => 'date',
                'department_id' => 'foreignId',
                'program_id' => 'foreignId',
            ],
        ],
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
        'Parent' => [
            'columns' => [
                'id' => 'increments',
                'user_id' => 'foreignId',
                'first_name' => 'string,50',
                'last_name' => 'string,50',
                'address' => 'text|nullable',
                'city' => 'string,50|nullable',
                'state' => 'string,50|nullable',
                'zip_code' => 'string,20|nullable',
                'phone' => 'string,20|nullable',
                'email' => 'string,100|unique',
            ],
        ],
        'Class' => [
            'columns' => [
                'id' => 'increments',
                'course_id' => 'foreignId',
                'faculty_id' => 'foreignId',
                'semester' => 'string,20',
                'year' => 'integer',
            ],
        ],
        'Subject' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,50',
                'description' => 'text|nullable',
                'class_id' => 'foreignId',
                'teacher_id' => 'foreignId',
            ],
        ],
        'Enrollment' => [
            'columns' => [
                'id' => 'increments',
                'student_id' => 'foreignId',
                'course_id' => 'foreignId',
                'enrollment_date' => 'date',
                'status' => 'enum,[Active,Completed,Withdrawn]|default:Active',
            ],
        ],
        'Attendance' => [
            'columns' => [
                'id' => 'increments',
                'student_id' => 'foreignId',
                'class_id' => 'foreignId',
                'date' => 'date',
                'status' => 'enum,[Present,Absent,Late]|default:Present',
            ],
        ],
        'Exam' => [
            'columns' => [
                'id' => 'increments',
                'course_id' => 'foreignId',
                'title' => 'string,100',
                'description' => 'text|nullable',
                'date' => 'date',
                'total_marks' => 'integer',
            ],
        ],
        'Result' => [
            'columns' => [
                'id' => 'increments',
                'student_id' => 'foreignId',
                'exam_id' => 'foreignId',
                'marks_obtained' => 'integer',
                'grade' => 'string,2',
            ],
        ],
        'Fee' => [
            'columns' => [
                'id' => 'increments',
                'student_id' => 'foreignId',
                'amount' => 'decimal,10,2',
                'due_date' => 'date',
                'status' => 'enum,[Paid,Unpaid,Overdue]|default:Unpaid',
            ],
        ],
        'Payment' => [
            'columns' => [
                'id' => 'increments',
                'fee_id' => 'foreignId',
                'amount' => 'decimal,10,2',
                'payment_date' => 'date',
                'payment_method' => 'enum,[Cash,Credit Card,Bank Transfer]|default:Cash',
            ],
        ],
        'Event' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,50',
                'description' => 'text|nullable',
                'date' => 'date',
                'location' => 'string,100',
                'status' => 'enum,[Scheduled,Completed,Cancelled]|default:Scheduled',
            ],
        ],
        'LibraryBook' => [
            'columns' => [
                'id' => 'increments',
                'title' => 'string,100',
                'author' => 'string,50',
                'isbn' => 'string,20|unique',
                'category' => 'string,50',
                'status' => 'enum,[Available,Borrowed,Reserved]|default:Available',
            ],
        ],
        'Borrow' => [
            'columns' => [
                'id' => 'increments',
                'student_id' => 'foreignId',
                'book_id' => 'foreignId',
                'borrow_date' => 'date',
                'return_date' => 'date|nullable',
                'status' => 'enum,[Borrowed,Returned,Overdue]|default:Borrowed',
            ],
        ],
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
        'Supplier' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,100',
                'email' => 'string,100|unique|nullable',
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
        'Department' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,100',
                'description' => 'text|nullable',
                'head_id' => 'foreignId|nullable',
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
        'AssetType' => [
            'columns' => [
                'id' => 'increments',
                'type_name' => 'string,100|unique',
                'description' => 'text|nullable',
            ],
        ],
        'AssetCategory' => [
            'columns' => [
                'id' => 'increments',
                'category_name' => 'string,100|unique',
                'description' => 'text|nullable',
            ],
        ],
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
        'AssetDepreciation' => [
            'columns' => [
                'id' => 'increments',
                'asset_id' => 'foreignId',
                'depreciation_date' => 'date',
                'depreciation_amount' => 'float,8,2',
                'description' => 'text|nullable',
            ],
        ],
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
        'AssetLocation' => [
            'columns' => [
                'id' => 'increments',
                'location_name' => 'string,100|unique',
                'description' => 'text|nullable',
            ],
        ],
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
        'Assignment' => [
            'columns' => [
                'id' => 'increments',
                'course_id' => 'foreignId',
                'title' => 'string,100',
                'description' => 'text|nullable',
                'due_date' => 'date',
            ],
        ],
        'Grade' => [
            'columns' => [
                'id' => 'increments',
                'course_id' => 'foreignId',
                'student_id' => 'foreignId',
                'grade' => 'string,2|nullable',
                'remarks' => 'text|nullable',
            ],
        ],
        'Note' => [
            'columns' => [
                'id' => 'increments',
                'title' => 'string,100',
                'content' => 'text|nullable',
                'category' => 'string,50|nullable',
                'priority' => 'enum,[Low,Medium,High]|default:Medium',
            ],
        ],
        'Expense' => [
            'columns' => [
                'id' => 'increments',
                'title' => 'string,100',
                'amount' => 'float,8,2',
                'description' => 'text|nullable',
                'date' => 'date',
            ],
        ],
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
        'Reminder' => [
            'columns' => [
                'id' => 'increments',
                'title' => 'string,100',
                'description' => 'text|nullable',
                'date' => 'datetime',
                'is_completed' => 'boolean|default:false',
            ],
        ],
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
        'Transaction' => [
            'columns' => [
                'id' => 'increments',
                'loan_id' => 'foreignId',
                'type' => 'enum,[Disbursement,Repayment]|default:Disbursement',
                'amount' => 'decimal,10,2',
                'transaction_date' => 'date',
            ],
        ],
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
        'Collateral' => [
            'columns' => [
                'id' => 'increments',
                'loan_id' => 'foreignId',
                'name' => 'string,100',
                'description' => 'text|nullable',
                'value' => 'decimal,10,2',
            ],
        ],
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
        'Folder' => [
            'columns' => [
                'id' => 'increments',
                'user_id' => 'foreignId',
                'parent_id' => 'integer|nullable',
                'name' => 'string,255',
                'description' => 'text|nullable',
            ],
        ],
        'SharedFile' => [
            'columns' => [
                'id' => 'increments',
                'file_id' => 'foreignId',
                'shared_with' => 'integer',
                'shared_at' => 'timestamp',
            ],
        ],
        'Tag' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,100',
            ],
        ],
        'FileTag' => [
            'columns' => [
                'file_id' => 'integer',
                'tag_id' => 'integer',
            ],
        ],
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
        'Faculty' => [
            'columns' => [
                'id' => 'increments',
                'user_id' => 'foreignId',
                'first_name' => 'string,50',
                'last_name' => 'string,50',
                'dob' => 'date',
                'gender' => 'enum,[Male,Female,Other]',
                'address' => 'text|nullable',
                'city' => 'string,50|nullable',
                'state' => 'string,50|nullable',
                'zip_code' => 'string,20|nullable',
                'hire_date' => 'date',
                'department_id' => 'foreignId',
                'designation' => 'string,50',
            ],
        ],
        'Program' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,100',
                'description' => 'text|nullable',
                'department_id' => 'foreignId',
                'duration' => 'integer',
            ],
        ],
        'Course' => [
            'columns' => [
                'id' => 'increments',
                'title' => 'string,100',
                'description' => 'text|nullable',
                'instructor_id' => 'foreignId',
                'start_date' => 'date',
                'end_date' => 'date|nullable',
                'status' => 'enum,[Planned,Active,Completed]|default:Planned',
            ],
        ],
        'Hostel' => [
            'columns' => [
                'id' => 'increments',
                'name' => 'string,100',
                'location' => 'string,100',
                'total_rooms' => 'integer',
            ],
        ],
        'Room' => [
            'columns' => [
                'id' => 'increments',
                'hostel_id' => 'foreignId',
                'room_number' => 'string,10',
                'capacity' => 'integer',
                'status' => 'enum,[Available,Occupied,Maintenance]|default:Available',
            ],
        ],
        'HostelAllocation' => [
            'columns' => [
                'id' => 'increments',
                'student_id' => 'foreignId',
                'room_id' => 'foreignId',
                'allocation_date' => 'date',
                'status' => 'enum,[Active,Inactive]|default:Active',
            ],
        ],
        'Transport' => [
            'columns' => [
                'id' => 'increments',
                'vehicle_number' => 'string,20',
                'driver_name' => 'string,50',
                'route' => 'string,100',
                'capacity' => 'integer',
            ],
        ],
        'TransportAllocation' => [
            'columns' => [
                'id' => 'increments',
                'student_id' => 'foreignId',
                'transport_id' => 'foreignId',
                'allocation_date' => 'date',
                'status' => 'enum,[Active,Inactive]|default:Active',
            ],
        ],
        'Profile' => [
            'columns' => [
                'id' => 'increments',
                'user_id' => 'foreignId',
                'first_name' => 'string,50',
                'last_name' => 'string,50',
                'dob' => 'date',
                'gender' => 'enum,[Male,Female,Other]',
                'address' => 'text|nullable',
                'city' => 'string,50|nullable',
                'state' => 'string,50|nullable',
                'zip_code' => 'string,20|nullable',
            ],
        ],
        'Module' => [
            'columns' => [
                'id' => 'increments',
                'course_id' => 'foreignId',
                'title' => 'string,100',
                'description' => 'text|nullable',
                'order' => 'integer',
            ],
        ],
        'Lesson' => [
            'columns' => [
                'id' => 'increments',
                'module_id' => 'foreignId',
                'title' => 'string,100',
                'content' => 'text',
                'video_url' => 'string,255|nullable',
                'order' => 'integer',
            ],
        ],
        'Submission' => [
            'columns' => [
                'id' => 'increments',
                'assignment_id' => 'foreignId',
                'student_id' => 'foreignId',
                'submitted_at' => 'timestamp',
                'file_url' => 'string,255|nullable',
                'grade' => 'integer|nullable',
                'feedback' => 'text|nullable',
            ],
        ],
        'Question' => [
            'columns' => [
                'id' => 'increments',
                'exam_id' => 'foreignId',
                'question_text' => 'text',
                'question_type' => 'enum,[MCQ,TrueFalse,ShortAnswer,Essay]',
                'marks' => 'integer',
            ],
        ],
        'Option' => [
            'columns' => [
                'id' => 'increments',
                'question_id' => 'foreignId',
                'option_text' => 'text',
                'is_correct' => 'boolean|default:false',
            ],
        ],
        'ExamSubmission' => [
            'columns' => [
                'id' => 'increments',
                'exam_id' => 'foreignId',
                'student_id' => 'foreignId',
                'submitted_at' => 'timestamp',
                'total_marks' => 'integer|nullable',
            ],
        ],
        'Answer' => [
            'columns' => [
                'id' => 'increments',
                'exam_submission_id' => 'foreignId',
                'question_id' => 'foreignId',
                'answer_text' => 'text|nullable',
                'marks_obtained' => 'integer|nullable',
            ],
        ],
        'Discussion' => [
            'columns' => [
                'id' => 'increments',
                'course_id' => 'foreignId',
                'user_id' => 'foreignId',
                'title' => 'string,100',
                'content' => 'text',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp|nullable',
            ],
        ],
        'Comment' => [
            'columns' => [
                'id' => 'increments',
                'discussion_id' => 'foreignId',
                'user_id' => 'foreignId',
                'content' => 'text',
                'created_at' => 'timestamp',
                'updated_at' => 'timestamp|nullable',
            ],
        ],
        'Notification' => [
            'columns' => [
                'id' => 'increments',
                'user_id' => 'foreignId',
                'message' => 'text',
                'is_read' => 'boolean|default:false',
                'created_at' => 'timestamp',
            ],
        ],
    ],
];

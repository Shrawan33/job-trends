<?php

return [
    'platforms' => [
        'web' => 'Web',
        'api' => 'API'
    ],
    'state' => [
        'data' => [
            'active' => 'Active', 'archived' => 'Inactive', 'deleted' => 'Deleted'
        ],
        'color-class' => [
            'active' => 'primary', 'archived' => 'warning', 'deleted' => 'danger'
        ]
    ],
    'approval_status' => [
        'data' => [
            0 => 'Waiting for Approval', 1 => 'Approved', 2 => 'Rejected', 3 => 'Cancel'
        ],
        'color-class' => [
            0 => 'warning', 1 => 'success', 2 => 'danger', 3 => 'primary'
        ],
        'icon-class' => [
            0 => 'ionicons ion-android-stopwatch', 1 => 'fa fa-check', 2 => 'fa fa-times'
        ],
        'text' => [
            0 => 'Waiting for Review', 1 => 'Approved', 2 => 'Rejected', 3 => 'Cancelled'
        ]
    ],
    'currency_symbol' => '₹',
    'currency_code' => 'Rs',
    'dropzone' => [
        'maxFiles' => 1,
        'acceptedFiles' => ['pdf' => 'application/pdf', 'documents' => 'application/pdf,.doc,.docx,.xls,.xlsx,.csv', 'picture' => 'image/*', 'video' => 'video/*', 'audio' => 'audio/*', 'word' => 'application/pdf,.doc,.docx'],
        // 'maxFilesize' => 10, // in MB
        'maxFilesize' => ['video' => 2, 'pdf' => 1, 'picture' => 100, 'documents' => 100, 'audio' => 1,'word' => 1], // in MB,

    ],
    'document_type' => ['image' => 0, 'document' => 1, 'cropped_images' => 2, 'video' => 3, 'audio' => 4, 'cover_letter' => 5, 'order_document' => 6],
    'display_date_timezone' => env('USER_TIMEZONE', 'UTC'),
    'format' => [
        'date' => 'M d, Y',
        'time' => 'h:i A',
        'datetime' => 'M d, Y h:i A',
        'moment_date' => 'MMM D, Y',
        'moment_datetime' => 'MMM D, Y hh:mm A',
        'sql_date' => 'YYYY-MM-DD',
    ],
    'default_configuration_model' => [
        'general' => [
            'label' => [
                'package_access' => 'Package Access',
                'sms_access' => 'SMS Access'
                // 'bas_charge' => 'BAS Charges',
                // 'labour_cost_above_300_kg' => 'Labour cost above 300 kg',
                // 'custom' => 'Custom',
                // 'document_fees' => 'Document Fees'
            ],
            'type' => [
                'package_access' => 'checkbox',
                'sms_access' => 'checkbox',
                // 'labour_cost_above_300_kg' => 'decimal',
                // 'custom' => 'decimal',
                // 'document_fees' => 'decimal'
            ],
            'postfix' => [
                // 'profit_margin' => '%',
                // 'custom' => '%',
                // 'document_fees' => 'BD'
            ]
        ],
        'contact' => [
            'label' => [
                'tag_line' => 'Tag Line',
                'email' => 'Email',
                'phone' => 'Phone',
                'location' => 'Location'
            ],
            'type' => [
                'tag_line' => 'text',
                'email' => 'email',
                'phone' => 'text',
                'location' => 'textarea'
            ],
            'postfix' => [
            ]
        ],
        'pricing' => [
            'label' => [
                'price' => 'Price',
                'gst' => 'GST',
                // 'disc_test' => 'Disc Test',
                // 'disc_test_duration' => 'Expire Duration'
            ],
            'type' => [
                'price' => 'decimal',
                'gst' => 'numeric',
                // 'disc_test' => 'decimal',
                // 'disc_test_duration' => 'numeric'
            ],
            'postfix' => [
                //'cover_video' => '',
                'gst' => '%',
                // 'disc_test' => 'Peso',
                // 'disc_test_duration' => 'Days'
            ]
        ],
    ],
    'document_disk_field_mapping' => [
        'customer' => 'customer_id'
    ],
    'yesno' => [
        1 => 'Yes',
        0 => 'No',
    ],
    'pad_number' => 4,
    'default_dd_limit' => null,
    'configuration_setting_type' => [
        1 => 'prefix',
        2 => 'pattern',
        3 => 'general'
    ],
    'number_patterns' => [
        'general' => [
            '{$counter}',
            '{$year}',
            '{$date:format}' => [
                'extra_info' => ' <a href="https://php.net/manual/en/function.date.php" target="_blank">See options</a>'
            ]
        ]
    ],
    'sessionConfigurationParams' => ['general', 'contact', 'pricing'],
    'non_staff_roles' => [
        'employer',
        'jobseeker'
    ],
    'icheck-class' => 'icheck-primary',
    'application_tracking_status' => [
        1 => 'Shortlisted',
        2 => 'Rejected'
    ],
    'user_role' => [
        'Employer' => 'employer',
        'Jobseeker' => 'jobseeker',
        'admin' => 'admin'
    ],
    'lang' => [
        'en' => 'English',
        'hi' => 'Hindi',
        'de' => 'Germany'
    ],
    'image_mime' => [
        'image/jpeg',
        'image/jpg',
        'image/png'
    ],
    'google_captcha' => [
        'site_key' => env('GOOGLE_CAPTCHA_SITE_KEY'),
        'secret_key' => env('GOOGLE_CAPTCHA_SECRET_KEY')
    ],
    'verification_code' => [
        'length' => [
            'phone' => 5,
            'email' => 5
        ],
        'fake' => '11111'
    ],
    'salary_type' => [
        'data' => [
            0 => 'Hourly',
            1 => 'Daily',
            2 => 'Monthly',
            3 => 'Yearly'
        ],
    ],
    'gender' => [
        1 => 'Male',
        2 => 'Female'
    ],
    'currency' => [
        1 => 'INR',
        2 => 'US Dollar',
        3 => 'Dirham'
    ],
    'marital_status' => [
        1 => 'Single',
        2 => 'Married',
        3 => 'Divorced'
    ],

    'religion' => [
        'Hinduism' => 'Hinduism',
        'Islam' => 'Islam',
        'Christianity' => 'Christianity',
        'Sikhism' => 'Sikhism',
        'Jewish' => 'Jewish',
        'Budhist' => 'Budhist',
        'Parsi' => 'Parsi',
        'Others' => 'Others',
        'N/A' => 'N/A'
    ],
    'pagination' => [
        'page_no' => 10
    ],
    'years_range' => [
        'duration_from' => date('Y', strtotime('-60 year', time())),
        'duration_to' => date('Y'),
    ],
    'education_years_range' => [
        'education_duration_from' => date('Y', strtotime('-60 year', time())),
        'education_duration_to' => date('Y'),
    ],
    'months_range' => [
            'January' => 'January',
            'February' => 'February',
            'March' => 'March',
            'April' => 'April',
            'May' => 'May',
            'June' => 'June',
            'July' => 'July',
            'August' => 'August',
            'September' => 'September',
            'October' => 'October',
            'November' => 'November',
            'December' => 'December',

    ],
    'candidate_status' => [
        'Awaiting Review' => 'Awaiting Review',
        'Shortlisted' => 'Shortlisted',
        'Contacting' => 'Contacting',
        'Hired' => 'Hired',
        'Rejected' => 'Rejected',
        // '4' => 'Unido',
    ],
    'question_types' => [
        'list' => [
            1 => 'basic',
            2 => 'mcq'
        ],
        'applicable' => 1
    ],
    'questions_limit' => 5,
    // 'message_type' => [
    //     'data' => [
    //         1 => 'Received',
    //         2 => 'Sent'
    //     ],
    //     'default' => 1
    // ],

    'message_type' => [
        'data' => [
            1 => 'Received',
            2 => 'Sent'
        ],
        'default' => 2
    ],
    'front_login' => ['employer','jobseeker'],
    'staff_login' => ['admin','mentor','account'],

    'phone_prefix' => env('PHONE_PREFIX', ''),
    'token_valid_till' => 60,
    'message_length' => 500,
    'enable_cover_video' => false,
    'home_categories_count' => 8,
    'home_events_count' => 8,
    'home_jobs_count' => 4,
    'home_featured_count' => 4,
    'package_status' => [
        null => 'Pending',
        0 => 'Expired',
        1 => 'Active',
        2 => 'Hold'
    ],
    // 'credit_fields' => ['profile', 'job_posts', 'sms'],
    // 'credit_fields' => ['profile', 'job_posts'],
    // 'jobseeker_credit_fields' => ['resume_posts'],
    'credit_fields' => ['profile', 'job_posts'],
    'jobseeker_credit_fields' => [],
    'duration_package_day' => [
        'before_end_date' => 2,
        'before_grace_date' => 2
    ],
    'nationality_choices' => [
        'data' => [1 => 'Indian', 0 => 'Others'],
        'default' => 1
    ],
    'public_choices' => [
        'data' => [1 => 'Public', 0 => 'Private'],
        'default' => 1
    ],
    'visa_status' => [
        'data' => [1 => 'N/A', 0 => 'Active'],
        'default' => 1
    ],

    'payment' => [
        'entity_types' => [0 => 'plan', 1 => 'video', 2 => 'disc_test'],
        'transaction_status' => [0 => 'pending', 1 => 'success', 2 => 'failed']
    ],
    'criteria' => [
        1 => 'Communication',
        2 => 'Core Skills',
        3 => 'Attitute',
        4 => 'Presentation',
        5 => 'Reponse Level',
        6 => 'Comfortness'
    ],
    'level_range' => [
        'score' => [
            1 => [
                1 => 2,
                2 => 4,
                3 => 6,
                4 => 8,
                5 => 10
            ],
            2 => [
                1 => 2,
                2 => 4,
                3 => 6,
                4 => 8,
                5 => 10
            ],
            3 => [
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5
            ],
            4 => [
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5
            ],
            5 => [
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5
            ],
            6 => [
                1 => 2,
                2 => 4,
                3 => 6,
                4 => 8,
                5 => 10
            ]
        ],
        'max_score_by_criteria' => [
            1 => 10,
            2 => 10,
            3 => 5,
            4 => 5,
            5 => 5,
            6 => 10
        ],
        'total_score' => 45
    ],
    'candidate_score' => [
        1 => 'Average Candidate',
        2 => 'Fair Candidate',
        3 => 'Good Candidate ',
        4 => 'Best Candidate',
        5 => 'Excellent Candidate',
    ],
    'criteria_max_level' => 5,
    'criteria_max_prefix' => 'L',
    'free_paid_filter' => [
        1 => 'Free',
        2 => 'Paid'
    ],
    'default_country_id' => env('DEFAULT_COUNTRY_ID', 356),
    'react_search_job' => env('REACT_SEARCH_JOB', false),
    'image_type' => [
        'thumb' => 'thumbnail',
        'small' => '40*40'
    ],
    'job_type_id' => env('JOB_TYPE_ID', 1),
    'review_category_type' => [
        1 => 'Strengths',
        2 => 'Challenges'
    ],
    'badges' => [
        'eagle' => 'Eagle',
        'dove' => 'Dove',
        'owl' => 'Owl',
        'peacock' => 'Peacock'
    ],
    'review_type' => [
       1 => 'basic',
       2 => 'advance'
    ],
    'is_anonymous' => [
        0 => 'False',
        1 => 'True'
    ],
    'criteria' => [
        1 => 'Communication',
        2 => 'Core Skills',
        3 => 'Attitute',
        4 => 'Presentation',
        5 => 'Reponse Level',
        6 => 'Comfortness'
    ],
    'package_type' => [
        '' => "Select Package Type",
        1 => 'Use our expertise',
        2 => 'Use ChatGPT service',
        3 => 'Normal service',
        4 => 'Military Service',
        5 => 'Interview Service',
        6 => 'Combo Service'

    ],
    'employer_package_type' => [
        '' => "Select Package Type",
        1 => 'Job Posting',
        2 => 'Profile Access'
    ],
    'payment_status' => [0 => 'Pending', 1 => 'Success', 2 => 'Failed'],
    'order_process_status' => [0 => 'Pending', 1 => 'Completed'],

    'notification_audience' => [
        0 => 'Jobseeker',
        1 => 'Employer',
    ],

    'important_announcement_subject' => 'Important Announcement From ' . env('APP_NAME'),

];

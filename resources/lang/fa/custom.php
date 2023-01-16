<?php
return [
    'all_items' => 'همه',
    'messages' => [
        'errors' => [
            'login' => 'ابتدا باید وارد سیستم شوید.',
            'dont_have_permission_for_download' => 'شما امکان دانلود فایل مورد نظر را ندارید.',
            'dont_have_any_active_packages' => 'شما در حال حاضر پکیج فعالی ندارید.',
            'download_book_pages_finished' => 'تعداد صفحات دانلود کتاب برای حساب کاربری به اتمام رسیده است.',
            'download_book_pages_low' => 'تعداد صفحات دانلود کتاب برای حساب کاربری شما کمتر از تعداد صفحات کتاب مورد نظر است.',
            'download_article_count_finished' => 'تعداد دانلود مقاله برای حساب کاربری شما به اتمام رسیده است.',
            'download_article_count_low' => 'تعداد دانلود مقاله برای حساب کاربری شما کمتر از سقف مجاز شما است.',

            'api' => [
                'not_dont_have_allow_register_address' => 'ابتدا باید ثبت نام خود را تکمیل کنید.',
                'not_found_for_verify' => 'کاربر مورد نظر در سیستم ثبت نام نشده است.',
                'cart_empty' => 'سبد خرید شما خالی است.',
                'verification_code_is_expired' => 'کد تایید منقضی شده است.',
                'verification_code_is_invalid' => 'کد تایید ارسال شده درست نیست.',
                'verification_code_count_is_limited' => 'امکان دریافت کد تایید در این زمان وجود ندارد.',
                'receipt' => [
                    'in_limit_time' => 'شما سفارشات تکمیل نشده ای دارید.',
                    'in_limit_time1' => 'سقف مجاز سفارش شما به اتمام رسیده است.',
                ],
                'auth' => [
//                    'max_attempt_count' => 'حساب کاربری شما به مدت ۵ دقیقه بلاک شده است. لطفا پس از این مدت مجددا تلاش نمایید.',
                    'max_attempt_count' => 'سقف مجاز تعداد لاگین به اتمام رسیده است لطفا پس از چند دقیقه مجددا اقدام نمایید.'
                ]
            ]
        ],
    ],
    'accessors' => [
        'is_accepted' => [
            '0' => 'تاییدنشده',
            '1' => 'تاییدشده',
        ],
        'is_registered' => [
            '0' => 'ثبت نام نشده',
            '1' => 'ثبت نام شده',
        ],
        'answer_types' => [
            'single' => 'یک‌گزینه‌ای',
            'multi' => 'چندگزینه‌ای',
        ],
        'has_description' => [
            '1' => 'بله',
            '0' => 'خیر',
        ],
        'is_free' => [
            '0' => 'غیر رایگان',
            '1' => 'رایگان',
        ],
        'is_read' => [
            '0' => 'دیده‌نشده',
            '1' => 'دیده‌شده',
        ],
        'is_payed' => [
            '0' => 'پرداخت‌نشده',
            '1' => 'پرداخت‌شده',
        ],
        'messages_type' => [
            'sent' => 'پیام‌های ارسال‌شده',
            'received' => 'پیام‌های دریافت‌شده',
        ],
        'messages' => [
            'type' => [
                'sent' => 'پیام‌های ارسال‌شده',
                'received' => 'پیام‌های دریافت‌شده',
                'all' => 'پیام‌ها'
            ],
            'side_type' => [
                'sent' => 'دریافت‌کننده',
                'received' => 'ارسال‌کننده',
            ],
        ],
        'book_type' => [
            '1' => 'کتاب',
            '2' => 'نوشته',
        ],
        'package_type' => [
            '1' => 'رایگان',
            '2' => 'همراه با پکیج',
        ],
        'post_type' => [
            'post' => 'پست',
            'audible' => 'کوتاه و شنیدنی'
        ]
    ],
    'constants' => [
        'ACTIVE' => 'فعال',
        'INACTIVE' => 'غیرفعال',
        'AVAILABLE' => 'موجود',
        'UNAVAILABLE' => 'ناموجود',

        'ROLE_DYNAMIC' => 'داینامیک',
        'ROLE_STATIC' => 'استاتیک',

        'SATURDAY' => 'شنبه',
        'SUNDAY' => 'یکشنبه',
        'MONDAY' => 'دوشنبه',
        'TUESDAY' => 'سه شنبه',
        'WEDNESDAY' => 'چهارشنبه',
        'THURSDAY' => 'پنجشنبه',
        'FRIDAY' => 'جمعه',

        'USER_ACTIVATION_STATUS_ACTIVE' => 'فعال',
        'USER_ACTIVATION_STATUS_UNACTIVE' => 'غیرفعال',

        'USER_ACTIVATION_MOBILE' => 'فعال سازی با موبایل',
        'USER_ACTIVATION_EMAIL' => 'فعال سازی با ایمیل',
        'USER_GENDER_MALE' => 'آقا',
        'USER_GENDER_FEMALE' => 'خانم',

        'ROOM_NORMAL' => 'عادی',
        'ROOM_MEETINGS' => 'جلسات',

        'CENTER_STATUS_ACTIVE' => 'فعال',
        'CENTER_STATUS_INACTIVE' => 'غیرفعال',

        'SCHEDULE_STATUS_ACTIVE' => 'فعال',
        'SCHEDULE_STATUS_INACTIVE' => 'غیرفعال',

        'USER_ACTIVATION_MOBILE' => 'فعال سازی با SMS',
        'USER_ACTIVATION_EMAIL' => 'فعال سازی با ایمیل',

        'MEETING_HOLDING_STATUS_WAITING_FOR_START' => 'در انتظار برگزاری',
        'MEETING_HOLDING_STATUS_ON_PERFORMING' => 'در حال برگزاری',
        'MEETING_HOLDING_STATUS_TERMINATED' => 'خاتمه یافته',
        'MEETING_HOLDING_STATUS_NOT_HELD' => 'برگزار نشده',

        'MEETING_PERIODIC_NON_PERIODIC' => 'غیر دوره‌ای',
        'MEETING_PERIODIC_DAILY' => 'روزانه',
        'MEETING_PERIODIC_WEEKLY' => 'هفته‌ای',
        'MEETING_PERIODIC_TWO_WEEKLY' => 'دو هفته‌ای',
        'MEETING_PERIODIC_MONTHLY' => 'ماهانه',

        'EVENT_STATUS_ACTIVE' => 'فعال',
        'EVENT_STATUS_INACTIVE' => 'غیرفعال',

        'EVENT_PERIODIC_NON_PERIODIC' => 'غیر دوره‌ای',
        'EVENT_PERIODIC_DAILY' => 'روزانه',
        'EVENT_PERIODIC_WEEKLY' => 'هفته‌ای',
        'EVENT_PERIODIC_TWO_WEEKLY' => 'دو هفته‌ای',
        'EVENT_PERIODIC_MONTHLY' => 'ماهانه',

        'MESSAGE_SYSTEMIC' => 'سيستمي',
        'MESSAGE_NON_SYSTEMIC' => 'غير سيستمي',
        'MESSAGE_STATUS_SEEN' => 'ديده شده',
        'MESSAGE_STATUS_UNSEEN' => 'ديده نشده',

        'MEETING_STATUS_ACTIVE' => 'فعال',
        'MEETING_STATUS_INACTIVE' => 'غیر فعال',
        'MEETING_STATUS_CANCELED' => 'لغو شده',
    ],

];

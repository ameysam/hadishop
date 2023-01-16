<?php

return [

    'currency_label' => 'ریال',
    'layout' => [

        'admin' => [],

        'front' => [
            'title' => config('app.name'),
            'menus' => [
                'home' => 'خانه',
                'contact_us' => 'تماس با ما',
                'about_us' => 'درباره ما',
                'products' => 'کالاها',
                'packages' => 'پکیج ها',
                'basket' => 'سبد خرید',
                'login' => 'ورود',
                'register' => 'ثبت نام',
                'blog' => 'وبلاگ',
                'search' => 'جستجو',
            ],
        ],
    ],

    'home' => [

        'admin' => [],

        'front' => [
            'titles' => [
                'instagram' => 'اینستاگرام',
                'packages' => 'پکیج ها',
                'products' => 'کالاها',
                'sliders' => 'اسلایدر',
                'home' => 'خانه',
            ],

        ],
    ],

    'pages' => [
        'products' => [
            'index' => [
                'title' => 'کالاها',
                'description' => 'لیست کالاها',
            ],
            'details' => [
                'title' => 'کالا',
                'description' => 'جزئیات کالا',
            ],
        ]
    ],

    'auth' => [
        'login' => [
            'page' => [
                'title' => 'ورود به سـامـانه',
            ],
            'form' => [
                'mobile_no' => 'شماره همراه',
                'national_id' => 'کد ملی (شماره پرسنلی)',
                'passport_id' => 'شماره پاسپورت',
                'remember_me' => 'مرا به خاطر بسپار',
                'btn_login' => 'ورود به سیستم',
                'logging_in' => 'درحال ورود ...',
                'username' => 'نام کاربری (یا پست الکترونیکی)',
                'password' => 'رمز عبور',
            ],
            'validation' => [
                'mobile_no' => 'شماره همراه',
                'username' => 'نام کاربری',
                'email' => 'پست الکترونیکی',
                'password' => 'رمز عبور',
                'captcha' => 'کد امنیتی',
                'national_id' => 'کد ملی (شماره پرسنلی)',
                'passport_id' => 'شماره پاسپورت',
            ],
            'response' => [
                'register' => 'متاسفانه اکانت شما فعال نشده است!',
                'confirm' => '',
                'reject' => 'متاسفانه ثبت نام شما مورد پذیرش واقع نشده است.',
                'block' => 'متاسفانه اکانت شما به دلایل خاصی بلاک شده است.',
            ],
        ],
        'register' => [
            'page' => [
                'title' => 'ثبت نام',
            ],
            'form' => [
                'username' => 'نام کاربری',
                'email' => 'پست الکترونیکی',
                'password' => 'رمز عبور',
                'password_confirmation' => 'تکرار رمز عبور',
                'first_name' => 'نام',
                'last_name' => 'نام خانوادگی',
                'mobile_no' => 'شماره همراه',
                'id_no' => 'کد ملی (شماره پرسنلی)',
                'captcha' => 'تصویر',
                'btn_register' => 'ثبت نام',
                'registering' => 'درحال ارسال اطلاعات ...',
            ],
            'validation' => [
                'username' => 'نام کاربری',
                'email' => 'پست الکترونیکی',
                'password' => 'رمز عبور',
                'password_confirmation' => 'تکرار رمز عبور',
                'first_name' => 'نام',
                'last_name' => 'نام خانوادگی',
                'mobile_no' => 'شماره همراه',
                'captcha' => 'تصویر',
            ],
            'response' => [
                'success' => 'ثبت نام شما با موفقیت انجام شد و با تایید مدیر میتوانید وارد سایت شوید.'
            ],
        ],
    ],

];

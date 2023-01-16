<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'id_no' => '«:attribute» نادرست است.',
    'captcha' => '«:attribute» نادرست است.',
    'date_jalali' => 'فیلد «:attribute» نادرست است.',
    'jalali_date_time' => 'فیلد «:attribute» نادرست است.',
    'max_word' => 'فیلد «:attribute» بیشتر از 150 کلمه است.',
    'accepted' => 'The «:attribute» must be accepted.',
    'active_url' => 'The «:attribute» is not a valid URL.',
    'after' => 'فیلد «:attribute» باید پس از تاریخ :date باشد.',
    'after_or_equal' => 'فیلد «:attribute» باید پس از تاریخ :date و یا برابر با آن باشد.',
    'alpha' => 'The «:attribute» may only contain letters.',
    'alpha_dash' => 'The «:attribute» may only contain letters, numbers, and dashes.',
    'alpha_num' => 'The «:attribute» may only contain letters and numbers.',
    'array' => 'The «:attribute» must be an array.',
    'before' => 'The «:attribute» must be a date before :date.',
    'before_or_equal' => 'The «:attribute» must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The «:attribute» must be between :min and :max.',
        'file' => 'The «:attribute» must be between :min and :max kilobytes.',
        'string' => 'The «:attribute» must be between :min and :max characters.',
        'array' => 'The «:attribute» must have between :min and :max items.',
    ],
    'boolean' => 'فیلد «:attribute» فقط میتواند شامل درست یا نادرست باشد.',
    'confirmed' => 'فیلد «:attribute» با فیلد تکرار «:attribute» برابر نیست.',
    'date' => 'The «:attribute» is not a valid date.',
    'date_format' => 'قالب فیلد «:attribute» با قالب صحیح تاریخ مطابقت ندارد.',
    // 'date_format' => 'The «:attribute» does not match the format :format.',
    'different' => 'The «:attribute» and :other must be different.',
    'digits' => 'طول فیلد «:attribute» حتما باید :digits رقم باشد.',
    'digits_between' => 'طول فیلد «:attribute» باید بین :min و :max باشد.',
    'dimensions' => 'The «:attribute» has invalid image dimensions.',
    'distinct' => 'The «:attribute» field has a duplicate value.',
    'email' => 'فرمت «:attribute» معتبر نیست.',
    'exists' => 'فیلد «:attribute» نادرست است.',
    'file' => 'The «:attribute» must be a file.',
    'filled' => 'The «:attribute» field must have a value.',
    'image' => 'The «:attribute» must be an image.',
    'in' => 'فیلد «:attribute» نادرست است.',
    'in_array' => 'The «:attribute» field does not exist in :other.',
    'integer' => 'The «:attribute» must be an integer.',
    'ip' => 'The «:attribute» must be a valid IP address.',
    'ipv4' => 'The «:attribute» must be a valid IPv4 address.',
    'ipv6' => 'The «:attribute» must be a valid IPv6 address.',
    'json' => 'The «:attribute» must be a valid JSON string.',
    'max' => [
        'numeric' => 'فیلد «:attribute» باید کوچکتر از :max باشد.',
        'file' => 'حجم فایل «:attribute» نباید بیشتر از :max کیلوبایت باشد.',
        'string' => 'فیلد «:attribute» حداکثر می تواند :max کاراکتر باشد.',
        'array' => 'تعداد «:attribute» نباید بیشتر از :max عدد باشد.',
    ],
    #'mimes' => 'The «:attribute» must be a file of type: :values.',
    'mimes' => 'نوع فیلد «:attribute» باید از :values باشد.',
    'mimetypes' => 'The «:attribute» must be a file of type: :values.',
    'min' => [
        'numeric' => 'فیلد «:attribute» باید بیشتر از :min باشد.',
        'file' => 'The «:attribute» must be at least :min kilobytes.',
        'string' => 'فیلد «:attribute» باید بیشتر از :min کاراکتر باشد.',
        'array' => 'فیلد «:attribute» نباید کمتر از :min عدد باشد.',
    ],
    'not_in' => 'فیلد «:attribute» نادرست است.',
    'numeric' => 'مقدار فیلد «:attribute» باید عدد باشد.',
    'present' => 'The «:attribute» field must be present.',
    'regex' => 'فیلد «:attribute» معتبر نیست.',
    'required' => 'فیلد «:attribute» را کامل کنید.',
    'required_if' => 'فیلد «:attribute» را کامل کنید.',
//    'required_if' => 'The «:attribute» field is required when :other is :value.',
    'required_unless' => 'The «:attribute» field is required unless :other is in :values.',
    'required_with' => 'فیلد «:attribute» در صورت انتخاب فیلد :values الزامی  می باشد.',
    'required_with_all' => 'The «:attribute» field is required when :values is present.',
    'required_without' => 'The «:attribute» field is required when :values is not present.',
    'required_without_all' => 'The «:attribute» field is required when none of :values are present.',
    'same' => 'The «:attribute» and :other must match.',
    'size' => [
        'numeric' => 'اندازه فیلد «:attribute» باید :size کاراکتر باشد.',
        'file' => 'The «:attribute» must be :size kilobytes.',
        'string' => 'اندازه فیلد «:attribute» باید :size کاراکتر باشد.',
        'array' => 'The «:attribute» must contain :size items.',
    ],
    'string' => 'The «:attribute» must be a string.',
    'timezone' => 'The «:attribute» must be a valid zone.',
    'unique' => 'این «:attribute» قبلا ثبت شده است.',
    'uploaded' => 'The «:attribute» failed to upload.',
    'url' => 'فرمت «:attribute» معتبر نیست.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'province_id' => [
            'required' => 'فیلد «:attribute» را انتخاب کنید.',
        ],
        'city_id' => [
            'required' => 'فیلد «:attribute» را انتخاب کنید.',
        ],
    ],

    'values' => [
        'day' => [
            'tomorrow' => 'فردا',
            'today' => 'امروز',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'address' => 'نشانی',
        'birth_date' => 'تاریخ تولد',
        'province_id' => 'استان',
        'city_id' => 'شهر',
        'content' => 'متن',
        'email' => 'پست الکترونیکی',
        'finish_at' => 'تاریخ پایان',
        'first_name' => 'نام',
        'image' => 'عکس',
        'lang' => 'زبان',
        'last_name' => 'نام خانوادگی',
        'latitude' => 'عرض جغرافیایی',
        'link' => 'لینک',
        'location' => 'جایگاه',
        'longitude' => 'طول جغرافیایی',
        'mobile_no' => 'شماره همراه',
        'id_no' => 'کد ملی (شماره پرسنلی)',
        'p_code' => 'کد پستی',
        'old_password' => 'رمز عبور قدیمی',
        'password' => 'رمز عبور',
        'password_confirmation' => 'تکرار رمز عبور',
        'phone_no' => 'شماره تماس',
        'phones' => 'شماره های تماس',
        'price' => 'قیمت',
        'priority' => 'اولویت',
        'role' => 'نقش',
        'start_at' => 'تاریخ شروع',
        'status' => 'وضعیت',
        'slug' => 'نامک',
        'summary' => 'خلاصه',
        'tags' => 'کلمات کلیدی',
        'title' => 'عنوان',
        'username' => 'نام کاربری',
        'display_name' => 'نام نمایشی',
        'description' => 'توضیحات',
        'logo' => 'لوگو',
        'discount_id' => 'تخفیف',
        'rial_form_discount_id' => 'تخفیف ریالی',
        'percentage_discount_id' => 'تخفیف درصدی',
        'lat' => 'مختصات نقشه',
        'lon' => 'مختصات نقشه',
        'terms_of_use' => 'قوانین استفاده از نیکان سرویس',
        'payment_type' => 'نوع پرداخت',
        'info_id' => 'اطلاعات دریافت کننده',
        'time_id' => 'زمان ارسال',
        'code' => 'کد فعال سازی',
        'order_count' => 'تعداد',
        'national_no' => 'کد ملی (شماره پرسنلی)',
    ],
];

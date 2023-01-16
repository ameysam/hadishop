<?php

namespace App\Http\Controllers\ContactUs\Api;

use App\Constants\DBConstant;
use App\Constants\Types\ContactUs\ContactUsSubjectType;
use App\Constants\ErrorResponse;
use App\Constants\HttpCode;
use App\Http\Controllers\Controller;
use App\Models\ContactUsForm;
use App\Rules\Mobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        $request->merge([
            'mobile_no' => Str::removeCountryCodeFromMobileNo($request['mobile_no'])
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:' . DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH,
            'type' => 'required|min:1:max:255',
            'email' => 'nullable|email|max:' . DBConstant::MARIA_FIELD_STRING_MEDIUM_LENGTH,
            'mobile' =>  ["nullable", new Mobile()],
            'description' => 'required|string|max:2000',
        ], [], [
            'name' => 'نام',
            'type' => 'موضوع',
            'email' => 'پست الکترونیکی',
            'mobile' => 'شماره همراه',
            'description' => 'توضیحات',
        ]);

        if ($validator->fails())
        {
            return Response::apiResponse(ErrorResponse::get(HttpCode::_422, $validator->errors()), HttpCode::_422);
        }

        ContactUsForm::create([
            'name' => $request['name'],
            'subject_type' => $request['type'],
            'mobile_no' => $request['mobile'],
            'email' => $request['email'],
            'description' => $request['description'],
        ]);

        return Response::apiResponse(ErrorResponse::get(HttpCode::_200), HttpCode::_200);
    }
}

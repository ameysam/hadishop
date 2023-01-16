@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', 'شما اجازه دسترسی به این صفحه را ندارید.')
{{-- @section('message', __($exception->getMessage() ?: 'دسترسی غیرمجاز.')) --}}

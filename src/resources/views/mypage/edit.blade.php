@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage/_form.css') }}">
@endsection

@section('main')
@include('mypage._form')
@endsection
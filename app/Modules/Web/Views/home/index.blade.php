@extends('Web::layouts.master')

@section('breaking_news')   
    @include('Web::layouts.breaking_news')
@endsection

@section('feature_post')
    @include('Web::layouts.feature_post')
@endsection

@section('popular_news')
    @include('Web::layouts.popular_news')
@endsection

@section('vedio_post')
    @include('Web::layouts.vedio_post')
@endsection

@section('editorial')
    @include('Web::layouts.editor_post')
@endsection

@section('footer_img')
    @include('Web::layouts.footer_img')
@endsection
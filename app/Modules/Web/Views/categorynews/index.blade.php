@extends('Web::layouts.master')
	<?php
		class BanglaConverter {
		    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
		    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
		    
		   
		    public static function en2bn($number) {
		        return str_replace(self::$en, self::$bn, $number);
		    }
		}

	?>
@section('breaking_news')   
    @include('Web::layouts.breaking_news')
@endsection

@section('feature_post')
    @include('Web::categorynews.categorynews')
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
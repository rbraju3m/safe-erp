@extends('Web::layouts.master')

@section('breaking_news')   
    @include('Web::layouts.breaking_news')
@endsection



@section('single_news')   
    <!-- ##### Blog Area Start ##### -->
    <div class="blog-area section-padding-0-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="blog-posts-area">

                        <!-- Single Featured Post -->
                        
                        	@if (isset($news_data) && count($news_data) == 1)
                        		@include('Web::singlenews.singlenews')
	                        	<!-- About Author -->
		                        @include('Web::singlenews.author')

		                        <!-- Comment Area Start -->
		                        @include('Web::singlenews.comment_show')

		                        @include('Web::singlenews.comment')
                        	@endif
                        	

                        
                        
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="blog-sidebar-area">

                        <!-- Latest Posts Widget -->
<div class="latest-posts-widget mb-50">

                        @include('Web::singlenews.latest')
</div>

                        <!-- Popular News Widget -->
                        @include('Web::singlenews.populer')

                        

                        <!-- Newsletter Widget -->
                        @include('Web::singlenews.news_letter')

                        

                        <!-- Latest Comments Widget -->
                        @include('Web::singlenews.latest_comment')

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Blog Area End ##### -->
@endsection






@section('footer_img')
    @include('Web::layouts.footer_img')
@endsection
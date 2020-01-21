<div class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8">
                    <!-- Breaking News Widget -->
                    <div class="breaking-news-area d-flex align-items-center">
                        <div class="news-title">
                            <p>সর্বশেষ :</p>
                        </div>
                        <div id="breakingNewsTicker" class="ticker">
                            <ul>
                            	@if (isset($BreakingNews) && count($BreakingNews) > 0)
                            		@foreach ($BreakingNews as $element)
                                		<li><a href=" {{ asset($element->link) }} ">{{$element->title}}</a></li>
                            		@endforeach
                            	@endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Hero Add -->
                <div class="col-12 col-lg-4">
                    <div class="hero-add">
                        <a href="#"><img src="{{asset('/frontend/img/bg-img/hero-add.gif')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
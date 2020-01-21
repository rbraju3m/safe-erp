<div class="video-post-area bg-img bg-overlay" style="background-image: url({{ asset('/frontend/img/bg-img/bg1.jpg') }});">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Single Video Post -->
                
                @foreach ($VedioNews as $element)
                	@if (isset($VedioNews) && !empty($VedioNews))


                	<div class="col-12 col-sm-6 col-md-4">
                    <div class="single-video-post">
                        <img style="width: 377px;height: 250px;" src="{{URL::to('')}}/uploads/video/{{$element->video_image}}" alt="">
                        <!-- Video Button -->
                        <div class="videobtn">
                            <a href="{{$element->video_link}}" class="videoPlayer"><i class="fa fa-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                		
                	@endif
                @endforeach
                


            </div>
        </div>
    </div>
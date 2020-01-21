<div class="editors-pick-post-area section-padding-80-50">
        <div class="container">
            <div class="row">
                <!-- Editors Pick -->
                <div class="col-12 col-md-7 col-lg-9">
                    <div class="section-heading">
                        <h6>সম্পাদকের পছন্দ</h6>
                    </div>

                    <div class="row">

                        <!-- Single Post -->
                @if (isset($EditorsPick) && count($EditorsPick) > 0)
            		@foreach ($EditorsPick as $element)
                        <div class="col-12 col-lg-4">
                            <div class="single-blog-post">
                                <div class="post-thumb">
                                    <a href="{{ route('frontend.singel.news',$element->id) }}"><img class="editor-img" src="{{URL::to('')}}/uploads/news/{{$element->image_link}}" alt="{{$element->title}}"></a>
                                </div>
                                <div class="post-data">
                                    <a href="{{ route('frontend.singel.news',$element->id) }}" class="post-title">
                                        <h6>{{$element->title}}</h6>
                                    </a>
                                    <div class="post-meta">
                                        <div class="post-date"><a href="#">{{BanglaConverter::en2bn($element->created_at)}}</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

 						@endforeach
            			@endif
                    </div>
                </div>

                <!-- World News -->
                <div class="col-12 col-md-5 col-lg-3">
                    <div class="section-heading">
                    	{{-- @foreach ($RandomCategory as $element) --}}
                       		<h6>অর্থনীতি{{-- {{$element->title}} --}} </h6>	
                    	{{-- @endforeach --}}
                    </div>

                    <!-- Single Post -->
                @if (isset($RandomCategoryNews) && count($RandomCategoryNews) > 0)
            		@foreach ($RandomCategoryNews as $element)
                    <div class="single-blog-post style-2">
                        <div class="post-thumb">
                            <a href="{{ route('frontend.singel.news',$element->id) }}"><img src="{{URL::to('')}}/uploads/news/{{$element->image_link}}" alt="{{$element->title}}"></a>
                        </div>
                        <div class="post-data">
                            <a href="{{ route('frontend.singel.news',$element->id) }}" class="post-title">
                                <h6>{{$element->title}}</h6>
                            </a>
                            <div class="post-meta">
                                <div class="post-date"><a href="#">{{BanglaConverter::en2bn($element->created_at)}}</a></div>
                            </div>
                        </div>
                    </div>
                    
@endforeach
            			@endif

                </div>
            </div>
        </div>
    </div>
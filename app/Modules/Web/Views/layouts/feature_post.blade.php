<div class="featured-post-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="row">

                    	<?php
							class BanglaConverter {
							    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
							    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
							    
							   
							    public static function en2bn($number) {
							        return str_replace(self::$en, self::$bn, $number);
							    }
							}

						?>

                        <!-- Single Featured Post -->
@if (isset($FeatureNewsLeft) && count($FeatureNewsLeft) > 0)
	@foreach ($FeatureNewsLeft as $element)
        <div class="col-12 col-lg-7">
            <div class="single-blog-post featured-post">
                <div class="post-thumb">
                	
                    <a href="{{ route('frontend.singel.news',$element->id) }}"><img src="{{URL::to('')}}/uploads/news/{{$element->image_link}}" alt="" class="featured-img-left"></a>
                </div>
                <div class="post-data">
                    <a href="{{ route('frontend.category.news',$element->category_id) }}" class="post-catagory">{{$element->category_title}}</a>
                    <a href="{{ route('frontend.singel.news',$element->id) }}" class="post-title">
                        <h6>{{$element->title}}</h6>
                    </a>
                    <div class="post-meta">

                    	<?php
                    		$start_date = new DateTime($element->created_at);
							$since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s')));

							$total_day = $since_start->d;
							$total_hour = $since_start->h;
							$total_minute = $since_start->i;
							$total_second = $since_start->s;
                    	?>
                    	
                        <p class="post-author">
                        	@if ($total_day > 0)
                    			{{BanglaConverter::en2bn($total_day).' দিন'}}
                    		@endif

                    		@if ($total_hour > 0)
                    			{{BanglaConverter::en2bn($total_hour).' ঘন্টা'}}
                    		@endif

                    		@if ($total_minute > 0)
                    			{{BanglaConverter::en2bn($total_minute).' মিনিট'}}
                    		@endif

                    		@if ($total_second > 0)
                    			{{BanglaConverter::en2bn($total_second).' সেকেন্ড আগে'}}
                    		@endif

                         By <a href="#">{{$element->username}}</a></p>
                        <p class="post-excerp">
                        	<?php
                        	$string = strip_tags($element->discription);
								if (strlen($string) > 700) {

								    // truncate string
								    $stringCut = substr($string, 0, 700);
								    $endPoint = strrpos($stringCut, ' ');

								    //if the string doesn't contain any space then it will cut without word basis.
								    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
								    $string .= '... <a href="'.route('frontend.singel.news',$element->id) .'">Read More</a>';
								}
								echo $string;
							?>
						</p>
						<a href=""><img src="{{ asset('img/core-img/add.png')  }}" alt="Featured Advertisement" class="featured-img-add"></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

            		@if (isset($FeatureNewsRight) && count($FeatureNewsRight) > 0)
                        <div class="col-12 col-lg-5">
                            <!-- Single Featured Post -->
                            @foreach ($FeatureNewsRight as $element)
                            <div class="single-blog-post featured-post-2">
                                <div class="post-thumb">
                                    <a href="{{route('frontend.singel.news',$element->id) }}"><img src="{{URL::to('')}}/uploads/news/{{$element->image_link}}" alt="" class="featured-img-right"></a>
                                </div>
                                <div class="post-data">
                                    <a href="{{ route('frontend.category.news',$element->category_id) }}" class="post-catagory">{{$element->category_title}}</a>
                                    <div class="post-meta">
                                        <a href="{{route('frontend.singel.news',$element->id) }}" class="post-title">
                                            <h6>{{$element->title}}</h6>
                                        </a>
                                    </div>

                                    <?php
                                    		$start_date = new DateTime($element->created_at);
											$since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s')));

											$total_day = $since_start->d;
											$total_hour = $since_start->h;
											$total_minute = $since_start->i;
											$total_second = $since_start->s;
                                    	?>

                                    <p class="post-author">
                                        	@if ($total_day > 0)
                                    			{{BanglaConverter::en2bn($total_day).' দিন'}}
                                    		@endif

                                    		@if ($total_hour > 0)
                                    			{{BanglaConverter::en2bn($total_hour).' ঘন্টা'}}
                                    		@endif

                                    		@if ($total_minute > 0)
                                    			{{BanglaConverter::en2bn($total_minute).' মিনিট'}}
                                    		@endif

                                    		@if ($total_second > 0)
                                    			{{BanglaConverter::en2bn($total_second).' সেকেন্ড আগে'}}
                                    		@endif
										</p>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Single Featured Post -->
                    @if (isset($RecentNews) && count($RecentNews) > 0)
	                    @foreach ($RecentNews as $element)
	                    	
	                   
		                    <div class="single-blog-post small-featured-post d-flex">
		                        <div class="post-thumb">
		                            <a href="{{route('frontend.singel.news',$element->id) }}"><img src="{{URL::to('')}}/uploads/news/{{$element->image_link}}" alt="{{$element->title}}"></a>
		                        </div>
		                        <div class="post-data">
		                            <a href="{{ route('frontend.category.news',$element->category_id) }}" class="post-catagory">{{$element->category_title}}</a>
		                            <div class="post-meta">
		                                <a href="{{route('frontend.singel.news',$element->id) }}" class="post-title">
		                                    <h6>{{$element->title}}</h6>
		                                </a>
		                                <p class="post-date"><span>{{BanglaConverter::en2bn($element->created_at)}}</span></p>
		                                <?php
                                    		$start_date = new DateTime($element->created_at);
											$since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s')));

											$total_day = $since_start->d;
											$total_hour = $since_start->h;
											$total_minute = $since_start->i;
											$total_second = $since_start->s;
                                    	?>

                                    <p class="post-author">
                                        	@if ($total_day > 0)
                                    			{{BanglaConverter::en2bn($total_day).' দিন'}}
                                    		@endif

                                    		@if ($total_hour > 0)
                                    			{{BanglaConverter::en2bn($total_hour).' ঘন্টা'}}
                                    		@endif

                                    		@if ($total_minute > 0)
                                    			{{BanglaConverter::en2bn($total_minute).' মিনিট'}}
                                    		@endif

                                    		@if ($total_second > 0)
                                    			{{BanglaConverter::en2bn($total_second).' সেকেন্ড আগে'}}
                                    		@endif
										</p>
		                            </div>
		                        </div>
		                    </div>

                     	@endforeach
                    @endif


                </div>
            </div>
        </div>
    </div>
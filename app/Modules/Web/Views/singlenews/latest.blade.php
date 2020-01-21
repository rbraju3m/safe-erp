@if (isset($RecentNews) && count($RecentNews) > 0)
	                    @foreach ($RecentNews as $element)
	                    	
	                   
		                    <div class="single-blog-post small-featured-post d-flex">
		                        <div class="post-thumb">
		                            <a href="{{ route('frontend.singel.news',$element->id) }}"><img src="{{URL::to('')}}/uploads/news/{{$element->image_link}}" alt=""></a>
		                        </div>
		                        <div class="post-data">
		                            <a href="{{ route('frontend.category.news',$element->category_id) }}" class="post-catagory">{{$element->category_title}}</a>
		                            <div class="post-meta">
		                                <a href="{{ route('frontend.singel.news',$element->id) }}" class="post-title">
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



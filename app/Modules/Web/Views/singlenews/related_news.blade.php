<div class="section-heading">
                            <h6>সম্পর্কিত খবর</h6>
                        </div>

                        <div class="row">
                            <!-- Single Post -->

                    @if (isset($CategoryNews) && count($CategoryNews) > 0)
	                    @foreach ($CategoryNews as $element)
	                    <?php
                            $start_date = new DateTime($element->created_at);
							$since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s')));

							$total_day = $since_start->d;
							$total_hour = $since_start->h;
							$total_minute = $since_start->i;
							$total_second = $since_start->s;
                        ?>    
                            <div class="col-12 col-md-6">
                                <div class="single-blog-post style-3 mb-80 related-single-news">
                                    <div class="post-thumb">
                                        <a href="{{ route('frontend.singel.news',$element->id) }}"><img src="{{URL::to('')}}/uploads/news/{{$element->image_link}}" alt="{{$element->title}}"></a>
                                    </div>
                                    <div class="post-data">
                                        <a href="{{ route('frontend.category.news',$element->category_id) }}" class="post-catagory">{{$element->category_title}}</a>
                                        <a href="{{ route('frontend.singel.news',$element->id) }}" class="post-title">
                                            <h6>{{$element->title}}</h6>
                                        </a>

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
                                    		<br>
                                    		  By <a href="#">{{$news_data->username}}</a></p>
                                    		<hr>
										</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                        </div>
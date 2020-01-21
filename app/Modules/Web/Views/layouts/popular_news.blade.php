<div class="popular-news-area section-padding-80-50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="section-heading">
                        <h6>জনপ্রিয় সংবাদ</h6>
                    </div>

                    <div class="row">

                    	

                        <!-- Single Post -->
                @if (isset($PopulerNews) && count($PopulerNews) > 0)
            		@foreach ($PopulerNews as $element)
                        <div class="col-12 col-md-6">
                            <div class="single-blog-post style-3">
                                <div class="post-thumb">
                                    <a href="{{ route('frontend.singel.news',$element->id) }}"><img src="{{URL::to('')}}/uploads/news/{{$element->image_link}}" alt=""></a>
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
                                    	
                                        <p class="post-author add-class">
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
                                         By <a href="#">{{$element->username}}</a></p>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                     @endforeach
            	@endif  

                      <img src="{{ asset('img/add1.gif') }}" style="width: 747px;height: 250px;">  
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="section-heading">
                        <h6>সারাদেশ</h6>
                    </div>
                    <!-- Popular News Widget -->
                    <div class="popular-news-widget mb-30">
                @if (isset($MostPopulerNews) && count($MostPopulerNews) > 0)
                <?php 
                	$count = 1 ;
                    $news_date = $element->created_at;

                ?>
            		@foreach ($MostPopulerNews as $element)
                        <!-- Single Popular Blog -->
                        <div class="single-popular-post">
                            <a href="{{ route('frontend.singel.news',$element->id) }}">
                                <h6><span>{{BanglaConverter::en2bn($count++)}}.</span>{{$element->title}}</h6>
                            </a>
                            <p>{{BanglaConverter::en2bn($element->created_at)}}</p>
                        </div>
                    @endforeach
            	@endif 
                    </div>

                    <!-- Newsletter Widget -->
                    <div class="newsletter-widget">
                        <h4>Newsletter</h4>
                        <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                        <form action="#" method="post">
                            <input type="text" name="text" placeholder="Name">
                            <input type="email" name="email" placeholder="Email">
                            <button type="submit" class="btn w-100">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
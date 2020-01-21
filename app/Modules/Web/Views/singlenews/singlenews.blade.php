
<?php
							class BanglaConverter {
							    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
							    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
							    
							   
							    public static function en2bn($number) {
							        return str_replace(self::$en, self::$bn, $number);
							    }
							}

						?>
<div class="single-blog-post featured-post single-post">
                            <div class="post-thumb">
                                <a href="#"><img src="{{URL::to('')}}/uploads/news/{{$news_data->image_link}}" alt="" class="single-news-img"></a>
                            </div>
                            <div class="post-data">
                                <a href="{{ route('frontend.category.news',$news_data->category_id) }}" class="post-catagory">{{$news_data->category_title}}</a>
                                <a href="#" class="post-title">
                                    <h6>{{$news_data->title}}</h6>
                                </a>
                                <div class="post-meta">
                                	<?php
                                    		$start_date = new DateTime($news_data->created_at);
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

                                         By <a href="#">{{$news_data->username}}</a></p>
                                    <hr>
                                    <?php
                                    	echo $news_data->discription;
                                    ?>
                                    <div class="newspaper-post-like d-flex align-items-center justify-content-between">
                                        <!-- Tags -->
                                        <div class="newspaper-tags d-flex">                
                                        	<ul class="d-flex">
                                            	@if (isset($news_tags) && count($news_tags) > 0)
                                                	@foreach ($news_tags as $element)
                                                		<li><a href="#" class="badge badge-primary">{{$element->title}}</a></li>
                                                	@endforeach
                                            	@endif
                                            </ul>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
<div class="popular-news-widget mb-50">
                    <div class="section-heading">
                            <h6 class="section-heading">সারাদেশ</h6>

                    </div>


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
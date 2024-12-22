@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <!-- hero section -->
    <section id="hero">
        <div class="container-xl">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <!-- featured post large -->
                    @if ($favourite)
                        <div class="post featured-post-lg">
                            <div class="details clearfix">
                                <a href="{{ route('post.detail', $favourite->uuid) }}"
                                    class="category-badge">{{ optional($favourite->category)->name ?? '-' }}</a>
                                <h2 class="post-title"><a
                                        href="{{ route('post.detail', $favourite->uuid) }}">{{ $favourite->title }}</a></h2>
                                <ul class="meta list-inline mb-0">
                                    <li class="list-inline-item"><a
                                            href="#">{{ optional($favourite->creator)->name ?? '-' }}</a></li>
                                    <li class="list-inline-item"><span style="padding-right: 5px">
                                            {{ convert_date($favourite->created_at) }}</span>
                                        |
                                        <span class=""
                                            style="padding-left: 5px">{{ $favourite->visitors->count() . ' views' }}</span>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('post.detail', $favourite->uuid) }}">
                                <div class="thumb rounded">
                                    <div class="inner data-bg-image"
                                        data-bg-image="{{ asset('storage/thumb/' . $favourite->attachment) }}">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif

                </div>
                <div class="col-lg-4">
                    <!-- post tabs -->
                    <div class="post-tabs rounded bordered">
                        <!-- tab navs -->
                        <ul class="nav nav-tabs nav-pills nav-fill" id="postsTab" role="tablist">
                            <li class="nav-item" role="presentation"><button aria-controls="popular" aria-selected="true"
                                    class="nav-link active" data-bs-target="#popular" data-bs-toggle="tab" id="popular-tab"
                                    role="tab" type="button">Popular</button></li>
                            <li class="nav-item" role="presentation"><button aria-controls="recent" aria-selected="false"
                                    class="nav-link" data-bs-target="#recent" data-bs-toggle="tab" id="recent-tab"
                                    role="tab" type="button">Recent</button></li>
                        </ul>
                        <!-- tab contents -->
                        @if (!empty($populars))
                            <div class="tab-content" id="postsTabContent">
                                <!-- loader -->
                                <div class="lds-dual-ring"></div>
                                <!-- popular posts -->
                                <div aria-labelledby="popular-tab" class="tab-pane fade show active" id="popular"
                                    role="tabpanel">
                                    <!-- post -->
                                    @foreach ($populars as $popular)
                                        <div class="post post-list-sm circle">
                                            <div class="thumb circle">
                                                <a href="{{ route('post.detail', $popular->uuid) }}">
                                                    <div class="inner" style="width:60px; height:60px; overflow:hidden">
                                                        <img src="{{ $popular->attachment_url }}" alt="post-title"
                                                            style="width: 100%; height: 100%; object-fit: cover;" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details clearfix">
                                                <h6 class="post-title my-0"><a
                                                        href="{{ route('post.detail', $popular->uuid) }}">{{ $popular->title }}</a>
                                                </h6>
                                                <ul class="meta list-inline mt-1 mb-0">
                                                    <li class="list-inline-item">{{ convert_date($popular->created_at) }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- recent posts -->
                                <div aria-labelledby="recent-tab" class="tab-pane fade" id="recent" role="tabpanel">
                                    <!-- post -->
                                    @foreach ($posts->take(4) as $post)
                                        <div class="post post-list-sm circle">
                                            <div class="thumb circle">
                                                <a href="{{ route('post.detail', $post->uuid) }}">
                                                    <div class="inner" style="width:60px; height:60px; overflow:hidden">
                                                        <img src="{{ $post->attachment_url }}" alt="post-title"
                                                            style="width: 100%; height: 100%; object-fit: cover;" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details clearfix">
                                                <h6 class="post-title my-0"><a
                                                        href="blog-single.html">{{ $post->title }}</a></h6>
                                                <ul class="meta list-inline mt-1 mb-0">
                                                    <li class="list-inline-item">{{ convert_date($post->created_at) }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">

            <div class="row gy-4">

                <div class="col-lg-8">

                    <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Editor’s Pick</h3>
                        <img src="{{ asset('') }}assets/images/wave.svg" class="wave" alt="wave" />
                    </div>
                    @if (!empty($editorPicks))
                        <div class="padding-30 rounded bordered">
                            <div class="row gy-5">
                                <div class="col-sm-6">
                                    <!-- post -->
                                    <div class="post">
                                        <div class="thumb rounded">
                                            <a href="category.html"
                                                class="category-badge position-absolute">{{ optional($editorPicks[0]->category)->name ?? '-' }}</a>
                                            <span class="post-format">
                                                <i class="icon-picture"></i>
                                            </span>
                                            <a href="{{ route('post.detail', $editorPicks[0]->uuid) }}">
                                                <div class="inner">
                                                    <img src="{{ asset('storage/thumb/' . $editorPicks[0]->attachment) }}"
                                                        alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <ul class="meta list-inline mt-4 mb-0 align-items-center justify-content-start"
                                            style="display: flex; flex-direction:row; gap: 12px;">
                                            <a href="#" style="display: inline-block">
                                                <img src="{{ asset('') }}assets/images/other/author-sm.png"
                                                    class="author" alt="author" width="50" />
                                            </a>
                                            <div class="">
                                                <span class="list-inline-item">
                                                    {{ optional($editorPicks[0]->creator)->name ?? '-' }}
                                                </span>
                                                <div class="d-flex flex-col">
                                                    <li class="list-inline-item" style="content:none !important;">
                                                        {{ convert_date($editorPicks[0]->created_at) }}
                                                    </li>
                                                    <li class="list-inline-item">
                                                        {{ $editorPicks[0]->time_to_read }}
                                                    </li>
                                                </div>
                                            </div>
                                        </ul>
                                        @php
                                            $plain = strip_tags($editorPicks[0]->content);
                                        @endphp
                                        <h5 class="post-title mb-3 mt-3"><a
                                                href="{{ route('post.detail', $editorPicks[0]->uuid) }}">{{ $editorPicks[0]->title ?? '-' }}</a>
                                        </h5>
                                        <p class="excerpt mb-0">{{ Str::limit($plain, 200) }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- post -->
                                    @foreach ($editorPicks as $pick)
                                        @if (!$loop->first)
                                            <div class="post post-list-sm square">
                                                <div class="thumb rounded">
                                                    <a href="{{ route('post.detail', $favourite->uuid) }}">
                                                        <div class="inner">
                                                            <img src="{{ asset('storage/thumb/' . $pick->attachment) }}"
                                                                alt="post-title" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="details clearfix">
                                                    <h6 class="post-title my-0"><a
                                                            href="{{ route('post.detail', $pick->uuid) }}">{{ $pick->title ?? '-' }}</a>
                                                    </h6>
                                                    <ul class="meta list-inline mt-1 mb-0">
                                                        <li class="list-inline-item">
                                                            {{ convert_date($pick->created_at) }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="spacer" data-height="50"></div>

                    <!-- horizontal ads -->
                    <div class="ads-horizontal text-md-center">
                        <span class="ads-title">- Sponsored Ad -</span>
                        <a href="#">
                            <img src="{{ asset('') }}assets/images/ads/ad-750.png" alt="Advertisement" />
                        </a>
                    </div>

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    {{-- <div class="section-header">
                        <h3 class="section-title">Trending</h3>
                        <img src="{{ asset('') }}assets/images/wave.svg" class="wave" alt="wave" />
                    </div> --}}

                    {{-- <div class="padding-30 rounded bordered">
                        <div class="row gy-5">
                            <div class="col-sm-6">
                                <!-- post large -->
                                <div class="post">
                                    <div class="thumb rounded">
                                        <a href="category.html" class="category-badge position-absolute">Culture</a>
                                        <span class="post-format">
                                            <i class="icon-picture"></i>
                                        </span>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="{{ asset('') }}assets/images/posts/trending-lg-1.jpg"
                                                    alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <ul class="meta list-inline mt-4 mb-0">
                                        <li class="list-inline-item"><a href="#"><img
                                                    src="{{ asset('') }}assets/images/other/author-sm.png"
                                                    class="author" alt="author" />Katen Doe</a></li>
                                        <li class="list-inline-item">29 March 2021</li>
                                    </ul>
                                    <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">Facts About
                                            Business That Will Help You Success</a></h5>
                                    <p class="excerpt mb-0">A wonderful serenity has taken possession of my entire
                                        soul, like these sweet mornings of spring which I enjoy</p>
                                </div>
                                <!-- post -->
                                <div class="post post-list-sm square before-seperator">
                                    <div class="thumb rounded">
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="{{ asset('') }}assets/images/posts/trending-sm-1.jpg"
                                                    alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details clearfix">
                                        <h6 class="post-title my-0"><a href="blog-single.html">3 Easy Ways To Make
                                                Your iPhone Faster</a></h6>
                                        <ul class="meta list-inline mt-1 mb-0">
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- post -->
                                <div class="post post-list-sm square before-seperator">
                                    <div class="thumb rounded">
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="{{ asset('') }}assets/images/posts/trending-sm-2.jpg"
                                                    alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details clearfix">
                                        <h6 class="post-title my-0"><a href="blog-single.html">An Incredibly Easy
                                                Method That Works For All</a></h6>
                                        <ul class="meta list-inline mt-1 mb-0">
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- post large -->
                                <div class="post">
                                    <div class="thumb rounded">
                                        <a href="category.html" class="category-badge position-absolute">Inspiration</a>
                                        <span class="post-format">
                                            <i class="icon-earphones"></i>
                                        </span>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="{{ asset('') }}assets/images/posts/trending-lg-2.jpg"
                                                    alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <ul class="meta list-inline mt-4 mb-0">
                                        <li class="list-inline-item"><a href="#"><img
                                                    src="{{ asset('') }}assets/images/other/author-sm.png"
                                                    class="author" alt="author" />Katen Doe</a></li>
                                        <li class="list-inline-item">29 March 2021</li>
                                    </ul>
                                    <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">5 Easy Ways You
                                            Can Turn Future Into Success</a></h5>
                                    <p class="excerpt mb-0">A wonderful serenity has taken possession of my entire
                                        soul, like these sweet mornings of spring which I enjoy</p>
                                </div>
                                <!-- post -->
                                <div class="post post-list-sm square before-seperator">
                                    <div class="thumb rounded">
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="{{ asset('') }}assets/images/posts/trending-sm-3.jpg"
                                                    alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details clearfix">
                                        <h6 class="post-title my-0"><a href="blog-single.html">Here Are 8 Ways To
                                                Success Faster</a></h6>
                                        <ul class="meta list-inline mt-1 mb-0">
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- post -->
                                <div class="post post-list-sm square before-seperator">
                                    <div class="thumb rounded">
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="{{ asset('') }}assets/images/posts/trending-sm-4.jpg"
                                                    alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details clearfix">
                                        <h6 class="post-title my-0"><a href="blog-single.html">Master The Art Of
                                                Nature With These 7 Tips</a></h6>
                                        <ul class="meta list-inline mt-1 mb-0">
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    {{-- <div class="section-header">
                        <h3 class="section-title">Inspiration</h3>
                        <img src="{{ asset('') }}assets/images/wave.svg" class="wave" alt="wave" />
                        <div class="slick-arrows-top">
                            <button type="button" data-role="none" class="carousel-topNav-prev slick-custom-buttons"
                                aria-label="Previous"><i class="icon-arrow-left"></i></button>
                            <button type="button" data-role="none" class="carousel-topNav-next slick-custom-buttons"
                                aria-label="Next"><i class="icon-arrow-right"></i></button>
                        </div>
                    </div> --}}

                    {{-- <div class="row post-carousel-twoCol post-carousel">
                        <!-- post -->
                        <div class="post post-over-content col-md-6">
                            <div class="details clearfix">
                                <a href="category.html" class="category-badge">Inspiration</a>
                                <h4 class="post-title"><a href="blog-single.html">Want To Have A More Appealing
                                        Tattoo?</a></h4>
                                <ul class="meta list-inline mb-0">
                                    <li class="list-inline-item"><a href="#">Katen Doe</a></li>
                                    <li class="list-inline-item">29 March 2021</li>
                                </ul>
                            </div>
                            <a href="blog-single.html">
                                <div class="thumb rounded">
                                    <div class="inner">
                                        <img src="{{ asset('') }}assets/images/posts/inspiration-1.jpg"
                                            alt="thumb" />
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- post -->
                        <div class="post post-over-content col-md-6">
                            <div class="details clearfix">
                                <a href="category.html" class="category-badge">Inspiration</a>
                                <h4 class="post-title"><a href="blog-single.html">Feel Like A Pro With The Help Of
                                        These 7 Tips</a></h4>
                                <ul class="meta list-inline mb-0">
                                    <li class="list-inline-item"><a href="#">Katen Doe</a></li>
                                    <li class="list-inline-item">29 March 2021</li>
                                </ul>
                            </div>
                            <a href="blog-single.html">
                                <div class="thumb rounded">
                                    <div class="inner">
                                        <img src="{{ asset('') }}assets/images/posts/inspiration-2.jpg"
                                            alt="thumb" />
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- post -->
                        <div class="post post-over-content col-md-6">
                            <div class="details clearfix">
                                <a href="category.html" class="category-badge">Inspiration</a>
                                <h4 class="post-title"><a href="blog-single.html">Your Light Is About To Stop
                                        Being Relevant</a></h4>
                                <ul class="meta list-inline mb-0">
                                    <li class="list-inline-item"><a href="#">Katen Doe</a></li>
                                    <li class="list-inline-item">29 March 2021</li>
                                </ul>
                            </div>
                            <a href="blog-single.html">
                                <div class="thumb rounded">
                                    <div class="inner">
                                        <img src="{{ asset('') }}assets/images/posts/inspiration-3.jpg"
                                            alt="thumb" />
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> --}}

                    <div class="spacer" data-height="50"></div>

                    <!-- section header -->
                    <div class="section-header">
                        <h3 class="section-title">Latest Posts</h3>
                        <img src="{{ asset('') }}assets/images/wave.svg" class="wave" alt="wave" />
                    </div>

                    <div class="padding-30 rounded bordered">

                        <div class="row">

                            <div class="col-md-12 col-sm-6">
                                <!-- post -->
                                <div class="post post-list clearfix">
                                    <div class="thumb rounded">
                                        <span class="post-format-sm">
                                            <i class="icon-picture"></i>
                                        </span>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="{{ asset('') }}assets/images/posts/latest-sm-1.jpg"
                                                    alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-3">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="{{ asset('') }}assets/images/other/author-sm.png"
                                                        class="author" alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item"><a href="#">Trending</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title"><a href="blog-single.html">The Next 60 Things To
                                                Immediately Do About Building</a></h5>
                                        <p class="excerpt mb-0">A wonderful serenity has taken possession of my
                                            entire soul, like these sweet mornings</p>
                                        <div class="post-bottom clearfix d-flex align-items-center">
                                            <div class="social-share me-auto">
                                                <button class="toggle-button icon-share"></button>
                                                <ul class="icons list-unstyled list-inline mb-0">
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-facebook-f"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-twitter"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-linkedin-in"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-pinterest"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-telegram-plane"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="far fa-envelope"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="more-button float-end">
                                                <a href="blog-single.html"><span class="icon-options"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6">
                                <!-- post -->
                                <div class="post post-list clearfix">
                                    <div class="thumb rounded">
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="{{ asset('') }}assets/images/posts/latest-sm-2.jpg"
                                                    alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-3">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="{{ asset('') }}assets/images/other/author-sm.png"
                                                        class="author" alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item"><a href="#">Lifestyle</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title"><a href="blog-single.html">Master The Art Of Nature
                                                With These 7 Tips</a></h5>
                                        <p class="excerpt mb-0">A wonderful serenity has taken possession of my
                                            entire soul, like these sweet mornings</p>
                                        <div class="post-bottom clearfix d-flex align-items-center">
                                            <div class="social-share me-auto">
                                                <button class="toggle-button icon-share"></button>
                                                <ul class="icons list-unstyled list-inline mb-0">
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-facebook-f"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-twitter"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-linkedin-in"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-pinterest"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-telegram-plane"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="far fa-envelope"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="more-button float-end">
                                                <a href="blog-single.html"><span class="icon-options"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6">
                                <!-- post -->
                                <div class="post post-list clearfix">
                                    <div class="thumb rounded">
                                        <span class="post-format-sm">
                                            <i class="icon-camrecorder"></i>
                                        </span>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="{{ asset('') }}assets/images/posts/latest-sm-3.jpg"
                                                    alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-3">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="{{ asset('') }}assets/images/other/author-sm.png"
                                                        class="author" alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item"><a href="#">Fashion</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title"><a href="blog-single.html">Facts About Business
                                                That Will Help You Success</a></h5>
                                        <p class="excerpt mb-0">A wonderful serenity has taken possession of my
                                            entire soul, like these sweet mornings</p>
                                        <div class="post-bottom clearfix d-flex align-items-center">
                                            <div class="social-share me-auto">
                                                <button class="toggle-button icon-share"></button>
                                                <ul class="icons list-unstyled list-inline mb-0">
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-facebook-f"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-twitter"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-linkedin-in"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-pinterest"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-telegram-plane"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="far fa-envelope"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="more-button float-end">
                                                <a href="blog-single.html"><span class="icon-options"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6">
                                <!-- post -->
                                <div class="post post-list clearfix">
                                    <div class="thumb rounded">
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="{{ asset('') }}assets/images/posts/latest-sm-4.jpg"
                                                    alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-3">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="{{ asset('') }}assets/images/other/author-sm.png"
                                                        class="author" alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item"><a href="#">Politic</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title"><a href="blog-single.html">Your Light Is About To
                                                Stop Being Relevant</a></h5>
                                        <p class="excerpt mb-0">A wonderful serenity has taken possession of my
                                            entire soul, like these sweet mornings</p>
                                        <div class="post-bottom clearfix d-flex align-items-center">
                                            <div class="social-share me-auto">
                                                <button class="toggle-button icon-share"></button>
                                                <ul class="icons list-unstyled list-inline mb-0">
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-facebook-f"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-twitter"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-linkedin-in"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-pinterest"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fab fa-telegram-plane"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="far fa-envelope"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="more-button float-end">
                                                <a href="blog-single.html"><span class="icon-options"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- load more button -->
                        <div class="text-center">
                            <button class="btn btn-simple">Load More</button>
                        </div>

                    </div>

                </div>
                <div class="col-lg-4">
                    <!-- sidebar -->
                    <div class="sidebar">
                        <!-- widget about -->
                        {{-- @include('layouts.partials.about') --}}

                        <!-- widget popular posts -->
                        @include('contents.popular')

                        <!-- widget categories -->
                        @include('layouts.partials.category')

                        <!-- widget newsletter -->
                        {{-- <div class="widget rounded">
                            <div class="widget-header text-center">
                                <h3 class="widget-title">Newsletter</h3>
                                <img src="{{ asset('') }}assets/images/wave.svg" class="wave" alt="wave" />
                            </div>
                            <div class="widget-content">
                                <span class="newsletter-headline text-center mb-3">Join 70,000 subscribers!</span>
                                <form>
                                    <div class="mb-2">
                                        <input class="form-control w-100 text-center" placeholder="Email address…"
                                            type="email">
                                    </div>
                                    <button class="btn btn-default btn-full" type="submit">Sign Up</button>
                                </form>
                                <span class="newsletter-privacy text-center mt-3">By signing up, you agree to our
                                    <a href="#">Privacy Policy</a></span>
                            </div>
                        </div> --}}

                        <!-- widget post carousel -->
                        <div class="widget rounded">
                            <div class="widget-header text-center">
                                <h3 class="widget-title">Celebration</h3>
                                <img src="{{ asset('') }}assets/images/wave.svg" class="wave" alt="wave" />
                            </div>
                            <div class="widget-content">
                                <div class="post-carousel-widget">
                                    <!-- post -->
                                    <div class="post post-carousel">
                                        <div class="thumb rounded">
                                            <a href="category.html" class="category-badge position-absolute">How
                                                to</a>
                                            <a href="blog-single.html">
                                                <div class="inner">
                                                    <img src="{{ asset('') }}assets/images/widgets/widget-carousel-1.jpg"
                                                        alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <h5 class="post-title mb-0 mt-4"><a href="blog-single.html">5 Easy Ways
                                                You Can Turn Future Into Success</a></h5>
                                        <ul class="meta list-inline mt-2 mb-0">
                                            <li class="list-inline-item"><a href="#">Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                    </div>
                                    <!-- post -->
                                    <div class="post post-carousel">
                                        <div class="thumb rounded">
                                            <a href="category.html" class="category-badge position-absolute">Trending</a>
                                            <a href="blog-single.html">
                                                <div class="inner">
                                                    <img src="{{ asset('') }}assets/images/widgets/widget-carousel-2.jpg"
                                                        alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <h5 class="post-title mb-0 mt-4"><a href="blog-single.html">Master The Art
                                                Of Nature With These 7 Tips</a></h5>
                                        <ul class="meta list-inline mt-2 mb-0">
                                            <li class="list-inline-item"><a href="#">Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                    </div>
                                    <!-- post -->
                                    <div class="post post-carousel">
                                        <div class="thumb rounded">
                                            <a href="category.html" class="category-badge position-absolute">How
                                                to</a>
                                            <a href="blog-single.html">
                                                <div class="inner">
                                                    <img src="{{ asset('') }}assets/images/widgets/widget-carousel-1.jpg"
                                                        alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <h5 class="post-title mb-0 mt-4"><a href="blog-single.html">5 Easy Ways
                                                You Can Turn Future Into Success</a></h5>
                                        <ul class="meta list-inline mt-2 mb-0">
                                            <li class="list-inline-item"><a href="#">Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- carousel arrows -->
                                <div class="slick-arrows-bot">
                                    <button type="button" data-role="none"
                                        class="carousel-botNav-prev slick-custom-buttons" aria-label="Previous"><i
                                            class="icon-arrow-left"></i></button>
                                    <button type="button" data-role="none"
                                        class="carousel-botNav-next slick-custom-buttons" aria-label="Next"><i
                                            class="icon-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- widget advertisement -->
                        <div class="widget no-container rounded text-md-center">
                            <span class="ads-title">- Sponsored Ad -</span>
                            <a href="#" class="widget-ads">
                                <img src="{{ asset('') }}assets/images/ads/ad-360.png" alt="Advertisement" />
                            </a>
                        </div>

                        <!-- widget tags -->
                        <div class="widget rounded">
                            <div class="widget-header text-center">
                                <h3 class="widget-title">Tag Clouds</h3>
                                <img src="{{ asset('') }}assets/images/wave.svg" class="wave" alt="wave" />
                            </div>
                            <div class="widget-content">
                                <a href="#" class="tag">#Trending</a>
                                <a href="#" class="tag">#Video</a>
                                <a href="#" class="tag">#Featured</a>
                                <a href="#" class="tag">#Gallery</a>
                                <a href="#" class="tag">#Celebrities</a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- instagram feed -->
    <div class="instagram">
        <div class="container-xl">
            <!-- button -->
            <a href="#" class="btn btn-default btn-instagram">@Katen on Instagram</a>
            <!-- images -->
            <div class="instagram-feed d-flex flex-wrap">
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{ asset('') }}assets/images/insta/insta-1.jpg" alt="insta-title" />
                    </a>
                </div>
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{ asset('') }}assets/images/insta/insta-2.jpg" alt="insta-title" />
                    </a>
                </div>
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{ asset('') }}assets/images/insta/insta-3.jpg" alt="insta-title" />
                    </a>
                </div>
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{ asset('') }}assets/images/insta/insta-4.jpg" alt="insta-title" />
                    </a>
                </div>
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{ asset('') }}assets/images/insta/insta-5.jpg" alt="insta-title" />
                    </a>
                </div>
                <div class="insta-item col-sm-2 col-6 col-md-2">
                    <a href="#">
                        <img src="{{ asset('') }}assets/images/insta/insta-6.jpg" alt="insta-title" />
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

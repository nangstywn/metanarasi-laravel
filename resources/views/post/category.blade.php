@extends('layouts.app')
@section('title', $category->name)
@push('styles')
    <style>
        .inner {
            width: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden !important;
            /* Prevent any overflow that might cause extra space */
        }
    </style>
@endpush
@section('content')

    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>


        <section class="page-header">
            <div class="container-xl">
                <div class="text-center">
                    <h1 class="mt-0 mb-2">{{ $category->name }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <!-- section main content -->
        <section class="main-content">
            <div class="container-xl">

                <div class="row gy-4">

                    <div class="col-lg-8">

                        <div class="row gy-4">
                            @foreach ($posts as $post)
                                <div class="col-sm-6">
                                    <!-- post -->
                                    <div class="post post-grid rounded bordered">
                                        <div class="thumb top-rounded">
                                            <a href="#"
                                                class="category-badge position-absolute">{{ $category->name }}</a>
                                            <span class="post-format">
                                                <i class="icon-picture"></i>
                                            </span>
                                            <a href="">
                                                <div class="inner">
                                                    <img src="{{ asset('storage/thumb/' . $post->attachment) }}"
                                                        alt="post-title" style="height: 250px;object-fit: cover;" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="details">
                                            <ul class="meta list-inline mb-0">
                                                <li class="list-inline-item"><a href="#"><img
                                                            src="{{ asset('') }}images/other/author-sm.png"
                                                            class="author"
                                                            alt="author" />{{ optional($post->creator)->name ?? '-' }}</a>
                                                </li>
                                                <li class="list-inline-item">{{ convert_date($post->created_at) }}</li>
                                            </ul>
                                            @php
                                                $plain = strip_tags($post->content);
                                            @endphp
                                            <h5 class="post-title mb-3 mt-3"><a
                                                    href="{{ route('post.detail', $post->slug) }}">{{ $post->title ?? '-' }}</a>
                                            </h5>
                                            <p class="excerpt mb-0">{{ Str::limit($plain, 100) }}</p>
                                        </div>
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
                            @endforeach

                            {{-- <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                        <a href="category.html" class="category-badge position-absolute">Inspiration</a>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="images/posts/post-md-2.jpg" alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="images/other/author-sm.png" class="author"
                                                        alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">Most Important
                                                Thing You Need To Know About Swim</a></h5>
                                        <p class="excerpt mb-0">I am so happy, my dear friend, so absorbed in the
                                            exquisite sense of mere tranquil existence.</p>
                                    </div>
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

                            <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                        <a href="category.html" class="category-badge position-absolute">Fashion</a>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="images/posts/post-md-3.jpg" alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="images/other/author-sm.png" class="author"
                                                        alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">The Secrets To
                                                Finding Class Tools For Your Dress</a></h5>
                                        <p class="excerpt mb-0">I am so happy, my dear friend, so absorbed in the
                                            exquisite sense of mere tranquil existence.</p>
                                    </div>
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
                            </div> --}}

                            {{-- <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                        <a href="category.html" class="category-badge position-absolute">Lifestyle</a>
                                        <span class="post-format">
                                            <i class="icon-camrecorder"></i>
                                        </span>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="images/posts/post-md-4.jpg" alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="images/other/author-sm.png" class="author"
                                                        alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">How I Improved My
                                                Fashion Style In One Day</a></h5>
                                        <p class="excerpt mb-0">I am so happy, my dear friend, so absorbed in the
                                            exquisite sense of mere tranquil existence.</p>
                                    </div>
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
                            <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                        <a href="category.html" class="category-badge position-absolute">Trending</a>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="images/posts/post-md-5.jpg" alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="images/other/author-sm.png" class="author"
                                                        alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">3 Easy Ways To
                                                Make Your iPhone Faster</a></h5>
                                        <p class="excerpt mb-0">I am so happy, my dear friend, so absorbed in the
                                            exquisite sense of mere tranquil existence.</p>
                                    </div>
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

                            <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                        <a href="category.html" class="category-badge position-absolute">Fashion</a>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="images/posts/post-md-6.jpg" alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="images/other/author-sm.png" class="author"
                                                        alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">Wondering How To
                                                Make Your Hair Style Rock?</a></h5>
                                        <p class="excerpt mb-0">I am so happy, my dear friend, so absorbed in the
                                            exquisite sense of mere tranquil existence.</p>
                                    </div>
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

                            <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                        <a href="category.html" class="category-badge position-absolute">How To</a>
                                        <span class="post-format">
                                            <i class="icon-picture"></i>
                                        </span>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="images/posts/post-md-7.jpg" alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="images/other/author-sm.png" class="author"
                                                        alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">How To Make More
                                                Construction By Doing Less</a></h5>
                                        <p class="excerpt mb-0">I am so happy, my dear friend, so absorbed in the
                                            exquisite sense of mere tranquil existence.</p>
                                    </div>
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

                            <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                        <a href="category.html" class="category-badge position-absolute">Culture</a>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="images/posts/post-md-8.jpg" alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="images/other/author-sm.png" class="author"
                                                        alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">An Incredibly Easy
                                                Method That Works For All</a></h5>
                                        <p class="excerpt mb-0">I am so happy, my dear friend, so absorbed in the
                                            exquisite sense of mere tranquil existence.</p>
                                    </div>
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
                            </div> --}}

                            {{-- <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                        <a href="category.html" class="category-badge position-absolute">Inspiration</a>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="images/posts/post-md-9.jpg" alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="images/other/author-sm.png" class="author"
                                                        alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">10 Ways To
                                                Immediately Start Selling Furniture</a></h5>
                                        <p class="excerpt mb-0">I am so happy, my dear friend, so absorbed in the
                                            exquisite sense of mere tranquil existence.</p>
                                    </div>
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
                            </div> --}}

                            {{-- <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">
                                        <a href="category.html" class="category-badge position-absolute">Lifestyle</a>
                                        <span class="post-format">
                                            <i class="icon-earphones"></i>
                                        </span>
                                        <a href="blog-single.html">
                                            <div class="inner">
                                                <img src="images/posts/post-md-10.jpg" alt="post-title" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="images/other/author-sm.png" class="author"
                                                        alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3"><a href="blog-single.html">Now You Can Have
                                                Your Thoughts Done Safely</a></h5>
                                        <p class="excerpt mb-0">I am so happy, my dear friend, so absorbed in the
                                            exquisite sense of mere tranquil existence.</p>
                                    </div>
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
                            </div> --}}

                        </div>

                        {{ $posts->links('vendor.pagination.custom-pagination') }}

                    </div>
                    <div class="col-lg-4">

                        <!-- sidebar -->
                        <div class="sidebar">
                            <!-- widget about -->
                            <div class="widget rounded">
                                <div class="widget-about data-bg-image text-center" data-bg-image="images/map-bg.png">
                                    <img src="images/logo.svg" alt="logo" class="mb-4" />
                                    <p class="mb-4">Hello, We’re content writer who is fascinated by content fashion,
                                        celebrity and lifestyle. We helps clients bring the right content to the right
                                        people.</p>
                                    <ul class="social-icons list-unstyled list-inline mb-0">
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- widget popular posts -->
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Popular Posts</h3>
                                    <img src="images/wave.svg" class="wave" alt="wave" />
                                </div>
                                <div class="widget-content">
                                    <!-- post -->
                                    <div class="post post-list-sm circle">
                                        <div class="thumb circle">
                                            <span class="number">1</span>
                                            <a href="blog-single.html">
                                                <div class="inner">
                                                    <img src="images/posts/tabs-1.jpg" alt="post-title" />
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
                                    <div class="post post-list-sm circle">
                                        <div class="thumb circle">
                                            <span class="number">2</span>
                                            <a href="blog-single.html">
                                                <div class="inner">
                                                    <img src="images/posts/tabs-2.jpg" alt="post-title" />
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
                                    <!-- post -->
                                    <div class="post post-list-sm circle">
                                        <div class="thumb circle">
                                            <span class="number">3</span>
                                            <a href="blog-single.html">
                                                <div class="inner">
                                                    <img src="images/posts/tabs-3.jpg" alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="details clearfix">
                                            <h6 class="post-title my-0"><a href="blog-single.html">10 Ways To
                                                    Immediately Start Selling Furniture</a></h6>
                                            <ul class="meta list-inline mt-1 mb-0">
                                                <li class="list-inline-item">29 March 2021</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- widget categories -->
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Explore Topics</h3>
                                    <img src="images/wave.svg" class="wave" alt="wave" />
                                </div>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="#">Lifestyle</a><span>(5)</span></li>
                                        <li><a href="#">Inspiration</a><span>(2)</span></li>
                                        <li><a href="#">Fashion</a><span>(4)</span></li>
                                        <li><a href="#">Politic</a><span>(1)</span></li>
                                        <li><a href="#">Trending</a><span>(7)</span></li>
                                        <li><a href="#">Culture</a><span>(3)</span></li>
                                    </ul>
                                </div>

                            </div>

                            <!-- widget newsletter -->
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Newsletter</h3>
                                    <img src="images/wave.svg" class="wave" alt="wave" />
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
                            </div>

                            <!-- widget post carousel -->
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Celebration</h3>
                                    <img src="images/wave.svg" class="wave" alt="wave" />
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
                                                        <img src="images/widgets/widget-carousel-1.jpg"
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
                                                <a href="category.html"
                                                    class="category-badge position-absolute">Trending</a>
                                                <a href="blog-single.html">
                                                    <div class="inner">
                                                        <img src="images/widgets/widget-carousel-2.jpg"
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
                                                        <img src="images/widgets/widget-carousel-1.jpg"
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
                                    <img src="images/ads/ad-360.png" alt="Advertisement" />
                                </a>
                            </div>

                            <!-- widget tags -->
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Tag Clouds</h3>
                                    <img src="images/wave.svg" class="wave" alt="wave" />
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

        <!-- footer -->
        <footer>
            <div class="container-xl">
                <div class="footer-inner">
                    <div class="row d-flex align-items-center gy-4">
                        <!-- copyright text -->
                        <div class="col-md-4">
                            <span class="copyright">© 2021 Katen. Template by ThemeGer.</span>
                        </div>

                        <!-- social icons -->
                        <div class="col-md-4 text-center">
                            <ul class="social-icons list-unstyled list-inline mb-0">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a>
                                </li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>

                        <!-- go to top button -->
                        <div class="col-md-4">
                            <a href="#" id="return-to-top" class="float-md-end"><i class="icon-arrow-up"></i>Back
                                to Top</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div><!-- end site wrapper -->

    <!-- search popup area -->
    <div class="search-popup">
        <!-- close button -->
        <button type="button" class="btn-close" aria-label="Close"></button>
        <!-- content -->
        <div class="search-content">
            <div class="text-center">
                <h3 class="mb-4 mt-0">Press ESC to close</h3>
            </div>
            <!-- form -->
            <form class="d-flex search-form">
                <input class="form-control me-2" type="search" placeholder="Search and press enter ..."
                    aria-label="Search">
                <button class="btn btn-default btn-lg" type="submit"><i class="icon-magnifier"></i></button>
            </form>
        </div>
    </div>


@endsection

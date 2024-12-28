@extends('layouts.app')
@section('title', $post->title)
@section('content')
    <!-- site wrapper -->
    <div class="site-wrapper">
        <!-- section main content -->
        <section class="main-content mt-3">
            <div class="container-xl">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ $post->category->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                    </ol>
                </nav>

                <div class="row gy-4">

                    <div class="col-lg-8">
                        <!-- post single -->
                        <div class="post post-single">
                            <!-- post header -->
                            <div class="post-header">
                                <h1 class="title mt-0 mb-3">{{ $post->title }}</h1>
                                <ul class="meta list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="#"><img src="{{ asset('') }}assets/images/other/author-sm.png"
                                                class="author" alt="author" />{{ optional($post->creator)->name ?? '-' }}
                                        </a>
                                    </li>
                                    <li class="list-inline-item">{{ convert_date($post->created_at) }}</li>
                                    <li class="list-inline-item">{{ $post->visitors->count() . ' views' }}</li>
                                </ul>
                            </div>
                            <!-- featured image -->
                            <div class="featured-image">
                                <img src="{{ $post->attachment_url }}" alt="post-title" />
                            </div>
                            <!-- post content -->
                            <div class="post-content clearfix">
                                {!! $post->content !!}

                            </div>
                            <!-- post bottom section -->
                            <div class="post-bottom">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6 col-12 text-center text-md-start">
                                        <!-- tags -->
                                        <a href="#" class="tag">#Trending</a>
                                        <a href="#" class="tag">#Video</a>
                                        <a href="#" class="tag">#Featured</a>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <!-- social icons -->
                                        <ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
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
                                </div>
                            </div>

                        </div>

                        <div class="spacer" data-height="50"></div>

                        {{-- <div class="about-author padding-30 rounded">
                            <div class="thumb">
                                <img src="{{ asset('') }}assets/images/other/avatar-about.png" alt="Katen Doe" />
                            </div>
                            <div class="details">
                                <h4 class="name"><a href="#">Katen Doe</a></h4>
                                <p>Hello, I’m a content writer who is fascinated by content fashion, celebrity and
                                    lifestyle. She helps clients bring the right content to the right people.</p>
                                <!-- social icons -->
                                <ul class="social-icons list-unstyled list-inline mb-0">
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div> --}}

                        <div class="spacer" data-height="50"></div>

                        <!-- section header -->
                        @include('post.comment')

                        <div class="spacer" data-height="50"></div>

                        <!-- section header -->
                        <div class="section-header">
                            <h3 class="section-title">Leave Comment</h3>
                            <img src="{{ asset('') }}assets/images/wave.svg" class="wave" alt="wave" />
                        </div>
                        <!-- comment form -->
                        <div class="comment-form rounded bordered padding-30">

                            <form id="comment-form" class="comment-form" method="POST">
                                @csrf
                                <div class="messages"></div>

                                <div class="row">

                                    <div class="column col-md-12">
                                        <!-- Comment textarea -->
                                        <div class="form-group">
                                            <textarea name="comment" id="InputComment" class="form-control" rows="4" placeholder="Your comment here..."></textarea>
                                            <span class="text-danger error-message comment"></span>
                                        </div>
                                    </div>

                                    {{-- <div class="column col-md-6">
                                        <!-- Email input -->
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="InputEmail" name="InputEmail"
                                                placeholder="Email address" required="required">
                                        </div>
                                    </div> --}}

                                    {{-- <div class="column col-md-6">
                                        <!-- Name input -->
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="InputWeb" id="InputWeb"
                                                placeholder="Website" required="required">
                                        </div>
                                    </div> --}}

                                    <div class="column col-md-12">
                                        <!-- Email input -->
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" id="InputName"
                                                name="InputName" placeholder="Your name">
                                            <span class="text-danger error-message name"></span>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" name="submit" id="submit" value="Submit"
                                    class="btn btn-default">Submit</button>

                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4">

                        <!-- sidebar -->
                        <div class="sidebar">
                            <!-- widget about -->
                            @include('layouts.partials.about')

                            <!-- widget popular posts -->
                            @include('contents.popular')

                            <!-- widget categories -->
                            @include('layouts.partials.category')

                            <!-- widget newsletter -->
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Newsletter</h3>
                                    <img src="{{ asset('') }}assets/images/wave.svg" class="wave"
                                        alt="wave" />
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
                                    <span class="newsletter-privacy text-center mt-3">By signing up, you agree to our <a
                                            href="#">Privacy Policy</a></span>
                                </div>
                            </div>

                            <!-- widget post carousel -->
                            <div class="widget rounded">
                                <div class="widget-header text-center">
                                    <h3 class="widget-title">Celebration</h3>
                                    <img src="{{ asset('') }}assets/images/wave.svg" class="wave"
                                        alt="wave" />
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
                                            <h5 class="post-title mb-0 mt-4"><a href="blog-single.html">5 Easy Ways You
                                                    Can Turn Future Into Success</a></h5>
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
                                                        <img src="{{ asset('') }}assets/images/widgets/widget-carousel-2.jpg"
                                                            alt="post-title" />
                                                    </div>
                                                </a>
                                            </div>
                                            <h5 class="post-title mb-0 mt-4"><a href="blog-single.html">Master The Art Of
                                                    Nature With These 7 Tips</a></h5>
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
                                            <h5 class="post-title mb-0 mt-4"><a href="blog-single.html">5 Easy Ways You
                                                    Can Turn Future Into Success</a></h5>
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
                                    <img src="{{ asset('') }}assets/images/wave.svg" class="wave"
                                        alt="wave" />
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
                            <img src="images/insta/insta-1.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="#">
                            <img src="images/insta/insta-2.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="#">
                            <img src="images/insta/insta-3.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="#">
                            <img src="images/insta/insta-4.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="#">
                            <img src="images/insta/insta-5.jpg" alt="insta-title" />
                        </a>
                    </div>
                    <div class="insta-item col-sm-2 col-6 col-md-2">
                        <a href="#">
                            <img src="images/insta/insta-6.jpg" alt="insta-title" />
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#comment-form').on('submit', function(e) {
                e.preventDefault();
                $('.text-danger').html('')
                const postId = '{{ $post->uuid }}';

                let url = '{{ route('resource.comment', ':uuid') }}';
                url = url.replace(':uuid', postId);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(data) {
                        $('.text-danger').html('')
                        $('#comment').html(data);
                        $('#InputComment').val('')
                        $('#InputName').val('')
                    },
                    error: function(err) {
                        console.log(err);
                        if (err.status == 422) {
                            var keys = Object.keys(err.responseJSON.errors);
                            keys.forEach(function(val, key) {
                                $(`[class*="text-danger error-message ${val}"]`)
                                    .text(
                                        err
                                        .responseJSON.errors[val])
                            });
                            toastr["error"](err.responseJSON.message);
                        }
                        if (err.responseJSON.status == 500) {
                            toastr["error"](err.responseJSON.message);
                        }
                    }

                });
            })
        });
    </script>
@endpush

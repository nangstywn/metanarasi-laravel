<div class="widget rounded">
    <div class="widget-header text-center">
        <h3 class="widget-title">Popular Posts</h3>
        <img src="{{ asset('') }}assets/images/wave.svg" class="wave" alt="wave" />
    </div>
    <div class="widget-content">
        <!-- post -->
        @foreach ($populars->take(4) as $popular)
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
                        <li class="list-inline-item">
                            {{ convert_date($popular->created_at) }}
                        </li>
                        <li class="list-inline-item">
                            <span>{{ $popular->visitors->count() . ' views' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>

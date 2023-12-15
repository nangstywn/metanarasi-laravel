<div class="widget rounded">
    <div class="widget-header text-center">
        <h3 class="widget-title">Explore Topics</h3>
        <img src="{{ asset('') }}assets/images/wave.svg" class="wave" alt="wave" />
    </div>
    <div class="widget-content">
        <ul class="list">
            @foreach ($categories as $category)
                <li><a href="#">{{ $category->name }}</a><span>({{ $category->posts_count }})</span>
                </li>
            @endforeach
        </ul>
    </div>

</div>

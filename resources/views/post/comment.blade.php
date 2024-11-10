    <div id="comment">
        <div class="section-header">
            <h3 class="section-title">Comments ({{ $comments->count() }})</h3>
            <img src="{{ asset('') }}assets/images/wave.svg" class="wave" alt="wave" />
        </div>
        <!-- post comments -->
        <div class="comments bordered padding-30 rounded">
            @foreach ($comments ?? [] as $comment)
                <ul class="comments" style="margin-bottom: 30px">
                    <!-- comment item -->
                    <li class="comment rounded">
                        <div class="thumb">
                            <img src="{{ asset('') }}assets/images/other/comment-1.png" alt="John Doe" />
                        </div>
                        <div class="details">
                            <h4 class="name"><a href="#">{{ $comment->name }}</a></h4>
                            <span class="date">{{ convert_date($comment->created_at) }}
                                {{ convert_time($comment->created_at) }}</span>
                            <p>{{ $comment->comment }}</p>
                            <a href="#" class="btn btn-default btn-sm">Reply</a>
                        </div>
                    </li>
                    <!-- comment item -->
                    {{-- <li class="comment child rounded">
                        <div class="thumb">
                            <img src="{{ asset('') }}assets/images/other/comment-2.png" alt="John Doe" />
                        </div>
                        <div class="details">
                            <h4 class="name"><a href="#">Helen Doe</a></h4>
                            <span class="date">Jan 08, 2021 14:41 pm</span>
                            <p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit
                                amet adipiscing sem neque sed ipsum.</p>
                            <a href="#" class="btn btn-default btn-sm">Reply</a>
                        </div>
                    </li> --}}
                </ul>
            @endforeach
        </div>
    </div>

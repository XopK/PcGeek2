<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/style/style.css">
    <title>PcGeek</title>
</head>

<body>
    <x-header></x-header>
    <div class="container">
        <div class="filter-forums row d-flex justify-content-between align-items-center">
            <div class="col">
                <form action="" method="GET">
                    <select class="form-select sort focus-ring focus-ring-secondary" style="border: 2px solid #999999;">
                        <option disabled selected>Сортировка</option>
                        <option value="1">Популярность</option>
                        <option value="2">Дата публикации</option>
                        <option value="3">Алфавит</option>
                        <option value="4">Кол-во лайков (убывание)</option>
                        <option value="5">Кол-во лайков (возрастание)</option>
                    </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-custom">Применить</button>
            </div>
            </form>
        </div>
        <div class="list-forums mt-4">
            <div class="row">
                @forelse ($posts as $post)
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="favorite-button">
                                <button type="button" class="btn-light"><img src="/image/heart.svg"
                                        alt="heart"></button>
                            </div>
                            <div class="card-body">
                                <div class="tags mb-3">
                                    @foreach ($post->tags as $tag)
                                        <span class="badge fw-bold text-bg-custom">{{ $tag->title_tag }}</span>
                                    @endforeach

                                </div>
                                <h3 class="card-title">{{ $post->title_post }}</h3>
                                <div class="post-info mb-2">
                                    <span class="author"><strong>Автор: </strong>{{ $post->user->login }}</span><br>
                                    <span class="date"> <strong>Дата публикации:</strong>
                                        {{ date('d.m.Y', strtotime($post->created_at)) }}</span>
                                </div>
                                <p class="card-text short-text">{{ $post->description }}</p>
                                <img src="/storage/image_posts/{{ $post->image_posts }}" class="card-img-top forum-img"
                                    alt="{{ $post->image_posts }}">
                                <div class="d-flex justify-content-between mt-3 align-items-center">
                                    <a href="/forum/{{ $post->id }}" class="btn btn-custom">Читать</a>
                                    <div class="like-dislike-buttons d-flex align-items-center mr-3">
                                        <button type="button" data-post-id="{{ $post->id }}"
                                            class="btn btn-like {{ $post->isLiked ? 'liked' : '' }}"><img
                                                src="/image/up_arrow.svg" alt="up_arrow"></button>
                                        <span data-post-id="{{ $post->id }}"
                                            class="likes-count text-white px-2">{{ $post->likesCount()}}</span>
                                        <button type="button" data-post-id="{{ $post->id }}"
                                            class="btn btn-dislike {{ $post->isDissliked ? 'dissliked' : '' }}"><img
                                                src="/image/down_arrow.svg" alt="down_arrow"></button>
                                        <a href="/forum/{{ $post->id }}#comment-section"
                                            class="btn btn-comment mx-2"><img src="/image/comment.svg"
                                                alt="comment"></a>
                                        <span class="comments-count text-white ml-2">25</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
        <x-footer></x-footer>
    </div>
    <x-auth></x-auth>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $('.btn-like').click(function() {
            var postId = $(this).data('post-id');
            var token = $('meta[name="csrf-token"]').attr('content');
            var isLiked = $(this).hasClass('liked');
            var $btnLike = $(this);

            $.ajax({
                url: '/post/like',
                type: 'POST',
                data: {
                    '_token': token,
                    'post_id': postId,
                },
                success: function(response) {
                    var likesCountSpan = $('.likes-count[data-post-id="' + postId + '"]');
                    var currentLikesCount = parseInt(likesCountSpan.text());

                    if (isLiked) {
                        likesCountSpan.text(currentLikesCount - 1);
                        $btnLike.removeClass('liked');
                    } else {
                        $('.btn-dislike[data-post-id="' + postId + '"]').removeClass('dissliked');

                        likesCountSpan.text(currentLikesCount + 1);
                        $btnLike.addClass('liked');
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseJSON.message);
                }
            });
        });

        $('.btn-dislike').click(function() {
            var postId = $(this).data('post-id');
            var token = $('meta[name="csrf-token"]').attr('content');
            var isDisliked = $(this).hasClass('dissliked');
            var $btnDislike = $(this);

            $.ajax({
                url: '/post/disslike',
                type: 'POST',
                data: {
                    '_token': token,
                    'post_id': postId,
                },
                success: function(response) {
                    var likesCountSpan = $('.likes-count[data-post-id="' + postId + '"]');
                    var currentLikesCount = parseInt(likesCountSpan.text());

                    if (isDisliked) {
                        likesCountSpan.text(currentLikesCount + 1);
                        $btnDislike.removeClass('dissliked');
                    } else {
                        // Remove like class if present
                        $('.btn-like[data-post-id="' + postId + '"]').removeClass('liked');

                        likesCountSpan.text(currentLikesCount - 1);
                        $btnDislike.addClass('dissliked');
                    }
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseJSON.message);
                }
            });
        });
    </script>
</body>

</html>

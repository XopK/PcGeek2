$('.btn-like').click(function () {
    var postId = $(this).data('post-id');
    var token = $('meta[name="csrf-token"]').attr('content');
    var isLiked = $(this).hasClass('liked');
    var isDisliked = $(this).siblings('.btn-dislike').hasClass('dissliked');
    var $btnLike = $(this);
    var $btnDislike = $btnLike.siblings('.btn-dislike');

    $btnLike.prop('disabled', true);
    $btnDislike.prop('disabled', true);


    setTimeout(function () {
        $.ajax({
            url: '/post/like',
            type: 'POST',
            data: {
                '_token': token,
                'post_id': postId,
            },
            success: function (response) {
                var likesCountSpan = $('.likes-count[data-post-id="' + postId + '"]');
                var currentLikesCount = parseInt(likesCountSpan.text());

                if (isLiked) {
                    likesCountSpan.text(currentLikesCount - 1);
                    $btnLike.removeClass('liked');
                } else {
                    likesCountSpan.text(currentLikesCount + 1);
                    $btnLike.addClass('liked');
                }

                if (isDisliked) {
                    var dislikesCountSpan = $('.dislikes-count[data-post-id="' +
                        postId + '"]');
                    var currentDislikesCount = parseInt(dislikesCountSpan.text());
                    dislikesCountSpan.text(Math.max(0, currentDislikesCount - 1));
                    $btnLike.siblings('.btn-dislike').removeClass('dissliked');
                }

                $btnLike.prop('disabled', false);
                $btnDislike.prop('disabled', false);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseJSON.message);
                $btnLike.prop('disabled', false);
                $btnDislike.prop('disabled', false);
            }
        });
    }, 300);
});
$('.btn-dislike').click(function () {
    var postId = $(this).data('post-id');
    var token = $('meta[name="csrf-token"]').attr('content');
    var isDisliked = $(this).hasClass('dissliked');
    var isLiked = $(this).siblings('.btn-like').hasClass('liked');
    var $btnDislike = $(this);
    var $btnLike = $btnDislike.siblings('.btn-like');

    $btnDislike.prop('disabled', true);
    $btnLike.prop('disabled', true);

    setTimeout(function () {
        $.ajax({
            url: '/post/disslike',
            type: 'POST',
            data: {
                '_token': token,
                'post_id': postId,
            },
            success: function (response) {
                var dislikesCountSpan = $('.dislikes-count[data-post-id="' + postId +
                    '"]');
                var currentDislikesCount = parseInt(dislikesCountSpan.text());

                if (isDisliked) {
                    dislikesCountSpan.text(currentDislikesCount - 1);
                    $btnDislike.removeClass('dissliked');
                } else {
                    dislikesCountSpan.text(currentDislikesCount + 1);
                    $btnDislike.addClass('dissliked');
                }

                if (isLiked) {
                    var likesCountSpan = $('.likes-count[data-post-id="' + postId +
                        '"]');
                    var currentLikesCount = parseInt(likesCountSpan.text());
                    likesCountSpan.text(Math.max(0, currentLikesCount - 1));
                    $btnDislike.siblings('.btn-like').removeClass('liked');
                }

                $btnDislike.prop('disabled', false);
                $btnLike.prop('disabled', false);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseJSON.message);
                $btnDislike.prop('disabled', false);
                $btnLike.prop('disabled', false);
            }
        });
    }, 300);
});

$('#btn-favorite').click(function () {
    var postId = $(this).data('post-id');
    var token = $('meta[name="csrf-token"]').attr('content');
    var isFavorite = $(this).hasClass('favorited');
    var btnfavorite = $(this);

    $.ajax({
        url: '/post/favorite',
        type: 'POST',
        data: {
            '_token': token,
            'post_id': postId,
        },
        success: function (response) {
            if (isFavorite) {
                btnfavorite.removeClass('favorited');
            } else {
                btnfavorite.addClass('favorited');
            }
        },
        error: function (xhr, status, error) {
            alert(xhr.responseJSON.message);
        }
    });
});

$('.btn-like-comment').click(function () {
    var commentId = $(this).data('comment-id');
    var token = $('meta[name="csrf-token"]').attr('content');
    var isLiked = $(this).hasClass('liked-comment');
    var isDisliked = $(this).siblings('.btn-dislike-comment').hasClass('disliked-comment');
    var $btnLike = $(this);
    var $btnDislike = $btnLike.siblings('.btn-dislike-comment');

    $btnLike.prop('disabled', true);
    $btnDislike.prop('disabled', true);

    setTimeout(function () {
        $.ajax({
            url: '/comment/like',
            type: 'POST',
            data: {
                '_token': token,
                'comment_id': commentId,
            },
            success: function (response) {
                var likesCountSpan = $('.likes-comment-count[data-comment-id="' + commentId + '"]');
                var currentLikesCount = parseInt(likesCountSpan.text());

                if (isLiked) {
                    likesCountSpan.text(currentLikesCount - 1);
                    $btnLike.removeClass('liked-comment');
                } else {
                    likesCountSpan.text(currentLikesCount + 1);
                    $btnLike.addClass('liked-comment');
                }

                if (isDisliked) {
                    var dislikesCountSpan = $('.dislikes-comment-count[data-comment-id="' + commentId + '"]');
                    var currentDislikesCount = parseInt(dislikesCountSpan.text());
                    dislikesCountSpan.text(Math.max(0, currentDislikesCount - 1));
                    $btnLike.siblings('.btn-dislike-comment').removeClass('disliked-comment');
                }

                $btnLike.prop('disabled', false);
                $btnDislike.prop('disabled', false);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseJSON.message);
                $btnLike.prop('disabled', false);
                $btnDislike.prop('disabled', false);
            }
        });
    }, 300);
});


$('.btn-dislike-comment').click(function () {
    var commentId = $(this).data('comment-id');
    var token = $('meta[name="csrf-token"]').attr('content');
    var isDisliked = $(this).hasClass('disliked-comment');
    var isLiked = $(this).siblings('.btn-like-comment').hasClass('liked-comment');
    var $btnDislike = $(this);
    var $btnLike = $btnDislike.siblings('.btn-like-comment');

    $btnDislike.prop('disabled', true);
    $btnLike.prop('disabled', true);

    setTimeout(function () {
        $.ajax({
            url: '/comment/disslike',
            type: 'POST',
            data: {
                '_token': token,
                'comment_id': commentId,
            },
            success: function (response) {
                var dislikesCountSpan = $('.dislikes-comment-count[data-comment-id="' + commentId +
                    '"]');
                var currentDislikesCount = parseInt(dislikesCountSpan.text());

                if (isDisliked) {
                    dislikesCountSpan.text(currentDislikesCount - 1);
                    $btnDislike.removeClass('disliked-comment');
                } else {
                    dislikesCountSpan.text(currentDislikesCount + 1);
                    $btnDislike.addClass('disliked-comment');
                }

                if (isLiked) {
                    var likesCountSpan = $('.likes-comment-count[data-comment-id="' + commentId +
                        '"]');
                    var currentLikesCount = parseInt(likesCountSpan.text());
                    likesCountSpan.text(Math.max(0, currentLikesCount - 1));
                    $btnDislike.siblings('.btn-like-comment').removeClass('liked-comment');
                }

                $btnDislike.prop('disabled', false);
                $btnLike.prop('disabled', false);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseJSON.message);
                $btnDislike.prop('disabled', false);
                $btnLike.prop('disabled', false);
            }
        });
    }, 300);
});

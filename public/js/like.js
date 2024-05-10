$('.btn-like').click(function () {
    var postId = $(this).data('post-id');
    var token = $('meta[name="csrf-token"]').attr('content');
    var isLiked = $(this).hasClass('liked');
    var isDisliked = $(this).siblings('.btn-dislike').hasClass('dissliked');
    var $btnLike = $(this);

    $btnLike.prop('disabled', true);

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
            },
            error: function (xhr, status, error) {
                alert(xhr.responseJSON.message);
                $btnLike.prop('disabled', false);
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

    $btnDislike.prop('disabled', true);

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
            },
            error: function (xhr, status, error) {
                alert(xhr.responseJSON.message);
                $btnDislike.prop('disabled', false);
            }
        });
    }, 300);
});
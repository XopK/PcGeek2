$(document).ready(function () {
    $('.reply-btn').click(function () {
        $(this).parent().find('.reply-form').toggleClass('d-none');
    });

    // Обработчик отправки формы комментария через AJAX
    $('#commentForm').submit(function (e) {
        e.preventDefault(); // Предотвращаем отправку формы по умолчанию
        var formData = $(this).serialize(); // Получаем данные формы
        var postId = $(this).data('post-id'); // Получаем ID поста из атрибута data-post-id
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Получаем CSRF-токен

        $.ajax({
            type: 'POST',
            url: '/forum/' + postId + '/comment',
            data: formData + '&_token=' + csrfToken, // Добавляем CSRF-токен к данным формы
            success: function (response) {
                // Добавляем новый комментарий на страницу
                var newComment = response.comment;
                var commentBlock = '<div class="comment d-flex gap-2 mb-3">' +
                    '<img src="/storage/users_profile/' + newComment.users.profile_img + '" class="profile-img-forum" alt="profile.svg">' +
                    '<div class="comment-content" style="width: 100%">' +
                    '<div class="author-comment d-flex justify-content-between">' +
                    '<div class="author-info d-flex gap-2">' +
                    '<p class="fw-medium m-0">' + newComment.users.login + '</p>' +
                    '<p class="fw-light m-0">' + newComment.formatted_created_at + '</p>' + // Используем отформатированную дату
                    '</div>' +
                    '</div>' +
                    '<p class="comment-text">' + newComment.comment + '</p>' +
                    '<button type="button" class="reply-btn link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Ответить</button>' +
                    '<div class="reply-form d-none mt-2">' +
                    '<form class="d-flex align-items-center gap-2 w-100">' +
                    '<input class="form-control" placeholder="Напишите ответ здесь...">' +
                    '<button type="submit" class="btn btn-custom btn-sm">Отправить</button>' +
                    '</form>' +
                    '</div>' +
                    '<div class="replies mt-3"></div>' +
                    '</div>' +
                    '</div>';
                $('.comments').prepend(commentBlock);
                $('input[name="comment"]').val('');
            },
            error: function (xhr, status, error) {
                // Обработка ошибки
                console.error(error);
            }
        });
    });

});



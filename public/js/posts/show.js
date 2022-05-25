$(document).ready(function () {
    $('#send-comment').on('click', function () {
        let comment = $('#comment-body').val();
        let post_id = $('.single-post').attr('id');

        // let data = {
        //     "post_id" : post_id,
        //     "comment_body" : comment
        // };

        // console.log(data);

        $.ajax({
            type: "POST",
            url: "/posts/createComment",
            data: {
                post_id: post_id,
                comment_body: comment
            },
            dataType: "json",
            beforeSend: function() {
                $('#send-comment').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
                $('.comment-error').text('');
            },
            success: function (response) {
                $('#send-comment').text('Отправить');

                if (response.status) {
                    $('.add-comments').after(`
                        <div class="row">
                            <div class="col-6 offset-3 mt-3 pb-2 single-comment">
                                <div class="row">
                                    <b>`
                                        + response.username +
                                    `</b>
                                </div>
                
                                <div class="row">
                                    <p>`
                                        + response.commentBody +
                                    `</p>
                                </div>
                
                                <div class="row">
                                    <small>`
                                        + response.date +
                                    `</small>
                                </div>
                            </div>
                        </div>
                    `);

                    $('#comment-body').val('');
                }else {
                    $('.comment-error').text(response.commentBodyError);
                }
            }
        });
    });
});
$(document).ready(function () {
    // $('footer').css({
    //     'position': 'absolute',
    //     'bottom': '0'
    // })
});
window.pressed = function () {
    var file = document.getElementById('file');
    if (file.value === "") {
        fileLabel.innerHTML = "Choose file";
    }
    else {
        var theSplit = file.value.split('\\');
        console.log(theSplit);
        fileLabel.innerHTML = theSplit[theSplit.length - 1];
    }
};

var post_id = '';
var comment = '';
var that = '';

$('article .comment_btn').on('click', function (e) {
    that = this;
    event.preventDefault();
    post_id = e.target.parentNode.dataset.post;
    comment = e.target.nextElementSibling;
    $('#edit_modal').modal();
});

$('.new-post button').on('click', function (e) {
    e.preventDefault();
    var post_body = $('#new-post').val();
    if (!user) {
        $('.post_msg').addClass('error').text('You must Log in if you want to post message');
    } else if(!$('#new-post').val()){
        console.log($('#new-post').text());
        $('.post_msg').addClass('error').text('This Field can not be empty');
    }
    else {
        $.ajax({
            method: 'POST',
            url: urlAddPost,
            data: {body: post_body, movieId: movie_id, _token: token},
            success: function (msg) {
                var div = $('<div class="col-md-6 col-md-offset-3"></div>');
                var article = $('<article class="post"></article>');
                div.append(article);
                article.append('<p>' + msg['body'] + '</p>');
                article.append('<p class="comment_btn">Leave a comment</p>');
                $('.new-post').after(div);
                $('.post_msg').addClass('success').text('Post has been successfully added');
            },
            error: function (res) {
                var obj = JSON.parse(res.responseText);
                var errMsg = obj.errors.body;
                var filtredMsg = errMsg.toString().replace('body', 'post message');

                $('.post_msg').addClass('error').text(filtredMsg.toString());
            }
        })
    }
});


$('#modal_save').on('click', function (e) {
    e.preventDefault();
    var post_comment = $('#post_body').val();

    $.ajax({
        method: 'POST',
        url: urlAddComment,
        data: {comment: post_comment, postId: post_id, _token: token},
        success: function (msg) {
            $('#edit_modal').modal('hide');
            console.log(msg['user']);
            var res = document.createElement('p');
            res.innerHTML = msg['res'];
            res.style.textTransform = 'capitalize';
            $(that).after(res);
            $(comment).before('<hr>');
        },
        error: function (res) {
            var obj = JSON.parse(res.responseText);
            var errMsg = obj.errors.comment;
            $('#comment_err').addClass('error').text(errMsg.toString());
        }
    })

});



<div class="col-md-6 col-md-offset-3">
    @foreach($posts as $post)
        <article id="{{$post->id}}" class="post" data-post="{{ $post->id }}">

            <p>{{$post->body}}
            <span>Posted By {{ $post->user->first_name }}  {{ $post->created_at->diffForHumans() }}</span></p>
            <p class="comment_btn">Leave a comment</p>
            @foreach($comments as $comment)
                @if($post->id == $comment->post_id)
                    <p class="comment">{{ ucfirst($comment->comment) }}<span class="text-right">Posted By {{ $comment->user->first_name }}  {{ $comment->created_at->diffForHumans() }}</span></p>
                    <hr>
                @endif
            @endforeach
        </article>
    @endforeach
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Leave a Comment</h4>
                        <h4 class="text-center" id="comment_err"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="get">
                            <div class="form-group">
                                <label for="post_body">Edit The Post</label>
                                <textarea class="form-control" name="post_comment" id="post_body" rows="5"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="modal_save">Add Comment</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
</div>

<script>
    var user = '{{ Auth::user() }}'
    var token = '{{ Session::token() }}';
    var urlAddComment = "{{ Route('add_comment') }}";
</script>


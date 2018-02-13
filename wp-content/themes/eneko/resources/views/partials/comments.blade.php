@php
if (post_password_required()) {
  return;
}

$args = [
    'title_reply' => '',
    'comment_field' => \App\getCommentField(),
    'fields' => ['author' => '', 'url' => '', 'email' => ''],
    'comment_notes_before' => '',
    'label_submit' => 'Publier'
];
if(!is_user_logged_in()) {
$args['submit_button'] = '';
}
$commentsNumber = get_comments_number();
$comments = get_comments(array(
    'post_id' => get_the_ID(),
    'status' => 'approve',
));
@endphp

<section class="comment-field">
    <div class="comment-field__label">Réagissez à cet article</div>
    @php(comment_form($args))
    <ul class="comments">
        {!! wp_list_comments(array(
        'per_page' => 10, //Allow comment pagination
        'reverse_top_level' => false //Show the oldest comments at the top of the list
        ), $comments); !!}
    </ul>


  @if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments'))
    <div class="alert alert-warning">
      {{ __('Comments are closed.', 'sage') }}
    </div>
  @endif
</section>

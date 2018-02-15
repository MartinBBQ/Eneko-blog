@php($loggedIn = is_user_logged_in())
<form action="{{site_url( '/wp-comments-post.php' )}}" method="post" class="comment-field">
    <div class="comment-field__main">
        @if($loggedIn)
        <textarea name="comment" maxlength="65525" required placeholder="Ajouter un commentaire..."></textarea>@else
            <a class="comment-field__register" href="{{wp_registration_url()}}">Veuillez vous connecter pour pouvoir commenter</a>
        @endif
    </div>
    @if($loggedIn)
        <div class="comment-field__buttonContainer">
            <button type="submit" class="button button--medium button--filled-blue">Publier</button>
        </div>
    @endif
</form>
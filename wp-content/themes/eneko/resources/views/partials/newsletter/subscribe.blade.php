<div class="newsletter-in">
    <div class="cross cross--grey"></div>
    <h3 class="newsletter-in__title">Gardons le contact</h3>
    <h4 class="newsletter-in__subtitle">Restez informé(e) de l’actualité de votre territoire et de ses évènements.</h4>
    <form class="newsletter-in__form">
        <input required type="email" name="mail" placeholder="Entrez votre adresse mail...">
        <button class="newsletter-in__button">Informez-moi</button>
    </form>
    {{--This one is rendered right after the element. Wtf ?--}}
    @extends('layouts.modal', ['innerModifier' => 'newsletter', 'isSmall' => true])
    @section('modal-content')
        <h2 class="modal__title">Merci de votre confiance !</h2>
        <p class="modal__excerpt">
            Afin que nous puissions mieux vous connaitre et vous proposer un contenu adapté à vos besoins, merci de bien vouloir remplir les champs suivants.
        </p>
        <form>
            <div class="modal__group modal__group--newsletter">
                @include('partials.input', [
                'type' => 'text',
                'label' => 'Prénom',
                'required' => true,
                'name' => 'firstName'
                ])
                @include('partials.input', [
                'type' => 'text',
                'label' => 'Nom',
                'required' => true,
                'name' => 'lastName'
                ])
                @include('partials.input', [
                'type' => 'email',
                'label' => 'Adresse e-mail',
                'required' => true,
                'name' => 'email'
                ])
                @include('partials.input', [
                'type' => 'text',
                'label' => 'Ville',
                'name' => 'cityRef'
                ])
                @include('partials.input', [
                'type' => 'text',
                'label' => 'Pays',
                'name' => 'country'
                ])
            </div>
            <div class="flex-center">
                <button class="button button--medium button--filled-blue">Valider votre inscription</button>
            </div>
        </form>
    @endsection
</div>

<header class="header" style="background-image: url({{App\getHomeCover()}});">
    <div class="header__wrapper">
        @include('partials.header.profile')
        @include('partials.header.informations')
        <div class="header__menuContainer">
            <div class="header__container">
                @include('partials.header.tabs')
                @include('partials.header.socials')
            </div>
        </div>
    </div>
</header>
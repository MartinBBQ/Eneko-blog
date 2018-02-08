<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    {{--Modal IE--}}
    <div id="ie-check">
      @include('partials.ie')
    </div>
    @php(do_action('get_header'))
    @if(is_front_page())
    @include('partials.header')
    @else
    @include('partials.secondary-header')
    @endif
    <div class="main-wrapper">
        <main class="u-main">
          @yield('content')
        </main>
    </div>
    <div class="fs-form">
        <div class="fs-form__wrapper">
            <div class="fs-form__head">
                <div class="fs-form__label">Que recherchez-vous ?</div>
                <div class="cross cross--white cross--big"></div>
            </div>
            <div class="fs-form__main">
                <div class="fs-form__input">
                    <div class="fs-form__icon">
                        @include('icons.search')
                    </div>
                    <div class="fs-form__field">
                        <input type="text" placeholder="Tapez votre recherche ici...">
                    </div>
                </div>
                <div class="fs-form__bottom">
                    <span>Tapez entrée pour valider</span>
                </div>
            </div>
        </div>
    </div>
    @php(do_action('get_footer'))
    @include('partials.footer')
    @php(wp_footer())
  </body>
</html>

<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
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
    @php(do_action('get_footer'))
    @include('partials.footer')
    @php(wp_footer())
  </body>
</html>

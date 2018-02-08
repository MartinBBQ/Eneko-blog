<input type="checkbox" name="burger" value="" id="burger">


{!!  wp_nav_menu([
'container' => 'nav',
'container_class' => 'header__tabs',
'menu_class' => 'header__menu'
])  !!}


<label for="burger" class="burger">
  <img src="{{\App\asset_path('images/menu.png')}}" alt="">
</label>

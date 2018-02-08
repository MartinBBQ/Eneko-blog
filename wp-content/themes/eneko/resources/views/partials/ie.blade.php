<div id="modal-ie" class="modal is-open"  onclick="closeElt()" >
  <div class="modal__main">
    <div class="modal__inner {{$innerModifier}}">
      <div  onclick="closeElt()"  class="cross"></div>
      <div class="modal__content">
        <h2 class="modal__title">Votre navigateurs est ancien</h2>
        <p class="modal__excerpt">
          Le site s'affiche mieux sur des navigateurs plus récents tel que Google Chrome ou Firefox.
        </p>
        <div class="flex-center">
          <button onclick="closeElt()" class="button button--medium button--filled-blue">Fermer le modal</button>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function closeElt(){document.getElementById("modal-ie").style.display = 'none';}
  </script>
  <style media="screen">
    @media all and (-ms-high-contrast: none){
      #modal-ie {display: flex!important}
    }
    #modal-ie {display: none}
  </style>
</div>

<!--[if IE]>
  <style media="screen">
    #modal-ie {display: flex!important}
  </style>
<![endif]-->

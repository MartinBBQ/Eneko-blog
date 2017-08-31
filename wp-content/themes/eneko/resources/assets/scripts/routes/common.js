export default {
  init() {
    // JavaScript to be fired on all pages
	  console.log('coucou');
	  $.fn.datepicker.defaults.langage = 'fr';
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

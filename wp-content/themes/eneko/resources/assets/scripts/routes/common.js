import Modal from '../components/Modal';

export default {
	init() {
		// JavaScript to be fired on all pages
		Array.from(document.querySelectorAll('.modal')).forEach($el => {
			const modal = new Modal({$el});
		});
		this.$search = document.querySelector('.filters__group--search');
		this.$search && this.$search.addEventListener('click',this.toggleSearch.bind(this));
	},
	toggleSearch() {
		this.$search.classList.add('is-open');
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};

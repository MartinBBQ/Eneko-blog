import Modal from '../components/Modal';

export default {
	init() {
		// JavaScript to be fired on all pages
		Array.from(document.querySelectorAll('.modal')).forEach($el => {
			const modal = new Modal({$el});
		});
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};

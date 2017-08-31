import Modal from '../components/Modal';

export default {
	init() {
		// JavaScript to be fired on the home page

	},
	finalize() {
		// JavaScript to be fired on the home page, after the init JS
		document
			.querySelector('.informations__more')
			.addEventListener('click',this.displayAllStats.bind(this));
	},
	displayAllStats(ev) {
		const $target = ev.currentTarget;
		Array.from($target.parentNode.children).forEach($el => {
			$el.classList.toggle('is-hidden',false);
		})
		$target.removeEventListener('click',this.displayAllStats.bind(this));
		$target.remove();
	}
};

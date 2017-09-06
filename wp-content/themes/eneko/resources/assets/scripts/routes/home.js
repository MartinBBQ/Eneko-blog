import Dropdown from '../components/Dropdown';
import List from '../components/List';

export default {
	init() {
		// JavaScript to be fired on the home page
	},
	finalize() {
		// JavaScript to be fired on the home page, after the init JS
		document
			.querySelector('.informations__more')
			.addEventListener('click',this.displayAllStats.bind(this));
		this.dropdown = new Dropdown(document.querySelector('.dropdown'));
		this.list = new List(document.querySelector('.section'));
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

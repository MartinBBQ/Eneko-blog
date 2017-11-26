import Dropdown from '../components/Dropdown';
import List from '../components/List';

export default {
	init() {
		// JavaScript to be fired on the home page
		this.isOpenSearch = false;
	},
	finalize() {
		// JavaScript to be fired on the home page, after the init JS
		this.dropdown = new Dropdown(document.querySelector('.dropdown'));
		this.list = new List(document.querySelector('.section'));
	},
};

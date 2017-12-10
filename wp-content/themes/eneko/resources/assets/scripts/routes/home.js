import Dropdown from '../components/Dropdown';
import List from '../components/List';
import NewsletterInput from '../components/NewsletterInput';

export default {
	init() {
		// JavaScript to be fired on the home page
		this.isOpenSearch = false;
	},
	finalize() {
		// JavaScript to be fired on the home page, after the init JS
		this.dropdown = new Dropdown(document.querySelector('.dropdown'));
		this.list = new List(document.querySelector('.section'));
		new NewsletterInput(document.querySelector('.newsletter-in'))
	},
};

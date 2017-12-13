import DutyModal from '../components/DutyModal';
import Dropdown from '../components/Dropdown';
import List from '../components/List';
import NewsletterInput from '../components/NewsletterInput';

export default {
	init() {
		this.isOpenSearch = false;
		// JavaScript to be fired on all pages
		Array.from(document.querySelectorAll('.permanence .modal')).forEach($el => {
			new DutyModal({$el});
		});
		this.initDropdown();
		this.initList();
		this.$search = document.querySelector('.filters__group--search');
		this.$search && this.$search.addEventListener('click',this.toggleSearch.bind(this));
	},
	initDropdown() {
		const $dropdown = document.querySelector('.dropdown');
		if (!!$dropdown) {
			new Dropdown($dropdown);
		}
	},
	initList() {
		const $list = document.querySelector('.section')
		if (!!$list) {
			new List($list);
		}
	},
	initNewsletter() {
		const $newsletter = document.querySelector('.newsletter-in');
		if (!!$newsletter) {
			new NewsletterInput($newsletter);
		}
	},
	toggleSearch() {
		this.$search.classList.add('is-open');
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
		this.initNewsletter();
	},
};

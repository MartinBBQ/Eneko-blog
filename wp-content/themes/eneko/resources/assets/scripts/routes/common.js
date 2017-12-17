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
		this.$form = document.querySelector('.search-form');
		this.$search = document.querySelector('input[type="search"]');
		this.$fsForm = document.querySelector('.fs-form');
		this.$cross = this.$fsForm.querySelector('.cross');
		this.$input = this.$fsForm.querySelector('input');
		this.$search && this.$search.addEventListener('focus',this.openSearch.bind(this));
		this.$cross && this.$cross.addEventListener('click', this.closeSearch.bind(this));
		this.$input && this.$input.addEventListener('keydown', this.submitForm.bind(this));
	},
	initDropdown() {
		const $dropdown = document.querySelector('.dropdown');
		if (!!$dropdown) {
			new Dropdown($dropdown);
		}
	},
	submitForm(ev) {
		const key = ev.keyCode || ev.which;
		if (key == 13) {
			this.$form.querySelector('.search-field').value = ev.target.value;
			this.$form.submit();
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
	openSearch() {
		this.$fsForm.classList.add('is-open');
	},
	closeSearch() {
		this.$fsForm.classList.remove('is-open');
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
		this.initNewsletter();
	},
};

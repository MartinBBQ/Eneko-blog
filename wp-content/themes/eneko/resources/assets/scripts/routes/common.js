import DutyModal from '../components/DutyModal';
import Dropdown from '../components/Dropdown';
import ContactModal from '../components/ContactModal';
import List from '../components/List';
import NewsletterInput from '../components/NewsletterInput';

export default {
	init() {
		this.isOpenSearch = false;
		if(this.detectIE()) {
			document.body.classList.add('is-ie');
		}
		// JavaScript to be fired on all pages
		Array.from(document.querySelectorAll('.permanence .modal')).forEach($el => {
			new DutyModal({$el});
		});
		const $contactModal = document.body.querySelector('.modal--contact');
		console.log(document.body.querySelector('.js-trigger-contact'));
		$contactModal && new ContactModal({$el: $contactModal, $trigger: document.body.querySelector('.js-trigger-contact')});
		this.initDropdown();
		this.initList();
		this.$form = document.querySelector('.search-form');
		this.$search = document.querySelector('input[type="search"]');
		this.$fsForm = document.querySelector('.fs-form');
		if (this.$fsForm) {
			this.$cross = this.$fsForm.querySelector('.cross');
			this.$input = this.$fsForm.querySelector('input');
		}
		this.$search && this.$search.addEventListener('focus', this.openSearch.bind(this));
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
	detectIE() {
		const ua = window.navigator.userAgent;
		const msie = ua.indexOf('MSIE ');
		if (msie > 0) {
			// IE 10 or older => return version number
			return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
		}

		const trident = ua.indexOf('Trident/');
		if (trident > 0) {
			// IE 11 => return version number
			const rv = ua.indexOf('rv:');
			return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
		}

		const edge = ua.indexOf('Edge/');
		if (edge > 0) {
			// Edge (IE 12+) => return version number
			return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
		}

		// other browser
		return false;
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
		this.$fsForm && this.$fsForm.classList.add('is-open');
	},
	closeSearch() {
		this.$fsForm && this.$fsForm.classList.remove('is-open');
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
		this.initNewsletter();
	},
};

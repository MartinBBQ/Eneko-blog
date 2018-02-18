import NewsletterModal from './NewsletterModal';

export default class NewsletterInput {
	constructor($el) {
		this.setProps($el);
		this.setListeners();
	}
	setProps($el) {
		this.$el = $el;
		this.$form = $el.querySelector('.newsletter-in__form');
		this.$input = this.$form.querySelector('input');
		this.$button = this.$form.querySelector('.newsletter-in__button');
		this.$cross = this.$el.querySelector('.cross');
		this.$responseEl = $el.querySelector('.newsletter-in__response');
		/**
		 * I target the next sibling because I use an extension of layout
		 * which doesn't render the modal inside the el but right after.
		 */
		this.modal = new NewsletterModal({$el: $el.nextElementSibling, $trigger: document.querySelector('.js-trigger-newsletter')});
	}
	setListeners() {
		this.$form.addEventListener('submit', this.handleSubmit.bind(this));
		this.$cross.addEventListener('click', this.delete.bind(this));
	}
	delete() {
		this.$el.parentNode.removeChild(this.$el);
	}
	handleSubmit(ev) {
		ev.preventDefault();
		this.modal.setEmail(this.$input.value);
		this.modal.open();
	}
}
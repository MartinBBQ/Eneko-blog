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
		this.$responseEl = $el.querySelector('.newsletter-in__response');
		/**
		 * I target the next sibling because I use an extension of layout
		 * which doesn't render the modal inside the el but right after.
		 */
		this.modal = new NewsletterModal({$el: $el.nextElementSibling});
	}
	setListeners() {
		this.$form.addEventListener('submit', this.handleSubmit.bind(this))
	}
	handleSubmit(ev) {
		ev.preventDefault();
		this.modal.setEmail(this.$input.value);
		this.modal.open();
	}
	displayMessage({success = false} = {}) {
		let text, modifier;
		if(success) {
			text = 'Votre inscription a bien été prise en compte';
		} else {
			text = 'Il y a eu une erreur lors de votre inscription';
		}
		this.$responseEl.classList.add('is-visible');
		this.$responseEl.textContent = text;
	}
}
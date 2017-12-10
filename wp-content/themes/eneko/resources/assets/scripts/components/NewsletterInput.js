export default class NewsletterInput {
	constructor($el) {
		this.setProps($el);
		this.setListeners();
	}
	setProps($el) {
		this.$el = $el;
		this.$form = $el.querySelector('.newsletter-in__form');
		this.$input = this.$form.querySelector('input');
		this.$responseEl = $el.querySelector('.newsletter-in__response');
	}
	setListeners() {
		this.$form.addEventListener('submit', this.handleSubmit.bind(this))
	}
	handleSubmit(ev) {
		ev.preventDefault();
		const link = "test";
		const config = {
			method: 'POST'
		}
		fetch(link, config)
			.then(response => {
				this.$input.value = '';
				this.displayMessage({success: true});
			})
			.catch(error => {

			});
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
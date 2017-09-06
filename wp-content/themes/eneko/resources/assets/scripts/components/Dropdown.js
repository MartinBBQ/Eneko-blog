export default class Dropdown {
	constructor($el) {
		this.setProps($el);
		this.setListeners();
	}

	setProps($el) {
		this.$el = $el;
		this.isOpen = false;
	}
	close() {
		this.$el.classList.remove('is-open');
		this.isOpen = false;
	}
	setListeners() {
		document.body.addEventListener('click', this.close.bind(this));
	}
}
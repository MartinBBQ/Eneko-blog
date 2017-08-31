export default class Modal {
	constructor(props) {
		this.setProps(props);
		this.setListeners();
	}
	setProps(props) {
		this.$el = props.$el;
	}
	setListeners() {
		this.$el.addEventListener('click', this.toggle.bind(this))
	}
	toggle() {

	}
}
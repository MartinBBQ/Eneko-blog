import Modal from './Modal';

export default class ContactModal extends Modal {
	setProps(props) {
		super.setProps(props);
		this.$trigger = props.$trigger;
		// this.open();
	}
	setListeners() {
		super.setListeners();
		this.$trigger.addEventListener('click', super.open.bind(this));
	}
}
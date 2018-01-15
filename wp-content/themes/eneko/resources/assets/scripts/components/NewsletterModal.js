import Modal from './Modal';

export default class NewsletterModal extends Modal {
	setProps(props) {
		super.setProps(props);
		this.$form = this.$el.querySelector('form');
		this.$trigger = props.$trigger;
	}
	setListeners() {
		super.setListeners();
		this.$form.addEventListener('submit', this.register.bind(this));
		this.$trigger.addEventListener('click', super.open.bind(this));
	}
	getBody() {
		const body = {};
		Array.from(this.$form.elements).forEach($input => {
			const name = $input.getAttribute('name');
			if (name) {
				body[name] = $input.value;
			}
		})
		return body;
	}
	setEmail(value) {
		Array.from(this.$form.elements).forEach($input => {
			if ($input.getAttribute('type') === 'email') {
				$input.value = value;
			}
		})
	}
	register(ev) {
		ev.preventDefault();
		const url = `crm.${location.origin}/api/external/addContact`
		const config = {
			method: 'POST',
			body: this.getBody()
		}
		// console.log(this.getBody());
		fetch(url, config)
			.then(response => {
				this.close();
			})
			.catch(error => {

			});
	}
}
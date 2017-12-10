import Modal from './Modal';

export default class NewsletterModal extends Modal {
	setProps(props) {
		super.setProps(props);
		this.$form = this.$el.querySelector('form');
	}
	setListeners() {
		super.setListeners();
		this.$form.addEventListener('submit', this.register.bind(this));
	}
	getBody() {
		const {
			email,
			name,
			firstName,
			cityRef,
		} = this;
		return {
			email,
			name,
			firstName,
			cityRef
		}
	}
	setEmail(value) {
		Array.from(this.$form.elements).forEach($input => {
			if ($input.getAttribute('type') == 'email') {
				$input.value = value;
			}
		})
	}
	register(ev) {
		ev.preventDefault();
		const url = "test";
		const config = {
			method: 'POST',
			body: this.getBody()
		}
		fetch(url, config)
			.then(response => {
				this.close();
			})
			.catch(error => {

			});
	}
}
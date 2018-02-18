import Modal from './Modal';

export default class NewsletterModal extends Modal {
	setProps(props) {
		super.setProps(props);
		this.$form = this.$el.querySelector('form');
		this.$trigger = props.$trigger;
		this.$paragraph = this.$el.querySelector('.modal__bottom p');
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
		const url = `${location.protocol}//crm.${location.host}/api/external/addContact`
		const config = {
			method: 'POST',
			body: this.getBody()
		}
		const close = () => {
			setTimeout(() => {
				this.close();
			},4500)
		}
		fetch(url, config)
			.then(response => {
				this.$paragraph.textContent = 'Votre inscription a bien été prise en compte';
				close();
			})
			.catch(error => {
				this.$paragraph.textContent = 'Il y a eu une erreur lors de votre inscription';
				close();
			});
	}
}
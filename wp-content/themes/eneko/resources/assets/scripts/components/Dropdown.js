import EventBus from '../EventBus';
import {DROPDOWN_TOGGLE} from '../constants';

export default class Dropdown {
	constructor($el) {
		this.setProps($el);
		this.setListeners();
	}

	setProps($el) {
		this.$el = $el;
		this.isOpen = false;
	}
	open() {
		this.$el.classList.add('is-open');
		this.isOpen = true;
	}
	handleClose(ev) {
		const $target = ev.target;
		let isDropdown = true;
		if (!$target.classList.value.includes('dropdown')) {
			if ($target.parentNode.classList.value) {
				if (!$target.parentNode.classList.value.includes('dropdown')) {
					isDropdown = false;
				}
			} else {
				isDropdown = false;
			}
		}

		if (!isDropdown && this.isOpen) {
			this.close()
		}
	}
	close() {
		this.$el.classList.remove('is-open');
		this.isOpen = false;
	}
	toggleItem(ev) {
		const $target = ev.currentTarget;
		$target.classList.toggle('is-active');
		EventBus.emit(DROPDOWN_TOGGLE, { filter: $target.getAttribute('data-slug') });
	}
	toggle() {
		this.isOpen ? this.close() : this.open();
	}
	setListeners() {
		document.body.addEventListener('click', this.handleClose.bind(this));
		this.$el
			.querySelector('.dropdown__label')
			.addEventListener('click',this.toggle.bind(this));
		Array.from(this.$el.querySelectorAll('.dropdown__option')).forEach(item => {
			item.addEventListener('click',this.toggleItem.bind(this));
		})
	}
}
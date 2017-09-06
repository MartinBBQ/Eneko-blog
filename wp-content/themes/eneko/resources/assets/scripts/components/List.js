import eventBus from '../eventBus';
import {DROPDOWN_TOGGLE} from '../constants';

export default class List {
	constructor($el) {
		this.setProps($el);
		this.setListeners();
	}

	setProps($el) {
		this.$el = $el;
		this.$articles = this.$el.querySelectorAll('.article');
	}
	sortList(ev) {
		const filter = ev.detail.filter;
		console.log(filter);
		Array.from(this.$articles).forEach($el => {
			const { classList } = $el;
			console.log($el.getAttribute('data-category'));
			if(!$el.getAttribute('data-category').includes(filter)) {
				classList.toggle('is-hidden',true);
			} else {
				classList.toggle('is-hidden',false);
			}
		})
	}
	setListeners() {
		eventBus.addEventListener(DROPDOWN_TOGGLE,this.sortList.bind(this))
	}
}
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
		this.filters = [];
	}
	sortList(ev) {
		const filter = ev.detail.filter;
		const { filters } = this;
		let registerFilter = true;
		const hasFilter = this.filters.includes(filter);
		const isHiddenClass = 'is-hidden';
		Array.from(this.$articles).forEach($el => {
			const { classList } = $el;
			const elCategories = $el.getAttribute('data-category');
			let hasNoIntersection, hasIntersection;
			if(!hasFilter) {
				if(this.filters.length==0) {
					hasNoIntersection = !elCategories.includes(filter);
				} else {
					hasNoIntersection = this.filters.every(item => {
						return !elCategories.includes(item) && !elCategories.includes(filter);
					});
				}
				if(hasNoIntersection || classList.contains('is-url-article')) {
					classList.toggle(isHiddenClass,true);
				} else {
					classList.toggle(isHiddenClass,false);
				}
			} else {
				if(this.filters.length==1 && this.filters.includes(filter)) {
					classList.toggle(isHiddenClass,false);
				} else if(this.filters.length > 1) {
					hasIntersection = elCategories.split(' ').some(item => {
						let predicate = false;
						if(item!==filter) {
							return this.filters.includes(item);
						}
						return predicate;
					});
					if(hasIntersection) {
						classList.toggle(isHiddenClass,false);
					} else {
						classList.toggle(isHiddenClass,true);
					}
				}
				registerFilter = false;
			}
		})
		if(registerFilter) {
			this.filters.push(filter);
		} else {
			this.filters = this.filters.filter(item => item!==filter);
		}
	}
	setListeners() {
		eventBus.addEventListener(DROPDOWN_TOGGLE,this.sortList.bind(this))
	}
}
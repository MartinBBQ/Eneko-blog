export default class Modal {
	constructor(props) {
		this.setProps(props);
		this.setListeners();
	}
	setProps(props) {
		this.$el = props.$el;
		this.openClass = 'is-open';
		this.isOpen = false;
	}
	findAncestor ($el, cls) {
		while (($el = $el.parentElement) && !$el.classList.contains(cls));
		return $el;
	}
	setListeners() {
		this.$el.addEventListener('click', this.toggle.bind(this));
		this.$el.querySelector('.cross').addEventListener('click',this.close.bind(this));
		this.findAncestor(this.$el,'permanence').addEventListener('click',this.open.bind(this));
	}
	toggle(ev) {
		this.isOpen ? this.close(ev) : this.open(ev);
	}
	close(ev) {
		const $target = ev.target;
		const classVal = $target.classList.value;
		if(classVal.includes('cross') || $target.classList.contains('modal')) {
			this.$el.classList.remove(this.openClass);
			this.isOpen = false;
		}
	}
	open(ev) {
		const $target = ev.target;
		const classVal = $target.classList.value;
		if(!classVal.includes('modal') && !classVal.includes('cross')) {
			this.$el.classList.add(this.openClass);
			this.isOpen = true;
		}
	}
}
export default class Modal {
	constructor(props = {}) {
		this.setProps(props);
		this.setListeners();
	}
	setProps(props) {
		this.$el = props.$el;
		this.openClass = 'is-open';
		this.$cross = this.$el.querySelector('.cross');
		this.isOpen = false;
	}
	findAncestor ($el, cls) {
		while (($el = $el.parentElement) && !$el.classList.contains(cls));
		return $el;
	}
	setListeners() {
		this.$el.addEventListener('click', this.toggle.bind(this));
		if (this.$cross) {
			this.$cross.addEventListener('click',this.close.bind(this));
		}
	}
	toggle(ev) {
		this.isOpen ? this.handleClose(ev) : this.handleOpen(ev);
	}
	close() {
		this.$el.classList.remove(this.openClass);
		this.isOpen = false;
	}
	handleClose(ev) {
		const $target = ev.target;
		const classVal = $target.classList.value;
		if(classVal.includes('cross') || $target.classList.contains('modal')) {
			this.close();
		}
	}
	open() {
		this.$el.classList.add(this.openClass);
		this.isOpen = true;
	}
	handleOpen(ev) {
		const $target = ev.target;
		const classVal = $target && $target.classList.value;
		if(!classVal.includes('modal') && !classVal.includes('cross')) {
			this.open();
		}
	}
}

document.getElementById('modal-ie').onclick = closeIepopup;
function closeIepopup() {
	let modalIe = document.getElementById('modal-ie');

	if(modalIe.className === 'modal is-open'){
    		modalIe.className = 'modal';
	}
}

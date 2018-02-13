import Modal from './Modal';

export default class DutyModal extends Modal {
	setProps(props) {
		super.setProps(props);
		this.isTriggeredOnce = false;
	}
	setListeners() {
		super.setListeners();
		this.findAncestor(this.$el,'permanence').addEventListener('click',this.handleOpen.bind(this));
	}
	triggerGmap() {
		if(google && !this.isTriggeredOnce) {
			const map = this.$el.querySelector('.modal__map');
			google.maps.event.trigger(map, "resize");
			this.isTriggeredOnce = true;
		}
	}
	handleOpen(ev) {
		this.triggerGmap();
		super.handleOpen(ev);
	}
}
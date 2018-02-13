class EventBus {
	constructor(props = {}) {
		this.$el = EventBus.createEl();
		this.logEvents = !!props.logEvents;
	}
	/**
	 * Attach an event from the DOM Element
	 * @param {string} eventName
	 * @param {Function} callback
	 */
	on(eventName, callback = () => {}) {
		this.$el.addEventListener(eventName, callback);
	}

	/**
	 * Detach an event from the DOM Element
	 * @param {string} eventName
	 * @param {Function} callback
	 */
	off(eventName, callback = () => {}) {
		this.$el.removeEventListener(eventName, callback);
	}

	/**
	 * Dispatch an event.
	 * @param {string} eventName
	 * @param {object} payload
	 */
	emit(eventName, payload = {}) {
		if(this.logEvents) {
			console.log(`[Event] ${eventName}`, payload);
		}
		const eventConfig = { bubbles:true, detail: payload };
		const event = new CustomEvent(eventName, eventConfig);
		this.$el.dispatchEvent(event);
	}

	/**
	 * Replaces the DOM Element dispatching the events, and dumps all events attached to it
	 */
	refresh() {
		this.$el = EventBus.createEl();
	}

	/**
	 * Creates a div.
	 * @returns {Element}
	 */
	static createEl() {
		return document.createElement('div');
	}
}

export default new EventBus();
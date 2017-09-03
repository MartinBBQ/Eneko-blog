import {TweenLite, Power3} from 'gsap';

export default {
	init() {
		this.setProps()
		this.setListeners();
		this.sortEvents();
	},
	setProps() {
		// Body has datebook class aswell (page slug)
		this.$el = document.body.querySelector('.datebook');
		this.monthList = ['Janvier', 'Février', 'Mars',
		'Avril', 'Mai', 'Juin', 'Juillet', 'Août',
		'Septembre', 'Octobre', 'Novembre', 'Décembre'
		],
		this.$monthEl = this.$el.querySelector('.datebook__month > span');
		this.currentMonth = this.$el.getAttribute('data-current-month');
		this.$events = this.$el.querySelectorAll('.event');
	},
	setListeners() {
		this.$el
			.querySelector('.datebook__arrow.is-left')
			.addEventListener('click',this.getPrev.bind(this));
		this.$el
			.querySelector('.datebook__arrow.is-right')
			.addEventListener('click',this.getNext.bind(this));
		Array.from(this.$events).forEach($el => {
			$el.addEventListener('click',this.slideToggle.bind(this))
		});
	},
	getPrev() {
		if(this.currentMonth==1) {
			this.currentMonth = 12;
		} else {
			this.currentMonth--;
		}
		this.setMonth();
	},
	getNext() {
		if(this.currentMonth==12) {
			this.currentMonth = 1;
		} else {
			this.currentMonth++;
		}
		this.setMonth();
	},
	setMonth() {
		const month = this.monthList[this.currentMonth-1];
		this.$monthEl.textContent = month;
		this.sortEvents();
	},
	sortEvents() {
		Array.from(this.$events).forEach($el => {
			if($el.getAttribute('data-month')==this.currentMonth) {
				$el.classList.toggle('is-hidden',false);
			} else {
				$el.classList.toggle('is-hidden',true);
			}
		});
	},
	slideToggle(ev) {
		const $target = ev.currentTarget;
		const $content = $target.querySelector(".event__collapsible");
		const toggleClass = 'is-closed';
		const timing = 0.6;
		const tweenConfig = { height:0, ease: Power3.easeInOut};
		if(!$target.classList.contains(toggleClass)){
			TweenLite.to($content, timing, tweenConfig);
			$target.classList.add(toggleClass);
		} else{
			TweenLite.set($content, { height:"auto" });
			TweenLite.from($content, timing, tweenConfig);
			$target.classList.remove(toggleClass);
		}
	}
}
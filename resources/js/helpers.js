import { format, parseISO } from 'date-fns'
import { parseFromTimeZone } from 'date-fns-timezone'
import moment from 'moment';
export default {
	install(Vue, options) {

		Vue.prototype.$dateOnly = function (date) {
			return (date) ? moment(date).format("dd, Do MMM") : "";
		}
		Vue.prototype.$date = function (date, showTimeForOld = false, timezone = false) {
			var result = "";
			if (date) {
				date = parseISO(date);

				var now = new Date().toDateString();
				var date_string = new Date(date).toDateString();
				if (now == date_string) {
					result = format(date, "HH:mm");
				}

				if (!result) {
					var tomorrow = new Date();
					var d = tomorrow.getDate();
					tomorrow.setDate(++d);
					tomorrow = tomorrow.toDateString();
					if (tomorrow == date_string) {
						result = "Завтра " + format(date, "HH:mm");
					}
				}

				if (!result) {
					var yesterday = new Date();
					var d = yesterday.getDate();
					yesterday.setDate(--d);
					yesterday = yesterday.toDateString();
					if (yesterday == date_string) {
						result = "Вчера " + format(date, "HH:mm");
					}
				}

				if (!result) {
					var yesterday = new Date();
					var d = yesterday.getDate();
					yesterday.setDate(--d);
					yesterday = yesterday.toDateString();
					if (yesterday == date_string) {
						result = "Позавчера " + format(date, "HH:mm");
					}
				}

				if (!result) {
					var year = new Date().getFullYear();
					var date_year = new Date(date).getFullYear();

					if (year != date_year) {
						result = moment(date).format("dd, D MMM YYYY");
					} else {
						result = moment(date).format("dd, D MMM");
					}
					if (showTimeForOld) {
						result += " " + moment(date).format("HH:mm");
					}
				}
			}
			return result;
		}
		Vue.prototype.$truncateAvatarName = function (name) {
			return name.substring(0, 2);
		}
		Vue.prototype.$truncateTimeFromDate = function (date, timezone = "Europe/Moscow") {
			if (date) {
				date = parseFromTimeZone(date, { timeZone: timezone })
				date = format(date, 'HH:mm');
			}
			return date;
		}
		Vue.prototype.$truncateDateFromDate = function (date, timezone = "Europe/Moscow") {
			if (date) {
				date = parseFromTimeZone(date, { timeZone: timezone })
				date = format(date, 'DD.MM.YY');
			}
			return date;
		}

		Vue.prototype.$makePagination = function (data) {
			var pages = [];
			var cur = data.current_page;

			if (data.last_page !== 1) {
				var minus = 2;
				var plus = 2;

				if (cur == 1) {
					minus = 0;
					plus = 4;
				}
				if (cur == 2) {
					minus = 1;
					plus = 3;
				}

				for (var index = (cur - minus); index <= (cur + plus); index++) {
					if ((index > 0) && (index < data.last_page)) {
						pages.push(index);
					}
				}

				if (cur > 3) {
					pages.unshift(1);
				}
				if (pages[pages.length - 1] < data.last_page) {
					pages.push(data.last_page);
				}

			}
			return pages;
		}
	}
}

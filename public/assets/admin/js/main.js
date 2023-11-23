"use strict";

let menu, animate;
!function () {
	let e = document.querySelectorAll("#layout-menu"),
		t = (e.forEach(function (e) {
			menu = new Menu(e, {orientation: "vertical", closeChildren: !1}), window.Helpers.scrollToActive(animate = !1), window.Helpers.mainMenu = menu
		}), document.querySelectorAll(".layout-menu-toggle"));
	t.forEach(e => {
		e.addEventListener("click", e => {
			e.preventDefault(), window.Helpers.toggleCollapsed()
		})
	});
	if (document.getElementById("layout-menu")) {
		var l = document.getElementById("layout-menu");
		var o = function () {
			Helpers.isSmallScreen() || document.querySelector(".layout-menu-toggle").classList.add("d-block")
		};
		let e = null;
		l.onmouseenter = function () {
			e = Helpers.isSmallScreen() ? setTimeout(o, 0) : setTimeout(o, 300)
		}, l.onmouseleave = function () {
			document.querySelector(".layout-menu-toggle").classList.remove("d-block"), clearTimeout(e)
		}
	}
	let n = document.getElementsByClassName("menu-inner"),
		s = document.getElementsByClassName("menu-inner-shadow")[0];
	0 < n.length && s && n[0].addEventListener("ps-scroll-y", function () {
		this.querySelector(".ps__thumb-y").offsetTop ? s.style.display = "block" : s.style.display = "none"
	});

	function c(e) {
		"show.bs.collapse" == e.type || "show.bs.collapse" == e.type ? e.target.closest(".accordion-item").classList.add("active") : e.target.closest(".accordion-item").classList.remove("active")
	}

	const i = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')),
		a = (i.map(function (e) {
			return new bootstrap.Tooltip(e)
		}), [].slice.call(document.querySelectorAll(".accordion")));
	a.map(function (e) {
		e.addEventListener("show.bs.collapse", c), e.addEventListener("hide.bs.collapse", c)
	});
	window.Helpers.setAutoUpdate(!0), window.Helpers.initPasswordToggle(), window.Helpers.initSpeechToText(), window.Helpers.isSmallScreen() || window.Helpers.setCollapsed(!0, !1)
}();

/**
 *
 * @param options
 * @returns {HTMLElement, Element}
 */
function mCreateElement(options) {
	let element = document.createElement(options.element);

	if (options.attributes) {
		for (const attribute of options.attributes) {
			element.setAttribute(attribute.name, attribute.value);
			// if (attribute.value) {
			// } else {
			// 	element.setAttribute(attribute.name);
			// }
		}
	}

	if (options.text) {
		element.innerText = options.text;
	}

	if (options.html) {
		element.innerHTML = options.html;
	}

	return element;
}

function nl2br(str, is_xhtml) {
	if (typeof str === 'undefined' || str === null) {
		return '';
	}
	var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
	return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function toSeoUrl(url) {
	if (!url) {
		return url;
	}

	const words = url.split('-').join(' ')
		.replace(/[!-\/:-@[-`{-~]/g, "") //remove special characters
		.replace(/÷+/g, "")
		.replace(/٬+/g, "")
		.replace(/٫+/g, "")
		.replace(/٪+/g, "")
		.replace(/×+/g, "")
		.replace(/،+/g, "")
		.replace(/ـ+/g, "")
		.replace(/؟+/g, "")
		.replace(/\s+/g, " ")
		.split(' ');
	const newWords = [];
	for (let word of words) {
		if (word.length > 0) {
			newWords.push(word);
		} else {
			newWords.push('');
			break;
		}
	}

	return newWords.join('-');
}
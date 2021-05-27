function showList() {
	// let divElement = document.querySelector('div[name="posts"]>div');
	// if (divElement.style.opacity == "0") {
	// 	divElement.style.opacity = 1;
	// 	divElement.style.display = "flex";
	// 	for (let i = 0; i < anchorElements.length; ++i) {
	// 		anchorElements[i].style.pointerEvents = "visible";
	// 	}
	// } else {
	// 	divElement.style.opacity = 0;
	// 	// divElement.style.display = "none";
	// 	// // for (let i = 0; i < anchorElements.length; ++i) {
	// 	// // 	anchorElements[i].style.pointerEvents = "none";
	// 	// // }
	// }
	let elem = document.querySelector('div[name="posts"]>div');
	if (elem.classList.contains("visible")) {
		elem.classList.remove("visible");
	} else {
		elem.classList.add("visible");
	}
}

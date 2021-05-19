function showPassword() {
	let checkbox = document.querySelector('input[name="visible-pass"');
	let password = document.querySelector('input[name="password"');
	let repass = document.querySelector('input[name="re-password"');

	if (checkbox.checked) {
		password.type = "text";
		if (repass !== null) {
			repass.type = "text";
		}
	} else {
		password.type = "password";
		if (repass !== null) {
			repass.type = "password";
		}
	}
}
function checkPassword() {
	let password = document.querySelector('input[name="password"');
	let repass = document.querySelector('input[name="re-password"');
	let register = document.querySelector('input[name="register-submit"');
	register.onmouseover = function () {
		this.style.backgroundColor = "#52b2bf";
	};
	if (password.value !== repass.value) {
		register.disabled = true;
		register.style.backgroundColor = "red";
		register.onmouseleave = function () {
			this.style.backgroundColor = "red";
		};
		register.onmouseover = function () {
			this.style.backgroundColor = "darkred";
		};
	} else {
		register.disabled = false;
		register.style.backgroundColor = "#1f456e";
		register.onmouseleave = function () {
			this.style.backgroundColor = "#1f456e";
		};
	}
}

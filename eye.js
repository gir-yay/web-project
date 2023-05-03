/*
const pwfield = document.querySelector(
	".container .details .boxs .input-boxss input[type='password']"
);
const toggleBtn = document.querySelector(
	".container .details .boxs .input-boxss i"
);

toggleBtn.onclick = () => {
	if (pwfield.type == "password") {
		pwfield.type = "text";
		toggleBtn.classList.add("active");
	} else {
		pwfield.type = "password";
		toggleBtn.classList.remove("active");
	}
};
*/

var pwfield = document.querySelector(".pw");
var toggleBtn = document.querySelector(".e");

toggleBtn.onclick = () => {
	if (pwfield.type == "password") {
		pwfield.type = "text";
		toggleBtn.classList.add("active");
	} else {
		pwfield.type = "password";
		toggleBtn.classList.remove("active");
	}
};

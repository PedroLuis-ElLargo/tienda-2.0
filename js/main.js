/* -- Profile Users -- */
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () => {
	profile.classList.toggle('active');
	navbar.classList.remove('active');
};

/* -- Navbar -- */
let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () => {
	navbar.classList.toggle('active');
	profile.classList.remove('active');
};

window.onscroll = () => {
	profile.classList.remove('active');
	navbar.classList.remove('active');
};

/*-- Initialize Swiper --*/
var swiper = new Swiper('.home-slider', {
	loop: true,
	spaceBetween: 20,
	grabCursor: true,
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
	},
});

var swiper = new Swiper('.category-slider', {
	loop: true,
	spaceBetween: 20,
	grabCursor: true,
	pagination: {
		el: '.swiper-pagination',
	},
	breakpoints: {
		0: {
			slidesPerView: 2,
		},
		650: {
			slidesPerView: 3,
		},
		768: {
			slidesPerView: 4,
		},
		1024: {
			slidesPerView: 5,
		},
	},
});

document.addEventListener("DOMContentLoaded", function () {
    var currentPage = window.location.href;
    var menuLinks = document.querySelectorAll('.menu-links a');
    menuLinks.forEach(function (link) {
        console.log(link.getAttribute('href') + " " + currentPage);
        if (link.getAttribute('href') === currentPage) {
            link.parentElement.classList.add('active');
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {

    if (parseInt(document.getElementById("circle_reviews").innerText) < 1) {
        document.getElementById("circle_reviews").style.display = "none";
    }

    if (parseInt(document.getElementById("circle_tasks").innerText) < 1) {
        document.getElementById("circle_tasks").style.display = "none";
    }


    const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = document.querySelector(".mode-text");

    // Проверяем значение из localStorage и устанавливаем тему после загрузки


    const initialSide = localStorage.getItem('side') || 'close';

    if (initialSide === 'open') {
        sidebar.classList.remove('close');
    } else {
        sidebar.classList.add('close');
    }

    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
        localStorage.setItem('side', sidebar.classList.contains('close') ? 'close' : 'open');
    });


    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");

        if (body.classList.contains("dark")) {
            modeText.innerText = "Light mode";
            localStorage.setItem('theme', 'dark');
        } else {
            modeText.innerText = "Dark mode";
            localStorage.setItem('theme', 'light');
        }
    });

    window.addEventListener('load', function () {
        document.documentElement.style.visibility = 'visible';
    });

    const icons = document.querySelectorAll('.bx-calendar-exclamation');

    icons.forEach(icon => {
        icon.addEventListener('mouseover', () => {
            icon.classList.add('bx-tada', 'bx-rotate-180', 'icon-hover');
        });

        icon.addEventListener('mouseout', () => {
            icon.classList.remove('bx-tada', 'bx-rotate-180');
        });
    });
});








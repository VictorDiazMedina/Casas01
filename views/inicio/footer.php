<script src="assets/prueba/js/jquery.min.js"></script>
<script>
config = {
    minDate: "today",
    altInput: true,
    altFormat: "l j, F",
    dateFormat: "Y-m-d",
    locale: {
        firstDayOfWeek: 1,
        weekdays: {
            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        },
        months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ],
        },
    }
}

flatpickr("#llegada", config);
flatpickr("#salida", config);
</script>

<script>
window.onscroll = function() {
    myFunction()
};

function myFunction() {

    if (document.body.scrollTop != 0 || document.documentElement.scrollTop != 0) {
        document.getElementById('header').style.backgroundColor = "lightcoral";
    } else {
        document.getElementById('header').style.backgroundColor = "transparent";
    }
}
</script>

<script type="text/javascript">
const slider = document.querySelector(".slider");
const nextBtn = document.querySelector(".next-btn");
const prevBtn = document.querySelector(".prev-btn");
const slides = document.querySelectorAll(".slide");
const slideIcons = document.querySelectorAll(".slide-icon");

const numberOfSlides = slides.length;
var slideNumber = 0;

//image slider next button
nextBtn.addEventListener("click", () => {
    slides.forEach((slide) => {
        slide.classList.remove("active");
    });
    slideIcons.forEach((slideIcon) => {
        slideIcon.classList.remove("active");
    });

    slideNumber++;

    if (slideNumber > (numberOfSlides - 1)) {
        slideNumber = 0;
    }

    slides[slideNumber].classList.add("active");
    slideIcons[slideNumber].classList.add("active");
});

//image slider previous button
prevBtn.addEventListener("click", () => {
    slides.forEach((slide) => {
        slide.classList.remove("active");
    });
    slideIcons.forEach((slideIcon) => {
        slideIcon.classList.remove("active");
    });

    slideNumber--;

    if (slideNumber < 0) {
        slideNumber = numberOfSlides - 1;
    }

    slides[slideNumber].classList.add("active");
    slideIcons[slideNumber].classList.add("active");
});

//image slider autoplay
var playSlider;

var repeater = () => {
    document.querySelector(".navigation").style.height = screen.height;
    playSlider = setInterval(function() {
        slides.forEach((slide) => {
            slide.classList.remove("active");
        });
        slideIcons.forEach((slideIcon) => {
            slideIcon.classList.remove("active");
        });

        slideNumber++;

        if (slideNumber > (numberOfSlides - 1)) {
            slideNumber = 0;
        }

        slides[slideNumber].classList.add("active");
        slideIcons[slideNumber].classList.add("active");
    }, 4000);
}
repeater();

//stop the image slider autoplay on mouseover
slider.addEventListener("mouseover", () => {
    clearInterval(playSlider);
});

//start the image slider autoplay again on mouseout
slider.addEventListener("mouseout", () => {
    repeater();
});
</script>

<script>
window.addEventListener('DOMContentLoaded', () => {
    const btn_menu = document.querySelector('.btn_menu');

    const a = document.querySelector('.a');
    const b = document.querySelector('.b');
    const c = document.querySelector('.c');

    if (btn_menu) {
        btn_menu.addEventListener('click', () => {
            const menu_items = document.querySelector('.menu_items');
            menu_items.classList.toggle('show');
        });
        a.addEventListener('click', () => {
            const menu_items = document.querySelector('.menu_items');
            menu_items.classList.toggle('show');
        });

        b.addEventListener('click', () => {
            const menu_items = document.querySelector('.menu_items');
            menu_items.classList.toggle('show');
        });
        c.addEventListener('click', () => {
            const menu_items = document.querySelector('.menu_items');
            menu_items.classList.toggle('show');
        });
    }
});
</script>

<script src="assets/js/fixed-responsive-nav.js"></script>
</body>

</html>
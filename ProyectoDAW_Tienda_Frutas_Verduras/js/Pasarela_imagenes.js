let numeropasarela = 0;
const slides = document.getElementsByClassName("mySlides");


function enseñaPasarela() {
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    numeropasarela++;
    if (numeropasarela > slides.length) {
        numeropasarela = 1;
    }
    slides[numeropasarela - 1].style.display = "block";
    setTimeout(enseñaPasarela, 2000); // Cambia imagen cada 3 segundos
}

enseñaPasarela();

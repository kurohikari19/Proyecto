var carrusel = document.getElementById('carrusel');
var imgs = carrusel.querySelectorAll('img'); // <-- solo imágenes del carrusel
var prevBtn = document.getElementById('prev');
var nextBtn = document.getElementById('next');

var index = 0;
var intervalo;

function mostrarImagen(i) {
    imgs.forEach((img, idx) => {
        img.style.display = idx === i ? 'block' : 'none';
    });
}

function siguiente() {
    index = (index + 1) % imgs.length;
    mostrarImagen(index);
}

function anterior() {
    index = (index - 1 + imgs.length) % imgs.length;
    mostrarImagen(index);
}

prevBtn.addEventListener('click', () => {
    anterior();
    reiniciarIntervalo();
});

nextBtn.addEventListener('click', () => {
    siguiente();
    reiniciarIntervalo();
});

function reiniciarIntervalo() {
    clearInterval(intervalo);
    intervalo = setInterval(siguiente, 3000);
}

// Inicia el carrusel
mostrarImagen(index);
intervalo = setInterval(siguiente, 3000);

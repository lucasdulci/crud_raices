document.addEventListener('DOMContentLoaded', function() {
    
    eventListeners();
    
    darkMode();
});

function darkMode() {
    const botonDarkMode = document.querySelector('.dark-mode-boton');

    const prefiere = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode')
    } else {
        document.body.classList.remove('dark-mode')
    }

    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    const mobilemenu = document.querySelector('.mobile-menu');

    mobilemenu.addEventListener('click', navegacionResponsive);

}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar'); 
    } else {
        navegacion.classList.add('mostrar');
    }
}
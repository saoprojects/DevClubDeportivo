if(document.querySelector('#mapa')) {

    const lat = 40.35050947344591
    const lng = -3.9049071199336067
    const zoom = 16;

    const map = L.map('mapa').setView([lat, lng], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup(`
            <h2 class="mapa__heading">ClubDeportivo\/></h2> 
            <p class="mapa__texto">Visita nuestras instalaciones</p>
        `)
        .openPopup();
}
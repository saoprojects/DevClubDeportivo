(function() {
    const grafica = document.querySelector('#regalos-grafica');
    if(grafica) {

        obtenerDatos()
        async function obtenerDatos() {
           const url = '/api/equipacion'
           const respuesta = await fetch(url) 
           const resultado = await respuesta.json()
            console.log(resultado)
           const ctx = document.getElementById('regalos-grafica');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                labels: resultado.map( equipacion => equipacion.nombre),
                datasets: [{
                    label: '',
                    data: resultado.map( equipacion => equipacion.total),
                    backgroundColor: [
                        '#ea580c',
                        '#84cc16',
                        '#22d3ee',
                        '#a855f7',
                        '#ef4444',
                        '#14b8a6',
                        '#db2777',
                        '#e11d48',
                        '#7e22ce'
                    ]
                   
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                },
                plugins:{
                    legend: {
                        display: false
                    }
                }
            }
        });
           
        }
            
    }
        
})();
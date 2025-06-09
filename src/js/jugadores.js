(function() {
    const jugadoresInput = document.querySelector('#jugadores');
    if(jugadoresInput) {
        let jugadores = [];
        let jugadoresFiltrado = [];

        const listadoJugadores = document.querySelector('#listado-jugadores');
        const jugadorHidden = document.querySelector('[name="jugador_id"]');

        obtenerJugadores();
        jugadoresInput.addEventListener('input', buscarJugadores)

        if(jugadorHidden.value) {
            (async() =>{
                const jugador = await obtenerJugador(jugadorHidden.value)
                const {nombre, primer_apellido} = jugador
                
                // Insertar en el HTML
                const jugadorDOM = document.createElement('LI');
                jugadorDOM.classList.add('listado-jugadores__jugador', 'listado-jugadores__jugador--seleccionado');
                jugadorDOM.textContent = `${nombre} ${primer_apellido}`
                listadoJugadores.appendChild(jugadorDOM)
            })()
        }

        async function obtenerJugadores() {
            const url = `/api/jugadores`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            formatearJugadores(resultado);
        }

        async function obtenerJugador(id) {
            const url = `/api/jugador?id=${id}`;
            const respuesta = await fetch(url)
            const resultado = await respuesta.json()
            return resultado;
        }

        function formatearJugadores(arrayJugadores = []) {
            jugadores = arrayJugadores.map( jugador => {
                return {
                    nombre: `${jugador.nombre.trim()} ${jugador.primer_apellido.trim()}`,
                    id: jugador.id
                }
            })
           
        }

        function buscarJugadores(e) {
            const busqueda = e.target.value;
            if(busqueda.length > 3) {
                const expresion = new RegExp(busqueda, "i");
                jugadoresFiltrado = jugadores.filter(jugador => {
                    if(jugador.nombre.toLowerCase().search(expresion) != -1) {
                        return jugador
                    }
                })
                
            } else {
                jugadoresFiltrado = []
            }

            mostrarJugadores();
        }

        function mostrarJugadores() {
            while(listadoJugadores.firstChild) {
                listadoJugadores.removeChild(listadoJugadores.firstChild)
            }

            if(jugadoresFiltrado.length > 0) {
                jugadoresFiltrado.forEach(jugador => {
                    const jugadorHTML = document.createElement('LI');
                    jugadorHTML.classList.add('listado-jugadores__jugador')
                    jugadorHTML.textContent = jugador.nombre;
                    jugadorHTML.dataset.jugadorId = jugador.id
                    jugadorHTML.onclick = seleccionarJugador
    
                    // Añadir al DOM
                    listadoJugadores.appendChild(jugadorHTML)
                })
            } else {
                const noResultado = document.createElement('P')
                noResultado.classList.add('listado-jugadores__no-resultado')
                noResultado.textContent = 'No hay resultado para la busqueda'  
                listadoJugadores.appendChild(noResultado)
            } 
        }

        function seleccionarJugador(e) {
            const jugador = e.target;

            // Remover la clase previa
            const jugadorPrevio = document.querySelector('.listado-jugadores__jugador--seleccionado')
            if(jugadorPrevio) {
                jugadorPrevio.classList.remove('listado-jugadores__jugador--seleccionado')
            }

            jugador.classList.add('listado-jugadores__jugador--seleccionado')
            jugadorHidden.value = jugador.dataset.jugadorId
        }
    }
})()
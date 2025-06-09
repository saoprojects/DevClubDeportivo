(function() {
    const entrenadoresInput = document.querySelector('#entrenadores');
    if(entrenadoresInput) {
        let entrenadores = [];
        let entrenadoresFiltrado = [];

        const listadoEntrenadores = document.querySelector('#listado-entrenadores');
        const entrenadorHidden = document.querySelector('[name="entrenador_id"]');

        obtenerEntrenadores();
        entrenadoresInput.addEventListener('input', buscarEntrenadores)

        if(entrenadorHidden.value) {
            (async() =>{
                const entrenador = await obtenerEntrenador(entrenadorHidden.value)
                const {nombre, apellido} = entrenador
                
                // Insertar en el HTML
                const entrenadorDOM = document.createElement('LI');
                entrenadorDOM.classList.add('listado-entrenadores__entrenador', 'listado-entrenadores__entrenador--seleccionado');
                entrenadorDOM.textContent = `${nombre} ${apellido}`
                listadoEntrenadores.appendChild(entrenadorDOM)
            })()
        }

        async function obtenerEntrenadores() {
            const url = `/api/entrenadores`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            formatearEntrenadores(resultado);
        }

        async function obtenerEntrenador(id) {
            const url = `/api/entrenador?id=${id}`;
            const respuesta = await fetch(url)
            const resultado = await respuesta.json()
            return resultado;
        }

        // function formatearEntrenadores(arrayEntrenadores = []) {
        //     entrenadores = arrayEntrenadores.map( entrenador => {
        //         return {
        //             nombre: `${entrenador.nombre.trim()} ${entrenador.apellido.trim()}`,
        //             id: entrenador.id
        //         }
        //     })
        // }

        function formatearEntrenadores(arrayEntrenadores = []) {
            entrenadores = arrayEntrenadores.map(entrenador => {
                const nombreCompleto = [
                    entrenador.nombre ? entrenador.nombre.trim() : '',
                    entrenador.apellido ? entrenador.apellido.trim() : ''
                ].filter(Boolean).join(' ');
        
                return {
                    nombre: nombreCompleto,
                    id: entrenador.id
                };
            });
        }
        

        function buscarEntrenadores(e) {
            const busqueda = e.target.value;
            if(busqueda.length > 3) {
                const expresion = new RegExp(busqueda, "i");
                entrenadoresFiltrado = entrenadores.filter(entrenador => {
                    if(entrenador.nombre.toLowerCase().search(expresion) != -1) {
                        return entrenador
                    }
                })
            } else {
                entrenadoresFiltrado = []
            }

            mostrarEntrenadores();
        }

        function mostrarEntrenadores() {
            while(listadoEntrenadores.firstChild) {
                listadoEntrenadores.removeChild(listadoEntrenadores.firstChild)
            }

            if(entrenadoresFiltrado.length > 0) {
                entrenadoresFiltrado.forEach(entrenador => {
                    const entrenadorHTML = document.createElement('LI');
                    entrenadorHTML.classList.add('listado-entrenadores__entrenador')
                    entrenadorHTML.textContent = entrenador.nombre;
                    entrenadorHTML.dataset.entrenadorId = entrenador.id
                    entrenadorHTML.onclick = seleccionarEntrenador
    
                    // Añadir al DOM
                    listadoEntrenadores.appendChild(entrenadorHTML)
                })
            } else {
                const noResultado = document.createElement('P')
                noResultado.classList.add('listado-entrenadores__no-resultado')
                noResultado.textContent = 'No hay resultado para la busqueda'  
                listadoEntrenadores.appendChild(noResultado)
            } 
        }

        function seleccionarEntrenador(e) {
            const entrenador = e.target;

            // Remover la clase previa
            const entrenadorPrevio = document.querySelector('.listado-entrenadores__entrenador--seleccionado')
            if(entrenadorPrevio) {
                entrenadorPrevio.classList.remove('listado-entrenadores__entrenador--seleccionado')
            }

            entrenador.classList.add('listado-entrenadores__entrenador--seleccionado')
            entrenadorHidden.value = entrenador.dataset.entrenadorId
        }
    }
})();

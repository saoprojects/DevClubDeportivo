<main class="paquetes">
    <h2 class="paquetes__heading"><?php echo $titulo; ?></h2>
    <p class="paquetes__descripcion">Compara las subscripciones de Club Deportivo/ </p>

    

    <div <?php aos_animacion(); ?> class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento"> Acceso virtual a Club Deportivo/</li>
            </ul>
            <p class="paquete__precio">0€</p>
        </div>

        <div <?php aos_animacion(); ?> class="paquete">
            <h3 class="paquete__nombre">Pase Superior</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento"> Acceso virtual a Club Deportivo/</li>
                <li class="paquete__elemento"> Acceso virtual a Club Deportivo/</li>
                <li class="paquete__elemento"> Acceso virtual a Club Deportivo/</li>
                <li class="paquete__elemento"> Acceso virtual a Club Deportivo/</li>
                <li class="paquete__elemento"> Acceso virtual a Club Deportivo/</li>
                <li class="paquete__elemento"> Acceso virtual a Club Deportivo/</li>
            </ul>
            <p class="paquete__precio">200€</p>
        </div>

        <div <?php aos_animacion(); ?> class="paquete">
            <h3 class="paquete__nombre">Pase Intermedio</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento"> Acceso virtual a Club Deportivo/</li>
                <li class="paquete__elemento"> Acceso virtual a Club Deportivo/</li>
                <li class="paquete__elemento"> Acceso virtual a Club Deportivo/</li>
                <li class="paquete__elemento"> Acceso virtual a Club Deportivo/</li>
            </ul>
            <p class="paquete__precio">50€</p>
        </div>

    </div>

    <section class="boletos">
    <h2 class="boletos__heading">Pases & Precios</h2>
    <p class="boletos__descripcion">Precios para Clu</p>

    <div class="boletos__grid">
        <div <?php aos_animacion(); ?> class="boleto boleto--presencial">
            <h4 class="boleto__logo"> &lt;/Club Deportivo/&gt;</h4>
            <p class="boleto__plan">Pase Superior</p>
            <p class="boleto__precio">200€</p>
        </div>

        <div <?php aos_animacion(); ?> class="boleto boleto--virtual">
            <h4 class="boleto__logo">&lt;/Club Deportivo/&gt;</h4>
            <p class="boleto__plan">Pase Intermedio</p>
            <p class="boleto__precio">50€</p>
        </div>

        <div <?php aos_animacion(); ?> class="boleto boleto--gratis">
            <h4 class="boleto__logo">&lt;/Club Deportivo/&gt;</h4>
            <p class="boleto__plan">Pase Gratis</p>
            <p class="boleto__precio">Gratis - 0€</p>
        </div>
    </div>

    <div class="boleto__enlace-contenedor">
        <a href="/paquetes" class="boleto__enlace">Ver Paquetes</a>
    </div>
</section>
</main>
<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?php echo $titulo; ?></h2>
    <p class="devwebcamp__descripcion">Conoce los eventos mas importantes de nuestro Club</p>

    <div class="devwebcamp__grid">
        <div <?php aos_animacion(); ?> class="devwebcamp__imagen">
            <picture>
                <source srcset="build//img/sobre_devwebcamp.avif" type="image/avif"/>
                <source srcset="build//img/sobre_devwebcamp.webp" type="image/webp"/>
                <img loading="lazy" width="200" height="300" src="build/img/sobre_devwebcamp.jpg" alt="Imagen"/>
            </picture>
        </div>
            <div <?php aos_animacion(); ?> class="devwebcamp__contenido">
                <p class="devwebcamp__texto">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                    Odio, cumque ipsam. Recusandae molestiae ut est suscipit, enim porro placeat unde 
                    dolores praesentium dicta voluptatum modi neque magnam numquam quasi magni?</p>
                
                    <p class="devwebcamp__texto">Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                    Odio, cumque ipsam. Recusandae molestiae ut est suscipit, enim porro placeat unde 
                    dolores praesentium dicta voluptatum modi neque magnam numquam quasi magni?</p>
                
            </div>

        </div>
    
</main>
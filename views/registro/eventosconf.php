
<h2 class="pagina__heading"><?php echo $titulo; ?></h2>
<p class="pagina__descripcion">Elige tus eventos.</p>


<div class="eventos-registro">
    <main class="eventos-registro__listado">
        <h3 class="eventos-registro__heading--conferencias">&lt;Torneos /></h3>      
        <p class="eventos-registro__fecha">Viernes 5 de Diciembre</p>
                
        <div class="eventos-registro__grid">
            <?php foreach($eventos['torneos_v'] as $evento) { ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php } ?>
        </div>

            <p class="eventos-registro__fecha">Sabado 6 de Diciembre</p>
        <div class="eventos-registro__grid">
            <?php foreach($eventos['torneos_s'] as $evento) { ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php } ?>
        </div>


        <h3 class="eventos-registro__heading--workshops">&lt;Campus /></h3>      
        <p class="eventos-registro__fecha">Viernes 5 de Diciembre</p>
                
        <div class="eventos-registro__grid eventos--workshops">
            <?php foreach($eventos['campus_v'] as $evento) { ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php } ?>
        </div>

            <p class="eventos-registro__fecha">Sabado 6 de Diciembre</p>
        <div class="eventos-registro__grid eventos--workshops">
            <?php foreach($eventos['campus_s'] as $evento) { ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php } ?>
        </div>

    </main>

    <aside class="registro">
        <h2 class="registro__heading"> Tu registro</h2>

        <div id="registro-resumen" class="registro__resumen"></div>
        
        <div class="registro__regalo">
            <label for="equipacion" class="registro__label">Selecciona una equipacion</label>
                <select id="equipacion" class="registro__select">
                    <option value="">-- Selecciona talla --</option>
                        <?php foreach($equipacion as $equipaciones) { ?>
                            <option value="<?php echo $equipaciones->id; ?>"><?php echo $equipaciones->nombre; ?></option>
                        <?php } ?>
                </select>
        </div>

        <form id="registro" class="formulario">
            <div class="formulario__campo">
                <input type="submit" class="formulario__submit formulario__submit--full" value="Registrarme">
            </div>
        </form>
    </aside>

</div>
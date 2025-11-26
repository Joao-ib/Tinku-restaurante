<?php include RUTA_VISTAS . 'plantillas/encabezado.php'; ?>
<?php include RUTA_VISTAS . 'plantillas/navegacion.php'; ?>

<main>
    <div class="ImagenesPresentacion">
        <img src="publico/imagenes/carrusel/imagen1.webp" alt="Restaurante Tinku">
        <img src="publico/imagenes/carrusel/imagen2.webp" alt="Ambiente Tinku">
        <img src="publico/imagenes/carrusel/imagen3.webp" alt="Experiencia Tinku">
    </div>


    <section class="seccion-productos">
        <div class="productos-container">
            <div class="productos-imagen">
                <img src="publico/imagenes/inicio/productos.jpg" alt="Productos locales"
                    onerror="this.src='publico/imagenes/placeholder.jpg'">
            </div>
            <div class="productos-texto">
                <h2>Del campo a tu mesa</h2>
                <p>
                    Trabajamos directamente con más de 50 productores locales de todo el Perú.
                    Cada ingrediente es seleccionado cuidadosamente, respetando los ciclos naturales
                    y las prácticas sostenibles de cultivo.
                </p>
                <p>
                    Desde los valles de Cusco hasta las costas de Piura, nuestros proveedores
                    comparten nuestra pasión por la excelencia y el respeto por la tierra.
                    Esta conexión directa nos permite ofrecer productos de la más alta calidad,
                    frescos y llenos de sabor auténtico.
                </p>
                <div class="productos-stats">
                    <div class="stat">
                        <span class="numero">50+</span>
                        <span class="label">Productores Locales</span>
                    </div>
                    <div class="stat">
                        <span class="numero">100%</span>
                        <span class="label">Ingredientes Peruanos</span>
                    </div>
                    <div class="stat">
                        <span class="numero">3</span>
                        <span class="label">Regiones del Perú</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="seccion-filosofia">
        <div class="filosofia-container">
            <div class="filosofia-texto">
                <h2>Nuestra filosofía culinaria</h2>
                <p>
                    En Tinku, cada plato es una obra de arte que narra la historia del Perú.
                    Nuestro equipo de chefs, liderado por reconocidos maestros de la gastronomía
                    peruana, fusiona técnicas contemporáneas con recetas ancestrales.
                </p>
                <p>
                    La investigación constante y el respeto por nuestras raíces nos permiten
                    crear experiencias gastronómicas únicas. Cada temporada exploramos nuevos
                    ingredientes, redescubrimos sabores olvidados y celebramos la megadiversidad
                    de nuestro territorio.
                </p>
                <div class="filosofia-valores">
                    <div class="valor">
                        <span class="icono">🌱</span>
                        <h3>Sostenibilidad</h3>
                        <p>Compromiso con el medio ambiente y las comunidades</p>
                    </div>
                    <div class="valor">
                        <span class="icono">🔬</span>
                        <h3>Investigación</h3>
                        <p>Exploración constante de ingredientes y técnicas</p>
                    </div>
                    <div class="valor">
                        <span class="icono">❤️</span>
                        <h3>Pasión</h3>
                        <p>Amor por nuestra cultura y tradiciones culinarias</p>
                    </div>
                </div>
            </div>
            <div class="filosofia-imagen">
                <img src="publico/imagenes/inicio/chef.jpg" alt="Chef en cocina"
                    onerror="this.src='publico/imagenes/placeholder.jpg'">
            </div>
        </div>
    </section>
</main>

<?php include RUTA_VISTAS . 'plantillas/pie.php'; ?>
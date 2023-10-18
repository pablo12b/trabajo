document.addEventListener('DOMContentLoaded', function () {
    const recetas = JSON.parse(localStorage.getItem('recipes')) || [];

    document.getElementById('recetaForm').addEventListener('submit', function (e) {
        e.preventDefault();
        
        const nombreReceta = document.getElementById('nombreReceta').value;
        const ingredientes = document.getElementById('ingredientes').value;
        const pasos = document.getElementById('pasos').value;


        const imagen = document.getElementById('imagen').files[0];

        if (imagen) {
            // Display image information in the console
            console.log('Imagen Seleccionada:');
            console.log('Nombre: ', imagen.name);
            console.log('Tipo: ', imagen.type);
            console.log('Tamaño: ', imagen.size);

            const receta = {
                nombreReceta: nombreReceta,
                ingredientes: ingredientes,
                pasos: pasos,
                imagen: imagen, // Store the image in the recipe object
            };

            if (window.confirm('Receta enviada. ¿Deseas enviar otra receta?')) {
                recetas.push(receta);

                // Muestra todas las recetas en la consola
                console.log('Todas las recetas:');
                recetas.forEach(function (receta, index) {
                    console.log('Receta #' + (index + 1));
                    console.log('Nombre de la Receta:', receta.nombreReceta);
                    console.log('Ingredientes:', receta.ingredientes);
                    console.log('Pasos:', receta.pasos);
                    console.log('Imagen:', receta.imagen); // Display the image name
                });

                localStorage.setItem('recipes', JSON.stringify(recetas));
                //recetas.splice(0, recetas.length);

                // Print a message indicating that the array is cleared
                //console.log('Recetas array cleared');

                // Remove the 'recipes' data from localStorage
                //localStorage.removeItem('recipes');
                //console.log('Recetas array cleared, and data removed from localStorage');

                // Limpia el formulario
                document.getElementById('recetaForm').reset();
                
            } else {
                // Handle user cancelation or redirection
            }
        } else {
            // Handle case when no image is selected
            console.log('No se seleccionó ninguna imagen.');
        }
    });
});
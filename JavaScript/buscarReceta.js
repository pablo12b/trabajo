document.addEventListener('DOMContentLoaded', function () {
    const recetas = JSON.parse(localStorage.getItem('recipes')) || [];

    document.getElementById('searchForm').addEventListener('submit', function (e) {
        e.preventDefault();
        
        let found = false; // Initialize found as false
        const nombreReceta = document.getElementById('searchInput').value;

        if (nombreReceta != null) {
            for (const recipe of recetas) {
                if (nombreReceta === recipe.nombreReceta) {
                    showRecipeDetails(recipe);
                    found = true;
                    break;
                }
            }
        }
        if (!found) {
            console.log('No hay receta registrada');
        } else {
            console.log('Encontrado');
        }
    });
});

// Function to display recipe details
function showRecipeDetails(recipe) {
    const details = document.getElementById('recipe-details');
    details.innerHTML = `
        <h2>${recipe.nombreReceta}</h2>
        <img src="${recipe.imagen}" alt="${recipe.nombreReceta}" id="recipe-image">
        <p><strong>Ingredients:</strong> ${recipe.ingredientes}</p>
        <p>${recipe.pasos}</p>
    `;
}



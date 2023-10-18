<<<<<<< HEAD
document.addEventListener('DOMContentLoaded', function () {
    // Get references to HTML elements
    const searchButton = document.getElementById('searchButton');
    const searchInput = document.getElementById('searchInput');
    const recipeContainer = document.querySelector('.recipe-container');

    // Handle the search button click
    searchButton.addEventListener('click', function () {
        const searchTerm = searchInput.value.toLowerCase();

        // Retrieve recipes from local storage
        const recipes = JSON.parse(localStorage.getItem('recipes')) || [];

        // Find the recipes that match the search term
        const foundRecipes = recipes.filter(recipe => recipe.name.toLowerCase().includes(searchTerm));

        if (foundRecipes.length > 0) {
            // Display the found recipes' information
            displayRecipes(foundRecipes);
        } else {
            // No recipes found
            recipeContainer.innerHTML = 'Recetas no encontradas.';
        }
    });

    function displayRecipes(recipes) {
        // Clear previous results
        recipeContainer.innerHTML = '';

        // Display information for each found recipe
        recipes.forEach(recipe => {
            const recipeInfo = document.createElement('div');
            recipeInfo.innerHTML = `
                <h3>${recipe.name}</h3>
                <img src="${recipe.picture}" alt="${recipe.name}">
                <p><strong>Ingredientes:</strong> ${recipe.ingredientes}</p>
                <p><strong>Pasos:</strong> ${recipe.pasos}</p>
            `;
            recipeContainer.appendChild(recipeInfo);
        });
    }
});

=======
document.addEventListener('DOMContentLoaded', function () {
    // Get references to HTML elements
    const searchButton = document.getElementById('searchButton');
    const searchInput = document.getElementById('searchInput');
    const recipeContainer = document.querySelector('.recipe-container');

    // Handle the search button click
    searchButton.addEventListener('click', function () {
        const searchTerm = searchInput.value.toLowerCase();

        // Retrieve recipes from local storage
        const recipes = JSON.parse(localStorage.getItem('recipes')) || [];

        // Find the recipes that match the search term
        const foundRecipes = recipes.filter(recipe => recipe.name.toLowerCase().includes(searchTerm));

        if (foundRecipes.length > 0) {
            // Display the found recipes' information
            displayRecipes(foundRecipes);
        } else {
            // No recipes found
            recipeContainer.innerHTML = 'Recetas no encontradas.';
        }
    });

    function displayRecipes(recipes) {
        // Clear previous results
        recipeContainer.innerHTML = '';

        // Display information for each found recipe
        recipes.forEach(recipe => {
            const recipeInfo = document.createElement('div');
            recipeInfo.innerHTML = `
                <h3>${recipe.name}</h3>
                <img src="${recipe.picture}" alt="${recipe.name}">
                <p><strong>Ingredientes:</strong> ${recipe.ingredientes}</p>
                <p><strong>Pasos:</strong> ${recipe.pasos}</p>
            `;
            recipeContainer.appendChild(recipeInfo);
        });
    }
});

>>>>>>> 46175b364427ebffe49204cc9031d44215c25406

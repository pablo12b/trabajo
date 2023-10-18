// Load recipes from localStorage or initialize an empty array
const recipes = JSON.parse(localStorage.getItem("recipes")) || [];

// Function to display search results
function showResults(query) {
    const results = document.getElementById("results");
    results.innerHTML = ""; // Clear previous results

    for (const recipe of recipes) {
        if (recipe.name.toLowerCase().includes(query.toLowerCase())) {
            const item = document.createElement("li");
            item.textContent = recipe.name;
            item.addEventListener("click", () => showRecipeDetails(recipe));
            results.appendChild(item);
        }
    }
}

// Function to display recipe details
function showRecipeDetails(recipe) {
    const details = document.getElementById("recipe-details");
    details.innerHTML = `
        <h2>${recipe.name}</h2>
        <p>${recipe.description}</p>
        <p><strong>Ingredients:</strong> ${recipe.ingredients}</p>
    `;
}

// Add event listener for the search input
document.getElementById("searchInput").addEventListener("input", function () {
    showResults(this.value);
});

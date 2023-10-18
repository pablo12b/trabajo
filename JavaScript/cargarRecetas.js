document.addEventListener('DOMContentLoaded', function () {
    const quickLoadRecipes = [
        {
            nombreReceta: 'Ceviche de Camarones',
            ingredientes: 'Camarones, limón, cebolla, tomate, cilantro, achiote, sal',
            pasos: 'Paso 1: Pelar y cocinar los camarones, Paso 2: Picar cebolla, tomate y cilantro, Paso 3: Mezclar todo con el jugo de limón, achiote y sal',
            imagen: 'img/ceviche_camaron.jpeg', // Wrap the image filename in a string
        },
        {
            nombreReceta: 'Seco de Pollo',
            ingredientes: 'Pollo, arroz, frejoles, cebolla, ajo, comino, achiote, plátano',
            pasos: 'Paso 1: Cocinar el pollo con cebolla, ajo, comino y achiote, Paso 2: Servir con arroz y frejoles, Paso 3: Acompañar con plátano maduro frito',
            imagen: 'img/seco_pollo.jpeg', // Wrap the image filename in a string
        },
        {
            nombreReceta: 'Locro de Papa',
            ingredientes: 'Papas, cebolla, ajo, leche, queso, aguacate, maíz tostado',
            pasos: 'Paso 1: Cocinar las papas con cebolla y ajo, Paso 2: Agregar leche y queso, Paso 3: Servir con aguacate y maíz tostado',
            imagen: 'img/locro_papa.jpeg', // Wrap the image filename in a string
        },
        {
            nombreReceta: 'Encebollado',
            ingredientes: 'Atún, yuca, cebolla, tomate, cilantro, comino, achiote, limón',
            pasos: 'Paso 1: Cocinar el atún con cebolla, tomate y especias, Paso 2: Servir con yuca cocida, cilantro y limón',
            imagen: 'img/encebollado.jpeg', // Wrap the image filename in a string
        },
        {
            nombreReceta: 'Empanadas de Viento',
            ingredientes: 'Masa de empanadas, queso, azúcar glas',
            pasos: 'Paso 1: Rellenar la masa de empanadas con queso, Paso 2: Freírlas hasta que se inflen, Paso 3: Espolvorear azúcar glas por encima',
            imagen: 'img/empanadas_viento.jpeg', // Wrap the image filename in a string
        },
    ];

    // Store the recipes in local storage
    localStorage.setItem('recipes', JSON.stringify(quickLoadRecipes));
});

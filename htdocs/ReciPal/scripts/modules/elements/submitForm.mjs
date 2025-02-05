export default function submitForm(container) {
    return container.innerHTML = [
        `<form action="./api/submit" method="POST" enctype="multipart/form-data" id="recipeSubmitForm">
            <div class="mb-3">
                <label for="recipeName" class="form-label">Recipe Name</label>
                <input type="text" class="form-control" id="recipeName" name="recipeName" placeholder="Enter recipe name" required>
            </div>

            <div class="mb-3">
                <label for="recipeImage" class="form-label">Upload Recipe Image</label>
                <input type="file" class="form-control" id="recipeImage" name="recipeImage" required>
            </div>
            <div class="mb-3">
                <label for="recipeDescription" class="form-label">Recipe Description</label>
                <textarea class="form-control" id="recipeDescription" name="recipeDescription" rows="4" placeholder="Write a short description of your recipe" required></textarea>
            </div>
            <button type="submit" class="btn btn-success w-100">Submit Recipe</button>
        </form>`
    ].join('');
}
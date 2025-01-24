export function generateCards(data, container) {
    data.forEach((item) => {
        const card = document.createElement("div");
        card.classList.add("card");

        card.innerHTML = `
            <h2 class="card-title">${item.title}</h2>
            <h3 class="card-desc">${item.desc}</h3>
            <h3 class="author">${item.author}</h3>
            <h4 class="curator">${item.curated_by}</h4>
            <h4 class="curatedDate">${item.curated_date}</h4>
        `;

        container.appendChild(card);
    })
}
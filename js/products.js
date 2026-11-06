const products = [
    {
        id: 1,
        name: "Lumpia Kornet Mozzarella",
        category: "Snack",
        price: 20000,
        description: "Lumpia dengan isian kornet gurih dan mozzarella.",
        image: "assets/images/lumpia-kornet-mozzarella.jpg"
    },
    {
        id: 3,
        name: "Bruleebomb",
        category: "Cheese",
        price: 20000,
        description: "Bola Bola Creamy Yg di adon dengan susu dan didalamnya ada irisan beef dengan keju mozzarella.",
        image: "assets/images/bruleebomb.jpg"
    },
    {
        id: 5,
        name: "Chicken Cordon Blue",
        category: "Meal",
        price: 20000,
        description: "Ayam yg didalamnya terdapat irisan beef dan mozzarella.",
        image: "assets/images/chicken-cordon-bleu.jpg"
    },
    {
        id: 6,
        name: "Pizza Springroll",
        category: "Snack",
        price: 20000,
        description: "Kulit spring roll di isi dengan irisan beef yg ditumis, 2 jenis keju dan saus gurih creamy dipadukan dengan chilli oil.",
        image: "assets/images/pizza-springroll.jpg"
    }
];

function formatRupiah(price) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0
    }).format(price);
}

function renderProducts(list = products) {
    const grid = document.getElementById("product-grid");

    if (!list.length) {
        grid.innerHTML = "<p>Produk tidak ditemukan.</p>";
        return;
    }

    grid.innerHTML = list.map(product => `
        <article class="product-card">
            <img src="${product.image}"
                 alt="${product.name}"
                 loading="lazy"
                 onerror="this.src='https://placehold.co/600x400?text=Chizu+House'">

            <div class="product-info">
                <span class="product-category">${product.category}</span>
                <h3>${product.name}</h3>
                <p>${product.description}</p>

                <div class="product-bottom">
                    <span class="product-price">
                        ${formatRupiah(product.price)}
                    </span>

                    <button class="add-btn"
                        onclick="addToCart(${product.id})">
                        + Tambah
                    </button>
                </div>
            </div>
        </article>
    `).join("");
}

function filterCategory(category, button) {
    document.querySelectorAll(".category-card")
        .forEach(item => item.classList.remove("active"));

    button.classList.add("active");

    const filtered = category === "All"
        ? products
        : products.filter(item => item.category === category);

    renderProducts(filtered);
}

function searchProducts(keyword) {
    const query = keyword.toLowerCase().trim();

    const filtered = products.filter(product =>
        product.name.toLowerCase().includes(query) ||
        product.category.toLowerCase().includes(query)
    );

    renderProducts(filtered);
}

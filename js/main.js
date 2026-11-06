document.addEventListener("DOMContentLoaded", () => {
    if (typeof renderProducts === 'function') renderProducts();
    if (typeof updateCart === 'function') updateCart();

    if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll(".reveal, .section-heading, .category-list, .about")
            .forEach(element => observer.observe(element));
    } else {
        document.querySelectorAll(".reveal, .section-heading, .category-list, .about")
            .forEach(element => element.classList.add("visible"));
    }
});

function toggleMenu() {
    const nav = document.getElementById("nav");
    if (nav) nav.classList.toggle("open");
}

function closeMenu() {
    const nav = document.getElementById("nav");
    if (nav) nav.classList.remove("open");
}

function showLogin() {
    showToast("Login admin akan diaktifkan setelah database disiapkan.");
}

// Perbaikan event listener Escape dan klik di luar cart agar overlay mati total
document.addEventListener("keydown", event => {
    if (event.key === "Escape") {
        const cartPanel = document.getElementById("cart-panel");
        const cartOverlay = document.getElementById("cart-overlay");
        const paymentModal = document.getElementById("payment-modal");
        
        if (cartPanel) cartPanel.classList.remove("active");
        if (cartOverlay) {
            cartOverlay.style.display = "none";
            cartOverlay.style.pointerEvents = "none";
        }
        if (paymentModal) {
            paymentModal.style.display = "none";
            paymentModal.style.pointerEvents = "none";
        }
        closeMenu();
    }
});

// Fungsi penunjang toggleCart yang memastikan overlay bersih dari penghalang klik
function toggleCart() {
    const cartPanel = document.getElementById('cart-panel');
    const cartOverlay = document.getElementById('cart-overlay');
    
    if (cartPanel && cartOverlay) {
        cartPanel.classList.toggle('active');
        
        if (cartPanel.classList.contains('active')) {
            cartOverlay.style.display = 'block';
            cartOverlay.style.pointerEvents = 'auto';
        } else {
            cartOverlay.style.display = 'none';
            cartOverlay.style.pointerEvents = 'none';
        }
    }
}
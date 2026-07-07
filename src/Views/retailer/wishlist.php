<?php
/**
 * Wishlist Page — Pavitra Designer
 * Products are saved in browser localStorage (key: pavitra_wishlist = JSON array of variant IDs)
 */
?>
<div class="container-xl py-4" style="min-height: 60vh;">
    
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="mb-1" style="font-family: var(--font-headings); color: var(--meesho-pink);">
                <i class="fa-solid fa-heart me-2" style="color: var(--premium-gold);"></i>My Wishlist
            </h2>
            <p class="text-muted mb-0 small" id="wishlist-count-text">Loading your saved items…</p>
        </div>
        <button class="btn btn-sm btn-outline-danger" id="clear-wishlist-btn" style="display:none;" onclick="clearWishlist()">
            <i class="fa-solid fa-trash me-1"></i> Clear All
        </button>
    </div>

    <div id="wishlist-loading" class="text-center py-5">
        <div class="spinner-border text-muted" style="width:2rem;height:2rem;"></div>
        <p class="mt-3 text-muted">Fetching your saved items…</p>
    </div>

    <div id="wishlist-empty" class="text-center py-5" style="display:none;">
        <div style="font-size:4rem; margin-bottom:1rem;">🛍️</div>
        <h4 style="color: var(--premium-dark); font-family: var(--font-headings);">Your wishlist is empty</h4>
        <p class="text-muted mb-4">Browse our saree collection and tap <i class="fa-solid fa-heart text-danger"></i> to save products here.</p>
        <a href="/" class="btn btn-meesho-pink px-4">
            <i class="fa-solid fa-store me-2"></i>Browse Catalogue
        </a>
    </div>

    <div id="wishlist-grid" class="row g-3" style="display:none;"></div>

</div>

<style>
.wishlist-card {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: transform 0.28s ease, box-shadow 0.28s ease;
    position: relative;
    cursor: pointer;
}
.wishlist-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 36px rgba(72,41,34,0.13);
}
.wishlist-card img {
    width: 100%;
    height: 210px;
    object-fit: cover;
}
.wishlist-card-body {
    padding: 12px;
}
.wishlist-card-title {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--premium-dark);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}
.wishlist-card-price {
    font-size: 0.95rem;
    font-weight: 800;
    color: var(--meesho-pink);
    margin: 4px 0;
}
.wishlist-remove-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255,255,255,0.92);
    border: none;
    border-radius: 50%;
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #e00;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    transition: background 0.2s;
    z-index: 5;
}
.wishlist-remove-btn:hover { background: #ffe0e0; }
.wishlist-add-cart-btn {
    width: 100%;
    background: var(--meesho-pink-gradient);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-top: 8px;
    transition: opacity 0.2s;
}
.wishlist-add-cart-btn:hover { opacity: 0.88; }
</style>

<script>
const WISHLIST_KEY = 'pavitra_wishlist';

function getWishlist() {
    try { return JSON.parse(localStorage.getItem(WISHLIST_KEY) || '[]'); }
    catch(e) { return []; }
}

function saveWishlist(ids) {
    localStorage.setItem(WISHLIST_KEY, JSON.stringify(ids));
}

function removeFromWishlist(variantId) {
    let ids = getWishlist().filter(id => id != variantId);
    saveWishlist(ids);
    document.getElementById('card-' + variantId)?.remove();
    updateCountText(ids.length);
    if (ids.length === 0) showEmpty();
}

function clearWishlist() {
    if (!confirm('Remove all items from wishlist?')) return;
    saveWishlist([]);
    document.getElementById('wishlist-grid').innerHTML = '';
    showEmpty();
}

function updateCountText(n) {
    document.getElementById('wishlist-count-text').textContent = n === 0 ? 'No saved items' : n + ' item' + (n > 1 ? 's' : '') + ' saved';
    document.getElementById('clear-wishlist-btn').style.display = n > 0 ? 'inline-flex' : 'none';
}

function showEmpty() {
    document.getElementById('wishlist-grid').style.display = 'none';
    document.getElementById('wishlist-empty').style.display = 'block';
    document.getElementById('clear-wishlist-btn').style.display = 'none';
    document.getElementById('wishlist-count-text').textContent = 'No saved items';
}

async function loadWishlist() {
    const ids = getWishlist();
    document.getElementById('wishlist-loading').style.display = 'none';

    if (ids.length === 0) {
        showEmpty();
        return;
    }

    updateCountText(ids.length);
    document.getElementById('wishlist-grid').style.display = '';

    const grid = document.getElementById('wishlist-grid');
    grid.innerHTML = '';

    const fetchPromises = ids.map(async (variantId) => {
        try {
            const res = await fetch('/api/product-variant/' + variantId);
            if (!res.ok) return null;
            return await res.json();
        } catch(e) { return null; }
    });

    const products = await Promise.all(fetchPromises);

    products.forEach((p, idx) => {
        if (!p) return;
        const variantId = ids[idx];
        const card = document.createElement('div');
        card.className = 'col-6 col-sm-4 col-md-3 col-lg-2';
        card.id = 'card-' + variantId;
        const price = parseFloat(p.wholesale_price || p.price || 0);
        const mrp = parseFloat(p.price || price);
        const savings = mrp > price ? Math.round(((mrp - price) / mrp) * 100) : 0;

        card.innerHTML = `
            <div class="wishlist-card" onclick="window.location='/product/${p.product_id || variantId}'">
                <button class="wishlist-remove-btn" onclick="event.stopPropagation(); removeFromWishlist(${variantId})" title="Remove from Wishlist">
                    <i class="fa-solid fa-heart-crack" style="font-size:0.85rem;"></i>
                </button>
                ${savings > 0 ? `<div style="position:absolute;top:10px;left:10px;background:var(--premium-gold);color:#fff;font-size:0.65rem;font-weight:800;padding:2px 7px;border-radius:20px;z-index:5;">${savings}% OFF</div>` : ''}
                <img src="${p.image_url || '/assets/images/placeholder.jpg'}" alt="${p.title || 'Product'}" onerror="this.src='/assets/images/placeholder.jpg'">
                <div class="wishlist-card-body">
                    <div class="wishlist-card-title">${p.title || 'Saree'}</div>
                    <div class="wishlist-card-price">₹${price.toLocaleString('en-IN')}</div>
                    ${savings > 0 ? `<div class="text-muted" style="font-size:0.72rem;text-decoration:line-through;">₹${mrp.toLocaleString('en-IN')}</div>` : ''}
                    <button class="wishlist-add-cart-btn" onclick="event.stopPropagation(); addToCartFromWishlist(${variantId}, this)">
                        <i class="fa-solid fa-bag-shopping me-1"></i>Add to Cart
                    </button>
                </div>
            </div>`;
        grid.appendChild(card);
    });
}

async function addToCartFromWishlist(variantId, btn) {
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i>Adding…';
    try {
        const res = await fetch('/cart/add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `variant_id=${variantId}&quantity=1`
        });
        const data = await res.json();
        if (data.success) {
            btn.innerHTML = '<i class="fa-solid fa-check me-1"></i>Added!';
            btn.style.background = 'linear-gradient(135deg,#2ecc71,#27ae60)';
            if (typeof updateCartCount === 'function') updateCartCount();
            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-bag-shopping me-1"></i>Add to Cart';
                btn.style.background = '';
            }, 2000);
        } else {
            btn.innerHTML = '<i class="fa-solid fa-xmark me-1"></i>' + (data.message || 'Error');
            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-bag-shopping me-1"></i>Add to Cart';
            }, 2000);
        }
    } catch(e) {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-bag-shopping me-1"></i>Add to Cart';
    }
}

document.addEventListener('DOMContentLoaded', loadWishlist);
</script>

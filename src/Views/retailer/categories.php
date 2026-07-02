<?php
// Categories view page
?>
<div class="container py-4 my-3" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="text-center mb-5">
        <h2 class="text-uppercase fw-normal mb-1" style="font-family: 'Instrument Sans', sans-serif; letter-spacing: 0.12em; color: #482922;">Shop by Weaving Style</h2>
        <p class="text-muted small text-uppercase" style="letter-spacing: 0.08em;">Weaver-Direct Authentic Saree Collections</p>
        <div style="width: 40px; height: 1.5px; background-color: #482922; margin: 12px auto 0;"></div>
    </div>

    <!-- Category Grid -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($categories as $cat): ?>
            <div class="col">
                <a href="/?category=<?= $cat['slug'] ?>" class="text-decoration-none text-dark">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center nisho-cat-card" style="border-radius: 12px; background-color: #FAF6F0; border: 1px solid #ECE3D4 !important; transition: all 0.4s ease;">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="img-wrapper" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 3px solid #FFF; box-shadow: 0 8px 24px rgba(72,41,34,0.12);">
                                <img src="<?= htmlspecialchars($cat['image']) ?>" alt="<?= htmlspecialchars($cat['name']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        <h4 class="h6 text-uppercase fw-bold mb-2" style="letter-spacing: 0.05em; color: #482922;"><?= htmlspecialchars($cat['name']) ?></h4>
                        <p class="text-muted mb-3" style="font-size: 0.8rem;"><?= htmlspecialchars($cat['desc']) ?></p>
                        <span class="text-uppercase fw-bold" style="font-size: 0.72rem; letter-spacing: 0.08em; color: #C5A059;">Explore Collection →</span>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.nisho-cat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 36px rgba(72,41,34,0.08) !important;
    background-color: #FFF !important;
    border-color: #C5A059 !important;
}
.nisho-cat-card:hover .img-wrapper {
    box-shadow: 0 12px 30px rgba(197,160,89,0.2) !important;
    transform: scale(1.05);
    transition: all 0.4s ease;
}
</style>

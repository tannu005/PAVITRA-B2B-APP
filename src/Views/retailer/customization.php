<?php
/**
 * Saree Customization Request View — Pavitra Designer
 * Evokes premium custom handloom artisan design workflow
 */
?>
<div class="container py-5 my-2" style="max-width: 900px; font-family: 'Plus Jakarta Sans', sans-serif;">
    
    <div class="text-center mb-5">
        <span class="badge bg-gold text-white text-uppercase px-3 py-2 mb-2" style="font-size:0.68rem; letter-spacing:0.1em; background-color: var(--premium-gold);">Artisan Custom Studio</span>
        <h2 class="text-uppercase fw-normal mb-1" style="font-family: var(--font-headings); letter-spacing: 0.12em; color: var(--pavitra-pink);">Request Custom Saree Design</h2>
        <p class="text-muted small text-uppercase" style="letter-spacing: 0.08em;">Collaborate directly with master weavers to craft your custom drape</p>
        <div style="width: 50px; height: 1.5px; background-color: var(--pavitra-pink); margin: 12px auto 0;"></div>
    </div>

    <div class="row g-4">
        
        <div class="col-md-5 col-12">
            <div class="card border-0 shadow-sm p-4 text-center sticky-md-top" style="border-radius: 16px; background-color: #FFFDF8; border: 1px solid var(--premium-border) !important; top: 120px; z-index: 5;">
                <h5 class="fw-bold mb-3 text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.05em; color: var(--premium-dark);">Live Spec Visualizer</h5>
                
                <div id="saree-preview-box" style="height: 280px; border-radius: 12px; background: linear-gradient(135deg, #6B1D1D 0%, #3D0A0A 100%); transition: all 0.3s ease; position: relative; overflow: hidden; box-shadow: inset 0 0 20px rgba(0,0,0,0.2);">
                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 35px; background: linear-gradient(90deg, var(--premium-gold) 0%, #E6C280 50%, var(--premium-gold) 100%); display: flex; align-items: center; justify-content: center; border-top: 1px solid #FFFDF8; box-shadow: 0 -4px 10px rgba(0,0,0,0.15);">
                        <span id="saree-zari-text" style="font-size: 0.58rem; font-weight: 800; color: #3D0A0A; letter-spacing: 0.12em; text-transform: uppercase;">Standard Zari Border</span>
                    </div>
                    <div id="saree-motif-overlay" style="position: absolute; top:0; left:0; width:100%; height:100%; opacity:0.12; background-image: radial-gradient(var(--premium-gold) 2px, transparent 2px); background-size: 24px 24px;"></div>
                </div>

                <div class="mt-4 text-start">
                    <div class="mb-2" style="font-size: 0.78rem;"><strong>Material:</strong> <span id="visual-material" class="text-muted">Silk (Banarasi)</span></div>
                    <div class="mb-2" style="font-size: 0.78rem;"><strong>Body Color:</strong> <span id="visual-color" class="text-muted">#6B1D1D</span></div>
                    <div class="mb-2" style="font-size: 0.78rem;"><strong>Border Style:</strong> <span id="visual-border" class="text-muted">Standard Zari</span></div>
                    <div class="mb-2" style="font-size: 0.78rem;"><strong>Blouse Style:</strong> <span id="visual-blouse" class="text-muted">Matching Sleeveless</span></div>
                    <div style="font-size: 0.78rem;"><strong>Drape size:</strong> <span id="visual-size" class="text-muted">Standard (5.5m + 0.8m Blouse)</span></div>
                </div>
            </div>
        </div>

        <div class="col-md-7 col-12">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 16px; background-color: #FFFDF8; border: 1px solid var(--premium-border) !important;">
                <form id="customization-form" onsubmit="sendCustomizationToWhatsapp(event)">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">1. Select Fabric / Material</label>
                        <select class="form-select rounded-0" id="custom-fabric" onchange="updateVisualizer()">
                            <option value="Silk (Kanjeevaram)">Silk (Kanjeevaram)</option>
                            <option value="Silk (Banarasi)" selected>Silk (Banarasi)</option>
                            <option value="Silk (Mysore Crepe)">Silk (Mysore Crepe)</option>
                            <option value="Pure Linen Handloom">Pure Linen Handloom</option>
                            <option value="Organza / Tissue Saree">Organza / Tissue Saree</option>
                            <option value="Premium Georgette">Premium Georgette</option>
                            <option value="Chiffon Blend">Chiffon Blend</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">2. Choose Body Color Spectrum</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="color" class="form-control form-control-color border-0 p-0" id="custom-color-spectrum" value="#6B1D1D" style="width: 50px; height: 50px; cursor: pointer; background:none;" oninput="updateVisualizer()">
                            <div class="flex-grow-1">
                                <input type="text" class="form-control rounded-0 text-uppercase" id="custom-color-hex" value="#6B1D1D" oninput="updateHexFromText(this.value)" placeholder="#HEXCODE">
                                <span class="text-muted" style="font-size: 0.65rem;">Tap color box to open color picker palette</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">3. Border & Zari Width</label>
                        <div class="d-flex flex-wrap gap-2">
                            <input type="radio" class="btn-check" name="border_zari" id="border-narrow" value="Narrow Border (2-inch)" onchange="updateVisualizer()">
                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" for="border-narrow">Narrow (2")</label>

                            <input type="radio" class="btn-check" name="border_zari" id="border-std" value="Standard Zari Border" checked onchange="updateVisualizer()">
                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" for="border-std">Standard (4")</label>

                            <input type="radio" class="btn-check" name="border_zari" id="border-broad" value="Temple Broad Zari (8-inch)" onchange="updateVisualizer()">
                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" for="border-broad">Temple (8")</label>

                            <input type="radio" class="btn-check" name="border_zari" id="border-double" value="Double-Side Contrast Border" onchange="updateVisualizer()">
                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" for="border-double">Double Contrast</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">4. Blouse Style Preference</label>
                        <select class="form-select rounded-0" id="custom-blouse" onchange="updateVisualizer()">
                            <option value="Matching Sleeveless Blouse">Matching Sleeveless</option>
                            <option value="Matching Short Sleeves Blouse">Matching Short Sleeves</option>
                            <option value="Contrasting Elbow Length Blouse">Contrasting Elbow Length</option>
                            <option value="Full Sleeve Zari Border Blouse">Full Sleeve Zari Border</option>
                            <option value="No Blouse Required">No Blouse (Saree Only)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">5. Saree Length (Drape Size)</label>
                        <select class="form-select rounded-0" id="custom-size" onchange="updateVisualizer()">
                            <option value="Standard (5.5m + 0.8m Blouse)">Standard (5.5m + 0.8m Blouse Piece)</option>
                            <option value="Extended Drape (6.3m + 0.8m Blouse)">Extended Drape (6.3m - for taller or extra pleats)</option>
                            <option value="Lehenga Style Drape (9m)">Traditional 9-Meter (Nauvari / Paithani style)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">6. Body Pattern Motif</label>
                        <select class="form-select rounded-0" id="custom-motif" onchange="updateVisualizer()">
                            <option value="none">Plain / Solid Color (No motifs)</option>
                            <option value="dots" selected>Butta / Traditional Gold Dots</option>
                            <option value="floral">Paisley / Mango Motifs (Zari Weaving)</option>
                            <option value="geometric">Checked / Temple Geometrics</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">7. Reference Pattern / Embroidery Photo</label>
                        <div class="p-4 text-center border border-dashed rounded" style="border-style: dashed !important; border-width: 2px !important; border-color: var(--premium-gold) !important; background-color: var(--premium-pink-light);">
                            <i class="fa-solid fa-cloud-arrow-up fs-3 mb-2" style="color: var(--premium-gold);"></i>
                            <h6 class="mb-1" style="font-size:0.8rem; font-weight:700;">Drag reference image here</h6>
                            <p class="text-muted mb-0 small" style="font-size:0.7rem;">Or select from your files (Max size: 5MB)</p>
                            <input type="file" id="reference-image-file" class="d-none" onchange="alert('Demo Mode: Image upload selected!')">
                            <button type="button" class="btn btn-sm btn-outline-dark mt-3 px-3 rounded-0 text-uppercase fw-bold" style="font-size:0.65rem;" onclick="document.getElementById('reference-image-file').click()">Choose File</button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-pavitra-pink w-100 py-3 rounded-0 text-uppercase fw-bold" style="letter-spacing: 0.1em;">
                        <i class="fa-brands fa-whatsapp me-2 fs-5"></i>Send Specs to Master Weaver
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>

<script>
function updateVisualizer() {
    const color = document.getElementById('custom-color-spectrum').value;
    document.getElementById('custom-color-hex').value = color.toUpperCase();
    
    const previewBox = document.getElementById('saree-preview-box');
    previewBox.style.background = `linear-gradient(135deg, ${color} 0%, #1A0505 100%)`;
    
    const borderVal = document.querySelector('input[name="border_zari"]:checked').value;
    document.getElementById('saree-zari-text').textContent = borderVal;
    
    document.getElementById('visual-material').textContent = document.getElementById('custom-fabric').value;
    document.getElementById('visual-color').textContent = color.toUpperCase();
    document.getElementById('visual-border').textContent = borderVal;
    document.getElementById('visual-blouse').textContent = document.getElementById('custom-blouse').value;
    document.getElementById('visual-size').textContent = document.getElementById('custom-size').value;

    const motif = document.getElementById('custom-motif').value;
    const motifOverlay = document.getElementById('saree-motif-overlay');
    if (motif === 'none') {
        motifOverlay.style.backgroundImage = 'none';
    } else if (motif === 'dots') {
        motifOverlay.style.backgroundImage = 'radial-gradient(var(--premium-gold) 2px, transparent 2px)';
        motifOverlay.style.backgroundSize = '24px 24px';
        motifOverlay.style.opacity = '0.15';
    } else if (motif === 'floral') {
        motifOverlay.style.backgroundImage = 'radial-gradient(var(--premium-gold) 4px, transparent 4px)';
        motifOverlay.style.backgroundSize = '32px 32px';
        motifOverlay.style.opacity = '0.22';
    } else if (motif === 'geometric') {
        motifOverlay.style.backgroundImage = 'linear-gradient(45deg, var(--premium-gold) 25%, transparent 25%), linear-gradient(-45deg, var(--premium-gold) 25%, transparent 25%)';
        motifOverlay.style.backgroundSize = '20px 20px';
        motifOverlay.style.opacity = '0.12';
    }
}

function updateHexFromText(val) {
    if (val.match(/^#[0-9A-F]{6}$/i)) {
        document.getElementById('custom-color-spectrum').value = val;
        updateVisualizer();
    }
}

function sendCustomizationToWhatsapp(event) {
    event.preventDefault();
    
    const fabric = document.getElementById('custom-fabric').value;
    const color = document.getElementById('custom-color-hex').value;
    const border = document.querySelector('input[name="border_zari"]:checked').value;
    const blouse = document.getElementById('custom-blouse').value;
    const size = document.getElementById('custom-size').value;
    const motif = document.getElementById('custom-motif').value;

    const message = `*Pavitra Designer CUSTOM SAREE ORDER SPECIFICATIONS*
----------------------------------------
- *Fabric:* ${fabric}
- *Color HEX:* ${color}
- *Border Width:* ${border}
- *Blouse Custom Option:* ${blouse}
- *Length / Size:* ${size}
- *Motif Type:* ${motif}
----------------------------------------
Please assign this custom design request to a master weaver. Thank you!`;

    const encodedMsg = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/919876543210?text=${encodedMsg}`;
    window.open(whatsappUrl, '_blank');
}

document.addEventListener('DOMContentLoaded', () => {
    updateVisualizer();
});
</script>

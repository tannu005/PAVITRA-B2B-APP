<div class="container-fluid py-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h3 class="fw-bold text-dark mb-1"><i class="fa-solid fa-file-shield text-pink me-2"></i>Business KYC Verification</h3>
            <p class="text-secondary mb-0">Upload your business registration documents to activate your Master Weaver profile.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <?php 
                $allVerified = true;
                $reqDocs = ['AADHAAR', 'PAN', 'GST', 'SHOP_LICENSE', 'MSME', 'BANK_PASSBOOK'];
                foreach ($reqDocs as $docType) {
                    if (!isset($docMap[$docType]) || $docMap[$docType]['status'] !== 'VERIFIED') {
                        $allVerified = false;
                        break;
                    }
                }
            ?>
            <?php if ($user['status'] === 'PENDING'): ?>
                <span class="badge bg-warning text-dark px-3 py-2 fs-6 rounded-pill">
                    <i class="fa-solid fa-clock me-1"></i> Account Pending Approval
                </span>
            <?php else: ?>
                <span class="badge bg-success px-3 py-2 fs-6 rounded-pill">
                    <i class="fa-solid fa-circle-check me-1"></i> Account Verified
                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Required Documents</h5>
                    
                    <div class="row g-4">
                        <?php 
                        $docLabels = [
                            'AADHAAR' => 'Aadhaar Card',
                            'PAN' => 'PAN Card',
                            'GST' => 'GST Registration',
                            'SHOP_LICENSE' => 'Shop / Establishment License',
                            'MSME' => 'MSME / Udyam Certificate',
                            'BANK_PASSBOOK' => 'Bank Passbook / Cancelled Cheque'
                        ];
                        
                        foreach ($docLabels as $type => $label): 
                            $status = isset($docMap[$type]) ? $docMap[$type]['status'] : 'MISSING';
                        ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="border rounded-3 p-3 h-100 position-relative">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="fw-bold mb-1"><?= $label ?></h6>
                                            <?php if ($status === 'VERIFIED'): ?>
                                                <span class="badge bg-success bg-opacity-10 text-success"><i class="fa fa-check"></i> Verified</span>
                                            <?php elseif ($status === 'PENDING'): ?>
                                                <span class="badge bg-warning bg-opacity-10 text-warning"><i class="fa fa-clock"></i> In Review</span>
                                            <?php elseif ($status === 'REJECTED'): ?>
                                                <span class="badge bg-danger bg-opacity-10 text-danger"><i class="fa fa-xmark"></i> Rejected</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary"><i class="fa fa-exclamation-circle"></i> Required</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <?php if ($status === 'MISSING' || $status === 'REJECTED'): ?>
                                        <form class="kyc-upload-form" onsubmit="event.preventDefault(); uploadDoc('<?= $type ?>');">
                                            <div class="mb-2">
                                                <input type="text" class="form-control form-control-sm" id="doc_num_<?= $type ?>" placeholder="Document Number" required>
                                            </div>
                                            <div class="mb-2">
                                                <input type="file" class="form-control form-control-sm" id="doc_file_<?= $type ?>" accept="image/*,.pdf" required>
                                            </div>
                                            <button type="submit" class="btn btn-dark btn-sm w-100">Upload <?= $label ?></button>
                                        </form>
                                    <?php else: ?>
                                        <div class="p-3 bg-light rounded text-center">
                                            <div class="small text-muted mb-1">Document Number</div>
                                            <div class="fw-bold"><?= htmlspecialchars($docMap[$type]['document_number']) ?></div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function uploadDoc(type) {
    const docNum = $('#doc_num_' + type).val();
    const fileInput = document.getElementById('doc_file_' + type);
    
    if (!fileInput.files[0]) {
        alert('Please select a file.');
        return;
    }
    
    const file = fileInput.files[0];
    const reader = new FileReader();
    
    reader.onload = function(e) {
        const base64Data = e.target.result;
        
        $.ajax({
            url: '/api/kyc/upload',
            method: 'POST',
            data: JSON.stringify({
                document_type: type,
                document_number: docNum,
                file_data: base64Data
            }),
            contentType: 'application/json',
            success: function(res) {
                if (res.success) {
                    alert('Document uploaded successfully and is pending review.');
                    location.reload();
                } else {
                    alert(res.error || 'Failed to upload document.');
                }
            },
            error: function(err) {
                alert(err.responseJSON?.error || 'An error occurred during upload.');
            }
        });
    };
    
    reader.readAsDataURL(file);
}
</script>

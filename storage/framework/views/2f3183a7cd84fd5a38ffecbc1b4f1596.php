<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
    /* Modal Styles */
    #divValidateOTP {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        z-index: 1050;
        display: none;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
    }
    .modal-header {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-title { margin: 0; }
    .divpopup-inner { padding: 20px; }
    .divpopbutton {
        padding: 15px;
        border-top: 1px solid #ddd;
        text-align: center;
    }
    .subbtn, .btn {
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    .hvr-glow {
        transition: all 0.3s ease;
    }
    .hvr-glow:hover {
        box-shadow: 0px 0px 8px rgba(255, 255, 0, 0.8);
    }
    .content { padding: 20px; color: #000; }
    .kycstatus { margin-top: 10px; }
    
    /* New styles for display section */
    .current-details {
        background: #f8f9fa;
        border-left: 4px solid #007bff;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    .detail-row {
        margin-bottom: 8px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eee;
    }
    .detail-label {
        font-weight: 600;
        color: #495057;
        min-width: 150px;
        display: inline-block;
    }
    .detail-value {
        color: #212529;
    }
</style>

<div class="content">
    <!-- OTP Verification Modal -->
    <div class="modal-dialog modal-sm divpopup" id="divValidateOTP">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Verify with OTP</h4>
                <button type="button" class="close" onclick="closeModal();"><span aria-hidden="true">×</span></button>
            </div>
            <div class="divpopup-inner">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <label class="col-sm-12 lbl text-info">Enter OTP received on your registered email:</label>
                        <input type="text" class="form-control" id="txtKYCOTP" maxlength="6">
                    </div>
                </div>
            </div>
            <div class="divpopbutton">
                <input type="button" class="subbtn" value="Validate" id="btnValidate" onclick="validateOtp();">
                <input type="button" class="btn btn-default hvr-glow" value="Close" onclick="closeModal();">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card smallPageHeader">
                <div class="card-header">
                    <h5>Update USDT (BEP-20) Wallet Address <span id="WalletAddressStatus"></span></h5>
                </div>
                <div class="card-body form_design" id="divWalletAddress">
                    
                    <!-- Current Details Section -->
                    <div class="current-details">
                        <h6 class="text-primary mb-3">Current Details:</h6>
                        <div class="detail-row">
                            <span class="detail-label">Wallet Address:</span>
                            <span class="detail-value" id="currentWalletAddress"><?php echo e(auth()->user()->wallet_address ?? 'Not Set'); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Account Holder Name:</span>
                            <span class="detail-value" id="currentAccountName"><?php echo e(auth()->user()->account_name ?? 'Not Set'); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Account Number:</span>
                            <span class="detail-value" id="currentAccountNumber"><?php echo e(auth()->user()->account_number ?? 'Not Set'); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">IFSC Code:</span>
                            <span class="detail-value" id="currentIFSC"><?php echo e(auth()->user()->ifsc_code ?? 'Not Set'); ?></span>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Update Form Section -->
                    <h6 class="text-warning mb-3">Update Details:</h6>
                    <div class="form-group">
                        <label>Wallet Address : *</label>
                        <input type="text" class="form-control" id="txtWalletAddress" 
                               placeholder="Enter new wallet address" 
                               style="text-transform: uppercase;"
                               value="<?php echo e(auth()->user()->wallet_address ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label>Account Holder Name : *</label>
                        <input type="text" class="form-control" id="txtAccountName" 
                               placeholder="Enter account holder name"
                               value="<?php echo e(auth()->user()->account_name ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Account Number : *</label>
                        <input type="text" class="form-control" id="txtAccountNumber" 
                               placeholder="Enter account number"
                               value="<?php echo e(auth()->user()->account_number ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>IFSC Code : *</label>
                        <input type="text" class="form-control" id="txtIFSC" 
                               placeholder="Enter IFSC code" 
                               style="text-transform: uppercase;"
                               value="<?php echo e(auth()->user()->ifsc_code ?? ''); ?>">
                    </div>

                    <div class="text-right">
                        <button class="btn btn-warning hvr-glow" onclick="requestOtp()">Send OTP</button>
                        <button type="button" class="btn btn-warning hvr-glow" id="btnSaveWalletAddress" disabled>Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="path/to/your/js/Attachment.js"></script>
<script src="path/to/your/js/UploadDocument.js"></script>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let otpSent = false;

    // Open Modal Function
    function openModal() {
        const modal = document.getElementById('divValidateOTP');
        if (modal) {
            console.log('Opening OTP Modal');
            modal.style.display = 'block';
            otpSent = true;
            document.getElementById('btnSaveWalletAddress').disabled = false;
        } else {
            console.error('Modal element not found');
        }
    }

    // Close Modal Function
    function closeModal() {
        document.getElementById('divValidateOTP').style.display = 'none';
        document.getElementById('txtKYCOTP').value = '';
    }

    // Request OTP Function
    function requestOtp() {
        const walletAddress = document.getElementById('txtWalletAddress').value.trim();
        const accountName = document.getElementById('txtAccountName').value.trim();
        const accountNumber = document.getElementById('txtAccountNumber').value.trim();
        const ifsc = document.getElementById('txtIFSC').value.trim();

        // Basic validation
        if (!walletAddress) {
            alert('Please enter wallet address');
            return;
        }
        if (!accountName) {
            alert('Please enter account holder name');
            return;
        }
        if (!accountNumber) {
            alert('Please enter account number');
            return;
        }
        if (!ifsc) {
            alert('Please enter IFSC code');
            return;
        }

        console.log('Requesting OTP for updating details');
        
        fetch('/request-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ 
                wallet_address: walletAddress,
                txtAccountName: accountName,
                txtAccountNumber: accountNumber,
                txtIFSC: ifsc
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('OTP request response:', data);
            alert(data.message);
            
            if (data.success) {
                openModal();
            }
        })
        .catch(error => {
            console.error('Error in OTP request:', error);
            alert('Failed to request OTP. Please try again.');
        });
    }

    // Validate OTP and Update Details
    function validateOtp() {
        const otp = document.getElementById('txtKYCOTP').value.trim();
        const walletAddress = document.getElementById('txtWalletAddress').value.trim();
        const txtAccountName = document.getElementById('txtAccountName').value.trim();
        const txtAccountNumber = document.getElementById('txtAccountNumber').value.trim();
        const txtIFSC = document.getElementById('txtIFSC').value.trim();

        if (!otp) {
            alert('Please enter the OTP.');
            return;
        }

        // Show loading state
        const validateBtn = document.getElementById('btnValidate');
        validateBtn.disabled = true;
        validateBtn.value = 'Validating...';

        fetch('/validate-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ 
                otp: otp, 
                wallet_address: walletAddress,
                txtAccountName: txtAccountName,
                txtAccountNumber: txtAccountNumber,
                txtIFSC: txtIFSC
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            
            if (data.success) {
                // Update current details display
                document.getElementById('currentWalletAddress').textContent = walletAddress || 'Not Set';
                document.getElementById('currentAccountName').textContent = txtAccountName || 'Not Set';
                document.getElementById('currentAccountNumber').textContent = txtAccountNumber || 'Not Set';
                document.getElementById('currentIFSC').textContent = txtIFSC || 'Not Set';
                
                // Clear form and close modal
                closeModal();
                document.getElementById('btnSaveWalletAddress').disabled = true;
                otpSent = false;
            }
        })
        .catch(error => {
            console.error('Error validating OTP:', error);
            alert('Error occurred. Please try again.');
        })
        .finally(() => {
            // Reset button state
            validateBtn.disabled = false;
            validateBtn.value = 'Validate';
        });
    }

    // Event Listeners
    document.getElementById('btnSaveWalletAddress').addEventListener('click', function() {
        if (otpSent) {
            validateOtp();
        } else {
            alert('Please send OTP first');
        }
    });

    // Enable/Disable submit button based on form changes
    const formInputs = document.querySelectorAll('#divWalletAddress input[type="text"]');
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            document.getElementById('btnSaveWalletAddress').disabled = true;
            otpSent = false;
        });
    });
</script>

<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Pages/profile/UploadDocument.blade.php ENDPATH**/ ?>
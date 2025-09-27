document.getElementById('voucherForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const studentId = document.getElementById('studentId').value.trim();
    const errorDiv = document.getElementById('error');
    const resultDiv = document.getElementById('result');
    
    // Reset previous messages
    errorDiv.classList.add('hidden');
    resultDiv.classList.add('hidden');
    
    // Validate student ID format (8 digits)
    if (!/^\d{8}$/.test(studentId)) {
        showError('Please enter a valid 8-digit student ID');
        return;
    }
    
    try {
        const response = await fetch('generate_voucher.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `studentId=${encodeURIComponent(studentId)}`
        });
        
        const data = await response.json();
        
        if (data.success) {
            document.getElementById('voucherCode').textContent = data.voucherCode;
            resultDiv.classList.remove('hidden');
        } else {
            showError(data.message || 'Authentication failed');
        }
    } catch (error) {
        console.error('Error:', error);
        showError('Network error. Please try again later.');
    }
});

document.getElementById('printBtn').addEventListener('click', function() {
    window.print();
});

function showError(message) {
    const errorDiv = document.getElementById('error');
    errorDiv.textContent = message;
    errorDiv.classList.remove('hidden');
}
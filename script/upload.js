function submitForm() {
    const form = document.getElementById('insertForm');
    const formData = new FormData(form);

    // Validate required input fields
    let isValid = true;
    form.querySelectorAll('input[required]').forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('error'); // Optional: add error class if needed
        } else {
            field.classList.remove('error');
        }
    });

    if (!isValid) {
        console.log('Please fill out all required fields.');
        return; // Stop the function if validation fails
    }

    console.log('Form is valid and ready to submit.');

    fetch('../pages/upview.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('uploadview').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

document.getElementById('insertForm').addEventListener('input', updateQuery);





function submitForm1() {

    const form = document.getElementById('insertForm');
    const formData = new FormData(form);
    console.log('working properly');
    fetch('../pages/upview.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('uploadview').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

document.getElementById('insertForm').addEventListener('input', updateQuery);
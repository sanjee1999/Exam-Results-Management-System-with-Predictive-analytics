function submitForm() {

    const form = document.getElementById('searchForm');
    const formData = new FormData(form);
    console.log('working properly');
    fetch('../pages/view.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('viewout').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

document.getElementById('searchForm').addEventListener('input', updateQuery);
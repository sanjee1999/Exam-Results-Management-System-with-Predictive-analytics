function submitForm() {
    const form = document.getElementById('searchForm');
    const formData = new FormData(form);

    // Log to confirm the function is working
    console.log('Form data:', Object.fromEntries(formData.entries()));

    fetch('../pages/view.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Update the viewout div with the result
        document.getElementById('viewout').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}
document.getElementById('searchForm').addEventListener('input', updateQuery);

// Function to handle delete action
function deleteRow(id, table, column) {
    if (confirm('Are you sure you want to delete this row?')) {
        const formData = new URLSearchParams();
        formData.append('action', 'delete');
        formData.append('id', id);
        formData.append('table', table);
        formData.append('column', column);

        fetch('../pages/view.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            // if (result.trim() === 'success') {
                // Remove the row from the table
                document.querySelector(`tr[data-id='${id}']`).remove();
            // } else {
            //     alert('Failed to delete the row.');
            // }
        })
        .catch(error => console.error('Error:', error));
    }
}


function openUpdateModal(id, table, column) {
    let data = prompt("Enter new "+table+ " for " + id);
    if (data === null) return; // User cancelled

    const formData = new URLSearchParams();
    formData.append('action', 'update');
    formData.append('id', id);
    formData.append('data', data);
    formData.append('table', table);
    formData.append('column', column);

    fetch('../pages/view.php', {
        method: 'POST',
        body: formData
    })
    
    .then(response => response.text())
    .then(result => {
        const tdElement = document.querySelector(`td[data-id='${id}']`);
            //if (tdElement) {
                tdElement.textContent = data; // Update the <td> content with the new data
            
        if (result === 'success') {
            alert('Row updated successfully.');
        } else {
            alert('Failed to update the row.');
        }
    })
    .catch(error => console.error('Error:', error));
}
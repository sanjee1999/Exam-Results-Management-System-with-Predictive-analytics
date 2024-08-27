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

// Function to handle update action
function openUpdateModal(rowId, table, column, columns) {
    const formData = new URLSearchParams();
    formData.append('id', rowId);
    formData.append('table', table);
    formData.append('column', column);
    formData.append('columns', columns.join(',')); // Pass the columns as a comma-separated string

    fetch(`../pages/view.php?${formData.toString()}`)
        .then(response => response.json())
        .then(data => {
            // Create the formatted string dynamically
            const formattedData = columns.map(col => data[col]).join(' / ');

            // Set the formatted data as the value in the input box
            document.getElementById('updateInput').value = formattedData;

            // Store rowId, table, and columns for use in submitUpdate()
            const updateModal = document.getElementById('updateModal');
            updateModal.dataset.rowId = rowId;
            updateModal.dataset.table = table;
            updateModal.dataset.column = column;
            updateModal.dataset.columns = columns.join(',');

            // Open the modal
            updateModal.style.display = 'block';
        })
        .catch(error => console.error('Error fetching data:', error));
}

function submitUpdate() {
    const updateModal = document.getElementById('updateModal');
    const rowId = updateModal.dataset.rowId;
    const table = updateModal.dataset.table;
    const column = updateModal.dataset.column;
    const columns = updateModal.dataset.columns.split(',');

    const input = document.getElementById('updateInput').value;

    // Remove the extra "/" symbols to revert to the original format
    const dataParts = input.split(' / ');

    // Create an object to map column names to their corresponding values
    const dataObject = {};
    columns.forEach((col, index) => {
        dataObject[col] = dataParts[index];
    });

    const formData = new URLSearchParams();
    formData.append('action', 'update');
    formData.append('id', rowId);
    formData.append('table', table);
    formData.append('column', column);
    formData.append('data', JSON.stringify(dataObject)); // Send the data as a JSON string

    fetch('../pages/view.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        if (result === 'success') {
            // Dynamically update the row in the table
            const rowElement = document.querySelector(`tr[data-id='${rowId}']`);
            rowElement.innerHTML = columns.map(col => `<td>${dataObject[col]}</td>`).join('');

            // Close the modal
            closeModal();
        } else {
            alert('Failed to update the row.');
        }
    })
    .catch(error => console.error('Error:', error));
}

function closeModal() {
    document.getElementById('updateModal').style.display = 'none';
}

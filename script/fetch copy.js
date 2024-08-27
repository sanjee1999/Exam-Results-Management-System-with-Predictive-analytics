// Existing submitForm function
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


// New function for handling chart or table display
function fetchData() {
    const checkbox = document.getElementById('graph');  // Checkbox ID
    const viewout = document.getElementById('viewout');
    const form = document.getElementById('searchForm');  // Form ID
    const formData = new FormData(form);
    formData.append('responseType', checkbox.checked ? 'chart' : 'table');

    fetch('../pages/view.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (checkbox.checked) {
            return response.json();
        } else {
            return response.text();
        }
    })
    .then(data => {
        if (checkbox.checked) {
            // Show chart
            viewout.innerHTML = '<canvas id="dynamicChart" width="400" height="200"></canvas>';
            var ctx = document.getElementById('dynamicChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Dynamic Dataset',
                        data: data.values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        } else {
            // Show table
            viewout.innerHTML = data;
        }
    })
    .catch(error => console.error('Error:', error));
}

// Event listener for the checkbox
document.getElementById('graph').addEventListener('change', fetchData);

// Event listener for the search form
document.getElementById('searchForm').addEventListener('input', submitForm);

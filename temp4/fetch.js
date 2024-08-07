document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('showChart');
    const viewout = document.getElementById('viewout');

    function fetchData() {
        const formData = new FormData(document.getElementById('dataForm'));
        formData.append('responseType', checkbox.checked ? 'chart' : 'table');

        fetch('b.php', {
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

    checkbox.addEventListener('change', fetchData);

    // Fetch data initially
    fetchData();
});

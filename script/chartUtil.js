// Function to create a chart
function createChart(labels, values, graph_type, canvas_id) {
    new Chart(document.getElementById(canvas_id), {
        type: graph_type, // 'bar', 'line', 'pie', etc.
        data: {
            labels: labels,
            datasets: [{
                label: 'Data',
                data: values,
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
}

// Function to fetch data and create chart
function fetchDataAndCreateChart(apiUrl, labelsKey, valuesKey, graph_type, canvas_id) {
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            // Prepare data for Chart.js
            const labels = data.map(item => item[labelsKey]);
            const values = data.map(item => item[valuesKey]);
            console.log('working chartjs');
            // Create chart
            createChart(labels, values, graph_type, canvas_id); // Adjust graph_type and canvas_id as needed
        })
        .catch(error => console.error('Error fetching data:', error));
}

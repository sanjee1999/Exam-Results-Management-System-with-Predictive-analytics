// function submitForm() {

//     const form = document.getElementById('searchForm');
//     const formData = new FormData(form);
//     console.log('working properly okk');
//     fetch('../pages/viewchart.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.text())
//     .then(data => {
//         document.getElementById('viewchart').innerHTML = data;
//     })
//     .catch(error => console.error('Error:', error));
// }

// document.getElementById('searchForm').addEventListener('input', updateQuery);

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

// document.addEventListener('DOMContentLoaded', function() {
//     document.getElementById('searchForm').addEventListener('submit', function(event) {
//         event.preventDefault();

//         const formData = new FormData(this);

//         fetch('../pages/view.php', {
//             method: 'POST',
//             body: formData
//         })
//         .then(response => response.json())
//         .then(data => {
//             // Clear any existing chart
//             document.getElementById('viewout').innerHTML = '<canvas id="dynamicChart" width="400" height="200"></canvas>';
            
//             // Create the chart
//             var ctx = document.getElementById('dynamicChart').getContext('2d');
//             new Chart(ctx, {
//                 type: 'bar',
//                 data: {
//                     labels: data.labels,
//                     datasets: [{
//                         label: 'Dynamic Dataset',
//                         data: data.values,
//                         backgroundColor: 'rgba(75, 192, 192, 0.2)',
//                         borderColor: 'rgba(75, 192, 192, 1)',
//                         borderWidth: 1
//                     }]
//                 },
//                 options: {
//                     scales: {
//                         y: {
//                             beginAtZero: true
//                         }
//                     }
//                 }
//             });
//         })
//         .catch(error => console.error('Error:', error));
//     });
// });




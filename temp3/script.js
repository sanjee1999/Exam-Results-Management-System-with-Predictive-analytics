function updateQuery() {
    // let date = document.getElementById('date').value;
    // let hour = document.getElementById('hour').value;
    // let sub_code = document.getElementById('sub_code').value;
    // let year = document.getElementById('year').value;
    // let reg_no = document.getElementById('reg_no').value;

    // let query = "SELECT reg_no, date, sub_code FROM attendance WHERE 1=1";

    // if (date) {
    //     query += ` AND date = '${date}'`;
    // }
    // if (hour) {
    //     query += ` AND hour = ${hour}`;
    // }
    // if (sub_code) {
    //     query += ` AND sub_code = '${sub_code}'`;
    // }
    // if (year) {
    //     query += ` AND year = ${year}`;
    // }
    // if (reg_no) {
    //     query += ` AND reg_no = '${reg_no}'`;
    // }

    // document.getElementById('query').innerText = query;
}

function submitForm() {
    // updateQuery();

    const form = document.getElementById('searchForm');
    const formData = new FormData(form);

    fetch('view.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('results').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

document.getElementById('searchForm').addEventListener('input', updateQuery);

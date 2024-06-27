document.getElementById('fileUpload').addEventListener('change', handleFile, false);

                        function handleFile(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const formData = new FormData();
                                formData.append('fileUpload', file);

                                fetch('../pages/upload.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.text())
                                .then(data => {
                                    document.getElementById('output').innerHTML = data;
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                            }
                        }
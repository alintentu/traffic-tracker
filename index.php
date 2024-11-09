<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Visit Tracker</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Website Traffic Tracker</h1>

        <div id="visitData">
            <!-- The visit data will be inserted here by the AJAX response -->
        </div>

        <footer>
            <p>&copy; 2024 Website Traffic Tracker</p>
        </footer>
    </div>

    <script>
        // AJAX request to fetch visit data
        $(document).ready(function() {
            function loadVisitData() {
                $.ajax({
                    url: 'get_visits.php',  // This will fetch the visit data
                    type: 'GET',            // Use GET request
                    dataType: 'json',       // Expect JSON response
                    success: function(data) {
                        if (data.status === 'success') {
                            let totalVisits = data.total_visits;  // Total number of visits
                            let visitList = data.data;  // Array of visit details
                            let visitDetailsHTML = "<ul>";

                            // Loop through the visit data and create a list
                            visitList.forEach(function(visit) {
                                visitDetailsHTML += `
                                    <li>
                                        Page: ${visit.page_url}<br>
                                        IP Address: ${visit.ip_address}<br>
                                        Timestamp: ${visit.timestamp}
                                    </li>
                                `;
                            });
                            visitDetailsHTML += "</ul>";

                            // Update the HTML with total visits and the visit details
                            $('#visitData').html(`
                                <p>Total visits: ${totalVisits}</p>
                                <h2>Visit Details:</h2>
                                ${visitDetailsHTML}
                            `);
                        } else {
                            $('#visitData').html('<p>Error: Unable to fetch data.</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#visitData').html('<p>Error: There was an issue with the AJAX request.</p>');
                    }
                });
            }

            // Load visit data on page load
            loadVisitData();
            
            // Optional: Refresh visit data every 10 seconds
            setInterval(loadVisitData, 10000);
        });
    </script>
</body>
</html>

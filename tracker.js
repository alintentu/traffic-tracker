(function() {
    const url = window.location.href; // Get the current page URL
    const trackingUrl = 'http://localhost:8000/track.php'; // URL to your tracking PHP file

    // Send the tracking request using the Fetch API
    fetch(trackingUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ page_url: url })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            console.log('Visit tracked successfully');
        } else {
            console.error('Tracking failed:', data.message);
        }
    })
    .catch(error => {
        console.error('Error in tracking:', error);
    });
})();

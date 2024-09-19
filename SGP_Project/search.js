// Get the search button and input field by their IDs
const searchButton = document.getElementById('searchBtn');
const searchInput = document.getElementById('searchInput');

// Add an event listener to the search button
searchButton.addEventListener('click', function() {
    const searchTerm = searchInput.value.trim().toLowerCase();

    if (searchTerm) {
        // Simulate a search operation: you can customize this part.
        // Here we will just display an alert for demonstration purposes.
        alert('Searching for: ' + searchTerm);

        // You can also redirect to a results page
        // window.location.href = `search-results.html?query=${searchTerm}`;
    } else {
        alert('Please enter a sport or location.');
    }
});

// Alternatively, allow pressing "Enter" to trigger the search
searchInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchButton.click();
    }
});

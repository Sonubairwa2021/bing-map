<!DOCTYPE html>
<html>
<head>
    <title>Bing Maps Autosuggest with Bootstrap 4 Autocomplete</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
#autocomplete-results {
    border: 1px solid #ccc;
    background-color: #fff;
    position: absolute;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    display: none;
}

.autocomplete-item {
    padding: 10px;
    cursor: pointer;
    transition: background-color 0.2s;
}

.autocomplete-item:hover {
    background-color: #f2f2f2;
}
</style>
</head>

<body>

<div class="container mt-4">
    <h2>Bing Maps Autosuggest with Bootstrap 4 Autocomplete</h2>
    <input type="text" id="searchInput" class="form-control" placeholder="Search for a location...">
    <div id="suggestions" class="autocomplete-items"></div>
   
</div>

<!-- Include Bootstrap JS and Your Custom Script -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
    // Attach event listener to the input field
    $('#searchInput').keyup(function () {
        var query = $(this).val();

        if (query.trim() !== '') {
            // Make an API request using PHP to fetch suggestions
            $.ajax({
                url: 'get_suggestions.php',
                method: 'GET',
                data: {query: query},
                success: function (response) {
                    $('#suggestions').html(response);
                }
            });
        } else {
            $('#suggestions').empty();
        }
    });

    // Handle suggestion selection
    $(document).on('click', '.autocomplete-item', function () {
        $('#searchInput').val($(this).text());
        var name = $(this).data('name');
    var formattedAddress = $(this).data('formattedaddress');
    var latitude = $(this).data('latitude');
    var longitude = $(this).data('longitude');
    var addressLine = $(this).data('addressLine');
    var postalCode = $(this).data('postalCode');
    var city = $(this).data('city');
    var state = $(this).data('state');
    
    // Do something with the retrieved data
    console.log('Name:', name);
    console.log('Formatted Address:', formattedAddress);
    console.log('Latitude:', latitude);
    console.log('Longitude:', longitude);
    console.log('addressLine:', addressLine);
    console.log('city:', city);
    console.log('state:', state);
    console.log('postalCode:', postalCode);
        $('#suggestions').empty();
    });
});

</script>

</body>
</html>

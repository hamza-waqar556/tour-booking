<div id="airline-search-container" style="max-width:400px;">
    <!-- Search input -->
    <input type="text" id="airline-search-input" placeholder="Search Airlines..." style="width:100%; padding:8px; box-sizing:border-box;" />

    <!-- Custom dropdown results -->
    <ul id="airline-search-results" style="list-style:none; padding:0; margin:5px 0; border:1px solid #ccc; display:none;"></ul>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {

    /**
     * Load airlines via AJAX based on the given query.
     *
     * @param {string} query The search query.
     */
    function loadAirlines(query) {
        $.ajax({
            url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'searchAirlines',
                q: query
            },
            success: function(response) {
                var $results = $('#airline-search-results');
                var resultsHTML = '';

                if (response.success && response.data.length) {
                    $.each(response.data, function(index, airline) {
                        resultsHTML += '<li style="padding:8px; border-bottom:1px solid #eee; display:flex; align-items:center; cursor:pointer;">' +
                                       '<img src="' + airline.logo + '" alt="' + airline.code + '" style="width:30px; height:30px; margin-right:10px;"/>' +
                                       '<span>' + airline.name + ' - ' + airline.code + '</span>' +
                                       '</li>';
                    });
                    $results.html(resultsHTML).show();
                } else {
                    $results.html('<li style="padding:8px;">No results found</li>').show();
                }
            },
            error: function(xhr, status, error) {
                console.log('Error fetching airlines: ' + error);
            }
        });
    }

    // Initially hide the results dropdown.
    $('#airline-search-results').hide();

    // Listen for keyup events on the search input.
    $('#airline-search-input').on('keyup', function() {
        var query = $(this).val().trim();
        if(query.length < 2){
            $('#airline-search-results').hide();
            // Reset background and padding when the query is too short.
            $(this).css({'background-image': 'none', 'padding-left': '8px'});
            return;
        }
        // Clear any previously set background when typing a new query.
        $(this).css({'background-image': 'none', 'padding-left': '8px'});
        loadAirlines(query);
    });

    // When an option is clicked, set its text in the input and update the background image.
    $('#airline-search-results').on('click', 'li', function() {
        var text = $(this).find('span').text();
        var logo = $(this).find('img').attr('src');
        $('#airline-search-input').val(text);
        $('#airline-search-results').hide();
        // Set the input's background image to the selected logo and adjust padding.
        $('#airline-search-input').css({
            'background-image': 'url(' + logo + ')',
            'background-repeat': 'no-repeat',
            'background-size': '30px 30px',
            'background-position': '5px center',
            'padding-left': '40px'
        });
    });

    // Optional: hide the dropdown when clicking outside.
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#airline-search-container').length) {
            $('#airline-search-results').hide();
        }
    });
});
</script>

(function ($) {

    // select fly from 
    $(document).ready(function () {
        // Initialize Select2 on the dropdown
        $('#flight-from').select2({
            placeholder: 'Flying From', // Placeholder text
            allowClear: true, // Option to clear the selection
        });
    });

    // fly to
    $(document).ready(function () {
        // Initialize Select2 on the dropdown
        $('#flight-to').select2({
            placeholder: 'Flying To', // Placeholder text
            allowClear: true, // Option to clear the selection
        });
    });

    // depart date
    $(function () {
        $("#depart-date").datepicker({
            minDate: 0
        });
    });

    // return date
    $(function () {
        $("#return-date").datepicker({
            minDate: 0
        });
    });

    // show and hide return date
    $(document).ready(function () {
        if ($("#one-way").is(":checked")) {
            $("#return-date-wrapper").hide();
        }

        $("#one-way").on("change", function () {
            if ($(this).is(":checked")) {
                $("#return-date-wrapper").hide();
            }
        });

        $("#round-trip, #multi-trip").on("change", function () {
            if ($(this).is(":checked")) {
                $("#return-date-wrapper").show();
            }
        });
    });

    $(document).ready(function () {
        const min = 0; // Minimum value for travelers
        const max = 10; // Maximum value for each category

        function updateDropdownText() {
            const adults = parseInt($("[data-type='adults']").text(), 10);
            const children = parseInt($("[data-type='children']").text(), 10);
            const infants = parseInt($("[data-type='infants']").text(), 10);
            const total = adults + children + infants;

            $("#travellerDropdown").text(`Travellers: ${total}`);
        }

        // Increase count
        $(".increase").click(function (e) {
            e.preventDefault(); // Prevent default page refresh
            const type = $(this).data("type").replace('-increase', '');
            const countElement = $(`[data-type='${type}']`);
            let currentValue = parseInt(countElement.text(), 10);

            if (currentValue < max) {
                countElement.text(currentValue + 1);
                updateDropdownText();
            }
        });

        // Decrease count
        $(".decrease").click(function (e) {
            e.preventDefault(); // Prevent default page refresh
            const type = $(this).data("type").replace('-decrease', '');
            const countElement = $(`[data-type='${type}']`);
            let currentValue = parseInt(countElement.text(), 10);

            if (currentValue > min) {
                countElement.text(currentValue - 1);
                updateDropdownText();
            }
        });

        updateDropdownText();

        $(document).click(function (event) {
            if (!$(event.target).closest('.dropdown').length) {
                $('.dropdown-menu').removeClass('show');
            }
        });

        $('.dropdown').click(function (event) {
            event.stopPropagation();
        });
    });

    // form data into JSON form 
    $(document).ready(function () {
        $("#flight-form-submit").click(function (e) {
            e.preventDefault();

            var formData = {
                flights: $("input[name='flights']:checked").val(),
                flightType: $("#flight-type").val(),
                flightFrom: $("#flight-from").val(),
                flightTo: $("#flight-to").val(),
                departDate: $("#depart-date").val(),
                returnDate: $("#return-date").val(),
                travellers: {
                    adults: $(".count[data-type='adults']").text(),
                    children: $(".count[data-type='children']").text(),
                    infants: $(".count[data-type='infants']").text()
                }
            };

            $("#jsonDataOutput").show();
            $("#jsonContent").text(JSON.stringify(formData, null, 2));

            console.log(formData);
        });
    });

    // price slider filter
    $(function () {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 1000,
            values: [200, 800],
            slide: function (event, ui) {
                $("#min-price").text("$" + ui.values[0]);
                $("#max-price").text("$" + ui.values[1]);
            }
        });

        $("#min-price").text("$" + $("#slider-range").slider("values", 0));
        $("#max-price").text("$" + $("#slider-range").slider("values", 1));
    });

    // output list pagination
    $(document).ready(function () {
        const itemsPerPage = 2;
        const $cards = $('.flight-card');
        const totalItems = $cards.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const maxVisibleButtons = 5;

        let currentPage = 1;

        function showPage(page) {
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            $cards.hide();
            $cards.slice(startIndex, endIndex).fadeIn();
        }

        function createPagination() {
            const $pagination = $('#pagination');
            $pagination.empty();

            // Previous Button
            const $prevBtn = $('<button>')
                .text('Prev')
                .addClass('pagination-btn prev')
                .prop('disabled', currentPage === 1)
                .on('click', function () {
                    if (currentPage > 1) {
                        currentPage--;
                        updatePagination();
                    }
                });
            $pagination.append($prevBtn);

            // Page Buttons
            const $pageButtons = $('<div>').addClass('page-buttons');
            for (let i = 1; i <= totalPages; i++) {
                if (
                    i === 1 ||
                    i === totalPages ||
                    (i >= currentPage - Math.floor(maxVisibleButtons / 2) &&
                        i <= currentPage + Math.floor(maxVisibleButtons / 2))
                ) {
                    const $btn = $('<button>')
                        .text(i)
                        .addClass('pagination-btn page')
                        .toggleClass('active', i === currentPage)
                        .on('click', function () {
                            currentPage = i;
                            updatePagination();
                        });
                    $pageButtons.append($btn);
                } else if (
                    i === currentPage - Math.floor(maxVisibleButtons / 2) - 1 ||
                    i === currentPage + Math.floor(maxVisibleButtons / 2) + 1
                ) {
                    $pageButtons.append('<span class="ellipsis">...</span>');
                }
            }
            $pagination.append($pageButtons);

            // Next Button
            const $nextBtn = $('<button>')
                .text('Next')
                .addClass('pagination-btn next')
                .prop('disabled', currentPage === totalPages)
                .on('click', function () {
                    if (currentPage < totalPages) {
                        currentPage++;
                        updatePagination();
                    }
                });
            $pagination.append($nextBtn);
        }

        function updatePagination() {
            showPage(currentPage);
            createPagination();
        }

        showPage(currentPage);
        createPagination();
    });

})(jQuery);

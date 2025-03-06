<!--
 /**
 * ShortCode Flights
 */
 -->
<!-- <form id="flight-search-form">
    <input type="text" id="origin" name="origin" placeholder="Origin" value="ISB" >
    <input type="text" id="destination" name="destination" placeholder="Destination" value="LYP" >
    <input type="date" id="departure_date" name="departure_date" value="2025-02-25" >
    <input type="date" id="return_date" name="return_date">
    <input type="number" id="adults" name="adults" placeholder="Adults" min="1" value="1">
    <input type="number" id="max_results" name="max_results" placeholder="Max Results" min="1" value="3">
    <button type="submit">Search Flights</button>
</form>

-->


<!-- Rest Route : search_flights -->
<!-- <section id="flightsPage"> -->
<div class="container">
    <!-- this is page heading wrapper -->
    <div class="heading-wrapper">
        <div class="icon-wrapper">
            <i class="fa-solid fa-plane-departure"></i>
        </div>
        <h1 class="text-capitalize fs-5">
            Search for best Flights
        </h1>
    </div>

    <!-- Form for search  flights -->
    <form id="searchFlights">
        <div class="row gap-3 align-items-center mb-3">
            <div class="col-md">
                <div class="flights-toggle">
                    <!-- Hidden radio inputs -->
                    <input type="radio" name="flights" id="one-way" value="one-way" checked>
                    <label for="one-way">One Way</label>

                    <input type="radio" name="flights" id="round-trip" value="round-trip">
                    <label for="round-trip">Round Trip</label>

                    <input type="radio" name="flights" id="multi-way" value="multi-way">
                    <label for="multi-way">Multi Way</label>
                </div>
            </div>

            <!-- Flight Class || Select -->
            <div class="col-md">
                <div class="d-flex justify-content-end">
                    <div class="col-12 col-sm-6">
                        <select class="form-select text-capitalize" id="flight-type"
                            aria-label="Default select example">
                            <option value="economy">economy</option>
                            <option value="economy_premium">economy premium</option>
                            <option value="business">business</option>
                            <option value="first">first</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>



        <div class="row row-gap-3 align-items-center">
            <!-- Origin || Select -->
            <div class="col-md">
                <div class="airport-search-container">
                    <div class="airport-search-input-wrapper">
                        <!-- This box will be updated with the airport code -->
                        <div class="airport-code-box-input"></div>
                        <input type="text" name="origin" class="airport-search-input" placeholder="Origin" />
                    </div>
                    <ul class="airport-search-results"></ul>
                </div>
            </div>

            <!-- Destination || Select -->
            <div class="col-md">
                <div class="airport-search-container">
                    <div class="airport-search-input-wrapper">
                        <!-- This box will be updated with the airport code -->
                        <div class="airport-code-box-input"></div>
                        <input type="text" name="destination" class="airport-search-input" placeholder="Destination" />
                    </div>
                    <ul class="airport-search-results"></ul>
                </div>
            </div>

            <!-- DatePicker || Departure && Return -->
            <div class="col-md">
                <div class="row row-gap-3">
                    <div class="col-md">
                        <input type="text" class="w-100 form-control"
                            name="departure_date"
                            id="departure-date"
                            placeholder="Depart Date">
                    </div>
                    <div class="col-md" id="return-date-wrapper">
                        <input type="text"
                            name="return_date"
                            class="w-100 form-control"
                            id="return-date"
                            placeholder="Return Date">
                    </div>
                </div>
            </div>

            <!-- Travelers Dropdown (updated) -->
            <div class="col-md">
                <div class="travelers-counter">
                    <!-- The summary input shows the total count and is used for form submission -->
                    <input type="text" name="travelers" class="travelers-summary" readonly value="Travelers: 0">

                    <!-- Dropdown with travelers controls -->
                    <div class="travelers-dropdown">
                        <div class="travelers-item adults">
                            <span class="label">Adults</span>
                            <div class="counter">
                                <button type="button" class="decrease">-</button>
                                <span class="count">0</span>
                                <input type="hidden" name="adults" class="hidden-input">
                                <button type="button" class="increase">+</button>
                            </div>
                        </div>
                        <div class="travelers-item children">
                            <span class="label">Children</span>
                            <div class="counter">
                                <button type="button" class="decrease">-</button>
                                <span class="count">0</span>
                                <input type="hidden" name="children" class="hidden-input">
                                <button type="button" class="increase">+</button>
                            </div>
                        </div>
                        <div class="travelers-item infants">
                            <span class="label">Infants</span>
                            <div class="counter">
                                <button type="button" class="decrease">-</button>
                                <span class="count">0</span>
                                <input type="hidden" name="infants" class="hidden-input">
                                <button type="button" class="increase">+</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Hidden Max Results Field -->
            <input type="hidden" name="max_results" value="3">

            <!-- Form Submit Button -->
            <div class="col-md-2">
                <input type="submit" class="btn btn-primary w-100" value="Search">
            </div>
        </div>
    </form>

    <!-- This is where the JSON data will be shown after the form is submitted -->
    <div id="jsonDataOutput" style="display: none;">
        <h3>Form Data (JSON):</h3>
        <pre id="jsonContent"></pre>
    </div>


    <!-- Out Put of form in form of cards -->
    <div class="flights-output-wrapper mt-5 bg-white">
        <div class="row">
            <div class="col-12 col-md-3 border-end border-md">
                <div class="p-4">
                    <h5 class="mb-3">
                        Price Filter
                    </h5>
                    <div class="slider-container">
                        <div id="slider-range"></div>
                        <div class="price-labels d-flex align-items-center justify-content-between mt-2">
                            <span id="min-price">$0</span>
                            <span id="max-price">$1000</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="p-4">
                    <div class="card-list-header p-3 bg-primary text-white rounded mb-3 d-flex align-items-center justify-content-between flex-row flex-md-col">
                        <h5 class="text-capitalize m-0">
                            1 Flights found
                        </h5>
                        <div class="d-flex align-items-center gap-3">
                            <div class="text-uppercase ">
                                lhe - dxb
                            </div>
                            <div class="">
                                17-01-2025
                            </div>
                        </div>
                    </div>
                    <div class="mb-5" id="flights-card-wrapper">
                        <div class="flight-card border p-3 rounded mb-3">
                            <div class="row align-items-start row-gap-2">
                                <div class="col-lg-1">
                                    <span class="fs-2">
                                        <i class="fa-solid fa-plane-up"></i>
                                    </span>
                                </div>

                                <div class="col-lg-7">
                                    <h5 class="fw-medium text-black mb-1 text-capitalize">
                                        01:03 Am - 07:25 Am
                                    </h5>
                                    <p class="m-0">
                                        Pakistan International Airlines - 6
                                    </p>
                                </div>

                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6 class="fw-medium text-black mb-1 text-capitalize">
                                                Trip Duration
                                            </h6>
                                            <p class="m-0">
                                                3 Hours
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="fw-medium text-black mb-1 text-capitalize">
                                                Flight Stops
                                            </h6>
                                            <p class="m-0">
                                                0
                                            </p>
                                            <p class="m-0">
                                                LHE - DXB
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-2 mt-3">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="text-capitalize fw-medium text-black">
                                        price
                                    </div>
                                    <h5 class="text-black m-0">
                                        USD 100.00
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-secondary text-capitalize">
                                            book now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pagination"></div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- </section> -->


<div id="search-results"></div>
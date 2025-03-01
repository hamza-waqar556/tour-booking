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

<div id="search-results"></div> -->





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
            <form action="#" id="searchFlights">
                <div class="row gap-3 align-items-center mb-3">
                    <div class="col-md">
                        <div class="d-flex items-center gap-3">
                            <div class="">
                                <label for="one-way">
                                    <input type="radio" name="flights" id="one-way" value="one-way" checked>
                                    <span>
                                        One Way
                                    </span>
                                </label>
                            </div>
                            <div class="">
                                <label for="round-trip">
                                    <input type="radio" name="flights" id="round-trip" value="round-trip">
                                    <span>
                                        Round Trip
                                    </span>
                                </label>
                            </div>
                            <div class="">
                                <label for="multi-way">
                                    <input type="radio" name="flights" id="multi-way" value="multi-way">
                                    <span>
                                        Round Trip
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
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
                    <div class="col-md">
                        <select id="flight-from" class="form-select text-capitalize"
                            aria-label="Default select example">
                            <option></option>
                            <option class="text-capitalize" value="faisalabad">faisalabad</option>
                            <option class="text-capitalize" value="lahore">lahore</option>
                            <option class="text-capitalize" value="islamabad">islamabad</option>
                            <option class="text-capitalize" value="multan">multan</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <select id="flight-to" class="form-select text-capitalize" aria-label="Default select example">
                            <option></option>
                            <option class="text-capitalize" value="faisalabad">faisalabad</option>
                            <option class="text-capitalize" value="lahore">lahore</option>
                            <option class="text-capitalize" value="islamabad">islamabad</option>
                            <option class="text-capitalize" value="multan">multan</option>
                        </select>

                    </div>
                    <div class="col-md">
                        <div class="row row-gap-3">
                            <div class="col-md">
                                <input type="text" class="w-100 form-control" id="depart-date"
                                    placeholder="Depart Date">
                            </div>
                            <div class="col-md" id="return-date-wrapper">
                                <input type="text" class="w-100 form-control" id="return-date"
                                    placeholder="Return Date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="dropdown">
                            <button class="btn bg-white border w-100 text-start" type="button" id="travelerDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Travelers: 0
                            </button>
                            <ul class="dropdown-menu p-3 w-100" aria-labelledby="travelerDropdown"
                                style="width: 200px !important;">
                                <li>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Adults</span>
                                        <div>
                                            <button class="btn btn-outline-secondary btn-sm decrease"
                                                data-type="adults-decrease">-</button>
                                            <span class="mx-2 count" data-type="adults">0</span>
                                            <button class="btn btn-outline-secondary btn-sm increase"
                                                data-type="adults-increase">+</button>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Children</span>
                                        <div>
                                            <button class="btn btn-outline-secondary btn-sm decrease"
                                                data-type="children-decrease">-</button>
                                            <span class="mx-2 count" data-type="children">0</span>
                                            <button class="btn btn-outline-secondary btn-sm increase"
                                                data-type="children-increase">+</button>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Infants</span>
                                        <div>
                                            <button class="btn btn-outline-secondary btn-sm decrease"
                                                data-type="infants-decrease">-</button>
                                            <span class="mx-2 count" data-type="infants">0</span>
                                            <button class="btn btn-outline-secondary btn-sm increase"
                                                data-type="infants-increase">+</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" id="flight-form-submit" class="btn btn-primary w-100" value="Search">
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
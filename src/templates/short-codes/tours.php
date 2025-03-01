<div class="container">
            <!-- this is page heading wrapper -->
            <div class="heading-wrapper">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-cart-flatbed-suitcase"></i>
                </div>
                <h1 class="text-capitalize fs-5">
                    Find Best Tours
                </h1>
            </div>

            <!-- Form for search  flights -->
            <form action="#" id="searchTours">
                <div class="row row-gap-3 align-items-center">
                    <div class="col-md">
                        <select id="tour-locate" class="form-select text-capitalize"
                            aria-label="Default select example">
                            <option></option>
                            <option class="text-capitalize" value="faisalabad">faisalabad</option>
                            <option class="text-capitalize" value="lahore">lahore</option>
                            <option class="text-capitalize" value="islamabad">islamabad</option>
                            <option class="text-capitalize" value="multan">multan</option>
                        </select>
                    </div>
                    <div class="col-md">
                        <input type="text" class="w-100 form-control" id="tour-date" placeholder="Depart Date">
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
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" id="tours-form-submit" class="btn btn-primary w-100" value="Search">
                    </div>
                </div>
            </form>

            <!-- This is where the JSON data will be shown after the form is submitted -->
            <div id="jsonDataOutput" style="display: none;">
                <h3>Form Data (JSON):</h3>
                <pre id="jsonContent"></pre>
            </div>


            <!-- Out Put of form in form of cards -->
            <div class="tours-output-wrapper mt-5 bg-white">
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
                            <div
                                class="card-list-header p-3 bg-primary text-white rounded mb-3 d-flex align-items-center justify-content-between flex-row flex-md-col">
                                <h5 class="text-capitalize m-0">
                                    1 Tour found
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
                            <div class="mb-5" id="tours-card-wrapper">
                                <div class="tours-card border p-3 rounded mb-3">
                                    <div class="row align-items-start row-gap-2">
                                        <div class="col-lg-1">
                                            <span class="fs-2">
                                                <i class="fa-solid fa-suitcase-rolling"></i>
                                            </span>
                                        </div>

                                        <div class="col-md-8">
                                            <h5 class="fw-medium text-black mb-1 text-capitalize">
                                                6 Days Around Thailand
                                            </h5>
                                            <p class="m-0">
                                                Thailand,Thailand
                                            </p>
                                        </div>

                                        <div class="col-md-3">
                                                <h6 class="fw-medium text-black mb-1 text-capitalize">
                                                    Rating
                                                </h6>
                                                <p class="m-0">
                                                    3/5
                                                </p>
                                        </div>
                                    </div>
                                    <hr class="my-2 mt-3">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="text-capitalize fw-medium text-black">
                                                price
                                            </div>
                                            <h5 class="text-black m-0">
                                                USD 88.00
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
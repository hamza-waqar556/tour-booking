<div class="container">
            <div class="py-4">
                <h1 class="text-center text-white fs-4 m-0">Flight Booking</h1>
            </div>
            <form id="flightBookingForm">
                <div class="row row-gap-3">
                    <div class="col-lg-8">
                        <div class="bg-white shadow rounded mb-3">
                            <div class="p-4 border-bottom">
                                <h5 class="m-0">Personal Information</h5>
                            </div>
                            <div class="p-3">
                                <div class="row row-gap-3 mb-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="userFirstName"
                                                placeholder="Enter Your First Name Here">
                                            <label for="userFirstName" class="text-capitalize text-black fw-medium">
                                                First name </label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="userlastName"
                                                placeholder="Enter Your Last Name Here">
                                            <label for="userlastName" class="text-capitalize text-black fw-medium"> last
                                                name </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-gap-3 mb-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="userEmail"
                                                placeholder="Enter Your Email Here">
                                            <label for="userEmail" class="text-capitalize text-black fw-medium"> Email
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" id="userContact"
                                                placeholder="Enter Your Phone Number Here">
                                            <label for="userContact" class="text-capitalize text-black fw-medium"> phone
                                                number </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-gap-3 mb-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="userAddress"
                                                placeholder="Enter Your Address Here">
                                            <label for="userAddress" class="text-capitalize text-black fw-medium">
                                                Address </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-gap-3 mb-3">
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <select class="form-select" id="userNationality"
                                                aria-label="Floating label select example">
                                                <option value="1">Pakistan</option>
                                                <option value="2">Canada</option>
                                            </select>
                                            <label for="userNationality"
                                                class="text-capitalize text-black fw-medium">Nationality</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <select class="form-select" id="userCurrentCountry"
                                                aria-label="Floating label select example">
                                                <option value="1">Pakistan</option>
                                                <option value="2">Canada</option>
                                            </select>
                                            <label for="userCurrentCountry"
                                                class="text-capitalize text-black fw-medium">Current Country</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white shadow rounded mb-3">
                            <div class="p-4 border-bottom">
                                <h5 class="m-0">Travellers Information</h5>
                            </div>
                            <div class="p-3">
                                <div class=" border rounded overflow-hidden text-white">
                                    <div class="p-3 bg-secondary ">
                                        <h6 class="m-0">Adult Traveller 1</h6>
                                    </div>
                                    <div class="p-3">
                                        <div class="row row-gap-3 mb-3">
                                            <div class="col-md-2">
                                                <div class="form-floating">
                                                    <select class="form-select" id="adualtGender"
                                                        aria-label="Floating label select example">
                                                        <option value="1">Mr</option>
                                                        <option value="2">Miss</option>
                                                        <option value="2">Mrs</option>
                                                    </select>
                                                    <label for="adualtGender"
                                                        class="text-capitalize text-black fw-medium">Title</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="adultFirstName"
                                                        placeholder="Enter Your First Here">
                                                    <label for="adultFirstName"
                                                        class="text-capitalize text-black fw-medium">
                                                        first name
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="adultlastName"
                                                        placeholder="Enter Your Last Here">
                                                    <label for="adultlastName"
                                                        class="text-capitalize text-black fw-medium">
                                                        Last name
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-gap-3 mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select class="form-select" id="adualtNationality"
                                                        aria-label="Floating label select example">
                                                        <option value="1">Pakistan</option>
                                                        <option value="2">America</option>
                                                        <option value="2">Canada</option>
                                                    </select>
                                                    <label for="adualtNationality"
                                                        class="text-capitalize text-black fw-medium">Nationality</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row row-gap-3">
                                                    <div class="col-md-5">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="adualtBirthMonth"
                                                                aria-label="Floating label select example">
                                                                <option value="1">Jan</option>
                                                                <option value="2">Feb</option>
                                                                <option value="2">Mar</option>
                                                            </select>
                                                            <label for="adualtBirthMonth"
                                                                class="text-capitalize text-black fw-medium">Birth
                                                                Month
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="adualtBirthDate"
                                                                aria-label="Floating label select example">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="2">3</option>
                                                            </select>
                                                            <label for="adualtBirthDate"
                                                                class="text-capitalize text-black fw-medium">
                                                                Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <select class="form-select" id="adualtBirthYear"
                                                                aria-label="Floating label select example">
                                                                <option value="1">1992</option>
                                                                <option value="2">1993</option>
                                                                <option value="2">1994</option>
                                                            </select>
                                                            <label for="adualtBirthYear"
                                                                class="text-capitalize text-black fw-medium">
                                                                Birth Year
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-gap-3 mb-3">
                                            <div class="col-md">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="adultPassport"
                                                        placeholder="Enter Your First Here">
                                                    <label for="adultPassport"
                                                        class="text-capitalize text-black fw-medium">
                                                        Passport or Id number
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-gap-3 mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select class="form-select" id="adualtIssuanceMonth"
                                                        aria-label="Floating label select example">
                                                        <option value="1">Jan</option>
                                                        <option value="2">Feb</option>
                                                        <option value="2">Mar</option>
                                                    </select>
                                                    <label for="adualtIssuanceMonth"
                                                        class="text-capitalize text-black fw-medium">
                                                        Issuance Month
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <select class="form-select" id="adualtIssuanceDate"
                                                        aria-label="Floating label select example">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="2">3</option>
                                                    </select>
                                                    <label for="adualtIssuanceDate"
                                                        class="text-capitalize text-black fw-medium">
                                                        Issuance Date
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <select class="form-select" id="adualtIssuanceYear"
                                                        aria-label="Floating label select example">
                                                        <option value="1">1992</option>
                                                        <option value="2">1993</option>
                                                        <option value="2">1994</option>
                                                    </select>
                                                    <label for="adualtIssuanceYear"
                                                        class="text-capitalize text-black fw-medium">
                                                        Issuance Year
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-gap-3 mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select class="form-select" id="adualtExpiryMonth"
                                                        aria-label="Floating label select example">
                                                        <option value="1">Jan</option>
                                                        <option value="2">Feb</option>
                                                        <option value="2">Mar</option>
                                                    </select>
                                                    <label for="adualtExpiryMonth"
                                                        class="text-capitalize text-black fw-medium">
                                                        Expiry Month
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <select class="form-select" id="adualtExpiryDate"
                                                        aria-label="Floating label select example">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="2">3</option>
                                                    </select>
                                                    <label for="adualtExpiryDate"
                                                        class="text-capitalize text-black fw-medium">
                                                        Expiry Date
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <select class="form-select" id="adualtExpiryYear"
                                                        aria-label="Floating label select example">
                                                        <option value="1">1992</option>
                                                        <option value="2">1993</option>
                                                        <option value="2">1994</option>
                                                    </select>
                                                    <label for="adualtExpiryYear"
                                                        class="text-capitalize text-black fw-medium">
                                                        Expiry Year
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white shadow rounded mb-3">
                            <div class="p-4 border-bottom">
                                <h5 class="m-0">Payment Methods</h5>
                            </div>
                            <div class="p-3">
                                <div class="row row-gap-3 mb-3">
                                    <div class="col-md">
                                        <input type="radio" class="btn-check" id="paypal" name="payment-methods"
                                            autocomplete="off" checked>
                                        <label class="btn btn-outline-primary fw-medium text-capitalize w-100"
                                            for="paypal">
                                            Pay With paypal
                                        </label>
                                    </div>
                                    <div class="col-md">
                                        <input type="radio" class="btn-check" id="bankTransfer" name="payment-methods"
                                            autocomplete="off">
                                        <label class="btn btn-outline-primary fw-medium text-capitalize w-100"
                                            for="bankTransfer">
                                            bank transfer
                                        </label>
                                    </div>
                                    <div class="col-md">
                                        <input type="radio" class="btn-check" id="payLater" name="payment-methods"
                                            autocomplete="off">
                                        <label class="btn btn-outline-primary fw-medium text-capitalize w-100"
                                            for="payLater">
                                            Pay later
                                        </label>
                                    </div>
                                    <div class="col-md">
                                        <input type="radio" class="btn-check" id="stripe" name="payment-methods"
                                            autocomplete="off">
                                        <label class="btn btn-outline-primary fw-medium text-capitalize w-100"
                                            for="stripe">
                                            Pay with stripe
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <button class="btn btn-primary text-capitalize w-100 mb-5 fs-5" type="submit">
                                    Confirm Booking
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="sticky-md-top">
                            <div class="bg-primary rounded text-white">
                                <div class="p-4 border-bottom">
                                    <h5 class="text-white fw-medium m-0">
                                        Oneway Flight Details
                                    </h5>
                                </div>
                                <div class="p-3">
                                    <div class="row row-gap-3 mb-3">
                                        <div class="col-md">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fs-5">
                                                    LHE
                                                </span>
                                                <span>
                                                    <i class="fa-solid fa-arrow-right-long"></i>
                                                </span>
                                                <span class="fs-5">
                                                    DXB
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="d-flex align-items-center gap-2 fs-5">
                                                01:03
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <span class="fs-2">
                                                <i class="fa-solid fa-plane-departure"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row row-gap-2 mb-3">
                                        <div class="col-md">
                                            <span class="text-capitalize fw-medium ">
                                                Flight
                                            </span>
                                        </div>
                                        <div class="col-md">
                                            <span class="text-capitalize">
                                                6
                                            </span>
                                        </div>

                                    </div>
                                    <div class="row row-gap-2 mb-2">
                                        <div class="col-md">
                                            <span class="text-capitalize fw-medium ">
                                                Flight Class
                                            </span>
                                        </div>
                                        <div class="col-md">
                                            <span class="text-capitalize">
                                                economy
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row row-gap-2 mb-2">
                                        <div class="col-md">
                                            <span class="text-capitalize fw-medium ">
                                                Airline
                                            </span>
                                        </div>
                                        <div class="col-md">
                                            <span class="text-capitalize">
                                                Pakistan International Airlines
                                            </span>
                                        </div>
                                    </div>

                                    <hr class="my-3">

                                    <div class="">
                                        <div class="row row-gap-2 mb-2">
                                            <div class="col-md">
                                                <span class="text-capitalize fw-medium ">
                                                    Baggage
                                                </span>
                                            </div>
                                            <div class="col-md">
                                                <span class="text-capitalize">
                                                    45
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row row-gap-2 mb-2">
                                            <div class="col-md">
                                                <span class="text-capitalize fw-medium ">
                                                    Cabin Baggage
                                                </span>
                                            </div>
                                            <div class="col-md">
                                                <span class="text-capitalize">
                                                    20
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-3">

                                    <div class="">
                                        <div class="row row-gap-2 mb-2">
                                            <div class="col-md">
                                                <span class="text-capitalize fw-medium ">
                                                    Price
                                                </span>
                                            </div>
                                            <div class="col-md">
                                                <span class="text-capitalize">
                                                    USD 100.00
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row row-gap-2 mb-2">
                                            <div class="col-md">
                                                <span class="text-capitalize fw-medium ">
                                                    VAT
                                                </span>
                                            </div>
                                            <div class="col-md">
                                                <span class="text-capitalize">
                                                    (0%)
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 border-top">
                                    <div class="row">
                                        <div class="col-md">
                                            <span class="fs-4 fw-medium">
                                                Total
                                            </span>
                                        </div>
                                        <div class="col-md">
                                            <span class="fs-4 fw-medium">
                                                USD 100.00
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
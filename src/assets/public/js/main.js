import "../scss/main.scss";

import FlightSearch from "./ajax/flight-search.js";
import AirlineSearch from "./modules/airlines-search.js";
import AirportSearch from "./modules/airports-search.js";
import DatePicker from "./modules/date-picker.js";
import TravelersCounter from "./modules/travelers-counter.js";
import FlightToggle from "./modules/flight-toggle.js";

console.log("Public JS loaded");

// show and hide return date
// $(document).ready(function () {
//   if ($("#one-way").is(":checked")) {
//     $("#return-date-wrapper").hide();
//   }

//   $("#one-way").on("change", function () {
//     if ($(this).is(":checked")) {
//       $("#return-date-wrapper").hide();
//     }
//   });

//   $("#round-trip, #multi-trip").on("change", function () {
//     if ($(this).is(":checked")) {
//       $("#return-date-wrapper").show();
//     }
//   });
// });

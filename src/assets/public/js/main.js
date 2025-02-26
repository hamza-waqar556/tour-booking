import "../scss/main.scss";
import FlightSearch from "./ajax/flight-search.js";
import AirlineSearch from "./modules/airlines-search.js";

console.log("Public JS loaded");

jQuery(document).ready(() => {
  new FlightSearch();

  
});

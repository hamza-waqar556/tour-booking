import "../scss/main.scss";
import FlightSearch from "./ajax/flight-search.js";
// import SearchableSelect from "./modules/search-able-select.js";

console.log("Public JS loaded");

jQuery(document).ready(() => {
  new FlightSearch();
});

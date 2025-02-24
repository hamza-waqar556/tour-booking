import "../scss/main.scss";
import FlightSearch from "./ajax/flight-search.js";

console.log("Public JS loaded");

jQuery(document).ready(() => {
  new FlightSearch();
});

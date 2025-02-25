import "../scss/admin.scss";
import SearchableSelect from "./modules/searchable-select.js";
import AirportSearchableSelect from "./modules/airport-searchable-select.js";
import AirlineSearchableSelect from "./modules/airline-searchable-select.js";
import MultiSelect from "./modules/multi-select.js";
console.log("Admin JS loaded");

// $(document).ready(function () {
//   $("[data-airlines]").each(function () {
//     new AirlineSearchableSelect(this);
//   });
// });

// Leave this for now
window.addEventListener("load", function () {
  // Store tabs variable
  var tabs = document.querySelectorAll("ul.nav-tabs > li");

  for (let i = 0; i < tabs.length; i++) {
    tabs[i].addEventListener("click", switchTab);
  }

  function switchTab(event) {
    event.preventDefault();

    document.querySelector("ul.nav-tabs li.active").classList.remove("active");
    document.querySelector(".tab-pane.active").classList.remove("active");

    var clickedTab = event.currentTarget;
    var anchor = event.target;
    var activePaneID = anchor.getAttribute("href");

    clickedTab.classList.add("active");
    document.querySelector(activePaneID).classList.add("active");
  }
});

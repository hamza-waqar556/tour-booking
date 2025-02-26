// AirlineSearch.js
class AirlineSearch {
  constructor(container) {
    // console.log(AIOB.plugin);
    // console.log($(container));
    // return;

    this.$container = $(container);
    this.$input = this.$container.find(".airline-search-input");
    this.$results = this.$container.find(".airline-search-results");
    this.init();
  }

  init() {
    // Hide results by default
    this.$results.hide();
    this.bindEvents();
  }

  bindEvents() {
    // Bind the keyup event on the search input
    this.$input.on("keyup", this.onKeyUp.bind(this));
    // Bind click event for result selection
    this.$results.on("click", "li", this.onResultClick.bind(this));
    // Hide results if clicking outside the container
    $(document).on("click", this.onDocumentClick.bind(this));
  }

  onKeyUp() {
    const query = this.$input.val().trim();
    if (query.length < 2) {
      this.$results.hide();
      // Reset input style if query is too short.
      this.$input.css({ "background-image": "none", "padding-left": "8px" });
      return;
    }
    // Remove any previously set background image.
    this.$input.css({ "background-image": "none", "padding-left": "8px" });
    this.loadAirlines(query);
  }

  loadAirlines(query) {
    $.ajax({
      url: AIOB.plugin.ajax_url, // WordPress provides this global variable for admin-ajax.php
      method: "POST",
      dataType: "json",
      data: {
        action: "searchAirlines",
        q: query,
      },
      success: (response) => {
        let resultsHTML = "";
        if (response.success && response.data.length) {
          $.each(response.data, (index, airline) => {
            resultsHTML += `<li style="padding:8px; border-bottom:1px solid #eee; display:flex; align-items:center; cursor:pointer;">
                                <img src="${airline.logo}" alt="${airline.code}" style="width:30px; height:30px; margin-right:10px;" />
                                <span>${airline.name} - ${airline.code}</span>
                              </li>`;
          });
          this.$results.html(resultsHTML).show();
        } else {
          this.$results
            .html('<li style="padding:8px;">No results found</li>')
            .show();
        }
      },
      error: (xhr, status, error) => {
        console.log("Error fetching airlines: " + error);
      },
    });
  }

  onResultClick(e) {
    const $selected = $(e.currentTarget);
    const text = $selected.find("span").text();
    const logo = $selected.find("img").attr("src");
    this.$input.val(text);
    this.$results.hide();
    // Update the input's background image to the selected airline logo.
    this.$input.css({
      "background-image": `url(${logo})`,
      "background-repeat": "no-repeat",
      "background-size": "30px 30px",
      "background-position": "5px center",
      "padding-left": "40px",
    });
  }

  onDocumentClick(e) {
    if (!$(e.target).closest(this.$container).length) {
      this.$results.hide();
    }
  }
}

// Initializing the Class
jQuery(document).ready(() => {
  $(".airline-search-container").each(function () {
    new AirlineSearch(this);
  });
});
// Export the class
export default AirlineSearch;

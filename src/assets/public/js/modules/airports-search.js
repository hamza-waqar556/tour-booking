class AirportSearch {
  constructor(container) {
    // Cache the container element
    this.$container = $(container);
    // Find the wrapper that contains the input field
    this.$inputWrapper = this.$container.find(".airport-search-input-wrapper");
    // Find the text input for searching airports
    this.$input = this.$container.find(".airport-search-input");
    // Find the element that will display the airport code (for visual purposes)
    this.$codeBox = this.$container.find(".airport-code-box-input");
    // Find the container for search results
    this.$results = this.$container.find(".airport-search-results");

    // Dynamically create a hidden input for storing the airport code
    // Use the text input's name attribute, and append '_code' to it.
    const inputName = this.$input.attr("name") || "city_code";
    const hiddenName = inputName + "_code";
    this.$hiddenCodeInput = this.$inputWrapper.find(
      "input.airport-search-code"
    );
    if (!this.$hiddenCodeInput.length) {
      this.$hiddenCodeInput = $(
        `<input type="hidden" name="${hiddenName}" class="airport-search-code" />`
      );
      this.$inputWrapper.append(this.$hiddenCodeInput);
    }

    // Initialize the search functionality
    this.init();
  }

  // Initialize: hide results and bind event handlers
  init() {
    this.$results.hide();
    this.bindEvents();
  }

  // Bind events for input, result clicks, and document clicks
  bindEvents() {
    // On keyup in the input, handle search
    this.$input.on("keyup", this.onKeyUp.bind(this));
    // Delegate click event on result items
    this.$results.on("click", "li", this.onResultClick.bind(this));
    // Hide results if clicking outside of the container
    $(document).on("click", this.onDocumentClick.bind(this));
  }

  // Called when the user types into the search input
  onKeyUp() {
    const query = this.$input.val().trim();
    if (query.length < 2) {
      this.$results.hide();
      return;
    }
    this.loadAirports(query);
  }

  // AJAX call to load airports matching the query
  loadAirports(query) {
    $.ajax({
      url: AIOB.plugin.ajax_url, // AJAX endpoint URL
      method: "POST",
      dataType: "json",
      data: {
        action: "searchAirports", // Server-side action
        q: query, // Query string
      },
      success: (response) => {
        let resultsHTML = "";
        if (response.success && response.data.length) {
          $.each(response.data, (index, airport) => {
            resultsHTML += `
              <li data-code="${airport.code}" data-name="${airport.name}">
                <div class="airport-code-box">
                  <span>${airport.code}</span>
                </div>
                <div class="airport-info">
                  <div class="airport-location">
                    ${airport.city}
                    ${airport.state ? ", " + airport.state : ""}
                    ${airport.country ? ", " + airport.country : ""}
                  </div>
                  <div class="airport-name">${airport.name}</div>
                </div>
              </li>
            `;
          });
          this.$results.html(resultsHTML).show();
        } else {
          this.$results
            .html('<li style="padding:8px;">No results found</li>')
            .show();
        }
      },
      error: (xhr, status, error) => {
        console.log("Error fetching airports: " + error);
      },
    });
  }

  // Called when a user clicks on a search result
  onResultClick(e) {
    const $selected = $(e.currentTarget);
    const code = $selected.data("code");
    const name = $selected.data("name");
    // Update the input text with the selected airport name

    this.$input.val(name);
    // Update the visible code box with the airport code
    this.$codeBox.html(`<span>${code}</span>`);
    // Update the hidden input with the airport code for form submission
    this.$hiddenCodeInput.val(code);
    // Hide the search results
    this.$results.hide();
  }

  // Hide results when clicking outside of the search container
  onDocumentClick(e) {
    if (!$(e.target).closest(this.$container).length) {
      this.$results.hide();
    }
  }
}

// Initialize the AirportSearch class on each airport search container
jQuery(document).ready(() => {
  $(".airport-search-container").each(function () {
    new AirportSearch(this);
  });
});

// Export the class using ES modules
export default AirportSearch;

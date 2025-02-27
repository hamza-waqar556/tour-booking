class AirportSearch {
  constructor(container) {
    this.$container = $(container);
    this.$inputWrapper = this.$container.find(".airport-search-input-wrapper");
    this.$input = this.$container.find(".airport-search-input");
    this.$codeBox = this.$container.find(".airport-code-box-input");
    this.$results = this.$container.find(".airport-search-results");
    this.init();
  }

  init() {
    this.$results.hide();
    this.bindEvents();
  }

  bindEvents() {
    this.$input.on("keyup", this.onKeyUp.bind(this));
    this.$results.on("click", "li", this.onResultClick.bind(this));
    $(document).on("click", this.onDocumentClick.bind(this));
  }

  onKeyUp() {
    const query = this.$input.val().trim();
    if (query.length < 2) {
      this.$results.hide();
      return;
    }
    this.loadAirports(query);
  }

  loadAirports(query) {
    $.ajax({
      url: AIOB.plugin.ajax_url, // Use AIOB.plugins.ajax_url for AJAX calls.
      method: "POST",
      dataType: "json",
      data: {
        action: "searchAirports",
        q: query,
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
                        ${airport.city}${
              airport.state ? ", " + airport.state : ""
            }${airport.country ? ", " + airport.country : ""}
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

  onResultClick(e) {
    const $selected = $(e.currentTarget);
    const code = $selected.data("code");
    const name = $selected.data("name");
    // Update the input text with the airport name.
    this.$input.val(name);
    // Update the code box inside the input wrapper.
    this.$codeBox.html(`<span>${code}</span>`);
    this.$results.hide();
  }

  onDocumentClick(e) {
    if (!$(e.target).closest(this.$container).length) {
      this.$results.hide();
    }
  }
}

// Initialize the class
jQuery(document).ready(() => {
  $(".airport-search-container").each(function () {
    new AirportSearch(this);
  });
});

// Export the class
export default AirportSearch;

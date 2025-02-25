class AirlineSearchableSelect {
  constructor(container, jsonPath) {
    this.container = $(container);
    this.jsonPath = jsonPath;

    this.options = [];
    this.filteredOptions = [];
    this.hiddenInput = $(`#${this.container.attr("id")}-input`);

    this.init();
  }

  async init() {
    this.container.addClass("aiob-searchable-dropdown");

    this.input = $("<input>", {
      type: "text",
      placeholder: "Search airlines...",
    });
    this.list = $("<ul>").addClass("aiob-searchable-dropdown-list");

    this.container.append(this.input, this.list);

    // Load all options
    await this.loadOptions();

    // Pre-fill input if there's a stored value
    if (this.hiddenInput.val()) {
      this.input.val(this.hiddenInput.val()); // Set value without opening dropdown
    }

    // Ensure dropdown is hidden on load
    this.toggleDropdown(false);

    // Event Listeners
    this.input.on("click", () => this.toggleDropdown(true));
    this.input.on(
      "keyup",
      this.debounce(() => this.handleSearch(), 300)
    ); // Debounced search
    $(document).on("click", (event) => this.handleClickOutside(event));
  }

  async loadOptions() {
    try {
      const response = await fetch(this.jsonPath);
      this.options = await response.json();

      // Ensure correct data structure
      this.options = this.options.filter(
        (option) =>
          option.name &&
          typeof option.name === "string" &&
          option.iata &&
          typeof option.iata === "string"
      );

      this.filteredOptions = [...this.options]; // Show all options initially
    } catch (error) {
      console.error("Error loading airline data:", error);
    }
  }

  handleSearch() {
    const searchValue = this.input.val().trim().toLowerCase();

    if (!searchValue) {
      this.filteredOptions = [...this.options]; // Reset to all options when empty
    } else {
      this.filteredOptions = this.options.filter(
        (option) =>
          option.name.toLowerCase().includes(searchValue) ||
          (option.iata && option.iata.toLowerCase().includes(searchValue))
      );
    }

    this.populateList(); // Re-populate list after filtering
  }

  populateList() {
    this.list.empty();
    if (this.filteredOptions.length === 0) {
      this.list.append($("<li>").text("No results found"));
    } else {
      this.filteredOptions.forEach((option) => {
        const li = $("<li>")
          .text(`${option.name} (${option.iata})`)
          .on("click", () => this.selectOption(option));

        this.list.append(li);
      });
    }
    this.toggleDropdown(true);
  }

  toggleDropdown(show) {
    if (show) {
      this.list.css("display", "block");
    } else {
      this.list.css("display", "none");
    }
  }

  selectOption(option) {
    this.input.val(option.name);
    if (this.hiddenInput.length) {
      this.hiddenInput.val(option.name + " (" + option.iata + ")");
    }
    this.toggleDropdown(false);
  }

  handleClickOutside(event) {
    if (
      !this.container.is(event.target) &&
      !this.container.has(event.target).length
    ) {
      this.toggleDropdown(false);
    }
  }

  // Utility function: Debounce
  debounce(func, delay) {
    let timer;
    return function (...args) {
      clearTimeout(timer);
      timer = setTimeout(() => func.apply(this, args), delay);
    };
  }
}

// Auto-initialize on elements with `data-airlines`
$(document).ready(function () {
  $("[data-airlines]").each(function () {
    const fileName = $(this).data("file"); // Get the JSON file name from data attribute
    new AirlineSearchableSelect(
      this,
      AIOB.plugin.url + "src/assets/public/data/" + fileName
    );
  });
});

console.log("Airline Searchable Select initialized.");
export default AirlineSearchableSelect;

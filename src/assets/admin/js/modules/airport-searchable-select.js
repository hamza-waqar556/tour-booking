class AirportSearchableSelect {
  constructor(container, jsonPath) {
    this.container = $(container);
    this.jsonPath = jsonPath;

    this.input = this.container.find("input[type='text']");
    this.list = this.container.find("ul.aiob-searchable-dropdown-list");
    this.hiddenInput = this.container.next("input[type='hidden']");

    this.options = [];
    this.filteredOptions = [];

    this.init();
  }

  async init() {
    // Load options
    await this.loadOptions();

    // Pre-fill input if there's a stored value
    if (this.hiddenInput.val()) {
      this.input.val(this.hiddenInput.val()); // Set stored value
    }

    // Ensure dropdown is hidden on load
    this.toggleDropdown(false);

    // Event Listeners
    this.input.on("click", () => this.toggleDropdown(true));
    this.input.on(
      "keyup",
      this.debounce(() => this.handleSearch(), 300)
    );
    $(document).on("click", (event) => this.handleClickOutside(event));
  }

  async loadOptions() {
    try {
      const response = await fetch(this.jsonPath);
      this.options = await response.json();

      // Ensure correct data structure
      this.options = this.options.filter(
        (option) =>
          option.airport &&
          typeof option.airport === "string" &&
          option.code &&
          typeof option.code === "string"
      );

      this.filteredOptions = [...this.options]; // Show all options initially
    } catch (error) {
      console.error("Error loading airport data:", error);
    }
  }

  handleSearch() {
    const searchValue = this.input.val().trim().toLowerCase();

    if (!searchValue) {
      this.filteredOptions = [...this.options]; // Reset to all options when empty
    } else {
      this.filteredOptions = this.options.filter(
        (option) =>
          option.airport.toLowerCase().includes(searchValue) ||
          option.city.toLowerCase().includes(searchValue) ||
          option.country.toLowerCase().includes(searchValue) ||
          option.code.toLowerCase().includes(searchValue)
      );
    }

    this.populateList();
  }

  populateList() {
    this.list.empty();
    if (this.filteredOptions.length === 0) {
      this.list.append($("<li>").text("No results found"));
    } else {
      this.filteredOptions.forEach((option) => {
        const li = $("<li>")
          .text(`${option.airport} (${option.code})`)
          .on("click", () => this.selectOption(option));

        this.list.append(li);
      });
    }
    this.toggleDropdown(true);
  }

  toggleDropdown(show) {
    this.list.css("display", show ? "block" : "none");
  }

  selectOption(option) {
    const selectedText = `${option.airport} (${option.code})`;
    this.input.val(selectedText);
    if (this.hiddenInput.length) {
      this.hiddenInput.val(selectedText);
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

  debounce(func, delay) {
    let timer;
    return function (...args) {
      clearTimeout(timer);
      timer = setTimeout(() => func.apply(this, args), delay);
    };
  }
}

// Auto-initialize for multiple airport dropdowns
$(document).ready(function () {
  $("[data-airports]").each(function () {
    const fileName = $(this).data("file");
    new AirportSearchableSelect(
      this,
      AIOB.plugin.url + "src/assets/public/data/" + fileName
    );
  });
});

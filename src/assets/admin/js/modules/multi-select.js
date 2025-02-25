class MultiSelect {
  constructor(element) {
    this.element = element;
    this.selectedContainer = element.querySelector(".aiob-selected-options");
    this.dropdown = element.querySelector(".multi-select-dropdown");
    this.hiddenInput = element.querySelector('input[name="hotel_amenities"]'); // Hidden input

    // Parse multi-options from attribute
    this.options = this.getOptionsFromAttribute();
    this.selectedValues = this.hiddenInput.value
      ? this.hiddenInput.value.split(",")
      : [];

    this.init();
  }

  getOptionsFromAttribute() {
    try {
      return JSON.parse(this.element.getAttribute("data-multi-options")) || [];
    } catch (error) {
      console.error("Invalid JSON in data-multi-options:", error);
      return [];
    }
  }

  init() {
    this.selectedContainer.addEventListener("click", (e) => {
      e.stopPropagation();
      this.toggleDropdown();
    });
    document.addEventListener("click", (e) => this.handleClickOutside(e));
    this.renderOptions();
    this.updateSelectedDisplay(); // Load selected values
  }

  toggleDropdown() {
    this.dropdown.style.display =
      this.dropdown.style.display === "block" ? "none" : "block";
  }

  handleClickOutside(event) {
    if (!this.element.contains(event.target)) {
      this.dropdown.style.display = "none";
    }
  }

  renderOptions() {
    this.dropdown.innerHTML = "";
    this.options.forEach((option) => {
      const div = document.createElement("div");
      div.textContent = option;
      div.classList.add("multi-select-option");
      div.addEventListener("click", () => this.selectOption(option));

      // Highlight selected options
      if (this.selectedValues.includes(option)) {
        div.classList.add("selected");
      }

      this.dropdown.appendChild(div);
    });
  }

  selectOption(option) {
    if (this.selectedValues.includes(option)) {
      this.selectedValues = this.selectedValues.filter((val) => val !== option);
    } else {
      this.selectedValues.push(option);
    }
    this.updateSelectedDisplay();
  }

  updateSelectedDisplay() {
    this.selectedContainer.innerHTML = "";
    if (this.selectedValues.length === 0) {
      this.selectedContainer.textContent = "Select options";
    } else {
      this.selectedValues.forEach((option) => {
        const span = document.createElement("span");
        span.classList.add("aiob-single-option");
        span.textContent = option;

        const removeBtn = document.createElement("span");
        removeBtn.classList.add("remove-single-option");
        removeBtn.textContent = "×";
        removeBtn.addEventListener("click", (e) => {
          e.stopPropagation();
          this.removeOption(option);
        });

        span.appendChild(removeBtn);
        this.selectedContainer.appendChild(span);
      });
    }

    // ✅ Update hidden input field
    this.hiddenInput.value = this.selectedValues.join(",");
  }

  removeOption(option) {
    this.selectedValues = this.selectedValues.filter((val) => val !== option);
    this.updateSelectedDisplay();
  }
}

// Auto-initialize
document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelectorAll(".aiob-multi-select")
    .forEach((el) => new MultiSelect(el));
});

export default MultiSelect;

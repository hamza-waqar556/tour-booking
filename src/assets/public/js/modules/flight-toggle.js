class FlightToggle {
  /**
   * @param {jQuery|Element|string} container - The container element for the toggle group.
   * @param {string} returnWrapperSelector - The selector for the return date wrapper element.
   */
  constructor(container, returnWrapperSelector) {
    this.$container = $(container);
    this.$returnWrapper = $(returnWrapperSelector);
    this.init();
  }

  init() {
    // Set initial state on load.
    if (this.$container.find("#one-way").is(":checked")) {
      this.$returnWrapper.hide();
    } else {
      this.$returnWrapper.show();
    }

    // Bind change events on all radio buttons.
    this.$container.find("input[name='flights']").on("change", () => {
      // When one-way is selected, hide the return date wrapper; otherwise show it.
      if (this.$container.find("#one-way").is(":checked")) {
        this.$returnWrapper.hide();
      } else {
        this.$returnWrapper.show();
      }
    });
  }
}

// Usage Example:
$(document).ready(function () {
  // Instantiate the FlightToggle class on the toggle container
  // and pass the selector for the return date wrapper.
  new FlightToggle(".flights-toggle", "#return-date-wrapper");
});

export default FlightToggle;

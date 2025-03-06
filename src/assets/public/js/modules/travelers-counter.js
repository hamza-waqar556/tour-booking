class TravelersCounter {
  /**
   * @param {jQuery|Element|string} container - The container element for this travelers counter.
   * @param {Object} options - Optional settings.
   *    options.min: Minimum count value (default 0)
   *    options.max: Maximum count value (default 12)
   */
  constructor(container, options = {}) {
    this.$container = $(container);
    this.min = options.min || 0;
    this.max = options.max || 12;
    this.types = ["adults", "children", "infants"];
    this.init();
  }

  init() {
    const self = this;

    // this.$container.find(".travelers-dropdown").hide();

    // Toggle dropdown when clicking the summary input.
    this.$container.find(".travelers-summary").on("click", function (e) {
      e.stopPropagation();
      self.$container.find(".travelers-dropdown").toggle();
    });

    // Prevent dropdown from closing when clicking inside it.
    this.$container.find(".travelers-dropdown").on("click", function (e) {
      e.stopPropagation();
    });

    // Bind increase and decrease events on the dropdown controls.
    this.$container.find(".increase").on("click", function (e) {
      e.preventDefault();
      const $item = $(this).closest(".travelers-item");
      const type = self.getTypeFromItem($item);
      const $countEl = $item.find(".count");
      let currentValue = parseInt($countEl.text(), 10);

      if (currentValue < self.max) {
        if (type === "adults") {
          // Simply increase adults.
          $countEl.text(currentValue + 1);
        } else if (type === "children" || type === "infants") {
          // Only allow increasing children/infants if they don't exceed adults count.
          const adultsCount = parseInt(
            self.$container.find(".travelers-item.adults .count").text(),
            10
          );
          if (currentValue + 1 <= adultsCount) {
            $countEl.text(currentValue + 1);
          }
        }
      }
      self.updateAll();
    });

    this.$container.find(".decrease").on("click", function (e) {
      e.preventDefault();
      const $item = $(this).closest(".travelers-item");
      const $countEl = $item.find(".count");
      let currentValue = parseInt($countEl.text(), 10);

      if (currentValue > self.min) {
        $countEl.text(currentValue - 1);
      }
      self.updateAll();
    });

    // Hide dropdown when clicking anywhere outside the travelers counter.
    $(document).on("click", function () {
      self.$container.find(".travelers-dropdown").hide();
    });

    // Initialize summary and hidden inputs.
    self.updateAll();
  }

  // Returns the traveler type (adults, children, or infants) from the item’s classes.
  getTypeFromItem($item) {
    for (const type of this.types) {
      if ($item.hasClass(type)) {
        return type;
      }
    }
    return null;
  }

  // Update the summary input and hidden inputs.
  updateAll() {
    let total = 0;
    this.types.forEach((type) => {
      const $item = this.$container.find(`.travelers-item.${type}`);
      const count = parseInt($item.find(".count").text(), 10) || 0;
      total += count;
      // Update corresponding hidden input.
      $item.find(".hidden-input").val(count);
    });
    this.$container.find(".travelers-summary").val(`Travelers: ${total}`);
  }
}

// Usage example:
$(document).ready(function () {
  // Instantiate the travelers counter on the container element.
  new TravelersCounter(".travelers-counter");
});

export default TravelersCounter;

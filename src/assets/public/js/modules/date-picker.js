class DatePicker {
  /**
   * @param {Array} configs - Array of config objects. Each config should have:
   *    - selector: string for the datepicker element.
   *    - linked (optional): string selector for another datepicker that should be linked.
   *    - offset (optional): number of days to add to the linked date’s minDate (default is 0).
   */
  constructor(configs) {
    this.configs = configs;
    this.datePickers = {};
    this.init();
  }

  init() {
    this.configs.forEach((config) => {
      const { selector, linked, offset = 0 } = config;

      // Initialize the datepicker for this selector with the desired date format.
      this.datePickers[selector] = $(selector).datepicker({
        dateFormat: "yy-mm-dd", // Updated date format
        minDate: 0,
        onSelect: (selectedDate, instance) => {
          if (linked) {
            // Get the selected date from the current picker.
            const date = $(selector).datepicker("getDate");
            if (date) {
              // Add an offset (if desired) to ensure the linked date is after the current date.
              date.setDate(date.getDate() + offset);
              // Update the linked datepicker's minDate.
              $(linked).datepicker("option", "minDate", date);

              // Optional: if the linked date is earlier than the new minDate, update it.
              const linkedDate = $(linked).datepicker("getDate");
              if (linkedDate && linkedDate < date) {
                $(linked).datepicker("setDate", date);
              }
            }
          }
        },
      });
    });
  }
}

// Usage example
jQuery(document).ready(() => {
  new DatePicker([
    // When a departure date is selected, the return date will have a minDate of departure date + 1 day.
    { selector: "#departure-date", linked: "#return-date", offset: 1 },
    { selector: "#return-date" },
  ]);
});

// Export the class
export default DatePicker;

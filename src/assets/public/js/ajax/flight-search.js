class FlightSearch {
  constructor() {
    this.initEvents();
  }

  initEvents() {
    $("#flight-search-form").on("submit", (e) => this.handleSubmit(e));
  }

  handleSubmit(e) {
    e.preventDefault();

    let formData = {
      origin: $("#origin").val(),
      destination: $("#destination").val(),
      departure_date: $("#departure_date").val(),
      return_date: $("#return_date").val(),
      adults: $("#adults").val(),
      max_results: $("#max_results").val(),
    };

    this.fetchFlights(formData);
  }

  fetchFlights(formData) {
    $.ajax({
      url: AIOB.routes.search_flights,
      method: "POST",
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", AIOB.nonce);
      },
      data: formData,
      success: (response) => this.handleSuccess(response),
      error: (error) => this.handleError(error),
    });
  }

  handleSuccess(response) {
    if (response.error) {
      $("#search-results").html(`<p>Error: ${response.error}</p>`);
    } else {
      let resultsHtml = "<ul>";
      response.forEach((flight) => {
        resultsHtml += `<li>${flight.origin} to ${flight.destination} - ${flight.price}</li>`;
      });
      resultsHtml += "</ul>";
      $("#search-results").html(resultsHtml);
    }
  }

  handleError(error) {
    $("#search-results").html("<p>Something went wrong!</p>");
    console.log(error);
  }
}

export default FlightSearch;

// Initialize the class when document is ready
// $(document).ready(() => {
//   new FlightSearch();
// });

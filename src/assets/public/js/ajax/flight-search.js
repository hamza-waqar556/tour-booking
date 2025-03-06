class FlightSearch {
  constructor() {
    this.initEvents();
  }

  initEvents() {
    $("#searchFlights").on("submit", (e) => this.handleSubmit(e));
  }

  handleSubmit(e) {
    e.preventDefault();

    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData.entries());

    this.fetchFlights(data);
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
    // console.log(response);

    // return;

    if (!response.success) {
      $("#search-results").html(`<p>Error: ${response.error}</p>`);
      return;
    }
    let resultsHtml = "<ul>";
    response.forEach((flight) => {
      resultsHtml += `<li>${flight.origin} to ${flight.destination} - ${flight.price}</li>`;
    });
    resultsHtml += "</ul>";
    $("#search-results").html(resultsHtml);
  }

  handleError(error) {
    $("#search-results").html("<p>Something went wrong!</p>");
    console.log(error);
  }
}

// Initialize the class when document is ready
jQuery(document).ready(() => {
  new FlightSearch();
});

export default FlightSearch;

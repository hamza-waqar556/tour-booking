<!--
 /**
 * ShortCode Flights
 */
 -->


<form id="flight-search-form">
    <input type="text" id="origin" name="origin" placeholder="Origin" value="ISB" >
    <input type="text" id="destination" name="destination" placeholder="Destination" value="LYP" >
    <input type="date" id="departure_date" name="departure_date" value="2025-02-25" >
    <input type="date" id="return_date" name="return_date">
    <input type="number" id="adults" name="adults" placeholder="Adults" min="1" value="1">
    <input type="number" id="max_results" name="max_results" placeholder="Max Results" min="1" value="3">
    <button type="submit">Search Flights</button>
</form>

<div id="search-results"></div>

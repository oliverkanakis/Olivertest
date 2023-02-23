function calculate() {
  // Get the selected quarter value
  var quarterSelect = document.getElementById("quarter");
  var quarterValue = quarterSelect.options[quarterSelect.selectedIndex].value;
  
  // Get the total downtime value
  var downtimeInput = document.getElementById("downtime");
  var downtimeValue = downtimeInput.value;
  
  // Calculate the total uptime percentage
  var totalMinutes = parseInt(quarterValue);
  var totalDowntime = parseInt(downtimeValue);
  var uptimePercentage = ((totalMinutes - totalDowntime) / totalMinutes) * 100;
  
  // Display the result
  var resultElement = document.getElementById("output");
  resultElement.innerHTML = "Total Uptime %: " + uptimePercentage.toFixed(2) + "%";
}

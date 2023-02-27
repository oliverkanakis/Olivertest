function calculate() {
  // Get the selected quarter value
  const quarterSelect = document.getElementById("quarter");
  const quarterValue = quarterSelect.options[quarterSelect.selectedIndex].value;
  
  // Get the total downtime value
  const downtimeInput = document.getElementById("downtime");
  const downtimeValue = downtimeInput.value;
  
  // Calculate the total uptime percentage
  const totalMinutes = parseInt(quarterValue);
  const totalDowntime = parseInt(downtimeValue);
  const uptimePercentage = ((totalMinutes - totalDowntime) / totalMinutes) * 100;
  
  // Display the result
  const resultElement = document.getElementById("output");
  resultElement.innerHTML = "Total uptime: " + uptimePercentage.toFixed(3) + "%";
}

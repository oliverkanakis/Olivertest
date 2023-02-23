function calculate() {
  // Get the selected quarter value
  var quarterSelect = document.getElementById("quarter");
  var quarterValue = quarterSelect.options[quarterSelect.selectedIndex].value;
  
  // Get the downtime value
  var downtimeInput = document.getElementById("downtime");
  var downtimeValue = downtimeInput.value;
  
  // Calculate the result
  var totalTime = parseInt(quarterValue);
  var result = (totalTime - parseInt(downtimeValue)) / totalTime;
  
  // Display the result
  var resultElement = document.getElementById("output");
  resultElement.innerHTML = "Result: " + result.toFixed(2);
}

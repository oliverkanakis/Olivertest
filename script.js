const quarterTime = {
    Q1: 129600,
    Q2: 131040,
    Q3: 132480,
    Q4: 132480
};

const calcForm = document.getElementById('calc-form');
const quarterSelect = document.getElementById('quarter-select');
const downtimeInput = document.getElementById('downtime-input');
const resultDiv = document.getElementById('result');

calcForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent the default form submission behavior
    
    const selectedQuarter = quarterSelect.value;
    const downtime = parseInt(downtimeInput.value, 10);
    const totalQuarterTime = quarterTime[selectedQuarter];
    
    if (isNaN(downtime)) {
        resultDiv.innerText = 'Please insert a valid downtime value.';
        return;
    }
    
    const uptimePercentage = (totalQuarterTime - downtime) / totalQuarterTime * 100;
    resultDiv.innerText = `Quarter ${selectedQuarter}: ${uptimePercentage.toFixed(2)}% uptime`;
});

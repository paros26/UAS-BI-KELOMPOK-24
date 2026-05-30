// Dynamic Chart.js Configuration for Executive Dashboard

document.addEventListener('DOMContentLoaded', function() {
    // Access data from global variables defined in dashboard.php
    if (typeof catDist === 'undefined') return;

    const catLabels = Object.keys(catDist);
    const catData = Object.values(catDist);
    
    const genderLabels = Object.keys(genderDist);
    const genderData = Object.values(genderDist);
    
    const ageLabels = Object.keys(ageDist);
    const ageData = Object.values(ageDist);
    
    const payLabels = Object.keys(paymentDist);
    const payData = Object.values(paymentDist);

    // 1. Category Chart
    const ctxCategory = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'bar',
        data: {
            labels: catLabels,
            datasets: [{
                label: 'Total Revenue ($)',
                data: catData,
                backgroundColor: '#3B82F6',
                borderRadius: 8,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true }, x: { grid: { display: false } } }
        }
    });

    // 2. Gender Chart
    const ctxGender = document.getElementById('genderChart').getContext('2d');
    new Chart(ctxGender, {
        type: 'doughnut',
        data: {
            labels: genderLabels,
            datasets: [{
                data: genderData,
                backgroundColor: ['#3B82F6', '#8B5CF6'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%'
        }
    });

    // 3. Age Distribution
    const ctxAge = document.getElementById('ageDistChart').getContext('2d');
    new Chart(ctxAge, {
        type: 'line',
        data: {
            labels: ageLabels,
            datasets: [{
                label: 'Customers',
                data: ageData,
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // 4. Payment Chart
    const ctxPayment = document.getElementById('paymentChart').getContext('2d');
    new Chart(ctxPayment, {
        type: 'pie',
        data: {
            labels: payLabels,
            datasets: [{
                data: payData,
                backgroundColor: ['#3B82F6', '#60A5FA', '#93C5FD', '#8B5CF6', '#A78BFA', '#C4B5FD'],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 10 } } }
        }
    });

    // 5. Frequency Chart
    if (document.getElementById('frequencyChart')) {
        const freqLabels = Object.keys(freqDist);
        const freqData = Object.values(freqDist);
        const ctxFreq = document.getElementById('frequencyChart').getContext('2d');
        new Chart(ctxFreq, {
            type: 'polarArea',
            data: {
                labels: freqLabels,
                datasets: [{
                    data: freqData,
                    backgroundColor: ['rgba(59, 130, 246, 0.5)', 'rgba(139, 92, 246, 0.5)', 'rgba(16, 185, 129, 0.5)', 'rgba(245, 158, 11, 0.5)', 'rgba(239, 68, 68, 0.5)']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10 } } }
            }
        });
    }
});

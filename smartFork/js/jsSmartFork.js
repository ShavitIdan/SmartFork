//------------------------ dark theme ------------------------------------
window.onload = () => {
    btn = document.getElementById('btnSwitch');
    logo = document.getElementById('logo');
    themeIcon = document.getElementById('themeIcon');
    textElement = document.getElementById('themeText');
    
    
    btn.addEventListener('click',()=>{
        if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
            document.documentElement.setAttribute('data-bs-theme','light');
            logo.src = "images/SmartForkIcon.png";
            themeIcon.src = "images/sun.png";
            btn.style.color = "#89868D";
            textElement.textContent = "Light";
        }
        else {
            document.documentElement.setAttribute('data-bs-theme','dark');
            logo.src = "images/SmartForkIconWhite.png";
            themeIcon.src = "images/moon.png";
            btn.style.color = "#FFFFFF"
            textElement.textContent = "Dark";
        }
    
    
    })
    
    // ------------------------ charts ------------------------------------
    var ctxP = document.getElementById("pieChart").getContext('2d');
    var myPieChart = new Chart(ctxP, {
      type: 'pie',
      data: {
        labels: ["Ashley", "Goal"],
        datasets: [{
          data: [103,80],
          backgroundColor: ["#F7464A", "#07C703"],
          hoverBackgroundColor: ["#FF5A5E", "#07C703"]
        }]
      },
      options: {
        responsive: true
      }
    });

    const ctx = document.getElementById("chart").getContext('2d');
      const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["Fats", "Protain", "Carbs", "Calories"],
          datasets: [{
            label: 'Ashley status',
            backgroundColor: ["#F7464A", "#07C703","#07C703","#07C703"],
            data: [620, 301, 896, 1248],
          }]
        },
        options: {
          responsive: true,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
              }
            }]
          }
        },
      });

      // ------------------------ date picker ------------------------------------
    $(function(){
        $('#datepicker').datepicker();
    });
};

   
// ------------------------ json ------------------------------------
// Update the form with dynamic content

// Fetch the JSON data
fetch("data/option.json")
  .then(response => response.json())
  .then(data => showData(data));

    function showData(data) {

      const screenWidth = window.innerWidth;
      const ul2 = document.getElementById('target2');
      if(ul2)
      {
        for (const key in data.option2[0]) {
          const li2 = document.createElement('li');
          
          li2.classList.add('dropdown-item');
          const sHtml2 = data.option2[0][key];
          li2.innerHTML = sHtml2;
          ul2.appendChild(li2);
        }
      
        // Add a single event listener to the ul element with id "target2"
        ul2.addEventListener('click', function(event) {
          const target2 = event.target;
          const dropdownButton2 = document.getElementById('dropdownMenuButton');
          dropdownButton2.innerHTML = target2.innerHTML;
      
          const persons = document.getElementsByClassName('person');
      
          for (let i = 0; i < persons.length; i++) {
            const type = persons[i].querySelector('.type_target').innerText.toLowerCase();
            const type2 = persons[i].querySelector('.type_target').innerText.toLowerCase();
            if (dropdownButton2.innerHTML.toLowerCase() === 'all' || type === dropdownButton2.innerHTML.toLowerCase() || type2 === dropdownButton2.innerHTML.toLowerCase()) {
              if(screenWidth < 768)
              {
                persons[i].style.display = 'table-row';
              }
              else
              {
                persons[i].style.display = 'block';
              }

            } else {
              persons[i].style.display = 'none';
            }
          }
        });
      }

      const ul = document.getElementById('target');
      if(ul)
      {
        for (const key in data.option1[0]) {
          const li = document.createElement('li');
          li.classList.add('dropdown-item');
          const sHtml = data.option1[0][key];
          li.innerHTML = sHtml;
          ul.appendChild(li);
        }
      
        // Add a single event listener to the ul element
        ul.addEventListener('click', function(event) {
          const target = event.target;
          const dropdownButton = document.getElementById('dropdownMenuButton');
          dropdownButton.innerHTML = target.innerHTML;
          
          const persons = document.getElementsByClassName('person');
          
          for (let i = 0; i < persons.length; i++) {
            const diet = persons[i].querySelector('.diet_target').innerText.toLowerCase();
            const diet2 = persons[i].querySelector('.diet_target').innerText.toLowerCase();
            if (dropdownButton.innerHTML.toLowerCase() === 'all' || diet === dropdownButton.innerHTML.toLowerCase() || diet2 === dropdownButton.innerHTML.toLowerCase() ) { // Compare with the selectedOption
              if(screenWidth < 768)
              {
                persons[i].style.display = 'table-row';
              }
              else
              {
                persons[i].style.display = 'block';
              }

            } else {
              persons[i].style.display = 'none';
            }
          }
        });
      }
      
    }

    



window.onload = () => {

  //------------------------ dark theme ------------------------------------
    const btn = document.getElementById('btnSwitch');
    const logo = document.getElementById('logo');
    const themeIcon = document.getElementById('themeIcon');
    const textElement = document.getElementById('themeText');
    btn.addEventListener('click',()=>{
        if (document.documentElement.getAttribute('data-bs-theme') == 'dark' || document.documentElement.getAttribute('data-bs-theme') =='light-blue') {
            document.documentElement.setAttribute('data-bs-theme','light');
            logo.src = "images/SmartForkIcon.png";
            themeIcon.src = "images/sun.png";
            // btn.style.color = "#89868D";
            textElement.textContent = "Light";    
        }
        else {
            document.documentElement.setAttribute('data-bs-theme','dark');
            logo.src = "images/SmartForkIconWhite.png";
            themeIcon.src = "images/moon.png";
            // btn.style.color = "#FFFFFF"
            textElement.textContent = "Dark"; 
        }
    })
    
    // ------------------------ charts ------------------------------------
  if (document.getElementById("pieChart") !== null){
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
    };
  };

// ------------------------ date picker ------------------------------------
if (document.getElementById("datepicker") !== null){
  $(function(){
  $('#datepicker').datepicker();
  });
};

// ------------------------ change checkbox color ------------------------------------

const checkboxes = document.querySelectorAll('.btn-check');

checkboxes.forEach(checkbox => {
  checkbox.addEventListener('click', () => {
    const label = checkbox.nextElementSibling;
    if (checkbox.checked) {
      label.style.backgroundColor = '#8583FF';
    } else {
      label.style.backgroundColor = '';
    }
  });
});



if (document.getElementById("theSpinner") !== null){
  var spinner = document.getElementById('theSpinner');
  if(document.getElementById("submit") !== null){
  $('#submit').click(function() {
    spinner.style.display = 'block';
    // formModal.style.display = 'none';
    setTimeout(function() {
      spinner.style.display = 'none';    
    }, 1000);
  });
}
else{$('.submit').click(function() {
  spinner.style.display = 'block';
  // formModal.style.display = 'none';
  setTimeout(function() {
    spinner.style.display = 'none';
    
  }, 1000);
})
};
};


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
    
    // ------------------------------------------------------------------- index3
    
    $(function(){
        $('#datepicker').datepicker();
    });
};

   
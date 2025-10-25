window.addEventListener('DOMContentLoaded', (event) => {
    [...document.querySelectorAll("input[type=text]")].forEach(el => el.addEventListener('keyup',function (e) 
    {
        let nodes = document.querySelectorAll("input[type=text]");

        for (let i = 0; i < nodes.length; i++) 
        {
            if(isNaN(nodes[i].value) || nodes[i].value == "")
            {
                nodes[i].value = "";
                nodes[i].focus();
                return;
            }
        }

        let button = document.getElementById("sendForm");
        button.className = "login-disabled-button";
        button.className = "login-button";
    }));

    setInterval(function()
    {
        document.getElementById("seconds").textContent = seconds + " seconds";
        seconds--;
        
        if(seconds == -1)
            location.href = "index.php?error=1&code=47";
    }, 1000);
});
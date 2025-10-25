formVerify = function()
{
    let nodes = document.querySelectorAll("input");
    
    for (let i = 0; i < nodes.length; i++) 
    {
        if(nodes[i].value == "")
            return;
    }

    let button = document.getElementById("sendForm");
    button.className = "login-disabled-button";
    button.className = "login-button";
};

window.addEventListener('DOMContentLoaded', (event) => {

    [...document.querySelectorAll("input[type]")].forEach(el => el.addEventListener('keyup',function (e) 
    {
        formVerify();
    }));

    [...document.querySelectorAll("input[type]")].forEach(el => el.addEventListener('focusout',function (e) 
    {
        formVerify();
    }));

    document.getElementById("sendForm").addEventListener("click", function(){
        let nodes = document.querySelectorAll("input");
        for (let i = 0; i < nodes.length; i++) 
        {
            if(nodes[i].value == "")
                return;
        }

        document.getElementById("form").submit();
    });
});
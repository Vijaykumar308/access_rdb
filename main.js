const connectionButton = document.querySelectorAll(".connectionButton");
const connectionForm = document.querySelector("#authentication-modal");
const closeButton = document.querySelector(".closeButton");

const formSubmitButton = document.querySelector("#formSubmitButton");



formSubmitButton.addEventListener("click",()=>{
    const host     = document.getElementById("host").value;
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const dbName   = document.getElementById("dbName").value;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        if(this.responseText !== "connection failed") {
            // localStorage.setItem("conn",this.responseText);
            window.location.href = "query.php";
        }
        else{
            alert("connection failed");
            console.log(`connectin failed`);
        }
      }
    };

    let data = {
        "host" : host,
        "username" : username,
        "password" : password,
        "dbname" : dbName,
        "status" : "create connection"
    }

    // console.log(`dsd`, data);
    xhttp.open("POST", "query_response.php", true);
    xhttp.send(JSON.stringify(data));

});

function connectionButtonClicked(button){
    button.addEventListener("click",() =>{
        connectionForm.classList.remove("hidden");
    });
}

function closeConnectionForm(button){
    button.addEventListener("click",() =>{
        connectionForm.classList.add("hidden");;
    });
}

closeConnectionForm(closeButton);
connectionButtonClicked(connectionButton[0]);
connectionButtonClicked(connectionButton[1]);





const queryButton = document.querySelector("#querySubmitButton");
const query = document.querySelector("#query");
const table = document.querySelector(".myTable");
const outputHeader = document.querySelector("#outputHeader");
const outputRows = document.querySelector("#outputRows");
const errorDiv = document.querySelector(".error");
queryButton.addEventListener("click", () => {
    const sqlQuery = query.value.replace(/\s+/g, ' ').trim().toLowerCase();

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        let response = this.responseText;
        response = JSON.parse(response);
        
        switch(response.status){
          case "success":
            errorDiv.innerHTML = '';
            console.log(response);
            createHeader(response);
            createRows(response);
            break;

          case "failed":
            removeAllChildNodes(outputHeader);
            removeAllChildNodes(outputRows);
            errorDiv.innerHTML = "Error: " +response.error;
            errorDiv.style.fontSize = "20px";
            errorDiv.style.textTransform = "none";
            errorDiv.style.lineHeight = "2.1";
            break;

          case "other operations":
            alert("Opertion performed successfully");
            break;

          default:
            console.log("default case");  
        }
      }
    };

    let data = {
        "query": sqlQuery,
        "status": "run query"
    }

    xhttp.open("POST", "query_response.php", true);
    xhttp.send(JSON.stringify(data));
});


function createHeader(jsonData){
    removeAllChildNodes(outputHeader);
    outputHeader.classList.add("text-xs","text-gray-700", "uppercase", "bg-gray-50", "dark:bg-gray-700", "dark:text-gray-400");
    let tr = document.createElement("tr");
    for(let headerName of jsonData[0]){
      let th = document.createElement("th");
      th.innerHTML = headerName;
      th.classList.add("px-6", "py-3");

      tr.append(th);
      outputHeader.append(tr);
    }
}

function createRows(jsonData){
    removeAllChildNodes(outputRows); 
    for(let index in jsonData[1]){
        let tr = document.createElement("tr");
        tr.classList.add("bg-white","border-b","dark:bg-gray-800","dark:border-gray-700");
      let keys = Object.keys(jsonData[1][0]);
      
      for(let i of keys){
        let td = document.createElement("td");
        td.classList.add("px-6" ,"py-4");
        td.innerHTML = jsonData[1][index][i];
        tr.append(td);
      }
      outputRows.append(tr);
    }
}

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}
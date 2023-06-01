const queryButton = document.querySelector("#querySubmitButton");
const query = document.querySelector("#query");
const table = document.querySelector(".myTable");
const outputHeader = document.querySelector("#outputHeader");
const outputRows = document.querySelector("#outputRows");
const errorDiv = document.querySelector(".error");
const initialPhaseDiv = document.querySelector(".initial_phase");

var keywords = [
  "ALL", "ALLOCATE", "ALTER", "AND", "ANY", "ARE", "ARRAY", "AS", "ASC", "AT", "AUTHORIZATION",
  "BACKUP", "BEGIN", "BETWEEN", "BREAK", "BROWSE", "BULK", "BY",
  "CASCADE", "CASE", "CAST", "CATALOG", "CHECK", "CLOSE", "CLUSTERED", "COALESCE", "COLLATE",
  "COLUMN", "COMMENT", "COMMIT", "COMPUTE", "CONSTRAINT", "CONTAINS", "CONTINUE", "CONVERT",
  "CREATE", "CROSS", "CURRENT", "CURRENT_DATE", "CURRENT_TIME", "CURRENT_TIMESTAMP",
  "CURRENT_USER", "CURSOR",
  "DATABASE", "DATE", "DAY", "DEALLOCATE", "DECLARE", "DEFAULT", "DEFERRABLE", "DEFERRED", "DELETE",
  "DENY", "DESC", "DISTINCT", "DISTRIBUTED", "DO", "DOMAIN", "DROP",
  "ELSE", "END", "END-EXEC", "ESCAPE", "EXCEPT", "EXEC", "EXECUTE", "EXISTS", "EXIT", 
  "EXTERNAL", "EXTRACT", "FALSE",
  "FETCH", "FIELDS", "FILE", "FILLFACTOR", "FOR", "FOREIGN", "FREETEXT", "FREETEXTTABLE", "FROM",
  "FULL", "FUNCTION", "GOTO", "GRANT", "GROUP", "HAVING", "HOLDLOCK",
  "IDENTITY", "IDENTITYCOL", "IF", "IN", "INDEX", "INNER", "INSERT", "INTERSECT", "INTO", "IS", "JOIN",
  "KEY", "KILL", "LEFT", "LIKE","LINENO","LOAD","LOCAL","LOCK","LOGIN","LONG","LOOP","LOWER","MAINTAINED",
  "MAKEPROCIND", "MAX",
  "MERGE", "MICROSECOND", "MIN", "MINUTE", "MODIFY", "MONTH", "NAMES",
  "NATIONAL", "NATURAL", "NOCHECK", "NOCOUNT", "NOT", "NULL", "NULLIF",
  "OF", "OFF", "OFFSETS", "ON", "OPEN", "OPENDATASOURCE", "OPENQUERY", "OPENROWSET", "OPENXML", "OPTION", "OR", "ORDER", "OUTER", "OVER",
  "PERCENT", "PIVOT", "PLAN", "PRECISION", "PRIMARY", "PRINT", "PROCEDURE", "PUBLIC", 
  "RAISERROR", "READ", "READTEXT", "RECONFIGURE", "REFERENCES", "REPLICATION", "RESTORE", "RESTRICT",
  "RETURN", "REVERT", "REVOKE", "RIGHT", "ROLLBACK", "ROWCOUNT", "RULE", "SAVE",
  "SCHEMA", "SECURITYAUDIT", "SELECT", "SEMANTICKEYPHRASETABLE", "SEMANTICSIMILARITYDETAILSTABLE", 
  "SEMANTICSIMILARITYTABLE", "SESSION_USER", "SET", "SETUSER", "SHUTDOWN", "SOME", 
  "STATISTICS", "STORED", "STRING", "SUBSTRING", "SUM", "SUSPEND",
  "UPDATE",
  "WHERE","WITH","WHEN"];

// Keyup event
$("#query").on("keyup", function(e){
  // Space ke pressed
  if (e.keyCode == 32){
    var newHTML = "";
    // Loop through words
    $(this).text().replace(/[\s]+/g, " ").trim().split(" ").forEach(function(val){
      // If word is statement
      if (keywords.indexOf(val.trim().toUpperCase()) > -1)
        newHTML += "<span class='statement'>" + val + "&nbsp;</span>";
      else
        newHTML += "<span class='other'>" + val + "&nbsp;</span>"; 
    });
    $(this).html(newHTML);

    // Set cursor postion to end of text
    var child = $(this).children();
    var range = document.createRange();
    var sel = window.getSelection();
    range.setStart(child[child.length-1], 1);
    range.collapse(true);
    sel.removeAllRanges();
    sel.addRange(range);
    this.focus();
  }
});


queryButton.addEventListener("click", () => {
    const sqlQuery = query.innerText.replace(/\s+/g, ' ').trim().toLowerCase();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        let response = this.responseText;
        response = JSON.parse(response);
        console.log(response);
        switch(response.status){
          case "success":
            errorDiv.innerHTML = '';
            removeAllChildNodes(initialPhaseDiv);
            console.log(response);
            createHeader(response);
            createRows(response);
            break;

          case "failed":
            removeAllChildNodes(outputHeader);
            removeAllChildNodes(outputRows);
            removeAllChildNodes(initialPhaseDiv);
            errorDiv.innerHTML = "Error: " +response.error;
            errorDiv.style.fontSize = "20px";
            errorDiv.style.textTransform = "none";
            errorDiv.style.lineHeight = "2.1";
            break;

          case "other operations":
            // console.log(response.msg);
      
            // alert("Opertion performed successfully");
            removeAllChildNodes(outputHeader);
            removeAllChildNodes(outputRows);
            errorDiv.innerHTML = response.msg;
            break;

          default:
            removeAllChildNodes(outputHeader);
            removeAllChildNodes(outputRows);
            errorDiv.innerHTML = response.msg;
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
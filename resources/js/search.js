let suggestions = [];
let searchGroup = document.getElementById("searchGroup");
let searchBar = document.getElementById("searchBar");

window.onload  = function search(){
    let dataArray = [];
    searchBar.value = "";
    searchBar.placeholder = "Search stock";

    searchBar.addEventListener("input",async function(e) {     
            let searchInput = document.getElementById("searchBar").value;
            let apiKeyYvan = "HXNZQEXJOAJMBD7G";
            // let apiKeyCian = "P7M1271DHCCEADYS";

            let url = `https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=${searchInput}&apikey=${apiKeyYvan}`;
            // let url = `https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=tencent&apikey=demo`;
            let res = await fetch(url);
            let data = await res.json();
            dataArray = data['bestMatches'];

            cleanArray(dataArray);
            dropSuggestions();

            window.addEventListener('click', function(e){   
                if (!document.getElementById('searchGroup').contains(e.target)){
                    searchGroup.classList.add("hide-drop"); 
                }
                });

            clickListElement();

    }); 

}


function cleanArray(_dataArray){       
    //empty suggestions before populating the array with new suggestions
    suggestions = [];
    let counter = 0;

    _dataArray.forEach(element => {
        suggestions.push({
            id: counter,
            symbol: element['1. symbol'],
            name: element['2. name'],
        })
        counter++
    });
}

function dropSuggestions(){
    searchGroup.classList.remove("hide-drop"); 
    let counter = 0;
    searchGroup.innerHTML ="";

    suggestions.forEach(element => {
        let list = document.createElement("li");
        list.setAttribute("data-id", counter);
        list.innerHTML = `${element.symbol} - ${element.name}`;
        searchGroup.appendChild(list);
        counter++;
    });

    let className = "search-max-h";
    searchGroup.classList.add(className);
}


function clickListElement(listIdentifier){
    const lists = document.querySelectorAll("li[data-id]");

    lists.forEach(list => {
        list.addEventListener("click", () => {
            listIdentifier = list.getAttribute("data-id");
            promptIntoSearch(listIdentifier);
            searchGroup.innerHTML = "";
            searchBar.select();
        });
    });
}

function promptIntoSearch(_listIdentifier){
    searchGroup.classList.remove("search-max-h");
    let stock = suggestions[_listIdentifier];
    searchBar.value = stock.symbol + " - " + stock.name;
    let ticket = stock.symbol;

    // Save the ticket to the localstorage
    localStorage.setItem('ticket', ticket);
    console.log(ticket);

    $("#searchStock").attr("action", `/stock/${ticket}`);
}

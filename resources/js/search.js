let suggestions = [];
let searchGroup = document.getElementById("searchGroup");
let searchBar = document.getElementById("searchBar");


window.onload  = function search(){
    let dataArray = [];
    searchBar.value = "";
    searchBar.placeholder = "Search stock";

    searchBar.addEventListener("input",async function(e) {            
            let searchInput = document.getElementById("searchBar").value;
            // let apiKeyYvan = "HXNZQEXJOAJMBD7G";
            // let url = `https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=${searchInput}&apikey=${apiKeyYvan}`;
            let url = `https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=tencent&apikey=demo`;
            let res = await fetch(url);
            let data = await res.json();
            dataArray = data['bestMatches'];

            cleanArray(dataArray);
            dropSuggestions();
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
    let counter = 0;
    searchGroup.innerHTML ="";

    suggestions.forEach(element => {
        let list = document.createElement("li");
        list.setAttribute("data-id", counter);
        list.innerHTML = `${element.symbol} - ${element.name}`;
        searchGroup.appendChild(list);
        counter++;
    });
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
    let stock = suggestions[_listIdentifier];
    // console.log(stock.symbol)
    // searchBar.value = stock.symbol;
    $("#searchStock").attr("action", "/stock/" + stock.symbol);
}

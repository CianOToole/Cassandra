
// let url = `https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=${searchInput}&apikey=${apiKeyCian}`;
let stockData;
let test;
api().then(res => stockData = res);
async function api() {

    let ticket;

    let ticketDemo = "IBM";
    let apiKeyDemo = "demo";

    let apiKeyYvan = "HXNZQEXJOAJMBD7G";
    let apiKeyCian = "P7M1271DHCCEADYS";

    (function () {
        ticket = localStorage.getItem('ticket');
    })();

    console.log(ticket);

    let url = `https://financialmodelingprep.com/api/v3/profile/${ticket}?apikey=937d579e58c5f65961d708c85782f993`;

    let res = await fetch(url);
    let data = await res.json();
    // console.log(data);
    return data;
}


    test = document.getElementById("myBtn");
    console.log(test);
    console.log("hi");


// let test = document.getElementById("myBtn");
if (test) {
    test.addEventListener("click", () => {
        promptOrder();
    });
}
function promptOrder() {


    // setTimeout(function () {
    // let stock = suggestions[_listIdentifier];
    // searchBar.value = stock.symbol;
    // let ticket = stock.symbol;

    // // Save the ticket to the localstorage
    // localStorage.setItem('ticket', ticket);
    // console.log(ticket)

    $("#makeTrade").attr("action", `/trades.create/${stockData}`);

    // } , 2000);
}

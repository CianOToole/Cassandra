
// let url = `https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=${searchInput}&apikey=${apiKeyCian}`;
let stockData;
let test;
let ticket;
let apiData = api().then(res => stockData = res);

async function api() {



    let ticketDemo = "IBM";
    let apiKeyDemo = "demo";

    let apiKeyYvan = "HXNZQEXJOAJMBD7G";
    let apiKeyCian = "P7M1271DHCCEADYS";

    (function () {
        ticket = localStorage.getItem('ticket');
    })();

    // console.log(ticket);

    let url = `https://financialmodelingprep.com/api/v3/profile/${ticket}?apikey=937d579e58c5f65961d708c85782f993`;

    let res = await fetch(url);
    let data = await res.json();
   
    setTimeout(function() {
        // console.log(data);
        promptOrder(data);
        return data;
    }, 3000);
}




function promptOrder(_data) {
    console.log(_data);
    // window.addEventListener('load', function () {
        document.getElementById("hideBtn").value = ticket;
        document.getElementById('myBtn').innerHTML = `${_data[0].symbol} | ${_data[0].exchangeShortName}`;
        document.getElementById('myBtn2').innerHTML = _data[0].price;
        document.getElementById('myBtn4').innerHTML = `${_data[0].companyName} Data`;

        document.getElementById('myBtn5').innerHTML = ` Price       ${_data[0].price} `;
        document.getElementById('myBtn6').innerHTML = `Market's Cap    ${_data[0].mktCap} `;
        document.getElementById('myBtn7').innerHTML = `Average Volume ${_data[0].volAvg} `;
        document.getElementById('myBtn8').innerHTML = `Sector    ${_data[0].sector} `;
        document.getElementById('myBtn9').innerHTML = `Range    ${_data[0].range} `;
        document.getElementById('myBtn10').innerHTML = `Industry   ${_data[0].industry} `;
        
    //   })

    
    // document.getElementById("demo").innerHTML
    // document.getElementById("myBtn").value = "POG";

    // let name = document.getElementById('myBtn'),
    // factionName = name.value;

    // document.getElementById('myBtn').innerHTML = "POG";

    // setTimeout(function () {
    // let stock = suggestions[_listIdentifier];
    // searchBar.value = stock.symbol;
    // let ticket = stock.symbol;

    // // Save the ticket to the localstorage
    // localStorage.setItem('ticket', ticket);
    // console.log(ticket)

    // $("#makeTrade").attr("action", `/trades.create/${stockData}`);

    // } , 2000);
}

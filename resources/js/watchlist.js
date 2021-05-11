// API key: 1001c8ec6521e9e5a86ad2a88190bef0

// let container = document.getElementById("data")
// for (var name in data) {
//   console.log(name[0]['price'])
//   console.log(name + " = " + data[name]);
//   let item = document.createElement("li"); 
//   item.innerHTML = `${name} : ${data[name]}`;
//   container.appendChild(item);
// }

  let watchlist = ["AAPL", "MSFT", "FB", "GME", "AMZN", "AIR.PA", "TSLA", "OR.PA" ];
  let data;    
  let quote = [];
  let key = "1001c8ec6521e9e5a86ad2a88190bef0";
  let counter = 0;

  watchlist.forEach(cmpTicket => {
    let ticket = cmpTicket;    
    getData(ticket);
  });

  async function getData(_ticket){
    let url = `https://financialmodelingprep.com/api/v3/quote/${_ticket}?apikey=${key}`;
  
    try {
      let res = await fetch(url);
      quote = await res.json();     
      data = quote[0];
    } catch(err) {
      alert(err); 
    }
  
    // console.log(data);

    reformatData(data);
  }


  async function reformatData(_data){

    let stock = await{
      'id': counter,
      'symbol': _data.symbol,
      'name': _data.name,
      'exchange': _data.exchange,
      'price': _data.price,
      'volume': _data.volume,
    }
    counter++;
    await console.log(stock);

    let body = document.getElementById('watchlistBody');
    

  }








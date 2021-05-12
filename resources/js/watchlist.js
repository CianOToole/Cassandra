// API key: 1001c8ec6521e9e5a86ad2a88190bef0

  // let watchlist = ["AAPL", "MSFT", "FB", "GME", "AMZN", "AIR.PA", "TSLA", "RXT" ];
  let watchlist = ["AAPL", "MSFT", "FB", "RXT"];
  let data;    
  let quote = [];
  let key = "1001c8ec6521e9e5a86ad2a88190bef0";
  let key2 = "bac089fea350cd5d3f5f7c9f98443e63";
  let counter = 0;

  watchlist.forEach(cmpTicket => {
    let ticket = cmpTicket;    
    getData(ticket);
  });

  async function getData(_ticket){
    let url = `https://financialmodelingprep.com/api/v3/quote/${_ticket}?apikey=${key2}`;
  
    try {
      let res = await fetch(url);
      quote = await res.json();     
      data = await quote[0];
      reformatData(data);
      // console.log(data);
    } catch(err) {
      alert(err); 
    }
  }

  async function reformatData(_data){

    let stock = await{
      'id': counter,
      'symbol': _data.symbol,
      'name': _data.name,
      'exchange': _data.exchange,
      'price': _data.price,
      'open': _data.open,
      'volume': _data.volume,
    }

    counter++;
    // await console.log(stock);

    let gg = document.getElementById('watchlistBody');
    let new_row = document.createElement('tr');
    (stock.id % 2 != 1) ? (new_row.className= "blue-bck") : null;

    (async function(){
      new_row.insertCell(0).innerHTML = await stock.name;
      new_row.insertCell(1).innerHTML = await stock.exchange;
      new_row.insertCell(2).innerHTML = await `${stock.price}€`;
      new_row.insertCell(3).innerHTML = await `${stock.open}€`;
      new_row.insertCell(4).innerHTML = await stock.volume;

      let open = await parseFloat(new_row.cells[3].innerHTML);
      let price = await new_row.cells[2];

      let formatPrice = parseFloat(price.innerHTML);

      await (formatPrice >= open) ? (price.className= "bid-win") : (price.className= "bid-loss");

      gg.appendChild(new_row);
    })();
  };








// API key: 1001c8ec6521e9e5a86ad2a88190bef0

(async function(){
   let data;    
   let quote = [];
   let key = "1001c8ec6521e9e5a86ad2a88190bef0";

    let ticket = localStorage.getItem('ticket');    

    let url = `https://financialmodelingprep.com/api/v3/quote/${ticket}?apikey=${key}`;

    try {
        let res = await fetch(url);
        quote = await res.json();     
        data = quote[0];
      } catch(err) {
        alert(err); 
      }

    (function(){
      let container = document.getElementById("data")
        for (var name in data) {
          // console.log(name + " = " + data[name]);
          let item = document.createElement("li"); 
          item.innerHTML = `${name} : ${data[name]}`;
          container.appendChild(item);
        }
    })();

})();




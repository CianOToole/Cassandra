// API key: 1001c8ec6521e9e5a86ad2a88190bef0
// URL: https://financialmodelingprep.com/api/v3/quote/MSFT?apikey=1001c8ec6521e9e5a86ad2a88190bef0

const { property } = require("lodash");

quote();

 async function quote(){

    let  quote = [];
    let data;
    let url = `https://financialmodelingprep.com/api/v3/quote/MSFT?apikey=1001c8ec6521e9e5a86ad2a88190bef0`;

    try {
        let res = await fetch(url);
        quote = await res.json();     
        data = quote[0];
      } catch(err) {
        alert(err); 
      }

    (function(){
        for (var name in data) {
            if (data.hasOwnProperty(name)) {
                console.log(name + " = " + data[name]);
            }
        }
    })();

}





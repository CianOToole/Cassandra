window.onload  = function search(){

    document.getElementById("searchBar").addEventListener("keyup",async function(e) {
        if (e.key === 'Enter') {
            let searchInput = document.getElementById("searchBar").value;
            let url = `https://financialmodelingprep.com/api/v3/search?query=${searchInput}&limit=10&exchange=NYSE&apikey=demo`;
        
            let res = await fetch(url);
            let data = await res.json();
            testData = data;
        }
    });
}


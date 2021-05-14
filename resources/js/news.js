// news.js gets the articles that are displayed on the neewsfeed from the New York times
// after formating the atricles by keeping only the titles, date of publocation and URL (line 22),
// the articales are prompted in a <li> elements, append to a <ul> element
const { stubString } = require("lodash");

newsfeed();

 async function newsfeed(){

    let articles, news, newsfeed = [];
    let counter = 0;
    let url = `https://api.nytimes.com/svc/search/v2/articlesearch.json?q=election&api-key=0gTyHf1LfG8AMy1oOgf8ngN1v6TC8aUq`;

    try {
        let res = await fetch(url);
        articles = await res.json();        
        news = articles.response.docs;
      } catch(err) {
        alert(err); 
      }

      news.forEach(art => {
        news = {
          id: counter,
          title: formatTitle(art.abstract),
          url: art.web_url,
          pub_at: formatDate(art.pub_date)
        }

        counter++;
        newsfeed.push(news)
      });

    (function(){
        newsfeed.forEach(article => {
          let container = document.getElementById("newsfeed")
          let list = document.createElement("li");
          let art = document.createElement("a");
          art.setAttribute("href", article.url);
          art.target = "_blank";
          art.innerHTML = `${article.pub_at}  -  ${article.title}`;
          container.appendChild(list).appendChild(art);
        });    
    })();

}

function formatDate(_date){
    let date = _date;    
    let month = date.substring(5, 7);
    let day = date.substring(8, 10);
    let reformatedDate = `${day}/${month}`;

    return reformatedDate;
}

function formatTitle(_title){
  let title = `${_title.substring(0, 60)}...`;    

  return title;
}

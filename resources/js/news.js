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

      news.forEach(n => {
        news = {
          id: counter,
          title: n.abstract,
          url: n.web_url,
          pub_at: n.pub_date
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
          art.innerHTML = `${article.pub_at} - ${article.title}`;
          container.appendChild(list).appendChild(art);
        });    
    })();

}



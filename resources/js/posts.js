// quote passes the id on the clicked button (determined by the post id) 
// each post share in their class the id nmb which we fetch to get the textContent of the p element 
// then, we fetch the text area to prompt the textContent in it to quote 

    function quote(id){
        var posts_cnt = document.getElementsByClassName(id);
        var text = posts_cnt[0].textContent;        
        console.log(text);
        var post_txt = document.getElementById('post_txt');
        post_txt.innerHTML += text;
    }

    function editPost(id, action){
        var posts_cnt = document.getElementsByClassName(id);
        var text = posts_cnt[0].textContent;      
        var post_txt = document.getElementById('post_txt');
        post_txt.innerHTML += text;

        $("#form_post_put").attr("value", "PUT");
        
        console.log(action);
        
        $("#form_post").attr("action", action);

        }
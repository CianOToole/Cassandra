document.addEventListener("DOMContentLoaded", () => {
    let url = window.location.href;
    let lastSegment = url.split("/").pop();

    if(lastSegment == "board"){
        document.getElementById("news").classList.add("toggle-out");
        document.getElementById("boardTab").classList.add("underline-tab");
    } else if(lastSegment == "newsfeed"){
        document.getElementById("boards").classList.add("toggle-out");
        document.getElementById("newsfeedTab").classList.add("underline-tab");
    } else {
        document.getElementById("news").classList.add("toggle-out");
        document.getElementById("boardTab").classList.add("underline-tab");
    }
});

document.getElementById("boardTab").addEventListener("click", function() {
    document.getElementById("news").classList.add("toggle-out");
    document.getElementById("boardTab").classList.add("underline-tab");
    document.getElementById("boards").classList.remove("toggle-out");
    document.getElementById("newsfeedTab").classList.remove("underline-tab");
  });

  document.getElementById("newsfeedTab").addEventListener("click", function() {
    document.getElementById("news").classList.remove("toggle-out");
    document.getElementById("boardTab").classList.remove("underline-tab");
    document.getElementById("boards").classList.add("toggle-out");
    document.getElementById("newsfeedTab").classList.add("underline-tab");
  });

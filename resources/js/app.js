require('./bootstrap');

//HAMBURGER MENU  ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// The function below manages the hamburger menu's rotation when clicking on the icon y adding or removing the CCSS classes rotation-1 & 2
// and by either hidding od displayin gthe regular navbar
document.addEventListener("DOMContentLoaded", () => {

    let collapse = false;
    let hamburger = document.getElementById("dropMenu");
    
    hamburger.addEventListener("click", () => {
        if(collapse == false){
            hamburger.classList.remove("rotation-2");
            hamburger.classList.add("rotation-1");
            document.getElementById("responsiveNavbar").style.display = "grid";
            collapse = true;
        }else{
            hamburger.classList.remove("rotation-1");
            hamburger.classList.add("rotation-2");
            document.getElementById("responsiveNavbar").style.display = "none";
            collapse = false;            
        }
    });
});

// clickable rows    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// DOMContentLoaded waits for the browser to download the DOM structure before anything else 
// when done, the user checks if a table is present on the page, if yeas, it gets all the table row data-href value and save them within an array rows
// if a user click on a row, the application redirects the user to a view page were the id is given by data-href.
// window.location.href is responsible for the page navigation
document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll("tr[data-href]");

    rows.forEach(row => {
        row.addEventListener("click", () => {
            window.location.href = row.dataset.href
        });
    });
});


// TABLE SORTING ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$(function() {
    $('table')
        .on('click', ".sort", function() {
            var index = $(this).index(),
                rows = [],
                thClass = $(this).hasClass('asc') ? 'desc' : 'asc';

            $('.table-sort th').removeClass('asc desc');
            $(this).addClass(thClass);

            $('.table-sort tbody tr').each(function(index, row) {
                rows.push($(row).detach());
            });

            rows.sort(function(a, b) {
                var aValue = $(a).find('td').eq(index).text(),
                    bValue = $(b).find('td').eq(index).text();

                return aValue > bValue ?
                    1 :
                    aValue < bValue ?
                    -1 :
                    0;
            });

            if ($(this).hasClass('desc')) {
                rows.reverse();
            }

            $.each(rows, function(index, row) {
                $('.table-sort tbody').append(row);
            });
        });
});
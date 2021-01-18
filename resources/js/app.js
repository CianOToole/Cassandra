require('./bootstrap');

// clickable rows    ////////////////////////////////////////////////////////////////////////////////////////////////////

// DOMContentLoaded waits for the brower to download the DOM structure before anything else 
document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll("tr[data-href]");

    rows.forEach(row => {
        row.addEventListener("click", () => {
            window.location.href = row.dataset.href
        });
    });
});

// TABLE SORTING ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(function() {
    $('table')
        .on('click', 'th', function() {
            var index = $(this).index(),
                rows = [],
                thClass = $(this).hasClass('asc') ? 'desc' : 'asc';

            $('#table-visits th').removeClass('asc desc');
            $(this).addClass(thClass);

            $('#table-visits tbody tr').each(function(index, row) {
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
                $('#table-visits tbody').append(row);
            });
        });
});

// POSTS ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
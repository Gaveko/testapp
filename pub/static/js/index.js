document.getElementById("createBook").addEventListener("click", function() {
    window.open('http://localhost:8000/create', 'Create book');
});

function search() {
    let searchInput = document.getElementById("search");
    changeQuery('search', searchInput.value);
}

function changePage(event) {
    let newPage = event.target.textContent;

    changeQuery('page', newPage);
}

function sortByAsc() {
    changeQuery('orderBy', 'asc');
}

function sortByDesc() {
    changeQuery('orderBy', 'desc');
}

function filter() {
    let elem = document.getElementById('categorySelect');
    let value = elem.options[elem.selectedIndex].value;

    changeQuery('filterBy', value);
}

function changeQuery(query, value) {
    let queryString = window.location.search;
    let searchParams = new URLSearchParams(queryString);

    searchParams.set(query, value);

    let newUrl = window.location.protocol + '//' + window.location.host + window.location.pathname + '?' + searchParams.toString();
    window.location.href = newUrl;
}

function clearQuery() {
    window.location.search = '';
}
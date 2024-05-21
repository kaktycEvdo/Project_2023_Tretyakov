let searchQuery = "";
// просто берёт название страницы из текущего url

function createSearch(){
    const searchElement = document.createElement("div");
    searchElement.id = "search";

    const searchBar = document.createElement("input");
    searchBar.id = "search_input";

    searchBar.onchange = (e) => {
        searchQuery = e.target.value;
        searchBar.value = searchQuery;
    }
    
    searchElement.appendChild(searchBar);
    return searchElement;
}

function getPage(link, params = null){
    let loading = document.createElement('div');
    loading.className = 'loading';
    loading.innerHTML = 'loading...';
    document.getElementById("content").appendChild(loading);
    fetch(link, { redirect: 'follow'})
    .then(response => {
        // When the page is loaded convert it to text
        if(response.status == 401){
            getPage('pages/auth.php', [401, 'Нет авторизации'])
        }
        return response.text()
    })
    .then(html => {
        document.getElementById("content").removeChild(loading);

        // Initialize the DOM parser
        let parser = new DOMParser();

        // Parse the text
        let doc = parser.parseFromString(html, "text/html");

        let div = document.createElement('div');
        div.className = 'page';

        let docContent = doc.querySelectorAll('body > *');

        for (let i = 0; i < docContent.length; i++) {
            div.appendChild(docContent[i]);
        }

        if(document.querySelector('.page')){
            document.getElementById("content").removeChild(document.querySelector('.page'));
        }
        document.getElementById("content").appendChild(div);
        
        if(params){
            let error = document.getElementById('error');
            error.innerHTML = params[1];
        }
    })
    .catch(err => {
        loading.innerHTML =  'Возникла ошибка: ' + err;  
    });
}
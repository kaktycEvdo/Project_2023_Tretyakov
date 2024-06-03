let searchQuery = "";

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

function popup(style, content){
    const popup_window = document.createElement('div');
    const popup_content = document.createElement('p');
    popup_content.innerHTML = content;
    popup_window.className = "popup_window "+style;

    popup_window.appendChild(popup_content);

    document.body.appendChild(popup_window);

    function deletePopup(){
        document.body.removeChild(popup_window);

        delete popup_window;
        delete popup_content;
    }

    const timeout = setTimeout(deletePopup, 5000);

    popup_window.addEventListener('click', () => {
        clearTimeout(timeout);
        deletePopup();
    })
}
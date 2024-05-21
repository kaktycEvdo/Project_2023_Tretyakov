class DropMenu{
    constructor(content, name){
        this.opened = false;
        this.content = content;
        this.name = name;
    }

    getContent() {
        const block = document.createElement("div");
        block.className = "drop_menu_"+this.name;
        block.appendChild(this.content);
        return block;
    }

    close() {
        this.opened = false;
    }

    open() {
        this.opened = true;
    }
}

let profile_mode = "customer";
const plinks_container = document.createElement("div");
const plink1 = document.createElement("a");
const plink2 = document.createElement("a");
const plink3 = document.createElement("a");
const plink4 = document.createElement("a");
plink1.onclick = () => getPage('pages/auth.php');
plink2.onclick = () => getPage('pages/profile.php');
plink3.onclick = () => getPage('pages/profile.php?action=logout');
plink4.onclick = () => getPage('pages/chat.php');
plink1.innerHTML = "Авторизация";
plink2.innerHTML = "ЛК";
plink3.innerHTML = "Выход";
plink4.innerHTML = "Чат";
plinks_container.appendChild(plink1);
plinks_container.appendChild(plink2);
plinks_container.appendChild(plink3);
plinks_container.appendChild(plink4);
const profileDropMenu = new DropMenu(plinks_container, "profile");

function createHeader(){
    const headerContainer = document.querySelector("header");
    const profileDropMenuContent = profileDropMenu.getContent();

    const pic = document.createElement("a");
    pic.id = "profile_image_container";
    pic.onclick = prikol;
    pic.innerHTML = `<div class='lk_logo'><img src='static/e93161a711d78c374f9a863188be1edc.jpg'></div>`
    
    function prikol(){
        if (!profileDropMenu.opened){
            profileDropMenu.open();
            document.getElementsByClassName("lk_logo")[0].appendChild(profileDropMenuContent);
        }
        else if (profileDropMenu.opened){
            document.getElementsByClassName("lk_logo")[0].removeChild(profileDropMenuContent);
            profileDropMenu.close();
        }
    }

    if(localStorage.getItem("role") === "zak" || !localStorage.getItem("role")){
        headerContainer.innerHTML = `<a onclick='getPage("pages/index.php")' class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
        <div class='hmenu'>
            <a onclick='getPage("pages/index.php")'>Главная</a>
            <a onclick='getPage("pages/freelancers.php")'>Исполнители</a>
        </div>`
        headerContainer.appendChild(pic);
    }
    else if(localStorage.getItem("role") === "isp"){
        headerContainer.innerHTML = `<a onclick='getPage("pages/index.php")' class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
        <div class='hmenu'>
            <a onclick='getPage("pages/index.php")'>Главная</a>
            <a onclick='getPage("pages/burse.php")'>Биржа</a>
        </div>`
        headerContainer.appendChild(pic);
    }

    
    return headerContainer;
}

createHeader();
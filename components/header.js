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

const plinks_container = document.createElement("div");
const plink1 = document.createElement("a");
const plink2 = document.createElement("a");
const plink3 = document.createElement("a");
const plink4 = document.createElement("a");
plink1.href = 'auth';
plink2.href = 'profile';
plink3.href = 'logout';
plink4.href = 'chat';
plink1.innerHTML = "Авторизация";
plink2.innerHTML = "ЛК";
plink3.innerHTML = "Выход";
plink4.innerHTML = "Чат";
plinks_container.appendChild(plink1);
plinks_container.appendChild(plink2);
plinks_container.appendChild(plink3);
plinks_container.appendChild(plink4);
const profileDropMenu = new DropMenu(plinks_container, "profile");

const splinks_container = document.createElement("div");
const splink1 = document.createElement("a");
const splink2 = document.createElement("a");
const splink3 = document.createElement("a");
const splink4 = document.createElement("a");
splink1.href = 'auth';
splink2.href = 'profile';
splink3.href = 'logout';
splink4.href = 'chat';
splink1.innerHTML = "Авторизация";
splink2.innerHTML = "ЛК";
splink3.innerHTML = "Выход";
splink4.innerHTML = "Чат";
splinks_container.appendChild(splink1);
splinks_container.appendChild(splink2);
splinks_container.appendChild(splink3);
splinks_container.appendChild(splink4);
const sprofileDropMenu = new DropMenu(splinks_container, "profile");

function createHeader(){
    const headerContainer = document.querySelector("header.big_header");
    const smallHeaderContainer = document.querySelector('header.small_header');
    const profileDropMenuContent = profileDropMenu.getContent();
    const profileDropMenuContent2 = sprofileDropMenu.getContent();

    const pic1 = document.createElement("a");
    pic1.id = "profile_image_container";
    pic1.onclick = prikol;
    pic1.innerHTML = `<div class='lk_logo'><img src='static/e93161a711d78c374f9a863188be1edc.jpg'></div>`
    const pic2 = document.createElement("a");
    pic2.id = "profile_image_container2";
    pic2.onclick = prikol1;
    pic2.innerHTML = `<div class='lk_logo'><img src='static/e93161a711d78c374f9a863188be1edc.jpg'></div>`
    
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

    function prikol1(){
        if (!sprofileDropMenu.opened){
            sprofileDropMenu.open();
            document.getElementsByClassName("lk_logo")[1].appendChild(profileDropMenuContent2);
        }
        else if (sprofileDropMenu.opened){
            document.getElementsByClassName("lk_logo")[1].removeChild(profileDropMenuContent2);
            sprofileDropMenu.close();
        }
    }

    if(localStorage.getItem("role") === "zak" || !localStorage.getItem("role")){
        headerContainer.innerHTML = `<a href="/" class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
        <div class='hmenu'>
            <a href="/">Главная</a>
            <a href="freelancers"'>Исполнители</a>
        </div>`
        headerContainer.appendChild(pic1);
    }
    else if(localStorage.getItem("role") === "isp"){
        headerContainer.innerHTML = `<a href="/" class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
        <div class='hmenu'>
            <a href="/"'>Главная</a>
            <a href="burse">Биржа</a>
        </div>`
        headerContainer.appendChild(pic1);
    }

    smallHeaderContainer.innerHTML = `<a href="/" class='hlogo_container'><div>КФ</div></a>`
    smallHeaderContainer.appendChild(pic2);

    
    return headerContainer;
}

createHeader();
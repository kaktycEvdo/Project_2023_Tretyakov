/* models.js contents */
class Task{
    constructor(preferred_deadline, text, reward, tags){
        this.preferred_deadline = preferred_deadline;
        this.text = text;
        this.reward = reward;
        this.tags = tags;
    }

    /* DateTime, str, int, str|array(str) */
    setDetails(preferred_deadline, text, reward, tags){
        this.preferred_deadline = preferred_deadline;
        this.text = text;
        this.reward = reward;
        this.tags = tags;
    }

    getDetails(){
        return [this.preferred_deadline, this.text, this.reward, this.tags]
    }

    /* you cant delete such objects and make methods for it */
    deleteTask(){
        return 0;
    }
}

class Cards{

}

class PersonalData{
    constructor(login, password){
        this.login = login;
        this.password = password;
    }

    getData(){
        return [this.login, this.password];
    }

    /* str */
    setLogin(login){
        this.login = login;
    }

    /* str */
    setPassword(password){
        this.password = password;
    }
}

class User{
    constructor(name, surname, patronymic, phone, email, Cards, last_online, PersonalData, verified, isAdmin, aboutSelf, characteristics){
        this.name = name;
        this.surname = surname;
        this.patronymic = patronymic;
        this.phone = phone;
        this.email = email;
        this.Cards = Cards;
        this.last_online = last_online;
        this.PersonalData = PersonalData;
        this.verified = verified;
        this.isAdmin = isAdmin;
        this.aboutSelf = aboutSelf;
        this.characteristics = characteristics;
    }

    getName(){
        return this.name;
    }
    getFullName(){
        return [this.name, this.surname, this.patronymic];
    }
    getEmail(){
        return this.email;
    }
    getPhone(){
        return this.phone;
    }
    getCardNumber(){
        return this.Cards.getNumber();
    }
    getAboutSelf(){
        return this.aboutSelf;
    }
    getCharacteristics(){
        return this.characteristics;
    }
    setAboutSelf(aboutSelf){
        this.aboutSelf = aboutSelf;
    }
    setCharacteristics(characteristics){
        this.characteristics = characteristics;
    }
    setDetails(name, surname, patronymic, phone, email, aboutSelf){
        this.name = name;
        this.surname = surname;
        this.patronymic = patronymic;
        this.phone = phone;
        this.email = email;
        this.aboutSelf = aboutSelf;
        return 0;
    }
}

/* dummy arrays instead of database for now */

const tasks = [
    /* datetime, str, int, str|array(str) */
    new Task(new Date('2024-01-01T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 18000, ['tag', 'tag2', 'tag5']),
    new Task(new Date('2024-01-02T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 17000, ['tag1', 'tag', 'tag4']),
    new Task(new Date('2024-01-03T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 16000, ['tag2', 'tag3', 'tag1']),
    new Task(new Date('2024-01-04T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 15000, ['tag4', 'tag1', 'tag2']),
    new Task(new Date('2024-01-05T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 14000, ['tag2', 'tag6', 'tag4']),
    new Task(new Date('2024-01-06T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 13000, ['tag3', 'tag5', 'tag2']),
    new Task(new Date('2024-01-07T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 12000, ['tag1', 'tag4', 'tag3']),
    new Task(new Date('2024-01-08T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 11000, ['tag', 'tag4', 'tag5']),
    new Task(new Date('2024-01-09T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 10000, ['tag', 'tag5', 'tag6']),
    new Task(new Date('2024-01-10T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 9000, ['tag4', 'tag3', 'tag']),
    new Task(new Date('2024-01-11T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 8000, ['tag1', 'tag2', 'tag']),
    new Task(new Date('2024-01-12T12:00:00'), 'dummy text dummy text dummy text dummy text dummy text dummy text dummy text dummy text', 7000, ['tag6', 'tag', 'tag3']),
]

const users = [
    /* str, str, str|null, int, str, Cards|null, datetime, PersonalData, bool, bool */
    new User('имя', 'фамилия', 'отчество', 9623963223, 'email@mail.ru', null, new Date('2023-12-01T12:33:00'), new PersonalData('login', 'pswrd_encryptlater'), false, false, "about"),
    new User('имя', 'фамилия', null, 9223463223, 'email1111@mail.ru', null, new Date('2023-12-01T14:33:00'), new PersonalData('admin', 'pswrd_encryptlater'), true, true, "admin", ["💖Хулиганом", "Атакованный", "Компьютер", "Еле", "Работает✨"]),
]










/* scripts.js contents */












let searchQuery = "";
// просто берёт название страницы из текущего url
const current_page = window.location.href.split("/")[window.location.href.split("/").length-1].split(".")[0];

const urlParams = new URLSearchParams(window.location.search);
const taskID = urlParams.get('id');
const profileID = urlParams.get('pid');

const mainElement = document.getElementById("main");

function createTask(task, index){
    /* info in task */
    const text = task.text;
    const preferred_deadline = task.preferred_deadline;
    const reward = task.reward;
    const tags = task.tags;
    let datestr = (preferred_deadline.getDate() < 10 ? "0"+preferred_deadline.getDate() : preferred_deadline.getDate()) + "." +
    ((preferred_deadline.getMonth()+1) < 10 ? "0"+(preferred_deadline.getMonth()+1) : (preferred_deadline.getMonth()+1)) + "." +
    preferred_deadline.getFullYear();

    /* visualization of info */
    let taskElement = document.createElement("div");
    if(current_page === "burse") {
        taskElement = document.createElement("a");
        taskElement.href="task.html?id="+(index);
        taskElement.className = "task";
    }
    else if(current_page==="task") {
        taskElement = document.createElement("div");
        taskElement.className = "task_details";

        const taskHeader = document.createElement("div");
        const taskHeaderBuyerDetails = document.createElement("div");
        const taskHeaderBuyerIconContainer = document.createElement("a");
        const taskHeaderBuyerIcon = document.createElement("img");
        taskHeaderBuyerIconContainer.href = "profile.html?pid=0";
        const taskHeaderBuyerName = document.createElement("div");

        const fullname = users[0].getFullName();

        taskHeader.className = "task_details_header";
        taskHeaderBuyerDetails.className = "task_buyer_details";
        
        taskHeaderBuyerName.innerHTML = fullname[1] + " " + fullname[0][0] + "." + (fullname[2][0] != null ? fullname[2][0] + "." : "");
        taskHeaderBuyerIcon.src = "static/e93161a711d78c374f9a863188be1edc.jpg";

        taskHeaderBuyerIconContainer.appendChild(taskHeaderBuyerIcon);
        taskHeaderBuyerDetails.appendChild(taskHeaderBuyerIconContainer);
        taskHeaderBuyerDetails.appendChild(taskHeaderBuyerName);

        taskHeader.appendChild(taskHeaderBuyerDetails);
        taskElement.appendChild(taskHeader);
    };
    

    const taskElement_text = document.createElement("div");
    taskElement_text.className = "task_text";
    taskElement_text.innerHTML = text;

    const taskElement_preferredDeadline = document.createElement("div");
    taskElement_preferredDeadline.className = "task_deadline";
    taskElement_preferredDeadline.innerHTML = datestr;
    
    const taskElement_reward = document.createElement("div");
    taskElement_reward.className = "task_reward";
    taskElement_reward.innerHTML = "Цена: <i class='reward_text'>" + reward + "₽</i>";

    const taskElement_tags = document.createElement("div");
    taskElement_tags.className = "task_tags";
    taskElement_tags.innerHTML = tags;

    taskElement.appendChild(taskElement_text);
    taskElement.appendChild(taskElement_tags);
    taskElement.appendChild(taskElement_preferredDeadline);
    taskElement.appendChild(taskElement_reward);

    return(taskElement);
}

function createTaskList(){
    const list_container = document.createElement("div");
    list_container.className = "tasklist"

    tasks.forEach((task, index) => {
        list_container.appendChild(createTask(task, index));
    })

    return list_container;
}

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

class DropMenu{
    constructor(content, name){
        this.opened = false;
        this.content = content;
        this.name = name;
    }

    close() {
        this.opened = false;
    }

    open() {
        this.opened = true;
    }

    getContent() {
        if (this.opened){
            const block = document.createElement("div");
            block.className = "drop_menu_"+this.name;
            block.appendChild(this.content);
            return block;
        }
    }
}

const plinks_container = document.createElement("div");
const plink1 = document.createElement("a");
const plink2 = document.createElement("a");
const plink3 = document.createElement("a");
plinks_container.appendChild(plink1)
plinks_container.appendChild(plink2)
plinks_container.appendChild(plink3)
const profileDropMenu = new DropMenu(plinks_container, "profile");

function createHeader(){
    const headerContainer = document.createElement("header")
    const profileDropMenuContent = profileDropMenu.getContent;
    
    function prikol1(){
        profileDropMenu.open();
        headerContainer.appendChild(profileDropMenuContent);
    }
    function prikol2(){
        headerContainer.removeChild(profileDropMenuContent);
        profileDropMenu.close();
        
    }

    headerContainer.innerHTML = `<a href='index.html' class='hlogo_container'><div>КФ Крутой Фриланс</div></a>
    <div class='hmenu'>
        <a href='index.html'>Главная</a>
        <a href='burse.html'>Биржа</a>
    </div>
    <a href='#' onclick="`+ (profileDropMenu.opened ? prikol2() : prikol1) +`"><div class='lk_logo'><img src='static/e93161a711d78c374f9a863188be1edc.jpg'></div></a>`
    

    return headerContainer;
}

function createProfileDetails(profile){
    const pDetailsContainer = document.createElement("div");
    pDetailsContainer.className = "profile_container";
    const fullname = profile.getFullName();

    // я хотел сделать через innerHtml, но тогда цикл ломал всю разметку и в итоге вот что я делаю

    const profileBriefContainer = document.createElement("div");
    profileBriefContainer.className = "profile_brief"
    const profileBriefNameImg = document.createElement("div");
    profileBriefNameImg.className = "profile_name_img";
    const profileBriefName = document.createElement("div");
    
    profileBriefName.innerHTML = fullname[1] + " " + fullname[0] + " " + (fullname[2] != null ? fullname[2] : "");
    const profileBriefImg = document.createElement("img");
    profileBriefImg.src = "static/e93161a711d78c374f9a863188be1edc.jpg"
    const profileBriefButtons = document.createElement("div");
    profileBriefButtons.className = "profile_brief_buttons"
    const profileBriefButton1 = document.createElement("button");
    profileBriefButton1.innerHTML = "Исполнитель"
    const profileBriefButton2 = document.createElement("button");
    profileBriefButton2.innerHTML = "Заказчик"
    
    const profileDetailsContainer = document.createElement("div");
    const profileDetailsAboutContainer = document.createElement("div");
    profileDetailsAboutContainer.className = "profile_about";
    const profileDetailsAboutLabel = document.createElement("div");
    profileDetailsAboutLabel.innerHTML = "О себе:";
    const profileDetailsAboutText = document.createElement("textarea");
    profileDetailsAboutText.innerHTML = profile.getAboutSelf();
    profileDetailsAboutText.disabled = true;
    const profileDetailsCharasContainer = document.createElement("div");
    profileDetailsCharasContainer.className = "profile_charas";
    const profileDetailsCharasLabel = document.createElement("div");
    profileDetailsCharasLabel.innerHTML = "Характеристики:";
    const profileDetailsCharas = document.createElement("div");

    profile.getCharacteristics() ? profile.getCharacteristics().forEach(characteristic => {
        const profileDetailsChara = document.createElement("div");
        profileDetailsChara.innerHTML = characteristic;
        profileDetailsCharas.appendChild(profileDetailsChara);
    }) : profileDetailsCharas.append("Нет характеристик");
    
    profileBriefNameImg.appendChild(profileBriefImg);
    profileBriefNameImg.appendChild(profileBriefName);

    profileBriefButtons.appendChild(profileBriefButton1);
    profileBriefButtons.appendChild(profileBriefButton2);
    
    profileBriefContainer.appendChild(profileBriefNameImg);
    profileBriefContainer.appendChild(profileBriefButtons);

    profileDetailsAboutContainer.appendChild(profileDetailsAboutLabel);
    profileDetailsAboutContainer.appendChild(profileDetailsAboutText);
    profileDetailsCharasContainer.appendChild(profileDetailsCharasLabel);
    profileDetailsCharasContainer.appendChild(profileDetailsCharas);

    profileDetailsContainer.appendChild(profileDetailsAboutContainer);
    profileDetailsContainer.appendChild(profileDetailsCharasContainer);

    pDetailsContainer.appendChild(profileBriefContainer);
    pDetailsContainer.appendChild(profileDetailsContainer);

    return pDetailsContainer;
}

const searchBar = createSearch();
const taskList = createTaskList();
const task = taskID ? createTask(tasks[taskID]) : null;
const pDetails = profileID ? createProfileDetails(users[profileID === "me" ? 1 : profileID]) : null;

const header = createHeader();

mainElement.append(header);

switch (current_page){
    case "index": {
        mainElement.appendChild(searchBar);
        break;
    }
    case "burse": {
        mainElement.appendChild(searchBar);
        mainElement.appendChild(taskList);
        break;
    }
    case "task": {
        mainElement.appendChild(task);
        break;
    }
    case "profile": {
        mainElement.appendChild(pDetails);
        break;
    }
}

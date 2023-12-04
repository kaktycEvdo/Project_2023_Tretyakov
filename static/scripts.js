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
    constructor(name, surname, patronymic, phone, email, Cards, last_online, PersonalData, verified, isAdmin){
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
    }


}

/* dummy arrays instead of database for now */

tasks = [
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

users = [
    /* str, str, str|null, int, str, Cards|null, datetime, PersonalData, bool, bool */
    new User('имя', 'фамилия', 'отчество', 9623963223, 'email@mail.ru', null, new Date('2023-12-01T12:33:00'), new PersonalData('login', 'pswrd_encryptlater'), false, false),
    new User('имя', 'фамилия', null, 9223463223, 'email1111@mail.ru', null, new Date('2023-12-01T14:33:00'), new PersonalData('admin', 'pswrd_encryptlater'), true, true),
]










/* script.js contents */












let searchQuery = "";

function createTaskList(){
    const list_container = document.createElement("div");

    tasks.forEach((task, index) => {
        if (task.text.match(searchQuery)){
            /* info in task */
            const text = task.text;
            const preferred_deadline = task.preferred_deadline;
            const reward = task.reward;
            const tags = task.tags;
            const id = 'task'+index;

            /* visualization of info */
            const taskElement = document.createElement("div");
            taskElement.className = "task"

            const taskElement_text = document.createElement("div");
            taskElement_text.innerHTML = text;
            const taskElement_preferredDeadline = document.createElement("div");
            taskElement_preferredDeadline.innerHTML = preferred_deadline;
            const taskElement_reward = document.createElement("div");
            taskElement_reward.innerHTML = reward;
            const taskElement_tags = document.createElement("div");
            taskElement_tags.innerHTML = tags;
            const taskElement_id = document.createElement("div");
            taskElement_id.innerHTML = id;

            taskElement.appendChild(taskElement_text);
            taskElement.appendChild(taskElement_preferredDeadline);
            taskElement.appendChild(taskElement_reward);
            taskElement.appendChild(taskElement_tags);
            taskElement.appendChild(taskElement_id);

            list_container.appendChild(taskElement);
        }
    })

    return list_container;
}

function createSearch(){
    const searchElement = document.createElement("div");
    searchElement.id = "search";
    const searchBar = document.createElement("input");
    searchBar.id = "search_input";
    const searchButton = document.createElement("input");
    searchButton.id = "search_submit";
    searchButton.type = "button";
    searchButton.value = "Искать";
    searchBar.onchange = (e) => {
        searchQuery = e.target.value;
        searchBar.value = searchQuery;
    }
    searchButton.onclick = () => {

    }
    searchElement.appendChild(searchBar);
    searchElement.appendChild(searchButton);
    return searchElement;
}

let index = document.getElementById("main index");

let searchBar = createSearch();
let taskList = createTaskList();

index.appendChild(searchBar);
index.appendChild(taskList);
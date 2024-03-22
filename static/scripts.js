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
    profileBriefButton1.onclick = () => {profile_mode = "worker"}
    const profileBriefButton2 = document.createElement("button");
    profileBriefButton2.innerHTML = "Заказчик"
    profileBriefButton2.onclick = () => {profile_mode = "customer"}
    
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
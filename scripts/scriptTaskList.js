// var getTagButton = document.getElementById("add-new-tag");
// var getTagBlock = document.getElementById("tag-block");
// getTagBlock.addEventListener("click", enterTagData());

// create element
// var createTag = document.createElement("span");

// function enterTagData() {
    //     var createTagInput = document.createElement("input");
    //     createTagInput.setAttribute("type", "text");
    //     createTagInput.id = "new-tag";
    //     // getTagBlock.appendChild(createTagInput);
    //     getTagBlock.insertBefore(createTagInput, getTagButton);
    
    // }

// SHOW TAG INPUT WHEN BUTTON CLICKED
let enterTagButton = document.getElementById("add-new-tag");
enterTagButton.addEventListener("click", function() {
    let inputTag = document.getElementById("new-tag");
    let showTagBlock = document.getElementById("show-tags");
    if (inputTag.style.display === "flex") {
        inputTag.style.display = "none";
        showTagBlock.style.display = "none";
    } else {
        inputTag.style.display = "flex";
        showTagBlock.style.display = "block";

    }
})

let newTagInput = document.getElementById("new-tag");
newTagInput.addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();

        let tagValue = newTagInput.value;

        let tagContent = document.createElement("div");
        tagContent.className = "added-tag-content";
        tagContent.id = "added-tag-content";

        let deleteTag = document.createElement("input");
        deleteTag.className = "delete-tag";
        deleteTag.id = "delete-tag";
        deleteTag.value = "x";
        deleteTag.setAttribute("type", "button");
        deleteTag.setAttribute("onclick", "deleteTag(this.id)");

        let addedTag = document.createElement("input");
        addedTag.className = "added-tag";
        addedTag.id = "added-tag";
        addedTag.setAttribute("type", "text");
        addedTag.setAttribute("name", "added-tag");
        addedTag.setAttribute("onkeydown", "preventAddedTag(event)");
        addedTag.value = tagValue;
        tagContent.appendChild(deleteTag);
        tagContent.appendChild(addedTag);

        let tags = document.getElementById("tags");
        tags.appendChild(tagContent);
        let tagsArray = tags.childNodes;
        for (let i = 0; i < tagsArray.length; i++) {
            tagsArray[i].id = "added-tag-content-"+i;
            tagsArray[i].value = newTagInput.value;
            let tagChildren = tagsArray[i].childNodes;
            for (let a = 0; a < tagChildren.length; a++) {
                if (tagChildren[a].className === "added-tag") {
                    tagChildren[a].id = "added-tag-"+i;
                    tagChildren[a].setAttribute("name", "added-tag-"+i);
                }
                if (tagChildren[a].className === "delete-tag") {
                    tagChildren[a].id = "delete-tag-"+i;
                }
            }
        }

        newTagInput.value = "";
    }
})

// PREVENT DEFAULT FOR ADDED TAGS
function preventAddedTag(event) {
    if (event.key === "Enter") {
        event.preventDefault();
    }
}

// DELETE TAG IN NEW TASK PROMPT
function deleteTag(id) {
    let deleteTagButton = document.getElementById(id);
    let parentOfDelete = deleteTagButton.parentElement;
    console.log(parentOfDelete.id);
    console.log(deleteTagButton.id);
    parentOfDelete.remove();

    let allTags = document.getElementsByClassName("added-tag-content");
    for (let i = 0; i < allTags.length; i++) {
        allTags[i].id = "added-tag-content-"+i;
        let tagChildren = allTags[i].childNodes;
        for (let a = 0; a < tagChildren.length; a++) {
            if (tagChildren[a].className === "added-tag") {
                tagChildren[a].id = "added-tag-"+i;
                tagChildren[a].setAttribute("name", "added-tag-"+i);
            }
            if (tagChildren[a].className === "delete-tag") {
                tagChildren[a].id = "delete-tag-"+i;
            }
        }
    }
}

// CANCEL TASK PROMPT
function cancelTask() {
    let getOverlay = document.getElementById("overlay");
    let name = document.getElementById("name");
    let priorityButton = document.getElementById("priority-button");
    let priorityValue = document.getElementById("priority-value");
    let startDate = document.getElementById("start-date");
    let dueDate = document.getElementById("due-date");
    let description = document.getElementById("description");
    let shareUsername = document.getElementById("username");
    let findUserBlock = document.getElementById("find-user-block");
    let moodTagValue = document.getElementById("mood-tag-value");
    let timeEstimateButton = document.getElementById("time-estimate");


    name.value = "";
    priorityButton.className = "no-priority";
    priorityValue.value = "no-priority";
    startDate.value = null;
    dueDate.value = null;
    description.value = "";
    findUserBlock.style.display = "none";
    shareUsername.value = "";
    moodTagValue.value = "";
    timeEstimateButton.value = ""
    getOverlay.style.display = "none";
}

// Prevent page reload when Enter key pressed for certain form feilds
let nameInput = document.querySelector("#name");
nameInput.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
    }
})

let shareUsernameInput = document.querySelector("#username");

let timeInput = document.querySelector("#time-estimate");
timeInput.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        let hiddenTimeInput = document.getElementById("time-input");
        timeInput.setAttribute("value", timeInput.value);
        // OR
        hiddenTimeInput.setAttribute("value", timeInput.value);
    }
})
    
const priorityClasses = ["no-priority", "low-priority", "med-priority", "high-priority"];
var priorityButton = document.querySelector("#priority-button");
var hiddenPriValue = document.getElementById("priority-value");
priorityButton.addEventListener("click", function() {
    for(let i = 0; i < priorityClasses.length; i++) {
        if (priorityButton.className === priorityClasses[i]) {
            priorityButton.className = priorityClasses[i+1];
            hiddenPriValue.setAttribute("value", priorityButton.className)
            console.log(priorityClasses[i]);
            break;
        } else if (priorityButton.className === priorityClasses[3]) {
            priorityButton.className = priorityClasses[0];
            hiddenPriValue.setAttribute("value", priorityButton.className)
        }
    }
})
    
var getShareButton = document.querySelector("#share-user-button");
var sharePrompt = document.querySelector(".find-user-block");
getShareButton.addEventListener("click", addUser);

// Show hide share user prompt
function addUser() {
    if (sharePrompt.style.display === "flex") {
        sharePrompt.style.display = "none";
    } else {
        let input = document.getElementById("username");
        input.value = "";
        sharePrompt.style.display = "flex";
    }
}

function cancelMoodTagPrompt() {
    var hiddenInput = document.getElementById("mood-tag-value");
    hiddenInput.setAttribute("value", "");

    var selectMoodBlock = document.getElementById("select-mood-block");
    var moodImagesButtons = document.getElementById("mood-images").childNodes;
    

    // var addMoodTag = document.getElementById("add-mood-tag");
    if (selectMoodBlock.style.display === "flex") {
    
    // Remove highlight from the selected mood button
    for(let i = 0; i < moodImagesButtons.length; i++) {
        moodImagesButtons[i].className = "image-button";

    }
        selectMoodBlock.style.display = "none";
    } else {
        selectMoodBlock.style.display = "flex";

    }

}

function moodTagPrompt() {
    var selectMoodBlock = document.getElementById("select-mood-block");
    
    selectMoodBlock.style.display = "flex"
    
    
}

function closeTagPrompt() {

    var selectMoodBlock = document.getElementById("select-mood-block");
    var moodImagesButtons = document.getElementById("mood-images").childNodes;
    
    // Remove highlight from the selected mood button
    for(let i = 0; i < moodImagesButtons.length; i++) {
        moodImagesButtons[i].className = "image-button";

    }

    selectMoodBlock.style.display = "none";

}

var savedTag = null;

function clickedTag(id) {
    var moodImagesButtons = document.getElementById("mood-images").childNodes;
    var tagButton = document.getElementById(id);
    var hiddenInput = document.getElementById("mood-tag-value");

    // Remove highlight from the last selected mood button (only one button can be selected)
    for(let i = 0; i < moodImagesButtons.length; i++) {
        if (moodImagesButtons[i].id !== id) {
            moodImagesButtons[i].className = "image-button";
        }
    }
    // Add highlight to selected mood button
    if (tagButton.className === "image-button-clicked") {
        tagButton.className = "image-button";
        hiddenInput.setAttribute("value", "");
        savedTag = null;
        
    } else {
        tagButton.className = "image-button-clicked";
        savedTag = tagButton.firstChild.getAttribute("alt");
        hiddenInput.setAttribute("value", savedTag);
    }

    // Save tag value to hidden form input tag
    console.log(savedTag);

}

var savedMood = null;

function clickedCurrentMood(id) {
    var moodImagesButtons = document.getElementById("current-mood-images").childNodes;
    var tagButton = document.getElementById(id);
    var hiddenInput = document.getElementById("current-mood-set");

    // Remove highlight from the last selected mood button (only one button can be selected)
    for(let i = 0; i < moodImagesButtons.length; i++) {
        if (moodImagesButtons[i].id !== id) {
            moodImagesButtons[i].className = "current-images";
        }
    }
    // Add highlight to selected mood button
    if (tagButton.className === "current-images-clicked") {
        tagButton.className = "current-images";
        hiddenInput.setAttribute("value", "");
        savedMood = null;
        
    } else {
        tagButton.className = "current-images-clicked";
        savedMood = tagButton.firstChild.getAttribute("alt");
        hiddenInput.setAttribute("value", savedMood);
    }

    // Save tag value to hidden form input tag
    console.log(savedMood);
    console.log(tagButton.className);

    

}


// Hide and show task lists
var getListOption = document.getElementById("option-container");
var showLists = document.getElementById("list-name-block");
var listIcon = document.getElementById("list-icon");
var listText = document.getElementById("list-text");
var arrowIcon = document.getElementById("arrow-icon");
getListOption.addEventListener("click", function() {
    if (showLists.style.display === "flex") {
        showLists.style.display = "";
        getListOption.style.backgroundColor = "";
        listIcon.style.backgroundColor = "";
        listText.style.color = "";
        arrowIcon.style.rotate = "";
        
    } else {
        getListOption.style.backgroundColor = "white";
        listIcon.style.backgroundColor = "#0c0c47";
        listText.style.color = "#0c0c47";
        showLists.style.display = "flex";
        arrowIcon.style.rotate = "180deg";
    }
})

// Show and hide create list prompt
var createList = document.getElementById("create-new-list");
var overlayCreateList = document.getElementById("overlay-new-list");
createList.addEventListener("click", function() {
    if (overlayCreateList.style.display === "flex") {
        overlayCreateList.style.display = "none";
    } else {
        overlayCreateList.style.display = "flex";
    }

});

var cancelNewList = document.getElementById("cancel-new-list");
var clearListInput = document.getElementById("new-list-name");
cancelNewList.addEventListener("click", function(){
    overlayCreateList.style.display = "none";
    clearListInput.value = "";
});

// Show and hide what's your current mood prompt
var getButton = document.getElementById("current-mood")
var getCurrentOverlay = document.getElementById("overlay-current-mood")
getButton.addEventListener("click", function() {
    getCurrentOverlay.style.display = "flex";
});

var cancelCurrentMoodButton = document.getElementById("cancel-current-mood");
cancelCurrentMoodButton.addEventListener("click", function() {
    var currentMoodImages = document.getElementById("current-mood-images").childNodes;
    
    // Remove highlight from the selected mood button
    for(let i = 0; i < currentMoodImages.length; i++) {
        currentMoodImages[i].className = "current-images";

    }

    getCurrentOverlay.style.display = "none";
})

// Continue button for whats your mood prompt
var continueButton = document.getElementById("continue-button");
var suggestedTasksPrompt = document.getElementById("suggest-prompt");
var whatsCurrentMood = document.getElementById("whats-current-mood");

continueButton.addEventListener("click", function() {
    whatsCurrentMood.style.display = "none";
    suggestedTasksPrompt.style.display = "flex";
})

// Generate today's date
var today = new Date();
var todayDate = document.getElementsByClassName("suggest-task-date");
for (let i = 0; i<todayDate.length; i++) {
    todayDate[i].value = today;
}

var cancelSuggestion = document.getElementById("cancel-suggestion");
cancelSuggestion.addEventListener("click", function() {
    getCurrentOverlay.style.display = "none";
})


// Get What do you want to achieve this week button
var weeklyGoalButton = document.getElementById("create-weekly-goal");
// Get input box for entering the goal
var goalInput = document.getElementById("weekly-goal-entry");
// Get cancel button
var getCancelButton = document.getElementById("cancel-weekly-goal");
// Get create button
var getCreateButton = document.getElementById("create-goal");
// Get displaying the goal prompt
var displayGoal = document.getElementById("weekly-goal");

// Show input box for entering weekly goal
weeklyGoalButton.addEventListener("click", function() {

    // If the inbox box entering their goal is shown
    if (goalInput.style.display === "block") {
        // Hide inbox box for entering goal
        goalInput.style.display = "none";
        // Hide cancel button
        getCancelButton.style.display = "none";
        // Remove input from input box
        goalInput.value = "";

        // Otherwise (if the input box for entering the goal is hidden)
    } else {
        // Show input box for entering goal
        goalInput.style.display = "block";
        // Show create button
        getCreateButton.style.display = "block";
        // Show cancel button
        getCancelButton.style.display = "block";
        // Hide the weekly goal display block
        displayGoal.style.display = "none";
    
    }
    
})

// Cancel button
getCancelButton.addEventListener("click", function() {
    //Remove any remaining input
    goalInput.value = "";
    
    // Hide weekly goal input
    goalInput.style.display = "none";

    // Display the existing goal again
    displayGoal.style.display = "flex";

    // Hide the cancel button
    getCancelButton.style.display = "none";

    // Hide the create button
    getCreateButton.style.display = "none";

})

// Show hide add mood goal
var moodGoalPrompt = document.getElementById("little-mood-select");
var moodGoalButton = document.getElementById("create-mood-goal");
moodGoalButton.addEventListener("click", function() {
    moodGoalPrompt.style.display = "flex";
})

// Display the mood goal in the mood goal section
function displayMoodGoal(id) {
    var littleMoodSelection = document.getElementById("little-mood-select").childNodes;
    var littleMoodImage = document.getElementById(id);
    var getHiddenInput = document.getElementById("little-mood-value");
    var getAlt = littleMoodImage.firstChild.getAttribute("alt");

    // Remove highlight from other buttons
    for (let i = 0; i < littleMoodSelection.length; i++) {
        if (littleMoodSelection[i].id !== id) {
            littleMoodSelection[i].className = "little-moods";
        }
    }

    // Add highlight to selected button
    if (littleMoodImage.className == "little-moods") {
        littleMoodImage.className = "little-moods-clicked";
        getHiddenInput.setAttribute("value", getAlt);
    } else {
        littleMoodImage.className = "little-moods";
        getHiddenInput.setAttribute("value", "");
    }

}

let subtasks = document.getElementsByClassName("sub-task-element");
for (let i = 0; i < subtasks.length; i++) {
    subtasks[i].id = "sub-task-element-"+i;
}

// Create sub task
var subtaskButton = document.getElementById("create-sub-task");
subtaskButton.addEventListener("click", function() {

    // Removes focus on sub tasks other than newly created task when button is clicked
    let subTaskElements = document.getElementsByClassName("sub-task-element");
    for (let i = 0; i < subTaskElements.length; i++) {
        let getSubElements = subTaskElements[i].childNodes;
        for (let a = 0; a < getSubElements.length; a++) {
            if (getSubElements[a].className === "sub-task-focus") {

                getSubElements[a].className = "sub-task";
            }
        }
    }

    // Creating sub task when button is clicked
    var subTaskElement = document.createElement("div");
    subTaskElement.className = "sub-task-element";

    var subTask = document.createElement("div");
    subTask.className = "sub-task-focus";
    
    var subCheckbox = document.createElement("div");
    subCheckbox.className = "sub-checkbox";

    var subInput = document.createElement("input");
    subInput.className = "sub-task-input";
    subInput.setAttribute("type", "text");
    subInput.setAttribute("onkeypress", "enterSubTaskEnter(event, this.id)");
    subInput.setAttribute("onclick", "showEnterButton(event, this.id)");

    var subEnterButton = document.createElement("input");
    subEnterButton.className = "sub-enter-button";
    subEnterButton.setAttribute("type", "button");
    subEnterButton.setAttribute("name", "sub-enter-button");
    subEnterButton.setAttribute("onclick", "enterSubTaskClick(this.id)");
    subEnterButton.value = "Enter";

    var cancelSubTask = document.createElement("button");
    cancelSubTask.setAttribute("type", "button");
    cancelSubTask.className = "cancel-sub-task";
    cancelSubTask.setAttribute("onclick", "deleteSubTask(this.id)") ;
    cancelSubTask.innerText = "x";

    subTask.appendChild(subCheckbox);
    subTask.appendChild(subInput);
    subTask.appendChild(subEnterButton);
    subTaskElement.appendChild(subTask);
    subTaskElement.appendChild(cancelSubTask);

    // Create unique ids for new sub task
    let subtasks = document.getElementsByClassName("sub-task-element");
    if (subtasks.length === 0) {
        subTaskElement.id = "sub-task-element-0";
        subTask.id = "sub-task-0";
        subCheckbox.id = "sub-checkbox-0";
        subInput.id = "sub-task-input-0";
        subInput.setAttribute("name", "sub-task-input-0");
        subEnterButton.id = "sub-enter-button-0";
        let cancelButtonChild = subTaskElement.getElementsByClassName("cancel-sub-task");
        cancelButtonChild[0].id = "cancel-sub-task-0";
    } else {
        for (let i = 0; i < subtasks.length; i++) {
            let lastChar = parseInt(subtasks[i].id.charAt(subtasks[i].id.length-1));
            if (i === subtasks.length-1) {
                subTaskElement.id = "sub-task-element-"+(lastChar+1);
                subTask.id = "sub-task-"+(lastChar+1);
                subCheckbox.id = "sub-checkbox-"+(lastChar+1);
                subInput.id = "sub-task-input-"+(lastChar+1);
                subInput.setAttribute("name", "sub-task-input-"+(lastChar+1));
                subEnterButton.id = "sub-enter-button-"+(lastChar+1);
                let cancelButtonChild = subTaskElement.getElementsByClassName("cancel-sub-task");
                cancelButtonChild[0].id = "cancel-sub-task-"+(lastChar+1);        
            }
        }
    } 
    var subTaskBlock = document.getElementById("sub-task-block");
    subTaskBlock.appendChild(subTaskElement);
    subInput.focus();
    
})

// Delete a sub task
function deleteSubTask(id) {
    let cancelButton = document.getElementById(id);
    let parent = cancelButton.parentElement;
    parent.remove();
    let getSubTaskElements = document.getElementsByClassName("sub-task-element");
    if (getSubTaskElements.length > 0) {
        for (let i = 0; i < getSubTaskElements.length; i++) {
            getSubTaskElements[i].id = "sub-task-element-"+i;
            let childNodes = getSubTaskElements[i].childNodes;
            for (let a = 0; a < childNodes.length; a++) {
                if (childNodes[a].className === "sub-task") {
                    childNodes[a].id = "sub-task-"+a;
                    let subtaskChildren = childNodes[a].childNodes;
                    for (let e = 0; e < subtaskChildren.length; e++) {
                        if (subtaskChildren[e].className === "sub-checkbox") {
                            subtaskChildren[e].id = "sub-checkbox-"+e;
                        }
                        if (subtaskChildren[e].className === "sub-task-input") {
                            subtaskChildren[e].id = "sub-task-input-"+e;
                        }
                        if (subtaskChildren[e].className === "sub-enter-button") {
                            subtaskChildren[e].id = "sub-enter-button-"+e;
                        }
                    }
                } else if (childNodes[a].className === "sub-task-focus") {
                    childNodes[a].id = "sub-task-"+a;
                    let subtaskChildren = childNodes[a].childNodes;
                    for (let e = 0; e < subtaskChildren.length; e++) {
                        if (subtaskChildren[e].className === "sub-checkbox") {
                            subtaskChildren[e].id = "sub-checkbox-"+e;
                        }
                        if (subtaskChildren[e].className === "sub-task-input") {
                            subtaskChildren[e].id = "sub-task-input-"+e;
                        }
                        if (subtaskChildren[e].className === "sub-enter-button") {
                            subtaskChildren[e].id = "sub-enter-button-"+e;
                        }
                    }
                }
                if (childNodes[a].className === "cancel-sub-task") {
                    childNodes[a].id = "cancel-sub-task-"+a;
                }
            }
        }
    }

}

// Complete creating a sub task by pressing enter key
function enterSubTaskEnter(event, id) {
    let subTask = document.getElementById(id);
    let parent = subTask.parentElement;
    let listname = parent.childNodes;
    if (event.keyCode == 13) {
        event.preventDefault();
        for (let i = 0; i < listname.length; i++) {
            if (listname[i].className === "sub-enter-button") {
                listname[i].style.display = "none";
            }
        }
        parent.className = "sub-task";
        subTask.blur();
    }
    
}

// Complete creating a sub task by pressing Enter button
function enterSubTaskClick(id) {
    let getEnterButton = document.getElementById(id);
    let parent = getEnterButton.parentElement;
    let listname = parent.childNodes;
    let subTaskInput = "";
    console.log(listname);
    for (let i = 0; i < listname.length; i++) {
        if (listname[i].className === "sub-task-input") {
            subTaskInput = listname[i].value;
        }
        if (listname[i].className === "sub-enter-button") {
            listname[i].style.display = "none";
        }
    }
    parent.className = "sub-task";
    subTaskInput.blur();
    
}

// Show focus and Enter button when input clicked on
function showEnterButton(event, id) {
    let subTask = document.getElementById(id);
    let parent = subTask.parentElement;
    let subTaskElements = document.getElementsByClassName("sub-task-element");
    let listname = parent.childNodes;
    for (let i = 0; i < listname.length; i++) {
        if (listname[i].className === "sub-enter-button") {
            listname[i].style.display = "block";
        }
    }
    for (let i = 0; i < subTaskElements.length; i++) {
        let getSubElements = subTaskElements[i].childNodes;
        for (let a = 0; a < getSubElements.length; a++) {
            if (getSubElements[a].className === "sub-task-focus") {
                getSubElements[a].className = "sub-task";
            }
        }
    }
    parent.className = "sub-task-focus";

}

// prevent default
var button = document.getElementById("username");
button.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
    }

})

// Click on a user to share a task with
function assignUser(id) {
    let value = document.getElementById(id).innerText;
    let shareButton = document.getElementById("share-user-button");
    let findUser = document.getElementById("find-user-block");
    let removeUser = document.getElementById("remove-user");
    shareButton.innerText = value;
    findUser.style.display = "none";
    removeUser.style.display = "block";

    var hiddenShareUserInput = document.getElementById("shareuser-value");
    hiddenShareUserInput.setAttribute("value", value);

}

// Remove shared user
let removeUser = document.getElementById("remove-user");
removeUser.addEventListener("click", function() {
    let shareButton = document.getElementById("share-user-button");
    shareButton.innerText = "Share task with a user";
    let removeUser = document.getElementById("remove-user");
    removeUser.style.display = "none";
    let findUser = document.getElementById("find-user-block");
    findUser.style.display = "none";
    var hiddenShareUserInput = document.getElementById("shareuser-value");
    hiddenShareUserInput.setAttribute("value", "");

})

function selectTag(id) {
    let existingTag = document.getElementById(id).innerText;
    console.log(existingTag);

    let tagContent = document.createElement("div");
    tagContent.className = "added-tag-content";
    tagContent.id = "added-tag-content";

    let deleteTag = document.createElement("input");
    deleteTag.className = "delete-tag";
    deleteTag.id = "delete-tag";
    deleteTag.value = "x";
    deleteTag.setAttribute("type", "button");
    deleteTag.setAttribute("onclick", "deleteTag(this.id)");

    let addedTag = document.createElement("input");
    addedTag.className = "added-tag";
    addedTag.id = "added-tag";
    addedTag.setAttribute("type", "text");
    addedTag.setAttribute("name", "added-tag");
    addedTag.setAttribute("onkeydown", "preventAddedTag(event)");
    addedTag.value = existingTag;
    tagContent.appendChild(deleteTag);
    tagContent.appendChild(addedTag);

    let tags = document.getElementById("tags");
    tags.appendChild(tagContent);
    let tagsArray = tags.childNodes;
    for (let i = 0; i < tagsArray.length; i++) {
        tagsArray[i].id = "added-tag-content-"+i;
        tagsArray[i].value = newTagInput.value;
        let tagChildren = tagsArray[i].childNodes;
        for (let a = 0; a < tagChildren.length; a++) {
            if (tagChildren[a].className === "added-tag") {
                tagChildren[a].id = "added-tag-"+i;
                tagChildren[a].setAttribute("name", "added-tag-"+i);
            }
            if (tagChildren[a].className === "delete-tag") {
                tagChildren[a].id = "delete-tag-"+i;
            }
        }
    }

    newTagInput.value = "";

    let tabBlock = document.getElementById("tag-block");
    tabBlock.scrollTop = 0;

}

class SuggestedTask {
    constructor(name, description) {
        this.name = name;
        this.description = description;
    }
    name() {
        return this.name;
    }
    description() {
        return this.description;
    }
}

const task1 = new SuggestedTask("Take a long break", "We all need a well deserved break!");
const task2 = new SuggestedTask("Have some fresh air...", "Take a walk, have a breather. Make sure to make some time away from whatever tasks youre doing...");
const task3 = new SuggestedTask("Eat and drink", "Have a snack, make something to eat or drink!");
const task4 = new SuggestedTask("Treat yourself!", "Reward yourself, be sure you deserve it.");
const task5 = new SuggestedTask("Take yourself out and cool down", "Take a breather. It's important to cool your mind.");
const task6 = new SuggestedTask("Rest your eyes", "Take a power nap");
const task7 = new SuggestedTask("Exercise", "Keep it moving! It's good for your mind too");
const task8 = new SuggestedTask("Company!", "Call someone, meet up with someone...");
const task9 = new SuggestedTask("Do something you enjoy", "Create some time for your favourite hobbies...");
const task10 = new SuggestedTask("Journal", "Be creative, write down any thoughts you have...");
const task11 = new SuggestedTask("Quick break!", "10 mins, drink water, walk around, have a short break");


function displaySuggestions() {
    // var moodList = ["anxious", "bothered", "calm", "confident", "confused", "excited", "gloomy", "glum", "hopeful", "nervous", "neutral"];
    var suggestionBlock = document.getElementById("suggested-task-block");
    for (let i = 0; i < 3; i++) {
        var suggestedTask = document.createElement("div");
        suggestedTask.className = "suggested-tasks";
        var header = document.createElement("h3");
        var mainText = document.createElement("p");


    }
}


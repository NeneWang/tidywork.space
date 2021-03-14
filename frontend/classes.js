/* 
* Classes + constructors to simplify creating new objects, helpful constants to reset object values
*
* @authors Joseph Nagy 
*/

// helpful objects used to reset values 

const resetNewBoard = {
    boardId: null, 
    name: "", 
    backgroundImage: "", 
    color: "", 
    tags: [], 
    boardDescription: "", 
    projectDeadline: "", 
    priority: "", 
    columns: []
}

const resetNewCard = {
    cardId: null,
    columnId: null,
    name: "",
    color: "",
    description: "",
    deadline: "",
    priority: "",
    tags: [],
    comments: [],
    checklists: [],
    assignedTo: [],
    showModal: false
};

const resetNewColumn = {
    columnId: null,
    boardId: null,
    name: "",
    color: "",
    watch: false,
    color: "",
    cards: [],
    order: "alphabetical",
    showModal: false,
};

const resetNewComment = {
    commentId: null,
    timestamp: "",
    color: ""
};

const resetNewTag = {
    tagId: null,
    name: "",
    color: ""
}; 


class Tag {
    constructor(tagId, name, color) {
        this.tagId = tagId;
        this.name = name;
        this.color = color;
    }
}

class Comment {
    constructor(commentId, timestamp, description) {
        this.commentId = commentId; 
        this.timestamp = timestamp;
        this.description = description;
    }
}

class Card {
    constructor(cardId, columnId, name, color, description, deadline, priority, tags, comments, checklists, assignedTo) {
        this.cardId = cardId; 
        this.columnId = columnId; 
        this.name = name;
        this.color = color;
        this.description = description;
        this.deadline = deadline;
        this.priority = priority;
        this.tags = (!tags ? [] : tags);
        this.comments = (!comments ? [] : comments);
        this.checklists = (!checklists ? [] : checklists);
        this.assignedTo = (!assignedTo ? [] : assignedTo); 
        this.showModal = false;
    }
}

class Column {
    constructor(columnId, boardId, name, color, watch, cards, order) {
        this.columnId = columnId;
        this.boardId = boardId;
        this.name = name;
        this.color = color;
        this.watch = (!watch ? false : true); // probably better way 
        this.cards = (!cards ? [] : cards); // new column will start without cards
        this.order = order;
        this.showModal = false;
    }
}

class Board {
    constructor(boardId, name, backgroundImage, color, tags, boardDescription, projectDeadline, priority, columns) {
        this.boardId = boardId; 
        this.name = name;
        this.backgroundImage = backgroundImage;
        this.color = color; 
        this.tags = (!tags ? [] : tags);
        this.boardDescription = boardDescription;
        this.projectDeadline = projectDeadline;
        this.priority = priority;
        this.columns = (!columns ? [] : columns);  // new project will start without column
    }
}



/* 
*
* Example project data for testing tidywork.space project 
*
* @authors Joseph Nagy
*/


// TAGS 
EXAMPLE_TAG_0 = {
    tagId: 1, 
    description: "highPriority",
    boardId: 1
}
EXAMPLE_TAG_1 = {
    tagId: 2,
    description: "lowPriority",
    boardId: 1
}

// COMMENTS 

// example card 0 
const EXAMPLE_COMMENT_0 = {
    commentId: 1,
    timestamp: "2021-01-31T12:00",
    description: "This is an example comment"
}

const EXAMPLE_COMMENT_1 = {
    commentId: 2,
    timestamp: "2021-01-31T12:00",
    description: "This is an example comment also"
}

const EXAMPLE_COMMENT_2 = {
    commentId: 2,
    timestamp: "2021-03-31T12:00",
    description: "This is an example comment!!! Look at me"
}


const EXAMPLE_CARD_0_COMMENTS = [EXAMPLE_COMMENT_0, EXAMPLE_COMMENT_1];

// CARDS

// example column 0 
const EXAMPLE_CARD_0 = {
    cardId: 1, 
    columnId: 1,
    name: "Design UX",
    color: "#915D1C",
    description: `Have to figure out the UX Design...`,
    deadline: "2021-02-02T23:59",
    priority: "1",
    tags: [EXAMPLE_TAG_0, EXAMPLE_TAG_1],
    comments: EXAMPLE_CARD_0_COMMENTS,
    checklists: [],
    asignedTo: [], 
    showModal: false
}

const EXAMPLE_CARD_1 = {
    cardId: 2,
    columnId: 1,
    name: "Design UI",
    color: "#912D5C",
    description: `The Design is essential`,
    deadline: "2021-02-02T23:59",
    priority: "1",
    tags: [EXAMPLE_TAG_0, EXAMPLE_TAG_1],
    comments: EXAMPLE_COMMENT_2,
    checklists: [],
    asignedTo: [],
    showModal: false
}

const EXAMPLE_CARD_2 = {
    cardId: 2,
    columnId: 1,
    name: "Market Research",
    color: "#ABC123",
    description: `Have to research the market`,
    deadline: "2021-02-02T23:59",
    priority: "1",
    tags: [EXAMPLE_TAG_0, EXAMPLE_TAG_1],
    comments: EXAMPLE_COMMENT_2,
    checklists: [],
    asignedTo: [],
    showModal: false
}

const EXAMPLE_CARD_3 = {
    cardId: 2,
    columnId: 1,
    name: "Meeting",
    color: "#AA2144",
    description: `Have to attend meeting`,
    deadline: "2021-02-02T23:59",
    priority: "1",
    tags: [EXAMPLE_TAG_0, EXAMPLE_TAG_1],
    comments: EXAMPLE_COMMENT_2,
    checklists: [],
    asignedTo: [],
    showModal: false
}


// COLUMNS
const EXAMPLE_COLUMN_0 = {
    columnId: 1, 
    boardId: 1,
    name: "ToDo",
    color: "#aaaaaa",
    watch: false,
    cards: [EXAMPLE_CARD_0, EXAMPLE_CARD_1],
    order: "alphabetical",
    showModal: false
}

const EXAMPLE_COLUMN_1 = {
    columnId: 2,
    boardId: 1,
    name: "Doing",
    color: "#aaaaaa",
    watch: false,
    cards: [EXAMPLE_CARD_2],
    order: "alphabetical",
    showModal: false
}

const EXAMPLE_COLUMN_2 = {
    columnId: 2,
    boardId: 1,
    name: "Done",
    color: "#aaaaaa",
    watch: false,
    cards: [EXAMPLE_CARD_3],
    order: "alphabetical",
    showModal: false
}


// BOARDS
const EXAMPLE_BOARD_0 = {
    boardId: 1,
    name: "Schoolwork",
    color: "#aaaaaa",
    backgroundImage: "beach.jpg",
    tags: [EXAMPLE_TAG_0, EXAMPLE_TAG_1],
    boardDescription: "This tidywork.space board is used to organize the schoolwork for my classes",
    projectDeadline: "",
    priority: 2,
    columns: [EXAMPLE_COLUMN_0, EXAMPLE_COLUMN_1, EXAMPLE_COLUMN_2]
}
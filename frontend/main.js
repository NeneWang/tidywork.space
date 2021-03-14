/*
 * tidywork.space application
 *
 * @authors Joseph Nagy, Nelson Wang
 */

const app = new Vue({
    data() {
        return {
            dummyJson: null,
            jsonData: null, 
            currentUser: null,
            currentBoard: EXAMPLE_BOARD_0,
            columns: EXAMPLE_BOARD_0.columns,
            boards: EXAMPLE_BOARD_LIST,
            cardToMoveDestination: null,
            newBoard: {
                boardId: null,
                name: "",
                backgroundImage: "",
                color: "",
                tags: [],
                boardDescription: "",
                projectDeadline: "",
                priority: "",
                columns: []
            },
            newCard: {
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
            },
            newColumn: {
                columnId: null, 
                boardId: null, 
                name: "",
                color: "",
                watch: false,
                color: "",
                cards: [],
                order: "alphabetical",
                showModal: false,
            },
            newComment: {
                commentId: null, 
                timestamp: "",
                description: ""
            }, 
            newTag: {
                tagId: null, 
                name: "", 
                color: ""
            }
        }
    }, 
    methods: {
        // BACKEND functions

        // API fetch function
        fetchApi() {
            axios.get('http://wngnelson.com/api/tidywork/api/board.php').
                then(response => {

                    // TODO: make this equivalent to wahtever data you are using
                    this.jsonData = response.data;
                    populateCurrentBoard(); 
                }
                );
        },
        // API uplodad function
        uploadApi(dataToUpload) {

            console.log("posting the following data: ");
            // console.log(JSON.stringify(dataToUpload));

            const params = new URLSearchParams()
            params.append('update', JSON.stringify(dataToUpload))

            // var obj = {};
            // obj["update"] = dataToUpload;

            const config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }

            axios.post('http://wngnelson.com/api/tidywork/api/board.php',
                params, config).then((res) => {
                    console.log(res);
                    console.log(res["data"]);
                });
        },

        // populates currentBoard based on data fetched from DB 
        populateCurrentBoard(){
            // extract arrays of each type of object (users, boards, columns, etc.) 
            let users = this.jsonData.users; 
            let boards = this.jsonData.boards; 
            let columns = this.jsonData.columns; 
            let cards = this.jsonData.cards;

            // call helper functions to format data
            let usersToBoards = this.mapUsersToBoards(users, boards); // usersToBoards = {*userId* : [{board}] }
            let boardsToColumns = this.mapBoardsToColumns(boards, columns); // boardsToColumns = {*boardId* : [{column}] }
            let columnsToCards = this.mapColumnsToCards(columns, cards); // columnsToCards = {*columnId* : [{card}] }

            // populate board, columns, etc based on user + selected board
        },

        // helper function to map users to their associated board (objects) based on FK (boardId) in user.userData.tables
        // return: organizeUsers: {*userId* : [{board}] }
        mapUsersToBoards(users, boards){
            let organizeUsers = {};
            // for each user 
            for(i=0; i<users.length; i++){
                // array of boards -> filters for boards associated with users[i]
                // note: DB set up st userData.tables is array of ints, but board.boardId is a string
                let userBoards = boards.filter((board) => users[i].userData.tables.includes(parseInt(board.boardId)));
                // add userId field to organizeUsers object, set equal to array of boards
                Vue.set(organizeUsers, users[i].userId, userBoards); 
            }
            return organizeUsers; 

            // TODO: set this.boards equal to array of boards based on this.currentUser
        },

        // helper function to map boards to their associated column (objects) based on FK (boardId) in column.columnData.boardId
        // organizeBoards: {*boardId* : [{column}] }
        mapBoardsToColumns(boards, columns) {
            let organizeBoards = {};
            // for each board 
            for (i=0; i<boards.length; i++) {
                // array of columns -> filters for columns associated with boards[i]
                // note: DB set up st board.boardId is a string, but column.columnData.boardId is an int
                let boardColumns = columns.filter((column) => column.columnData.boardId === parseInt(boards[i].boardId));
                // add boardId field to organizeBoards object, set equal to array of columns
                Vue.set(organizeBoards, boards[i].boardId, boardColumns); 
            }
            return organizeBoards; 

            // TODO: set this.columns equal to array of columns based on this.currentBoard
        },

        // helper function to map columns to their associated card (objects) based on FK (columnId) in card.cardData.columnId
        // organizeColumns: {*columnId* : [{card}] }
        mapColumnsToCards(columns, cards){
            let organizeColumns = {};
            // for each column
            for(i=0; i<columns.length; i++){
                // array of cards -> filters for cards associated with columns[i]
                // note: DB set up st column.columnId is a string, but card.cardData.columnId is an int
                let columnCards = cards.filter((card) => card.cardData.columnId === parseInt(columns[i].columnId));
                // add columnId field to organizeColumns object, set equal to array of cards
                Vue.set(organizeColumns, columns[i].columnId, columnCards); 
            }
            return organizeColumns; 

            // for each column in columns 
            // (afterthought: I thinkkk this can go inside for loop instead of separate one)
            // putting it down here for consistency 
                // TODO: set this.columns[index] equal to organizeColumns[index] 
        },
        


        // FRONTEND functions

        // switches current board, columns 
        switchBoards(){
            this.columns = this.currentBoard.columns; 
        },

        // helper function that convert javascript date object to ISO string ('YYYY-MM-DDThh:mm')
        javascriptDateObjectToISOString(date) {
            day = date.getDate().toString();
            day = ((day.length === 1) ? '0' + day : day); // add zero in front if necessary 
            month = (date.getMonth() + 1).toString(); // +1 because .getMonth returns int 0-11
            month = ((month.length === 1) ? '0' + month : month); // add zero in front if necessary
            year = date.getFullYear().toString();
            ymd = [year, month, day].join("-") // ymd = 'YYYY-MM-DD'
            time = date.toString().split(" ")[4].substring(0, 5); // 'hh:mm'
            return [ymd, time].join("T");
        },
        // helper function that takes ISO date('YYYY-MM-DDThh:mm') and returns a display string for dates
        // TODO: make this cleaner
        displayDate(date) {
            if (date === undefined) {
                return "undefined time"
            } else {
                dateComponents = date.split('-');
                year = dateComponents[0];
                month = dateComponents[1];
                day = dateComponents[2].substring(0, 2);
                time = dateComponents[2].substring(3);
                d = [month, day, year].join("/")
                return d + " @ " + time;
            } 
        }, 
        // adds comment to card
        createComment(column, card) {
            // prepare comment content
            let now = new Date();
            let newCommentToAdd = new Comment(this.newComment.commentId, this.javascriptDateObjectToISOString(now), this.newComment.description);

            // add comment to card 
            this.columns[column].cards[card].comments.push(newCommentToAdd);

            // reset field
            this.newComment = resetNewComment;
        },
        // creates a new card and adds it to a specific column based on the column index (col)
        createCard(col) {
            // prevent user from creating card without all fields 
            // TODO: improve later to handle blank inputs
            if (this.newCard.name === "" || this.newCard.description === "" || this.newCard.deadline === "" ) {
                window.alert("Please fill in all card fields!");
                return;
            }
            // create new card using constructor 
            let newCardToAdd = new Card(this.newCard.cardId, this.newCard.columnId, this.newCard.name, this.newCard.color, this.newCard.description, this.newCard.deadline, this.newCard.priority, this.newCard.tags, [], [],[]);
            // push new card to the list of column's cards
            this.columns[col].cards.push(newCardToAdd);
            // reset newCard fields using resetNewCard (const in classes.js)
            this.newCard = resetNewCard;
        }, 
        createColumn() {
            // create new column using constructor 
            let newColumnToAdd = new Column(this.newColumn.columnId, this.newColumn.boardId, this.newColumn.name, this.newColumn.color, this.newColumn.watch, this.newColumn.cards, this.newColumn.order);
            // push new column to the end of columns 
            this.columns.push(newColumnToAdd);
            // reset newColumn fields 
            this.newColumn = resetNewColumn; 
        },
        createBoard() {
            // create new board using constructor 
            let newBoardToAdd = new Board(this.newBoard.boardId, this.newBoard.name, this.newBoard.backgroundImage, this.newBoard.color, this.newBoard.tags, this.newBoard.boardDescription, this.newBoard.projectDeadline, this.newBoard.priority, this.newBoard.columns);
            // push new board to the end of boards 
            this.boards.push(newBoardToAdd);
            // reset newColumn fields 
            this.newBoard = resetNewBoard;
            // switch to new board 
            this.currentBoard = newBoardToAdd;
            // clear columns
            this.columns = []; 

        },
        // deletes card from column based on indicies
        deleteCard(column, card) {
            this.columns[column].cards.splice(card, 1);
        },
        // deletes column based on index 
        deleteColumn(column) {
            this.columns.splice(column, 1);
        },
        deleteComment(column, card, comment){
            this.columns[column].cards[card].comments.splice(comment, 1);
        },
        // moves card from one column to another 
        moveCard(column, card) {
            // store card object 
            let cardToMove = this.columns[column].cards[card];

            // push it to destination 
            this.columns[this.cardToMoveDestination].cards.push(cardToMove);

            // remove card from old column
            this.deleteCard(column, card);

            // reset fields
            this.cardToMoveDestination = null;
        },
    }
}); 

// connect Vue app instance with HTML element with id="app" to display it
app.$mount('#app');
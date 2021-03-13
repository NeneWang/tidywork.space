/*
 * tidywork.space application
 *
 * @authors Joseph Nagy
 */

// ##API


const app = new Vue({

    data() {
        return {
            testText: "This is just me playing with Vue",
            dummyData: dummyJson,
            currentBoard: EXAMPLE_BOARD_0,
            columns: EXAMPLE_BOARD_0.columns,
            cardToMoveDestination: null,
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
        // ##API
        fetchApi: function () {
            axios.get('http://wngnelson.com/api/tidywork/api/board.php').
                then(response => {

                    // ##TODO: make this equivalent to wahtever data you are using
                    console.log(response.data)
                }
                );
        },
        uploadApi: function (dataToUpload) {

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
        // TODO: 
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
            if (this.newCard.name === "" || this.newCard.description === "" || this.newCard.deadline === "") {
                window.alert("Please fill in all card fields!");
                return;
            }
            // create new card using constructor 
            let newCardToAdd = new Card(this.newCard.cardId, this.newCard.columnId, this.newCard.name, this.newCard.color, this.newCard.description, this.newCard.deadline, this.newCard.priority, this.newCard.tags, [], [], []);
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
        // deletes card from column based on indicies
        deleteCard(column, card) {
            this.columns[column].cards.splice(card, 1);
        },
        // deletes column based on index 
        deleteColumn(column) {
            this.columns.splice(column, 1);
        },
        deleteComment(column, card, comment) {
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
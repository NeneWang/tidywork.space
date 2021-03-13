/*
 * tidywork.space application
 *
 * @authors Joseph Nagy
 */

const app = new Vue({
    data() {
        return {
            testText: "hello world",
            currentBoard: EXAMPLE_BOARD_0,
            columns: EXAMPLE_BOARD_0.columns,
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
                color: ""
            }, 
            newTag: {
                tagId: null, 
                name: "", 
                color: ""
            }
        }
    }, 
    methods: {
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
        }
    }
}); 

// connect Vue app instance with HTML element with id="app" to display it
app.$mount('#app');
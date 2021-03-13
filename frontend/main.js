/*
 * tidywork.space application
 *
 * @authors Joseph Nagy
 */

const app = new Vue({
    data() {
        return {
            testText: "hello world", 
            currentProject: EXAMPLE_PROJECT_0,
            taskLists: EXAMPLE_PROJECT_0.taskLists,
            cards: EXAMPLE_PROJECT_0.cards
        }
    }
}); 

// connect Vue app instance with HTML element with id="app" to display it
app.$mount('#app');
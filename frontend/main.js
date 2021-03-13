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
        }
    }
}); 

// connect Vue app instance with HTML element with id="app" to display it
app.$mount('#app');
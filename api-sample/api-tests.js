const fetchBtn = document.getElementById("btn-fetch");

const getData = () => {
    console.log("Fetching...");
    axios.get('https://reqres.in/api/users').then(
        console.log(Response)
    );
};


var hiddenBox = $( "#btn-fetch" );
hiddenBox.text("Fetch! sd");
hiddenBox.click(function () {
    console.log("Fetching...");
});


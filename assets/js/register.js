

const formRegister = document.querySelector("#formRegister");
formRegister.addEventListener("submit",async (event) => {

    event.preventDefault();
    const data = await fetch(`http://localhost/joille/api/users`,{
        method: "POST",
        body: new FormData(formRegister)
        
    });

    const user = await data.json();
    console.log(user);
});













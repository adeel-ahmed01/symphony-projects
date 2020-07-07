import '../css/home.css';

console.log("Hello everybody!");

const booksElts = document.getElementsByClassName("book");
booksElts.forEach(
    (b) => {
        b.addEventListener('click', (event) => {
            console.log(event);
        })
    }
);

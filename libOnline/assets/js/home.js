import '../css/home.css';

const booksElts = document.getElementsByClassName("book");
booksElts.forEach(
    (b) => {
        b.addEventListener('click', (event) => {
            console.log(event);
        })
    }
);

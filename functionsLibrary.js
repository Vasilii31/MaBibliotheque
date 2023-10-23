
const nbBooks_per_shelf = 6;


class livre{
    titre;
    auteur;
    genre;
    lu;
    cover;

    constructor(titre, auteur, genre, lu, cover)
    {
        this.titre = titre;
        this.auteur = auteur;
        this.genre = genre;
        this.lu = lu;
        this.cover = cover;
    }

    DoitAfficher(filter, search)
    {
        switch (filter)
        {
            case 'Nom':
                if(this.titre.includes(search))
                    return true;
                else
                    return false;
                break;
            case 'Auteur':
                if(this.auteur.includes(search))
                    return true;
                else
                    return false;
                break;
            case 'Genre':
                if(this.genre.includes(search))
                    return true;
                else
                    return false;
                break;
            case 'Lu':
                if(this.lu == search)
                    return true;
                else
                    return false;
                break;
            default: 
                return true;
        }
    }
}



document.addEventListener('DOMContentLoaded', (event) => {

    CreateLibrary(myBooks);
    initializeBooksEvents();
    initializeButtons();

    
})

function CreateLibrary(booksArray)
{
    var nb_shelves = calc_nb_shelves(booksArray.length, nbBooks_per_shelf);
    //On enleve 1 au resultat vu qu'on a déja le template
    shelves = CreateShelves(nb_shelves - 1);
    console.log(shelves);
    booksdisplayed = Put_Books_In_Shelves(shelves, nbBooks_per_shelf, booksArray, nb_shelves);
}

function Put_Books_In_Shelves(shelves, nbBooks_per_shelf , booksArray, nb_shelves)
{
    var booksInView = [];
    for(var j = 0; j < nb_shelves; j++)
    {
        var limit = j * nbBooks_per_shelf + nbBooks_per_shelf ;
        if(limit > booksArray.length)
        {
            //limit = (j * nbBooks_per_shelf) + limit - booksArray.length;
            limit = booksArray.length;
        }
        for(var i = j * nbBooks_per_shelf; i < limit; i++)
        {
            b = CreateBook(shelves[j],booksArray[i]);
            booksInView.push(b);
        }
    }
    return(booksInView);
}

function CreateBook(shelf, book)
{

    const clickable = document.createElement("a");
    clickable.href = "ficheLivre.php?id=" + book[0];
    const divBook = document.createElement("div");
    divBook.className = "book";
    if(book[5] != null)
    {
        divBook.style.background = 'linear-gradient(to right, rgb(60, 13, 20) 3px, rgba(255, 255, 255, 0.5) 5px, rgba(255, 255, 255, 0.25) 7px, rgba(255, 255, 255, 0.25) 10px, transparent 12px, transparent 16px, rgba(255, 255, 255, 0.25) 17px, transparent 22px), url(./bookCovers/'+ book[5] +')';    
    }else{
        divBook.style.background = 'linear-gradient(to right, rgb(60, 13, 20) 3px, rgba(255, 255, 255, 0.5) 5px, rgba(255, 255, 255, 0.25) 7px, rgba(255, 255, 255, 0.25) 10px, transparent 12px, transparent 16px, rgba(255, 255, 255, 0.25) 17px, transparent 22px)';
        const booktext = document.createElement("p");
        booktext.textContent = book[1];
        booktext.className = "textTemplate";
        divBook.appendChild(booktext);
    }
    
    divBook.style.backgroundSize = "contain";
    divBook.style.backgroundRepeat = "no-repeat";
    divBook.style.backgroundPosition = 'right';
    divBook.style.backgroundColor = 'brown';

    clickable.appendChild(divBook);
    let bc = shelf.children;
    bc[1].appendChild(clickable);

    return clickable;
}

function calc_nb_shelves(nbBooks, books_per_shelves)
{
    if((nbBooks % books_per_shelves) != 0)
    {
        return (Math.floor(nbBooks / books_per_shelves)+ 1);
    } 
    else
        return Math.floor(nbBooks / books_per_shelves);
}

function CreateShelves(nb_shelves)
{
    var bookshelves = [];
    const shelf_template =  document.getElementById('shelf');
    bookshelves.unshift(shelf_template);
    console.log(nb_shelves);
    if(nb_shelves == -1)
    {
        return bookshelves;
    }
    for(var i = 0; i < nb_shelves; i++)
    {
        var ns = CreateOneShelf(shelf_template);
        bookshelves.unshift(ns);
    }
    return bookshelves;
}

function CreateOneShelf(shelfTemplate)
{
    newshelf = shelfTemplate.cloneNode(true);
    //test avec la scrolldiv
    var scrolldiv = document.getElementById("sD");
    scrolldiv.appendChild(newshelf);
    //document.body.insertBefore(newshelf, shelfTemplate);
    return newshelf;
}

function initializeBooksEvents()
{
    bookList = document.querySelectorAll(".displayLivre");
    bookList.forEach(element => {
        element.addEventListener("mouseover", function(event){
            element.style.border = "solid #ff7f00 10px";
        });
    });

    bookList.forEach(element => {
        element.addEventListener("mouseleave", function(event){
            element.style.border = "solid #5B6DCD 10px";
        });
    });

    bookListNV = document.querySelectorAll(".book");
    bookListNV.forEach(element => {
        element.addEventListener("mouseover", function(event){
            element.style.backgroundColor= "blue";
        });
    });

    bookListNV.forEach(element => {
        element.addEventListener("mouseleave", function(event){
            element.style.backgroundColor= "brown";
        });
    });
}


function initializeButtons()
{
    const recherche = document.getElementById("RequestSearch");
    recherche.addEventListener("click", SearchBooks);

    const cancelSearch = document.getElementById("CancelSearch");
    cancelSearch.addEventListener('click', Cancel_ReloadLibrary);
    btnList = document.querySelectorAll(".btn");
    btnList.forEach(element => {
        element.addEventListener("mouseover", function(event){
            element.style.border = "solid #ff7f00 10px";
        });
    });

    btnList.forEach(element => {
        element.addEventListener("mouseleave", function(event){
            element.style.border = "solid #26a8a2 10px";
        });
    });
}

function Cancel_ReloadLibrary()
{
    ReloadLibrary(myBooks, shelves, booksdisplayed);
}

function SearchBooks()
{
    const searchParam = document.getElementById("search");
    const searchBy = document.getElementById("searchBySelector");
    if(searchBy.value == "" || searchParam.value == "")
    {
        if(searchBy.value == "")
        {
            window.alert('Veuillez renseigner une valeur dans le champ "Rechercher Par"');
        }
        else if(searchParam.value == "")
        {
            window.alert('Veuillez renseigner une valeur dans le champ "Votre Recherche"');
        }
    }
    else{
        console.log("ALLO");
        const searchlibrary = CreateLibrary_FromSearch(myBooks, searchBy.value, searchParam.value);
        ReloadLibrary(searchlibrary, shelves, booksdisplayed);
    }
    
}

function CreateLibrary_FromSearch(books, searchKey, searchValue)
{
    var arr = [];
    
    switch (searchKey)
    {
        case 'Nom':
            for(var i = 0; i < books.length; i++)
            {
                if(books[i][1].toLowerCase().includes(searchValue.toLowerCase()))
                    arr.push(books[i]); 
            } 
            break;
        case 'Auteur':
            for(var i = 0; i < books.length; i++)
            {
                if(books[i][2].toLowerCase().includes(searchValue.toLowerCase()))
                    arr.push(books[i]); 
            } 
            break;
        case 'Genre':
            for(var i = 0; i < books.length; i++)
            {
                if(books[i][7].toLowerCase().includes(searchValue.toLowerCase()))
                    arr.push(books[i]); 
            } 
            break;
        case 'Lu':
            break;
        default: 
            break;
    }
    return arr;
}

function ReloadLibrary(newLibrary, shelves, booksdisplayed)
{
    DestroyLibrary(shelves, booksdisplayed);
    CreateLibrary(newLibrary);
    initializeBooksEvents();
}

function DestroyLibrary(shelves, booksdisplayed)
{
    for(var i = 0; i < booksdisplayed.length; i++)
    {
        booksdisplayed[i].remove();
    }
    booksdisplayed = [];  
    for(var i = 0; i < shelves.length - 1; i++)
    {
        shelves[i].remove();
    }
    shelves = [];
}





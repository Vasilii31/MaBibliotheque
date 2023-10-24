document.addEventListener('DOMContentLoaded', (event) => {


    const btnModify = document.getElementById("btnModify");
    const btnAdd = document.getElementById("btnAdd");
    const formAjoutGenre = document.getElementById("AddForm");
    const formModifyGenre = document.getElementById("ModifyGenreForm");
    const genresSelector = document.getElementById("genres");
    const inputModify = document.getElementById("inputModify");
    const submitModify = document.getElementById("submitModify");

    btnModify.addEventListener('click', () => {
    
        console.log("clickModify");
        if(formModifyGenre.classList.contains('hidden'))
        {
            formAjoutGenre.classList.add('hidden');
            formModifyGenre.classList.remove('hidden');
            formModifyGenre.classList.add('show');
        }
    })


    btnAdd.addEventListener('click', () => {
            
        console.log("clickAdd");
        if(formAjoutGenre.classList.contains('hidden'))
        {
            formModifyGenre.classList.add('hidden');
            formAjoutGenre.classList.remove('hidden');
            formAjoutGenre.classList.add('show');
        }
    })
    
    genresSelector.addEventListener("change", () => {
        console.log(genresSelector.value);
       
        if(genresSelector.value === "")
        {
            inputModify.classList.add("hidden");
            submitModify.classList.add("hidden");
        }
        else
        {
            var inputText = genresSelector.options[genresSelector.selectedIndex].text;
            inputModify.value = inputText;
            inputModify.classList.remove("hidden");
            submitModify.classList.remove("hidden");
        }

    })
    
})   
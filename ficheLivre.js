document.addEventListener('DOMContentLoaded', (event) => {

    const btnSupprimer = document.getElementById("btnSupprimer");
    const btnModify = document.getElementById("btnModifier");
    const infos_livre = document.getElementById("infoslivre");
    const infos_livre_modif = document.getElementById("formInfosLivre");
    const carrousel_form = document.getElementById("carrouselModify");

    btnModify.addEventListener('click', () => {
        
        console.log("click");
        if(infos_livre_modif.classList.contains('hidden'))
        {
            carrousel_form.style.transform = 'translateX(-25%)';
            carrousel_form.style.transition = 'transform .5s';
            infos_livre.classList.add('hidden');
            infos_livre_modif.classList.remove('hidden');
        }
    })

    btnSupprimer.addEventListener('click', () => {
        
        console.log("click");
        if (window.confirm("Souhaitez-vous supprimer ce livre ?")) 
        {
            console.log("confirmé. SUPPRESSION");
            var url =  new URL(document.location.href);
            var id = url.searchParams.get('id');
            document.location.href = "http://mabibliotheque.com/delete.php?id=" + id;
            /*let xhr = new XMLHttpRequest();
            xhr.open("GET", "/delete.php?id");
            var url =  new URL(document.location.href);
            var id = url.searchParams.get('id');
            console.log(url.searchParams.get('id'));
            xhr.send(id);*/

            //xhr.setRequestHeader("Accept", "application/json");
            //xhr.setRequestHeader("Content-Type", "application/json");
        }
    })
})   
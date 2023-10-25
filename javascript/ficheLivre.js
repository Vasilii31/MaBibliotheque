document.addEventListener('DOMContentLoaded', (event) => {

    const btnSupprimer = document.getElementById("btnSupprimer");
    const btnModify = document.getElementById("btnModifier");
    const infos_livre = document.getElementById("infoslivre");
    const infos_livre_modif = document.getElementById("formInfosLivre");
    const carrousel_form = document.getElementById("carrouselModify");

    if(btnModify != null)
    {
            btnModify.addEventListener('click', () => {
            
            console.log("click");
            if(infos_livre_modif.classList.contains('hidden'))
            {
                carrousel_form.style.transform = 'translateX(-60%)';
                carrousel_form.style.transition = 'transform .5s';
                infos_livre.classList.add('hidden');
                infos_livre_modif.classList.remove('hidden');
            }
        })
    }
    

    
})   
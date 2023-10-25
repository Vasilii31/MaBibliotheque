
function DropDownRechercher() {
    document.getElementById("DropDownRechercher").classList.toggle("show");
  }

function DropDownAjouter() {
    document.getElementById("DropDownAjouter").classList.toggle("show");
  }

function DropDownAjouterLivre()
{
    document.getElementById("DropDownAjouterLivre").classList.toggle("show");
} 

function DropDownAjouterGenre()
{
    document.getElementById("DropDownAjouterGenre").classList.toggle("show");
}

function Cancel()
{
    var dropdownsides = document.getElementsByClassName('dropdown-content-side');
    for(var i = 0; i < dropdownsides.length; i++)
    {
        if(dropdownsides[i].classList.contains('show'))
        {
            dropdownsides[i].classList.remove('show');
        }
    }
    var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }

}
  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
    console.log(console.log(event.target));
    
    if (!event.target.matches('.dropbtn')) {
      var dropdownsides = document.getElementsByClassName('dropdown-content-side');
      {
        console.log(dropdownsides);
        for(var i = 0; i < dropdownsides.length; i++)
        {
            if(dropdownsides[i].classList.contains('show'))
            {
                dropdownsides[i].classList.remove('show');
            }
        }
      }  
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }

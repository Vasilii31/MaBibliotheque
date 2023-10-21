
    <div id="header">
    <a href="index.php">
        <h1>Ma bibliothèque</h1>
    </a>
    <div class="dropdown">
        <button onclick="DropDownAjouter()" class="dropbtn">Ajouter</button>
        <div id="DropDownAjouter" class="dropdown-content">
        <div class="dropdown-side">
            <button onclick="DropDownAjouterLivre()" class="dropbtn-side">Ajouter un livre</button>
            <div id="DropDownAjouterLivre" class="dropdown-content-side">
                <div id="formAjoutLivre">
                        <form action="/add.php?idadd=livre" method="POST" enctype="multipart/form-data">
                            <input type="text" name="Nom" placeholder="Nom" required>
                            <input type="text" name="Auteur" placeholder="Auteur" required>
                            <select id="genres" name="Genre">
                            <?php
                                $genres = get_genres($db);
                                if(!isset($genres) || $genres == null)
                                {
                                    echo "OUPS";
                                }
                                foreach($genres as $row)
                                {
                                    echo '<option value="'.$row["IdGenre"].'">'.$row["NomGenre"].'</option>';
                                }
                        
                            ?>
                            <input type="date" name="lu">
                            <input type="file" name="fichier">
                            <input type="submit" value="Ajouter">
                            
                        </form>
                        <button onclick="Cancel()">Annuler</button>
                    </div> 
                </div>
        </div>
        <div class="dropdown-side">
            <button onclick="DropDownAjouterGenre()" class="dropbtn-side">Ajouter un Genre</button>
            <div id="DropDownAjouterGenre" class="dropdown-content-side">
                <div id="formAjoutLivre">
                        <form action='/add.php?idadd=genre' method="POST" enctype="multipart/form-data">
                            <input type="text" name="genre" placeholder="Genre à ajouter" required>
                            <input type="submit" value="Ajouter">                                
                        </form>
                        <button onclick="Cancel()">Annuler</button>
                    </div> 
                </div>
        </div>
                <a href="#">Ajouter un éditeur</a>
            </div>
    </div>
    <div id="Auth">
        <div>Connexion</div>
        <div>Creer un Compte</div>
    </div>
</div>
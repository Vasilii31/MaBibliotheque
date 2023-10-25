
<link rel="stylesheet" href="header.css" />
<script src="javascript/header.js"></script>

<div id="header">
        <a id="t" href="index.php">
            <h1 id="th1">Ma bibliothèque</h1>
        </a>
        <a href="index.php?add=true" class="headerClickable">Ajouter un livre</a>
        <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) : ?>
            <a href="AddGenre.php" class="headerClickable">Gérer les genres</a>
        <?php endif; ?>
            <div id="Auth">
                <div id="MAAuth">
                    <div id="NDAuth">
                        <p id="usname"><?php if(isset($_SESSION['UserName'])){echo $_SESSION['UserName'];} ?></p>
                        <a id="logout" href="auth.php?action=logout">Deconnexion</a>
                    </div>
                    <?php if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) : ?>
                        <a id="ModeAdmin" href="AdminAuth.php">Mode Admin</a>
                    <?php endif; ?>
                </div>
            </div>  
        </div>
          
    </div>
    
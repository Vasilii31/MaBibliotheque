
<link rel="stylesheet" href="header.css" />
<script src="header.js"></script>

<div id="header">
        <a id="t" href="index.php">
            <h1 id="th1">Ma bibliothèque</h1>
        </a>
        <a href="index.php?add=true" class="headerClickable">Ajouter un livre</a>
        <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) : ?>
            <a href="index.php?add=true" class="headerClickable">Ajouter un genre</a>
        <?php endif; ?>
            <div id="Auth">
                <div>
                    <a href="auth.php?action=logout">Deconnexion</a>
                    <?php if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) : ?>
                        <a href="AdminAuth.php">Mode Admin</a>
                    <?php endif; ?>
                </div>
            </div>  
        </div>
          
    </div>
    
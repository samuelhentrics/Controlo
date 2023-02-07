<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="<?php echo IMG_PATH.'logo.png'; ?>" alt="Logo de Controlo" height="24" class="d-inline-block align-text-top">
                Controlo
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo PATH; ?>">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo PAGE_CONTROLES_PATH; ?>">Contrôles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo PAGE_ETUDIANTS_PATH; ?>">Étudiants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo PAGE_ENSEIGNANTS_PATH; ?>">Enseignants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo PAGE_PROMOTIONS_PATH; ?>">Promotions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo PAGE_SALLES_PATH; ?>">Salles</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<script>
    if(location.search){       
        let param;
        location.search.includes('&') ? param = location.search.split("?page=")[1].split("&")[0] : param = location.search.split("?page=")[1];
        function removeAccents (text) {
            var accents    = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž',
                accentsOut = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz",
                textNoAccents = [];
                
                for (var i in text) { 
                var idx = accents.indexOf(text[i]);
                if (idx != -1)
                textNoAccents[i] = accentsOut.substr(idx, 1);
                else
                textNoAccents[i] = text[i];
            }
            
            return textNoAccents.join('');
        }
        document.querySelectorAll('a.nav-link').forEach(e => {
            removeAccents(e.innerText.toLowerCase()).includes(param) ? e.classList.add('active') : e.classList.remove('active');
        })
} 
</script>
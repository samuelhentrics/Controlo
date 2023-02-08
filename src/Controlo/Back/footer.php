<footer class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <p class="text-muted">
          <?php
          $anneeCourante = date("Y");
          echo "© 2022-$anneeCourante Controlo | ";

          ?>
          <a class="text-reset" href="<?php echo PAGE_MENTIONSLEGALES_PATH; ?>">Mentions Légales</a> | 
          <a class="text-reset" href="<?php echo PAGE_POLITIQUEDECONFIDENTIALITE_PATH; ?>">Politique de Confidentialité</a> | 
          <a class="text-reset" href="<?php echo PAGE_MANUELUTILISATEUR_PATH; ?>">Manuel Utilisateur</a>
        </p>
      </div>
      <div class="col-lg-3 d-flex justify-content-end">
        <p class="text-muted text-right">
          Version 1.5
        </p>
      </div>
    </div>
  </div>
</footer>

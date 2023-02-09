<div class="container">
    <div class="col-3"></div>
    <div class="col-6 m-auto text-center">
        <?php

        echo '
                <h2>
                    <form action="' . PAGE_SALLES_PATH . '" method="post" style="display:inline;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </button>
                    </form>
                    Ajouter une salle
                </h2><br>';
        ?>
        <form action=<?php echo PAGE_AJOUTER2_SALLE_PATH; ?> method="post">
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Nom de salle pour génération *</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="nomSalle" class="form-control" name="nomSalle" placeholder="Ex : S124" type="text"
                            class="form-salle" required="required">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="salleVoisine" class="col-4 col-form-label">Salle voisine *</label>
                <div class="col-8">
                    <div class="input-group">
                        <select class="form-control" id="salleVoisine" name="salleVoisine">
                            <option value="">Aucune</option>
                            <?php
                            include_once(FONCTION_CRUD_SALLES_PATH);
                            $listeSallesSansVoisin = recupererSallesSansVoisin();
                            foreach ($listeSallesSansVoisin as $nomSalle) {
                                echo "<option value='" . $nomSalle . "'>" . $nomSalle . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="nbrLigne" class="col-4 col-form-label">Nombre de lignes *</label>
                <div class="col-8">
                    <div class="input-group">
                        <input class="form-control" id="nbrLigne" name="nbrLigne" placeholder="Ex: 5" type="number"
                            class="form-salle" required="required">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="nbrColonne" class="col-4 col-form-label">Nombre de colonnes *</label>
                <div class="col-8">
                    <div class="input-group">
                        <input class="form-control" id="nbrColonne" name="nbrColonne" placeholder="Ex: 6" type="number"
                            class="form-salle" required="required">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Créer le plan de la
                        salle</button>
                </div>
            </div>

        </form>
    </div>
    <div class="col-3"></div>
    (*) signifie obligatoire
</div>
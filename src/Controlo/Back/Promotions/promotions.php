<div class="container">
    <div class="col-3"></div>
    <div class="col-6">
        <form action="<?php echo PAGE_AJOUTER_PROMOTION_PATH ?>" method="POST">
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Nom de promotion pour génération</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomLong" name="nomGeneration" placeholder="Ex : Info semestre 1" type="text" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="controleNomCourt" class="col-4 col-form-label">Nom de promotion pour affichage</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomCourt" name="nomFormation" placeholder="Ex: BUT Informatique S1" type="text" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-3"></div>
</div>
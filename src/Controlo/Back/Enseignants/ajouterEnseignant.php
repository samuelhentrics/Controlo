<div class="container">
    <!-- Affichage fonctionnalité en cours de développement -->
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Fonctionnalité en cours de développement</h4>
        <p>La fonctionnalité que vous essayez d'utiliser est en cours de développement. Elle sera disponible dans les prochaines versions.</p>
        <hr>
        <p class="mb-0">Merci de votre compréhension.</p>
    </div>

    
    <div class="col-3"></div>
    <div class="col-6">
        <form>
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Nom</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="nom" name="nom" placeholder="ex: Dupond" type="text" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="prenom" class="col-4 col-form-label">Prénom</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="prenom" name="prenom" placeholder="ex: Jean" type="text" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-4 col-form-label">Statut</label>
                <div class="col-8">
                    <div class="input-group">
                        <select id="statut" name="statut" class="custom-select" required="required">
                            <option value="1">Enseignant</option>
                            <option value="2">Administrateur</option>
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
    <div class="col-3"></div>
</div>
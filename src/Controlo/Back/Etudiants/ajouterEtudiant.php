<div class="container">
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Attention !</strong>
        <p>Cette page est en cours de développement.</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  <div class="col-3"></div>
  <div class="col-6 m-auto">
    <h2>Ajouter un étudiant</h2>
    <form>
      <div class="form-group row">
        <label for="nom" class="col-4 col-form-label">Nom</label>
        <div class="col-8">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fa fa-address-card"></i>
              </div>
            </div>
            <input id="nom" name="nom" placeholder="ex : DUPONT" type="text" class="form-control"
              required="required">
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="prenom" class="col-4 col-form-label">Prénom</label>
        <div class="col-8">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fa fa-address-card"></i>
              </div>
            </div>
            <input id="prenom" name="prenom" placeholder="ex : Paul" type="text" class="form-control"
              required="required">
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="promo" class="col-4 col-form-label">Promotion</label>
        <div class="col-8">
          <select id="promo" name="promo" class="custom-select" required="required">
            <option value="Info semestre 1">Info semestre 1</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="td" class="col-4 col-form-label">TD</label>
        <div class="col-8">
          <input id="td" name="td" placeholder="ex : 1" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="tp" class="col-4 col-form-label">TP</label>
        <div class="col-8">
          <input id="tp" name="tp" placeholder="ex : 1" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="mail" class="col-4 col-form-label">Mail</label>
        <div class="col-8">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fa fa-envelope"></i>
              </div>
            </div>
            <input id="mail" name="mail" placeholder="ex : pdupont@iutbayonne.univ-pau.fr" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-4">Statuts</label>
        <div class="col-8">
          <div class="custom-control custom-checkbox custom-control-inline">
            <input name="checkbox" id="checkbox_0" type="checkbox" class="custom-control-input" value="tt">
            <label for="checkbox_0" class="custom-control-label">Tiers-temps</label>
          </div>
          <div class="custom-control custom-checkbox custom-control-inline">
            <input name="checkbox" id="checkbox_1" type="checkbox" class="custom-control-input" value="ordi">
            <label for="checkbox_1" class="custom-control-label">Ordinateur</label>
          </div>
          <div class="custom-control custom-checkbox custom-control-inline">
            <input name="checkbox" id="checkbox_2" type="checkbox" class="custom-control-input" value="demissionnaire">
            <label for="checkbox_2" class="custom-control-label">Démissionnaire</label>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-4 col-8">
          <button name="submit" type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-3"></div>
</div>
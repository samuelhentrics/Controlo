<div class="container">
  <div class="col-3"></div>
  <div class="col-6">
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
            <input id="nom" name="nom" placeholder="Nom de l'étudiant" type="text" class="form-control"
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
            <input id="prenom" name="prenom" placeholder="Prenom de l'étudiant" type="text" class="form-control"
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
          <input id="td" name="td" placeholder="TD de l'étudiant" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="tp" class="col-4 col-form-label">TP</label>
        <div class="col-8">
          <input id="tp" name="tp" placeholder="TP de l'étudiant" type="text" class="form-control" required="required">
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
            <input id="mail" name="mail" placeholder="Mail de l'étudiant" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-4">Checkboxes</label>
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
          <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-3"></div>
</div>
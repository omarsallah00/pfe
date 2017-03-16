<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <div class="row">
        <?php if (validation_errors()) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <div class="page-header">
                <h1>Inscription</h1>
            </div>
            <?= form_open() ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Entrer une @ Mail" required>
<!--                <p class="help-block">Une @ Mail valide</p>-->
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrer un mot de passe" required>
<!--                <p class="help-block"></p>-->
            </div>
            <div class="form-group">
                <label for="password_confirm">Confimer votre mot de passe</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confimer votre mot de passe" required>
<!--                <p class="help-block">Ils doivent être identique</p>-->
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre Nom" required>
<!--                <p class="help-block">Un Nom valide :D </p>-->
            </div>
            <div class="form-group">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prenom" required>
<!--                <p class="help-block">Un Prenom valide :D</p>-->
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Enregistrer">
            </div>
            </form>
        </div>
    </div><!-- .row -->
</div><!-- .container -->
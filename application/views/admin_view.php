<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Direction de la Météorologie Nationale</title>
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/simple-sidebar.css') ?>" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js') ?>"></script>
        <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
    </head> 
    <body>


        <div class="appHeader">
            <div class="headerLogo">
                <img alt="logo" src="<?php echo base_url('assets/sig/images/rocket-logo.png') ?>" height="54" />
            </div>
            <div class="headerTitle">
                <span id="headerTitleSpan">
                    Direction de la Météorologie Nationale
                </span>
                <div id="subHeaderTitleSpan" class="subHeaderTitle">
                    Système d'information geographique
                </div>

            </div>
            <div class="search">
                <div id='geocodeDijit'>
                </div>
            </div>
            <div class="headerLinks">
                <div>

                    <?php if (isset($_SESSION['email'])) : ?>

                        <span><a href="<?= base_url('user/sig') ?>"><i class="glyphicon glyphicon-globe" style="padding:5px;"></i>SIG</a></span>

                        <span style="padding:10px;" class="my_admin"><a href="#"><i class="glyphicon glyphicon-user" style="padding:5px;"></i><?php echo $_SESSION['email']; ?></a></span>
                        <span><i class="icon-signout" style="padding:5px;" id="my_logout"></i><a href="<?= base_url('logout') ?>">Logout</a></span>
                    <?php else : ?>
                        <span><a href="<?= base_url('register') ?>"><i class="glyphicon glyphicon-pencil" style="padding:5px;"></i>Inscription</a></span>
                        <span><a href="<?= base_url('login') ?>"><i class="glyphicon glyphicon-log-in" style="padding:5px;"></i>Login</a></span>
                    <?php endif; ?>
                </div>
            </div>

        </div>
       
    </div
    <div  class="container">

        <div id="page-content-wrapper">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Utilisateurs</a></li>
                <li><a data-toggle="tab" href="#menu1">Couches</a></li>
                <li><a data-toggle="tab" href="#menu2">Groupes</a></li>

            </ul>

            <div class="tab-content">

                <br>
                <br>

                <div id="home" class="tab-pane fade in active">


                    <!--  container  utilisateur-->
                    <div class="container">

                        <button class="btn btn-success" onclick="add_utilisateur()"><i class="glyphicon glyphicon-plus"></i> Ajouter un utilisateur</button>
                        <button class="btn btn-default" onclick="reload_table_utilisateur()"><i class="glyphicon glyphicon-refresh"></i> Actualiser</button>
                        <br />
                        <br />
                        <table id="table_utilisateur" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Mot de passe</th>
                                    <th>Type</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Date d'ajout</th>
                                    <th>Nom de groupe</th>
                                    <th style="width:125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Email</th>
                                    <th>Mot de passe</th>
                                    <th>Type</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Date d'ajout</th>
                                    <th>Nom de groupe</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!--  modal  utilisateur-->
                    <div class="modal fade" id="modal_form_utilisateur" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title">Utilisateur Form</h3>
                                </div>
                                <div class="modal-body form">
                                    <form action="#" id="form_utilisateur" class="form-horizontal">
                                        <input type="hidden" value="" name="idutilisateur"/> 
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Email</label>
                                                <div class="col-md-9">
                                                    <input name="email" placeholder="Email" class="form-control" type="email" required>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Mot de passe</label>
                                                <div class="col-md-9">
                                                    <input name="password" placeholder="Mot de passe" class="form-control" type="text" required>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Type</label>
                                                <div class="col-md-9">
                                                    <select name="type" class="form-control" required>
                                                        <option value="">--Type--</option>
                                                        <option value="Utilisateur">Utilisateur</option>
                                                        <option value="Admin">Admin</option>
                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Nom</label>
                                                <div class="col-md-9">
                                                    <input name="nom" placeholder="Nom" class="form-control" type="text" required>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Prenom</label>
                                                <div class="col-md-9">
                                                    <input name="prenom" placeholder="Prenom" class="form-control" type="text" required>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Date d'ajout</label>
                                                <div class="col-md-9">
                                                    <input name="date_creation" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Groupe</label>
                                                <div class="col-md-9">
                                                    <select name="nom_groupe" class="form-control nom_groupe" required>
                                                        <option value="">--Type--</option>


                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="btnSave_utilisateur" onclick="save_utilisateur()" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>


                <div id="menu1" class="tab-pane fade">
                    <!--  container  couche-->
                    <div class="container">

                        <button class="btn btn-success" onclick="add_couche()"><i class="glyphicon glyphicon-plus"></i> Ajouter une couche</button>
                        <button class="btn btn-default" onclick="reload_table_couche()()"><i class="glyphicon glyphicon-refresh"></i> Actualiser</button>
                        <br />
                        <br />
                        <table id="table_couche" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <!--                    //`idcouche`, `type`, `url`, `title`, `idgroupe`-->
                                <tr>
                                    <th>type</th>
                                    <th>URL</th>
                                    <th>Title</th>
                                    <th>Nom Groupe</th>

                                    <th style="width:125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>type</th>
                                    <th>URL</th>
                                    <th>Title</th>
                                    <th>Nom Groupe</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!--  modal couche -->
                    <div class="modal fade" id="modal_form_couche" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title">couche Form</h3>
                                </div>
                                <div class="modal-body form">
                                    <!--                    //`idcouche`, `type`, `url`, `title`, `idgroupe`-->
                                    <form action="#" id="form_couche" class="form-horizontal">
                                        <input type="hidden" value="" name="idcouche"/> 
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Type</label>
                                                <div class="col-md-9">
                                                    <select name="type" class="form-control" required>
                                                        <option value="">--Type--</option>
                                                        <option value="feature">feature</option>

                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">URL</label>
                                                <div class="col-md-9">
                                                    <input name="url" placeholder="URL" class="form-control" type="text" required>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Title</label>
                                                <div class="col-md-9">
                                                    <input name="title" placeholder="Title" class="form-control" type="text" required>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Groupe</label>
                                                <div class="col-md-9">
                                                    <select name="nom_groupe" class="form-control nom_groupe" required >
                                                        <option value="">--Type--</option>


                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="btnSave_couche" onclick="save_couche()" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                </div><!-- /.modal -->
            </div>


            <div id="menu2" class="tab-pane fade">
                <!--  container  groupe-->
                <div class="container">

                    <button class="btn btn-success" onclick="add_groupe()"><i class="glyphicon glyphicon-plus"></i> Ajouter un groupe</button>
                    <button class="btn btn-default" onclick="reload_table_groupe()"><i class="glyphicon glyphicon-refresh"></i> Actualiser</button>
                    <br />
                    <br />
                    <table id="table_groupe" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nom de groupe</th>

                                <th style="width:125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Nom de groupe</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!--  modal groupe -->
                <div class="modal fade" id="modal_form_groupe" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">groupe Form</h3>
                            </div>
                            <div class="modal-body form">
                                <form action="#" id="form_groupe" class="form-horizontal">
                                    <input type="hidden" value="" name="idgroupe"/> 
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nom de groupe</label>
                                            <div class="col-md-9">
                                                <input name="nom_groupe" placeholder="Nom de groupe" class="form-control" type="text" required>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="btnSave_groupe" onclick="save_groupe()" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>

        </div>
    </div>

</div>





<!-- SCRIPT -->
<script type="text/javascript">

    var save_method_utilisateur; //for save method string
    var table_utilisateur;
    var save_method_couche; //for save method string
    var table_couche;
    var save_method_groupe; //for save method string
    var table_groupe;
    var items = "";

    $(document).ready(function () {

        //datatables
        table_utilisateur = $('#table_utilisateur').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('utilisateur/ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                },
            ],
        });
        table_couche = $('#table_couche').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('couche/ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                },
            ],
        });
        table_groupe = $('#table_groupe').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('groupe/ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                },
            ],
        });

        //datepicker
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
        });

        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

        $.getJSON("<?php echo site_url('groupe/select_groupe') ?>", function (data) {
            $.each(data, function (index, item)
            {
                items += "<option value='" + item.nom_groupe + "'>" + item.nom_groupe + "</option>";
            });
            $(".nom_groupe").html(items);
        });

    });



    function add_utilisateur()
    {
        save_method_utilisateur = 'add';
        $('#form_utilisateur')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form_utilisateur').modal('show'); // show bootstrap modal
        $('.modal-title').text('Ajouter un utilisateur'); // Set Title to Bootstrap modal title
    }

    function edit_utilisateur(idutilisateur)
    {
        save_method_utilisateur = 'update';
        $('#form_utilisateur')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('utilisateur/ajax_edit/') ?>/" + idutilisateur,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="idutilisateur"]').val(data.idutilisateur);
                $('[name="email"]').val(data.email);
                $('[name="password"]').val(data.password);
                $('[name="type"]').val(data.type);
                $('[name="nom"]').val(data.nom);
                $('[name="prenom"]').val(data.prenom);
                $('[name="date_creation"]').datepicker('update', data.date_creation);
                $('[name="nom_groupe"]').val(data.nom_groupe);
                $('#modal_form_utilisateur').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Modifier un utilisateur'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table_utilisateur()
    {
        table_utilisateur.ajax.reload(null, false); //reload datatable ajax 
    }

    function save_utilisateur()
    {
        $('#btnSave_utilisateur').text('saving...'); //change button text
        $('#btnSave_utilisateur').attr('disabled', true); //set button disable 
        var url;

        if (save_method_utilisateur == 'add') {
            url = "<?php echo site_url('utilisateur/ajax_add') ?>";
        } else {
            url = "<?php echo site_url('utilisateur/ajax_update') ?>";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form_utilisateur').serialize(),
            dataType: "JSON",
            success: function (data)
            {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form_utilisateur').modal('hide');
                    reload_table_utilisateur();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave_utilisateur').text('save'); //change button text
                $('#btnSave_utilisateur').attr('disabled', false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave_utilisateur').text('save'); //change button text
                $('#btnSave_utilisateur').attr('disabled', false); //set button enable 

            }
        });
    }

    function delete_utilisateur(idutilisateur)
    {
        if (confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('utilisateur/ajax_delete') ?>/" + idutilisateur,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    //if success reload ajax table
                    $('#modal_form_utilisateur').modal('hide');
                    reload_table_utilisateur();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }

    function add_couche()
    {
        save_method_couche = 'add';
        $('#form_couche')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form_couche').modal('show'); // show bootstrap modal
        $('.modal-title').text('Ajouter une couche'); // Set Title to Bootstrap modal title
    }

    function edit_couche(idcouche)
    {
        save_method_couche = 'update';
        $('#form_couche')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('couche/ajax_edit/') ?>/" + idcouche,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
//`idcouche`, `type`, `url`, `title`, `idgroupe`
                $('[name="idcouche"]').val(data.idcouche);
                $('[name="type"]').val(data.type);
                $('[name="url"]').val(data.url);
                $('[name="title"]').val(data.title);
                $('[name="nom_groupe"]').val(data.nom_groupe);
                $('#modal_form_couche').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Modifier une couche'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table_couche()
    {
        table_couche.ajax.reload(null, false); //reload datatable ajax 
    }

    function save_couche()
    {
        $('#btnSave_couche').text('saving...'); //change button text
        $('#btnSave_couche').attr('disabled', true); //set button disable 
        var url;

        if (save_method_couche == 'add') {
            url = "<?php echo site_url('couche/ajax_add') ?>";
        } else {
            url = "<?php echo site_url('couche/ajax_update') ?>";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form_couche').serialize(),
            dataType: "JSON",
            success: function (data)
            {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form_couche').modal('hide');
                    reload_table_couche();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave_couche').text('save'); //change button text
                $('#btnSave_couche').attr('disabled', false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave_couche').text('save'); //change button text
                $('#btnSave_couche').attr('disabled', false); //set button enable 

            }
        });
    }

    function delete_couche(idcouche)
    {
        if (confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('couche/ajax_delete') ?>/" + idcouche,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    //if success reload ajax table
                    $('#modal_form_couche').modal('hide');
                    reload_table_couche();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }
    function add_groupe()
    {
        save_method_groupe = 'add';
        $('#form_groupe')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form_groupe').modal('show'); // show bootstrap modal
        $('.modal-title').text('Ajouter un groupe'); // Set Title to Bootstrap modal title
    }

    function edit_groupe(idgroupe)
    {
        save_method_groupe = 'update';
        $('#form_groupe')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('groupe/ajax_edit/') ?>/" + idgroupe,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="idgroupe"]').val(data.idgroupe);
                $('[name="nom_groupe"]').val(data.nom_groupe);
                $('#modal_form_groupe').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Modifier un groupe'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table_groupe()
    {
        table_groupe.ajax.reload(null, false); //reload datatable ajax 
    }

    function save_groupe()
    {
        $('#btnSave_groupe').text('saving...'); //change button text
        $('#btnSave_groupe').attr('disabled', true); //set button disable 
        var url;

        if (save_method_groupe == 'add') {
            url = "<?php echo site_url('groupe/ajax_add') ?>";
        } else {
            url = "<?php echo site_url('groupe/ajax_update') ?>";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form_groupe').serialize(),
            dataType: "JSON",
            success: function (data)
            {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form_groupe').modal('hide');
                    reload_table_groupe();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave_groupe').text('save'); //change button text
                $('#btnSave_groupe').attr('disabled', false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave_groupe').text('save'); //change button text
                $('#btnSave_groupe').attr('disabled', false); //set button enable 

            }
        });
    }

    function delete_groupe(idgroupe)
    {
        if (confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('groupe/ajax_delete') ?>/" + idgroupe,
                type: "POST",
                dataType: "JSON",
                success: function (data)
                {
                    //if success reload ajax table
                    $('#modal_form_groupe').modal('hide');
                    reload_table_groupe();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }

</script>
</body>
</html>

<div class="container">

    <button class="btn btn-success" onclick="add_utilisateur()"><i class="glyphicon glyphicon-plus"></i> Ajouter un utilisateur</button>
    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Actualiser</button>
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




<script type="text/javascript">

        var save_method; //for save method string
        var table;

        $(document).ready(function () {

            //datatables
            table = $('#table_utilisateur').DataTable({
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

        });



        function add_utilisateur()
        {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Ajouter un utilisateur'); // Set Title to Bootstrap modal title
        }

        function edit_utilisateur(idutilisateur)
        {
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals
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
                    $('[name="idgroupe"]').val(data.idgroupe);
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Modifier un utilisateur'); // Set title to Bootstrap modal title

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function reload_table()
        {
            table.ajax.reload(null, false); //reload datatable ajax 
        }

        function save()
        {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 
            var url;

            if (save_method == 'add') {
                url = "<?php echo site_url('utilisateur/ajax_add') ?>";
            } else {
                url = "<?php echo site_url('utilisateur/ajax_update') ?>";
            }

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function (data)
                {

                    if (data.status) //if success close modal and reload ajax table
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++)
                        {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 

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
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });

            }
        }

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Utilisateur Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
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
                                <input name="idgroupe" placeholder="Groupe" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

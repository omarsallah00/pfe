        <div class="container">

            <button class="btn btn-success" onclick="add_couche()"><i class="glyphicon glyphicon-plus"></i> Ajouter un couche</button>
            <button class="btn btn-default" onclick="reload_table_couche()"><i class="glyphicon glyphicon-refresh"></i> Actualiser</button>
            <br />
            <br />
            <table id="table_couche" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <!--                    //`idcouche`, `type`, `url`, `title`, `idgroupe`-->
                    <tr>
                        <th>type</th>
                        <th>URL</th>
                        <th>Title</th>
                        <th>ID Groupe</th>

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
                        <th>ID Groupe</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>




        <script type="text/javascript">

                var save_method_couche; //for save method string
                var table_couche;

                $(document).ready(function () {

                    //datatables
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



                function add_couche()
                {
                    save_method_couche = 'add';
                    $('#form')[0].reset(); // reset form on modals
                    $('.form-group').removeClass('has-error'); // clear error class
                    $('.help-block').empty(); // clear error string
                    $('#modal_form').modal('show'); // show bootstrap modal
                    $('.modal-title').text('Ajouter un couche'); // Set Title to Bootstrap modal title
                }

                function edit_couche(idcouche)
                {
                    save_method_couche = 'update';
                    $('#form')[0].reset(); // reset form on modals
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
                            $('[name="idgroupe"]').val(data.idgroupe);
                            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                            $('.modal-title').text('Modifier un couche'); // Set title to Bootstrap modal title

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

                function save()
                {
                    $('#btnSave').text('saving...'); //change button text
                    $('#btnSave').attr('disabled', true); //set button disable 
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
                        data: $('#form').serialize(),
                        dataType: "JSON",
                        success: function (data)
                        {

                            if (data.status) //if success close modal and reload ajax table
                            {
                                $('#modal_form').modal('hide');
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
                                $('#modal_form').modal('hide');
                                reload_table_couche();
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
                                        <input name="type" placeholder="Type" class="form-control" type="text" required>
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
                                    <label class="control-label col-md-3">ID Groupe</label>
                                    <div class="col-md-9">
                                        <input name="idgroupe" placeholder="ID Groupe" class="form-control" type="text" required>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave_couche" onclick="save()" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


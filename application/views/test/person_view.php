<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ajax CRUD with Bootstrap modals and Datatables</title>
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/simple-sidebar.css') ?>" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head> 
    <body>

        <div class="appHeader">
            <div class="headerLogo">

                <img alt="logo" src="<?php echo base_url('assets/images/rocket-logo.png') ?>" height="54" />
            </div>
            <div class="headerTitle">
                <span id="headerTitleSpan">
                    Direction de la Météorologie Nationale
                </span>
<!--                <div id="subHeaderTitleSpan" class="subHeaderTitle">
                    Système d'information geographique
                </div>-->
            </div>
           
            <div class="collapse navbar-collapse" id="my_right_menu">
                <ul  class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?>
                        <li><a href="<?= base_url('logout') ?>">Logout</a></li>
                    <?php else : ?>
                        <li><a href="<?= base_url('register') ?>">Register</a></li>
                        <li><a href="<?= base_url('login') ?>">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div id="wrapper" class="container">
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
<!--                    <li class="sidebar-brand">
                        <a href="#">
                            Start Bootstrap
                        </a>
                    </li>-->
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li>
                        <a href="#">Shortcuts</a>
                    </li>
                    <li>
                        <a href="#">Overview</a>
                    </li>
                    <li>
                        <a href="#">Events</a>
                    </li>
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <div id="page-content-wrapper">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Utilisateurs</a></li>
                    <li><a data-toggle="tab" href="#menu1">Couches</a></li>
                    <li><a data-toggle="tab" href="#menu2">Groupes</a></li>

                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <br />
                        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Ajouter un utilisateur</button>
                        <br />
                        <br />
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Date of Birth</th>
                                    <th style="width:125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Date of Birth</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <br />
                        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Ajouter une couche</button>
                        <br />
                        <br />
                        <table id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Date of Birth</th>
                                    <th style="width:125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Date of Birth</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <br />
                        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Ajouter un groupe</button>
                        <br />
                        <br />
                        <table id="table3" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Date of Birth</th>
                                    <th style="width:125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Date of Birth</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js') ?>"></script>


        <script type="text/javascript">

                            var save_method; //for save method string
                            var table;
                            $(document).ready(function () {
                                table = $('#table').DataTable({
                                    "processing": true, //Feature control the processing indicator.
                                    "serverSide": true, //Feature control DataTables' server-side processing mode.

                                    // Load data for the table's content from an Ajax source
                                    "ajax": {
                                        "url": "<?php echo site_url('person/ajax_list') ?>",
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
                                table2 = $('#table2').DataTable({
                                    "processing": true, //Feature control the processing indicator.
                                    "serverSide": true, //Feature control DataTables' server-side processing mode.

                                    // Load data for the table's content from an Ajax source
                                    "ajax": {
                                        "url": "<?php echo site_url('person/ajax_list') ?>",
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
                                table3 = $('#table3').DataTable({
                                    "processing": true, //Feature control the processing indicator.
                                    "serverSide": true, //Feature control DataTables' server-side processing mode.

                                    // Load data for the table's content from an Ajax source
                                    "ajax": {
                                        "url": "<?php echo site_url('person/ajax_list') ?>",
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
                            });

                            function add_person()
                            {
                                save_method = 'add';
                                $('#form')[0].reset(); // reset form on modals
                                $('#modal_form').modal('show'); // show bootstrap modal
                                $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
                            }

                            function edit_person(id)
                            {
                                save_method = 'update';
                                $('#form')[0].reset(); // reset form on modals

                                //Ajax Load data from ajax
                                $.ajax({
                                    url: "<?php echo site_url('person/ajax_edit/') ?>/" + id,
                                    type: "GET",
                                    dataType: "JSON",
                                    success: function (data)
                                    {

                                        $('[name="id"]').val(data.id);
                                        $('[name="firstName"]').val(data.firstName);
                                        $('[name="lastName"]').val(data.lastName);
                                        $('[name="gender"]').val(data.gender);
                                        $('[name="address"]').val(data.address);
                                        $('[name="dob"]').val(data.dob);

                                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                                        $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

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
                                var url;
                                if (save_method == 'add')
                                {
                                    url = "<?php echo site_url('person/ajax_add') ?>";
                                }
                                else
                                {
                                    url = "<?php echo site_url('person/ajax_update') ?>";
                                }

                                // ajax adding data to database
                                $.ajax({
                                    url: url,
                                    type: "POST",
                                    data: $('#form').serialize(),
                                    dataType: "JSON",
                                    success: function (data)
                                    {
                                        //if success close modal and reload ajax table
                                        $('#modal_form').modal('hide');
                                        reload_table();
                                    },
                                    error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        alert('Error adding / update data');
                                    }
                                });
                            }

                            function delete_person(id)
                            {
                                if (confirm('Are you sure delete this data?'))
                                {
                                    // ajax delete data to database
                                    $.ajax({
                                        url: "<?php echo site_url('person/ajax_delete') ?>/" + id,
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
                                            alert('Error adding / update data');
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
                        <h3 class="modal-title">Person Form</h3>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="form" class="form-horizontal">
                            <input type="hidden" value="" name="id"/> 
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">First Name</label>
                                    <div class="col-md-9">
                                        <input name="firstName" placeholder="First Name" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Last Name</label>
                                    <div class="col-md-9">
                                        <input name="lastName" placeholder="Last Name" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Gender</label>
                                    <div class="col-md-9">
                                        <select name="gender" class="form-control">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Address</label>
                                    <div class="col-md-9">
                                        <textarea name="address" placeholder="Address"class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Date of Birth</label>
                                    <div class="col-md-9">
                                        <input name="dob" placeholder="yyyy-mm-dd" class="form-control" type="text">
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
        <!-- End Bootstrap modal -->
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>Direction de la Météorologie Nationale</title>
        <link rel="stylesheet" type="text/css" href="//js.arcgis.com/3.14compact/esri/css/esri.css">
        <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="<?php echo base_url('assets/sig/css/theme/dbootstrap/dbootstrap.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/sig/css/main.css') ?>" rel="stylesheet">


    </head>
    <body class="dbootstrap">
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
                        <?php if ($_SESSION['type'] == 'Admin') : ?>
                            <span class="my_admin"><i class="icon-desktop my_admin"  style="padding:5px;"></i><a href="<?= base_url('user/dashboard') ?>">Administration</a></span>
                        <?php endif; ?>
                            <span style="padding:10px;" class="my_account"><i class="icon-user my_account"  style="padding:5px;"></i><a href="#"><?php echo $_SESSION['email']; ?></a></span>
                        <span><i class="icon-signout" style="padding:5px;" id="my_logout"></i><a href="<?= base_url('logout') ?>">Logout</a></span>
                            <?php else : ?>
                        <span><a href="<?= base_url('register') ?>">Inscription</a></span>
                        <span><a href="<?= base_url('login') ?>">login</a></span>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js') ?>"></script>
        <script type="text/javascript">
            var dojoConfig = {
                async: true,
                packages: [{
                        name: 'viewer',
                        location: '/meteo_ci_27/assets/sig/js/viewer'
                    }, {
                        name: 'config',
                        location: '/meteo_ci_27/assets/sig/js/config'
                    }, {
                        name: 'gis',
                        location: '/meteo_ci_27/assets/sig/js/gis'
                    }]
            };</script>
        <!--[if lt IE 9]>
            <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/es5-shim/4.0.3/es5-shim.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="//js.arcgis.com/3.14compact/"></script>
        <script type="text/javascript">
            // get the config file from the url if present

            var geocodingAPI = "<?php echo site_url('user/get_mes_couches') ?>";
            var i = 0;
//            var mes_layers=[] ;
            var mes_layers = [];





            $.getJSON(geocodingAPI, function (json) {
                while (i < json.length) {
                    var type = json[i].type;


                    var url = json[i].url;


                    var title = json[i].title;


                    i++;
                    mes_layers.push(
                            {
                                "type": type,
                                "url": url,
                                "title": title + i,
                                options: {
                                    id: title + i,
                                    opacity: 1.0,
                                    visible: false,
                                    outFields: ['*'],
                                    mode: 0
                                }
                            }
                    );
                }



            }
            );


            // console.log(mes_layers);
//            mes_layers.push(
//                    {
//                        type: 'feature',
//                        url: 'http://192.168.1.144/omarpc/rest/services/JMeteo1/MapServer/22',
//                        title: 'nouvelles_provinces',
//                        options: {
//                            id: 'nouvelles_provinces',
//                            opacity: 0.3,
//                            visible: true,
//                            outFields: ['*'],
//                            mode: 0
//                        }
//                    }
//                    );


            var file = 'config/viewer', s = window.location.search, q = s.match(/config=([^&]*)/i);
            if (q && q.length > 0) {
                file = q[1];
                if (file.indexOf('/') < 0) {
                    file = 'config/' + file;
                }
            }
            require(['viewer/Controller', file], function (Controller, config) {
                Controller.startup(config);
            });
        </script>
    </body>
</html>

define(
        ['esri/units', 'esri/geometry/Extent', 'esri/config',
            'esri/tasks/GeometryService', 'esri/layers/ImageParameters'],
        function (units, Extent, esriConfig, GeometryService, ImageParameters) {

            // url to your proxy page, must be on same machine hosting you app.
            // See proxy folder for readme.
            esriConfig.defaults.io.proxyUrl = 'proxy/proxy.ashx';
            esriConfig.defaults.io.alwaysUseProxy = false;
            // url to your geometry server.
            esriConfig.defaults.geometryService = new GeometryService(
                    'http://tasks.arcgisonline.com/ArcGIS/rest/services/Geometry/GeometryServer');

            // image parameters for dynamic services, set to png32 for higher
            // quality exports.
            var imageParameters = new ImageParameters();
            imageParameters.format = 'png32';

            return {
                // used for debugging your app
                isDebug: true,
                // default mapClick mode, mapClickMode lets widgets know what
                // mode the map is in to avoid multipult map click actions from
                // taking place (ie identify while drawing).
                defaultMapClickMode: 'identify',
                // map options, passed to map constructor. see:
                // https://developers.arcgis.com/javascript/jsapi/map-amd.html#map1
                mapOptions: {
                    basemap: 'streets',
                    center: [-7, 32],
                    zoom: 5,
                    sliderStyle: 'small'
                },
                collapseButtonsPane: 'center', // center or outer
                operationalLayers: mes_layers,
                // set include:true to load. For titlePane type set position the
                // the desired order in the sidebar
                widgets: {
                    growler: {
                        include: true,
                        id: 'growler',
                        type: 'domNode',
                        path: 'gis/dijit/Growler',
                        srcNodeRef: 'growlerDijit',
                        options: {}
                    },
                    geocoder: {
                        include: true,
                        id: 'geocoder',
                        type: 'domNode',
                        path: 'gis/dijit/Geocoder',
                        srcNodeRef: 'geocodeDijit',
                        options: {
                            map: true,
                            mapRightClickMenu: true,
                            geocoderOptions: {
                                autoComplete: true,
                                arcgisGeocoder: {
                                    placeholder: 'Chercher une adresse'
                                }
                            }
                        }
                    },
                    identify: {
                        include: true,
                        id: 'identify',
                        type: 'titlePane',
                        path: 'gis/dijit/Identify',
                        title: 'Identifier',
                        open: false,
                        position: 3,
                        options: 'config/identify'
                    },
                    basemaps: {
                        include: true,
                        id: 'basemaps',
                        type: 'domNode',
                        path: 'gis/dijit/Basemaps',
                        srcNodeRef: 'basemapsDijit',
                        options: 'config/basemaps'
                    },
                    mapInfo: {
                        include: false,
                        id: 'mapInfo',
                        type: 'domNode',
                        path: 'gis/dijit/MapInfo',
                        srcNodeRef: 'mapInfoDijit',
                        options: {
                            map: true,
                            mode: 'dms',
                            firstCoord: 'y',
                            unitScale: 3,
                            showScale: true,
                            xLabel: '',
                            yLabel: '',
                            minWidth: 286
                        }
                    },
                    scalebar: {
                        include: true,
                        id: 'scalebar',
                        type: 'map',
                        path: 'esri/dijit/Scalebar',
                        options: {
                            map: true,
                            attachTo: 'bottom-left',
                            scalebarStyle: 'line',
                            scalebarUnit: 'dual'
                        }
                    },
                    locateButton: {
                        include: true,
                        id: 'locateButton',
                        type: 'domNode',
                        path: 'gis/dijit/LocateButton',
                        srcNodeRef: 'locateButton',
                        options: {
                            map: true,
                            publishGPSPosition: true,
                            highlightLocation: true,
                            useTracking: true,
                            geolocationOptions: {
                                maximumAge: 0,
                                timeout: 15000,
                                enableHighAccuracy: true
                            }
                        }
                    },
                    overviewMap: {
                        include: true,
                        id: 'overviewMap',
                        type: 'map',
                        path: 'esri/dijit/OverviewMap',
                        options: {
                            map: true,
                            attachTo: 'bottom-right',
                            color: '#0000CC',
                            height: 100,
                            width: 125,
                            opacity: 0.30,
                            visible: false
                        }
                    },
                    homeButton: {
                        include: true,
                        id: 'homeButton',
                        type: 'domNode',
                        path: 'esri/dijit/HomeButton',
                        srcNodeRef: 'homeButton',
                        options: {
                            map: true,
                            extent: new Extent({
                                xmin: -9,
                                ymin: 22,
                                xmax: -4,
                                ymax: 38,
                                spatialReference: {
                                    wkid: 4326
                                }
                            })
                        }
                    },
                    legend: {
                        include: true,
                        id: 'legend',
                        type: 'titlePane',
                        path: 'esri/dijit/Legend',
                        title: 'Legende',
                        open: false,
                        position: 0,
                        options: {
                            map: true,
                            legendLayerInfos: true
                        }
                    },
                    layerControl: {
                        include: true,
                        id: 'layerControl',
                        type: 'titlePane',
                        path: 'gis/dijit/LayerControl',
                        title: 'Couches',
                        open: false,
                        position: 1,
                        options: {
                            map: true,
                            layerControlLayerInfos: true,
                            separated: true,
                            vectorReorder: true,
                            overlayReorder: true
                        }
                    },
                    bookmarks: {
                        include: true,
                        id: 'bookmarks',
                        type: 'titlePane',
                        path: 'gis/dijit/Bookmarks',
                        title: 'Bookmarks',
                        open: false,
                        position: 2,
                        options: 'config/bookmarks'
                    },
                    find: {
                        include: true,
                        id: 'find',
                        type: 'titlePane',
                        canFloat: true,
                        path: 'gis/dijit/Find',
                        title: 'Chercher',
                        open: false,
                        position: 3,
                        options: 'config/find'
                    },
                    draw: {
                        include: true,
                        id: 'draw',
                        type: 'titlePane',
                        canFloat: true,
                        path: 'gis/dijit/Draw',
                        title: 'Dessiner',
                        open: false,
                        position: 4,
                        options: {
                            map: true,
                            mapClickMode: true
                        }
                    },
                    measure: {
                        include: true,
                        id: 'measurement',
                        type: 'titlePane',
                        canFloat: true,
                        path: 'gis/dijit/Measurement',
                        title: 'Mesurer',
                        open: false,
                        position: 5,
                        options: {
                            map: true,
                            mapClickMode: true,
                            defaultAreaUnit: units.SQUARE_KILOMETERS,
                            defaultLengthUnit: units.KILOMETERS
                        }
                    },
                    print: {
                        include: true,
                        id: 'print',
                        type: 'titlePane',
                        canFloat: true,
                        path: 'gis/dijit/Print',
                        title: 'Imprimer',
                        open: false,
                        position: 6,
                        options: {
                            map: true,
                            printTaskURL: 'http://localhost:6080/arcgis/rest/services/Utilities/PrintingTools/GPServer/Export%20Web%20Map%20Task',
                            copyrightText: 'COPYRIGHT 2016',
                            authorText: 'DMN SIG ',
                            defaultTitle: 'CARTE DMN',
                            defaultFormat: 'PDF',
                            defaultLayout: 'Letter ANSI A Landscape'
                        }
                    }

                }
            };
        });
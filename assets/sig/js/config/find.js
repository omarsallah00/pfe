define({
   map: true,
   zoomExtentFactor: 2,
   queries: [

	   {
		   description: 'Chercher une station',
		   url: 'http://localhost:6080/arcgis/rest/services/JMeteo1/MapServer',
		   layerIds: [5 , 6 , 7 , 8 , 9 , 10 ,11 , 12 , 13],
		   searchFields: ['LIBESTAT','ADRESTAT'],
		   minChars: 3,
		   gridColumns: [
			   { field: 'layerName', label: 'Layer', width: 100, sortable: false, resizable: false },
			   { field: 'LIBESTAT', label: 'LIBESTAT', width: 100 },
			   { field: 'ADRESTAT', label: 'ADRESTAT' },
			   { field: 'SORT_VALUE', visible: false, get: function (findResult){
				   return findResult.layerName + ' ' + findResult.feature.attributes.Fcode;  //seems better to use attributes[ 'Fcode' ] but fails build.  Attribute names will be aliases and may contain spaces and mixed cases.
			   } }
		   ],
		   sort: [
			   {
				   attribute: 'SORT_VALUE',
				   descending: false
			   }
		   ],
		   prompt: 'LIBESTAT, ADRESTAT',

	   }
	   ,
	   {
		   description: 'Chercher une station QALITE_AIRE',
		   url: 'http://localhost:6080/arcgis/rest/services/JMeteo1/MapServer',
		   layerIds: [5],
		   searchFields: ['LIBESTAT','ADRESTAT'],
		   minChars: 3,
		   gridColumns: [
			   { field: 'layerName', label: 'Layer', width: 100, sortable: false, resizable: false },
			   { field: 'LIBESTAT', label: 'LIBESTAT', width: 100 },
			   { field: 'ADRESTAT', label: 'ADRESTAT' },
			   { field: 'SORT_VALUE', visible: false, get: function (findResult){
				   return findResult.layerName + ' ' + findResult.feature.attributes.Fcode;  //seems better to use attributes[ 'Fcode' ] but fails build.  Attribute names will be aliases and may contain spaces and mixed cases.
			   } }
		   ],
		   sort: [
			   {
				   attribute: 'SORT_VALUE',
				   descending: false
			   }
		   ],
		   prompt: 'LIBESTAT, ADRESTAT',

	   }
	   ,
	   {
		   description: 'Chercher une station STATIONS_AUTOMATIQUES',
		   url: 'http://localhost:6080/arcgis/rest/services/JMeteo1/MapServer',
		   layerIds: [6],
		   searchFields: ['LIBESTAT'],
		   minChars: 3,
		   gridColumns: [
			   { field: 'layerName', label: 'Layer', width: 100, sortable: false, resizable: false },
			   { field: 'LIBESTAT', label: 'LIBESTAT', width: 100 },
			   { field: 'ADRESTAT', label: 'ADRESTAT' },
			   { field: 'SORT_VALUE', visible: false, get: function (findResult){
				   return findResult.layerName + ' ' + findResult.feature.attributes.Fcode;  //seems better to use attributes[ 'Fcode' ] but fails build.  Attribute names will be aliases and may contain spaces and mixed cases.
			   } }
		   ],
		   sort: [
			   {
				   attribute: 'SORT_VALUE',
				   descending: false
			   }
		   ],
		   prompt: 'LIBESTAT, ADRESTAT',

	   }
   ],
   selectionSymbols: {
	   polygon: {
		   type   : 'esriSFS',
		   style  : 'esriSFSSolid',
		   color  : [255, 0, 0, 62],
		   outline: {
			   type : 'esriSLS',
			   style: 'esriSLSSolid',
			   color: [255, 0, 0, 255],
			   width: 3
		   }
	   },
	   point: {
		   type   : 'esriSMS',
		   style  : 'esriSMSCircle',
		   size   : 25,
		   color  : [255, 0, 0, 62],
		   angle  : 0,
		   xoffset: 0,
		   yoffset: 0,
		   outline: {
			   type : 'esriSLS',
			   style: 'esriSLSSolid',
			   color: [255, 0, 0, 255],
			   width: 2
		   }
	   }
   },
   selectionMode   : 'extended'
});





function xmyMapper2(lat, long) 
{
    var mymap = L.map('mapid').setView([ lat , long], 5);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoicGF1bGFnb2xkZXIiLCJhIjoiY2pneXhhbWoyMmkxazMzcDZncHFhODlkdiJ9.edTBTkIMndOfkYHlYp4eAQ'
    }).addTo(mymap);
    var marker = L.marker([lat , long]).addTo(mymap);
    return mymap;
}

function myMapper3(lat, long, zoom) 
{
    var mymap = L.map('mapid').setView([ lat , long], zoom);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoicGF1bGFnb2xkZXIiLCJhIjoiY2pneXhhbWoyMmkxazMzcDZncHFhODlkdiJ9.edTBTkIMndOfkYHlYp4eAQ'
    }).addTo(mymap);
    var marker = L.marker([lat , long]).addTo(mymap);
    return mymap;
}

function myMapper4(lat, long, zoom,kml, location) 
{
    
    var mymap = L.map('mapid').setView([ lat , long], zoom);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoicGF1bGFnb2xkZXIiLCJhIjoiY2pneXhhbWoyMmkxazMzcDZncHFhODlkdiJ9.edTBTkIMndOfkYHlYp4eAQ'
    }).addTo(mymap);
    var kmlLayer = omnivore.kml(kml).on('ready', function() {
        //mymap.fitBounds(kmlLayer.getBounds());
        kmlLayer.eachLayer(function(layer) {
            if(layer.feature.properties.description)
                var popuplabel  = layer.feature.properties.name + "<br/>" +layer.feature.properties.description;
            else
                var popuplabel  = layer.feature.properties.name ;   
            
            // See the `.bindPopup` documentation for full details. This
            // dataset has a property called `name`: your dataset might not,
            // so inspect it and customize to taste.
            //  layer.bindPopup(layer.feature.properties.name);
            layer.bindPopup(popuplabel);
        });
    });
    kmlLayer.on("loaded", function(e) { 
        mymap.fitBounds(e.target.getBounds());
    });
    kmlLayer.addTo(mymap);
    var marker = L.marker([lat , long]).addTo(mymap);
    return mymap;
}


function mapper5(lat, long, zoom,kml) {
    var map = new L.Map('mapid');                       
    
    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
        maxZoom: 18
    }).addTo(map);
    map.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text.
    
    var kmlLayer = new L.KML("mapperz-kml-example.kml", {async: true});
    
    kmlLayer.on("loaded", function(e) { 
        map.fitBounds(e.target.getBounds());
    });
    
    map.addLayer(kmlLayer);
    return map;
}


function myMapper6(lat, long, zoom,kml) 
{
    
    var accessToken = 'pk.eyJ1IjoicGF1bGFnb2xkZXIiLCJhIjoiY2pneXhhbWoyMmkxazMzcDZncHFhODlkdiJ9.edTBTkIMndOfkYHlYp4eAQ';
    var  attribution = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
    var maxZoom = 18;
    var id=  'mapid';
    
    var mymap = L.map('mapid');
    
    var tilelayer = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}',{ attribution, maxZoom, id, accessToken }).addTo(mymap);
    
    var kmlLayer = omnivore.kml(kml).on('ready', function() {
        mymap.fitBounds(kmlLayer.getBounds())
    }).addTo(mymap);
    
    var marker = L.marker([lat , long]).addTo(mymap);
    //mymap.setView([ lat , long], zoom);
    // mymap.setView(kmlLayer.getBounds().getCenter());
    return mymap;
}


function myMapper7(location) 
{ 
    var location_dc =redecode(location);
     console.log(location_dc);
    var mylocation = JSON.parse(location_dc);
    
    console.log(mylocation);
    
    var children= mylocation.children;
    
    var lat = mylocation.latitude;
    var long = mylocation.longitude;
    var zoom = mylocation.zoom;
    if(zoom <1 ) zoom = 1;
    
    var mymap = L.map('mapid').setView([ lat , long], zoom);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoicGF1bGFnb2xkZXIiLCJhIjoiY2pneXhhbWoyMmkxazMzcDZncHFhODlkdiJ9.edTBTkIMndOfkYHlYp4eAQ'
    }).addTo(mymap);
      if(mylocation.showchildren )
    {
    var kmllist = new Array();
    for (var i =0; i< children.length; i++) 
    {
        if(children[i].kml)
        {
          comune = omnivore.kml("/"+children[i].kml);
          kmllist.push(comune);
        }
        else
        {
          var   marker = L.marker([children[i].latitude , children[i].longitude]).addTo(mymap);
          var label = children[i].name;
	    marker.bindPopup(label);
	    marker.on('mouseover',function(ev) {
           marker.openPopup();  });
            
        }
    };
    var kmlLayer = L.layerGroup(kmllist);
    kmlLayer.on("loaded", function(e) 
    { 
        mymap.fitBounds(e.target.getBounds());
    });
    kmlLayer.addTo(mymap);
  
     var marker = new Array();
    for (var i =0; i< children.length; i++) 
    {
       // marker[i] = L.marker([children[i].latitude , children[i].longitude]).addTo(mymap);
       // var label = children[i].name;
	  //  marker[i].bindPopup(label);
	   // marker[i].on('mouseover',function(ev) {
      //     marker.openPopup();
      // });
    };
    }
    else
    {
          var marker = L.marker([lat , long]).addTo(mymap);
          var label = mylocation.name;
	      marker.bindPopup(label);
	      marker.on('mouseover',function(ev) {
           marker.openPopup();
       });
    }
    return mymap;
}


function redecode(intstr)
{
    instr = intstr.replace(/&amp;/g  , '&');
    instr = instr.replace(/&gt;/g  , '>');
    instr = instr.replace(/&lt;/g   , '<');
    instr = instr.replace(/&quot;/g  ,  '"');
    instr = instr.replace(/&#39;/g   ,"'");
    return instr;
}

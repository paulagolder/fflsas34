



function myMapper3(location) 
{
    var location_dc =redecode(location);
    //console.log(location_dc);
    var mylocation = JSON.parse(location_dc)
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
    var marker = L.marker([lat , long]).addTo(mymap);
    return mymap;
}




function myMapper7(location) 
{ 
    var location_dc =redecode(location);
    //console.log(location_dc);
    var mylocation = JSON.parse(location_dc);
    
    //console.log(mylocation);
    
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
                var poly1 = comune.bindPopup(children[i].name);
                kmllist.push(comune);
            }
            else
            {
                var   marker = L.marker([children[i].latitude , children[i].longitude]).addTo(mymap);
                var label = children[i].name;
                marker.bindPopup(label);
            }
        };
        var kmlLayer = L.layerGroup(kmllist);
        kmlLayer.on("loaded", function(e) 
        { 
            mymap.fitBounds(e.target.getBounds());
        });
        kmlLayer.addTo(mymap);
        
        var marker = new Array();
        
    }
    else
    {
        
        if(mylocation.kml)
        {
            var kmllist = new Array();
            comune = omnivore.kml("/"+mylocation.kml);
            var poly1 = comune.bindPopup(mylocation.name);
            kmllist.push(comune);
            var kmlLayer = L.layerGroup(kmllist);
            kmlLayer.on("loaded", function(e) 
            { 
                mymap.fitBounds(e.target.getBounds());
            });
            kmlLayer.addTo(mymap);
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
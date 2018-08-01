

function myFunction() {
    window.location.href = "/mailto";
}


   function myMapper2(lat, long) 
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
   
    function HideMe( divid) 
    {
      var x = document.getElementById(divid);
      if (x.style.display === "none") 
      {
        //x.style.display = "block";
        x.style.display= "flex";
      } else 
      {
        x.style.display = "none";
      }
   } 
   
     function HideMe2( divid) 
    {
      var x = document.getElementById(divid);
      if (x.style.display === "none") 
      {
        x.style.display = "block";
        //x.style.display= "flex";
      } else 
      {
        x.style.display = "none";
      }
   } 

   

     function clickevent(eid)
     {
        window.location.href = '/admin/event/'+eid;
     }
     function clickimage(iid)
     {
        window.location.href = '/admin/image/'+iid;
     }
     function clickperson(pid)
     {
        window.location.href = '/admin/person/'+pid;
     }
     function clicklocation(lid)
     {
        window.location.href = '/admin/location/'+lid;
     }
     function clickcontent(cid)
     {
        window.location.href = '/admin/content/'+cid;
     }

     
     function deletebookmark(bktype, cid)
     {
        window.location.href = '/admin/bookmark/delete/'+bktype+"/"+cid;
     }


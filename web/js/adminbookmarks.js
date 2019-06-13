

   

     function clickevent(eid)
     {
        window.location.href = '/admin/event/'+eid;
     }
     function clickimage(iid,label)
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
     function clickcontent(sid)
     {
        window.location.href = '/admin/subject/'+sid;
     }

     
     function deletebookmark(bktype, cid)
     {
        window.location.href = '/admin/bookmark/delete/'+bktype+"/"+cid;
     }


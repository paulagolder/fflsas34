<?php

  require_once "../phplib/myfuncts.inc"; 
  require_once "../phplib/login.inc"; 
  include_once  '../phplib/phpxml.inc';
  require_once "../FFLSAS/mkportal/modules/fflbase/efflsas.inc"; 
   
echo    " ".$_SERVER['SERVER_NAME']." ".getcwd();
$host=server_details(getcwd()."/");
$_SESSION['host'] = serialize($host);
echo "found".$host['id']." ".$host['service'];

$service=service_details($host,'fflsas');
$_SESSION['service']=serialize($service);
$_SESSION['mysqlconnect']=connect_service($service);

  print start_page_header("keywords");
  print end_page_header(""," bgcolor=#ffff66 ");
   print para( "page start".$path);

print para( "page start".$host["id"]);


$submit= $_POST['submit'];


//if($submit=="people" )
{ 
    
 //   $outline = start_page_header("FFLSAS index").end_page_header();
    $outline .= "<br><br><br><br><br><br><br><br>";
    $fp=fopen("people.htm","w");
    $t= people_list();
    $outline .= index_people($t); 
//    $outline .= page_footer();
    fputs($fp,$outline);
    fclose($fp);

    print para( "done people");
}

//if($submit=="events" )
{ 
//    $outline = start_page_header("events").end_page_header();
    $fp=fopen("events.htm","w");
    $t=    e_fill_event_tree(); ;
    $outline = index_events($t); 
 //   $outline .= page_footer();
    fputs($fp,$outline);
    fclose($fp);
 
    print para( "done events");
}


//  print page_footer();



function index_people($plist)
{
    $i=0;
    foreach ($plist as $pid=>$person)
    {
        $content .= $person['surname']." ".$person['forename']." ".$person['alias']." ";
        if($i>5) 
        {
            $i=0;
            $content .= "<br>";
        }
        $i++;
    }
    return $content;
}

function index_events($elist)
{
   
    $index = array();
     $content = "<br>";
     foreach ($elist as $eid=>$event)
    {
        $texts = e_get_event_texts($eid);
        $ftitle = $texts['title']["FR"]['comment'] ;
        $etitle = $texts['title']["EN"]['comment'];
        $index[$ftitle]=1;
        $index[$etitle]=1;
    }
      $i=0;
    foreach ($index as $title=>$count)
    {
     
        $content .= $title." ";
        if($i>5) 
        {
            $i=0;
            $content .= "<br>";
        }
        $i++;
    }
    return $content;
}




?>


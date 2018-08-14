



update incidenttype it, incidentlabels il set it.label = il.label WHERE il.itypeid= it.itypeid and il.lang ="FR" 



update incidenttype it, set label = replace(label,"&eacute;","é" )

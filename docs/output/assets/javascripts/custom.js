// replace all markdown fontawesome5 instances with actual icons
$("#main-content").html($("#main-content").html().replace(/\\faicon{(.+)}/g, "<i class='fas fa-$1'></i>"));
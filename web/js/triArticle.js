$( document ).ready(function(){
	triArticle=function triArticle(){
        url = window.location.href;
        tri="";
        if($(this).hasClass('asc'))
            tri="asc";
        else if($(this).hasClass('desc'))
            tri="desc";
		$.ajax({
                method: "GET",
                crossDomain: true,
                xhrFields: {
                    withCredentials: true
                },
                url: url,
                data: { tri: tri, mode: "ajax" },
                dataType : "html"
            })
            .done(function(reponse) {
                console.log(url);
               var oUrl=new URL(url);
               var params = new URLSearchParams(oUrl.search.slice(1));
               console.log(params.toString().length);
               if(params.toString().length>0 && params.has("tri")){
                    params.delete("tri");
               }
               
               params.append("tri", tri);

               history.pushState({urlPath:"?"+params.toString()},"","?"+params.toString());
               $("#articles").html(reponse);
            })
            .fail(function() {
                console.log("fail");
            })
            .always(function() {

            });
	}

    $( "#tri" ).on( "click", "button",triArticle);
    
});

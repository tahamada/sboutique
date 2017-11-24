$( document ).ready(function(){

  verifArticlePage=function verifArticlePage(){
    page=parseInt($("#ArticleListPage").text());
    
    if(page>1){
      $(".prec").removeClass("hidden");
    }else{
      $(".prec").addClass("hidden");
    }

    limit=parseInt($("#ArticleListLimit").text());
    nbArticle=parseInt($("#nbArticle").text());
    if(page*limit<nbArticle){
      $(".suiv").removeClass("hidden");
    }
    else
      $(".suiv").addClass("hidden");

  }

  verifArticlePage();

	changePage=function changePage(){
    url = window.location.href;
    page=verifArticlePage();    

    if($(this).text()=="Suivant"){
      page=parseInt($("#ArticleListPage").text())+1;
    }
    else if($(this).text()=="Précédent"){
      page=parseInt($("#ArticleListPage").text())-1;
    }
    $("#ArticleListPage").text(page);
    verifArticlePage();
		$.ajax({
        method: "GET",
        crossDomain: true,
        xhrFields: {
            withCredentials: true
        },
        url: url,
        data: { page: page, mode: "ajax" },
        dataType : "html"
    })
    .done(function(reponse) {
        console.log(url);
       var oUrl=new URL(url);
       var params = new URLSearchParams(oUrl.search.slice(1));
       console.log(params.toString().length);
       if(params.toString().length>0 && params.has("page")){
            params.delete("page");
       }
       
       params.append("page", page);

       history.pushState({urlPath:"?"+params.toString()},"","?"+params.toString());
       $("#articles").html(reponse);
    })
    .fail(function() {
        console.log("fail");
    })
    .always(function() {

    });
	}

    $( "#articlesListFoot" ).on( "click", "button",changePage);
    
});

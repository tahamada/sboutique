$( document ).ready(function(){
    panierFunction("loadingPage");
    function panierFunction(){
      
        $.ajax({
                method: "POST",
                crossDomain: true,
                xhrFields: {
                    withCredentials: true
                },
                url: "panier",
                dataType : "html"
            })
            .done(function(reponse) {
              if(reponse.length!=0){
                $( "#panierDialog" ).html(reponse);               
                verifStockPanier();
                total();
              }
              else
                dialogPanier.dialog( "close" );          
            })
            .fail(function() {
                console.log("fail");
            })
            .always(function() {

            });      
    }

    function commanderFunction(){

    }

    function verifStockPanier(){
      $("#panierDialog table .tableLigneArticle").each(function(){        
        verifStock($(this));
      });
    }

    total=function total(sommeEnleve){
      var somme=0;      
      $("#panierDialog table tr").each(function(){   
        var quantite=$(this).find(".quantite").val();
        var prix=$(this).find(".prix").text(); 
        if(quantite){
          somme+=parseFloat(quantite)*parseFloat(prix);
        }
      });
      somme=somme.toFixed(2);
      $("#total").text(somme+"€");  
    }    

    function verifStock(ligne){  
      if($(ligne).parent().length<1)
        var ligne=$(this).parent().parent();
     
      //ajoutPanier(ligne);
      quantite=$(ligne).find(".quantite").val();
      idVendeur=$(ligne).find(".panierIdVendeur").text();
      idArticle=$(ligne).find(".panierIdArticle").text();
      $.ajax({
                method: "POST",
                crossDomain: true,
                 xhrFields: {
                      withCredentials: true
                  },
                url: "stock/"+idArticle,
                data: { quantite: quantite},
                dataType : "json"
            })
            .done(function(reponse) {
              console.log(reponse['reponse']);
              var etatStock=$(ligne).children(".etatStock");
              $(etatStock).text(reponse['reponse']['reponse']);
              if(reponse['reponse']['etat']=="1"){                
                $(etatStock).addClass("green");
                $(etatStock).removeClass("red");
                $(ligne).find(".prix").text(reponse['reponse']['prix']);
                $(ligne).find(".BtnReserverPanier").addClass("hidden");
              }
              else{
                $(etatStock).addClass("red");
                $(etatStock).removeClass("green");
                $(ligne).find(".prix").text(0);
                $(ligne).find(".BtnReserverPanier").removeClass("hidden");
                
              }
              total();
              $("#nbPanier").text("("+reponse['reponse']["nbPanier"]+")");              
            })
            .fail(function() {
                console.log("fail");
            })
            .always(function() {

            });
    }

    ajoutPanier=function ajoutPanier(ligne){
      console.log($(this).attr('id'));
      console.log($(ligne));
      idArticle="";
      quantite="";
      idVendeur="";
      if($(this).attr('id')=="btnAjoutPanier"){
        if($("#idArticleVendeur").length > 0)
            idArticle=$("#idArticleVendeur").val();
        else
            idArticle=$(ligne).find("#idArticle").val();

        if($("#idVendeur").length > 0)
            idVendeur=$("#idVendeur").val();
        else
            idVendeur=$(ligne).find("#idVendeur").val();

        quantite=$(ligne).find(".quantite").val();
      }
      
      $.ajax({
              method: "POST",
              crossDomain: true,
              xhrFields: {
                  withCredentials: true
              },
              url: "panier/add/"+idArticle,
              data: { idArticle: idArticle,quantite:quantite},
              dataType : "json"
          })
          .done(function(reponse) {
            console.log(reponse['nb']);
            $("#nbPanier").text("("+reponse['nb']+")"); 
          })
          .fail(function() {
              console.log("fail");
          })
          .always(function() {

          });
    }

    $("#titreDetail").on("click","#btnAjoutPanier",ajoutPanier);

    delPanier=function dePanier(){
      var ligne=$(this).parent().parent();

      idArticle=$(ligne).find(".panierIdArticle").text();
      var index=$(this).parent().parent().index();

      $.ajax({
            method: "POST",
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            },
            url: "panier/del/"+idArticle,
            data: { index: index},
            dataType : "json"
        })
        .done(function(reponse) {
          panierFunction();
          $("#nbPanier").text("("+reponse['reponse']["nbPanier"]+")");
        })
        .fail(function() {
            console.log("fail");
        })
    }

    ajoutReservation=function ajoutReservation(ligne){
      console.log("ici")
      if($(ligne).parent().length<1)
        var ligne=$(this).parent().parent();
      ajoutPanier(ligne);
      quantite=$(ligne).find(".quantite").val();
      idVendeur=$(ligne).find(".panierIdVendeur").text();
      idArticle=$(ligne).find(".panierIdArticle").text();
      $.ajax({
            method: "POST",
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            },
            url: "ajoutReservation.php",
            data: { idArticle: idArticle,quantite:quantite,idVendeur:idVendeur},
            dataType : "json"
        })
        .done(function(reponse) {
          if(reponse['message']=="success")
            $.get("ajaxReponse/ajaxMessageSuccessReservation.html", function(data){
                $("#alertZonePanier").html(data).fadeIn(2000, function(){$(this).fadeOut(2000);});
                //panierFunction();
            });
          else{
            $.get("ajaxReponse/ajaxMessageWarningReservation.html", function(data){
                $("#alertZonePanier").html(data).fadeIn(2000, function(){$(this).fadeOut(2000);});
                //panierFunction();
            });
          }
        })
        .fail(function() {
            console.log("fail");
        })
    }

    dialogPanier = $( "#panierDialog" ).dialog({
        title:'Mon panier',
        autoOpen: false,
        height: 'auto',
        width: 'auto',
        modal: true,
        responsive: true,
        position: { my: "center ", at: "center", of: "#ban" },
        buttons: {
          "Commander": commanderFunction,
          Fermer: function() {
            dialogPanier.dialog( "close" );
          }
        },
        close: function() {
          //location.reload();
          //form[ 0 ].reset();
          //allFields.removeClass( "ui-state-error" );
        }
      });


   $("#btnPanier").click(function(){
      $("button").addClass("btn");
      $("button").addClass("btn-default");
      panierFunction();
      dialogPanier.dialog( "open" );
   }); 

   $("#panierDialog").on("change",".quantite",verifStock); 
   $("#panierDialog").on("click",".BtnDelPanier",delPanier); 
   $("#panierDialog").on("click",".BtnReserverPanier",ajoutReservation); 


});
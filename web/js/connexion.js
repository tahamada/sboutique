$( document ).ready(function(){
    function connexionFunction(){
        console.log("connfunc");
        $.ajax({
                method: "POST",
                crossDomain: true,
                xhrFields: {
                    withCredentials: true
                },
                url: "connexion.php",
                data: { email: $("#email").val(), password: $("#password").val() },
                dataType : "json"
            })
            .done(function(reponse) {
                if(reponse.message=="success"){
                  $.get("ajaxReponse/ajaxMessageSuccesConnexion.html", function(data){
                      $("#alertZone").html(data).fadeIn(2000, function(){$(this).fadeOut(1000);});
                      $( "#ConnexionDialog" ).dialog("close");
                  });
                  $("#connexion").empty();
                  $.get("view/monMenuCompte.html", function(data){
                      $("#connexion").html(data);
                  });
                  location.reload();
                }else if(reponse.message=="valide"){
                  $.get("ajaxReponse/ajaxMessageValideConnexion.html", function(data){
                      $("#alertZone").html(data).fadeIn(2000, function(){$(this).fadeOut(2000);});
                      $( "#ConnexionDialog" ).dialog("close");
                  });
                }else if(reponse.message=="error"){
                   $.get("ajaxReponse/ajaxMessageErrorConnexion.html", function(data){
                      $("#connAlertZone").html(data).fadeIn(2000, function(){$(this).fadeOut(1000);});;
                  });
                  $("#connAlertZone").append("<div class='alert alert-danger alert-dismissable'><strong>Mauvais identifiant</strong></div>");
                }
                console.log(reponse.message);
            })
            .fail(function() {
                console.log("fail");
            })
            .always(function() {

            });
    }


    dialog = $( "#ConnexionDialog" ).dialog({
        autoOpen: false,
        height: 350,
        width: 250,
        modal: true,
        buttons: {
          "Se connecter": connexionFunction,
          Fermer: function() {
            dialog.dialog( "close" );
          }
        },
        close: function() {
          //form[ 0 ].reset();
          //allFields.removeClass( "ui-state-error" );
        }
      });
   $("#connexionButton").click(function(){
      $("button").addClass("btn");
      $("button").addClass("btn-default");
      dialog.dialog( "open" );
   });    
});
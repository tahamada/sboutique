$( document ).ready(function(){
	$('#inscriptionForm').validate({
        errorElement: "div",
        messages: {
            nom: {
                required: "Entrer un nom"
            },
            prenom: {
                required: "Entrer un prenom"
            },
            email: {
                required: "Entrer un email",
                email: "Veuillez entrer unn email valide"
            },
            password: {
                required: "Entrer un mot de passe"
            },
            password2: {
                required: "Entrer votre mot de passe 2 fois",
                equalTo: "Les mots passes doivent correspondre"
            }
        }

        });

    $('#connexionForm').validate({
        errorElement: "div",
        messages: {            
            email: {
                required: "Entrer un email",
                email: "Veuillez entrer unn email valide"
            },
            password: {
                required: "Entrer un mot de passe"
            }
        }

        });
});
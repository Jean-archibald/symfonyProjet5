<?php
if (isset($_POST['familyName']))
{
    $familyName = htmlspecialchars($_POST['familyName']);
    $firstName = htmlspecialchars($_POST['firstName']);
    $email = htmlspecialchars($_POST['email']);
    $email2 = htmlspecialchars($_POST['email2']);
    $contentMessage = htmlspecialchars($_POST['textarea']);

   if ($email == $email2)
       {
           if(filter_var($email,FILTER_VALIDATE_EMAIL))        
               {
                    mail('jvjlondon@outlook.com','Formulaire de contact : JVJ Dev', $contentMessage, 'From : $email');  
                    $message = '<p class="information">Votre formulaire a bien été envoyé.<p/>';
               }
       }
       
}
?>
 <!-- Contact -->
 <section class="bg-light page-section" id="team">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Contact</h2>
            <h3 class="section-subheading text-muted">Consultez mon CV en ligne</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="team-member">
                    <img class="mx-auto rounded-circle" src="Web/img/team/4.jpg" alt="">
                    <h4>J-A Delafontaine</h4>
                    <p class="text-muted">Développeur PHP</p>
                    <ul class="list-inline social-buttons">
                    <li class="list-inline-item">
                        <a href="#">
                        <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                        <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                        <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    </ul>
                    <h4>Mon CV</h4>
                    <p class="text-muted"><a href="Web/img/CV.pdf" target="_blank" >Lien au format PDF</a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <?php
                    if (isset($message))
                    {
                        echo $message, '<br />';
                    }
                ?>
                <p class="large text-muted">Vous pouvez envoyer un formulaire si vous avez une question.</p>
                <form method="post">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" name="firstName" id="firstName" placeholder="Votre prénom" class="form-control"  required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">           
                                    <input type="text" name="familyName" id="familyName" placeholder="Votre nom de famille" class="form-control" required="required" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">          
                            <input type="email" id="email" name="email" placeholder="Votre email"  required="required" class="form-control" />               
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">   
                            <input type="email" id="email2" name="email2" placeholder="Confirmer votre email"  required="required" class="form-control" />               
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">       
                            <textarea name="textarea" id="textarea" cols="40" rows="3" value="" required="required" placeholder="Votre message" class="form-control"></textarea>               
                        </div>
                    </div>
                    <input type="submit" value="Envoyer" name="envoyer" class="btn btn-primary btn-block"/>
                </form>
            </div>
        </div>
    </div>
  </section>
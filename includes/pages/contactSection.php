<!DOCTYPE html>
<html>
    <head>
        <title>ContactUs</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="cssStyles/cotactSection_page_style.css">
    </head>
    <body>
        <!-- Contact Section -->
        <div class="container" style="color: black; background-color: lightgray;" id="contact">
            <h3 style="text-align: center; font-size: 24px;">CONTACT</h3>
            <p style="text-align: center; font-size: 48px;">Lets get in touch. Send us a message:</p>
            <div style="margin-top:48px">
                <p><i class="fa fa-map-marker fa-fw icon"></i>
                    Sankarankovil,Tamilnadu, INDIA</p>
                <p><i class="fa fa-phone fa-fw icon"></i> Phone:
                    +91 9876543210</p>
                <p><i class="fa fa-envelope fa-fw icon"> </i>
                    Email: msquare@gmail.com</p>
                <br>
                <form method="POST" action="action.php">
                    <p><input class="input border" type="text" placeholder="Name" required name="contactFormName"></p>
                    <p><input class="input border" type="text" placeholder="Email" required name="contactFormEmail"></p>
                    <p><input class="input border" type="text" placeholder="Subject" required name="contactFormSubject"></p>
                    <p><input class="input border" type="text" placeholder="Message" required name="contactFormMessage"></p>
                    <p>
                        <button style="color: white; background-color: black;" type="submit" name="contact">
                            <i class="fa fa-paper-plane"></i> SEND MESSAGE
                        </button>
                    </p>
                </form>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1699.9813523145308!2d77.53441130869906!3d9.172191928148527!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b0697f058a3172b%3A0x29be23ebcf3862e4!2sSri%20Venkateswara%20Jewellers%20Sankarankovil!5e0!3m2!1sen!2sin!4v1692544177018!5m2!1sen!2sin" style=" border: 0px; max-width: 100% ; height: 60vw; width:100%;margin-top:15px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </body>
</html>
<?php include("DBentguide/db.php"); ?>

<?php include("includes/header.php"); ?>
<!-- NAVIGATION -->
<?php include("includes/navigation.php"); ?>
<?php include("functions/functions.php"); ?>
<div id="contact_bg" class="container">

    <?php 
    if(isset($_GET['success'])) {
        $_GET['success'] = $_GET['success'];
    } else {
        $_GET['success'] = '';
    }
            switch ($_GET['success']) {
                case 'savedContactData':
                    echo '<h3 class=\'text-danger\'>Thank you for your inquiry, we\'ll get back to you soon!</h3>';
                    break;
                default:
                    break;
            }
		 ?>
    <div class="contact_form col-lg-10 col-md-8">
        <h1>Contact Us</h1>
        <form name="myForm" method="post" id="login-form" action="saveContact.php">
            <div class="form-group">
                <input type="text" id="name" placeholder="First Name" name="strFirstName" class="form-control"
                    pattern="[A-Za-z]{1,32}" title="Please Enter A Valid Name With Only Alphabets And No Spaces" />
            </div>
            <div class="form-group">
                <input type="text" id="name" placeholder="Last Name" name="strLastName" class="form-control"
                    pattern="[A-Za-z]{1,32}" title="Please Enter A Valid Name With Only Alphabets And No Spaces" />
            </div>
            <div class="form-group">
                <input type="text" id="email" placeholder="Email" name="strEmail" class="form-control"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="name@account.com" />
            </div>
            <div class="form-group">
                <input type="tel" id="number" placeholder="Phone Number" name="nPhone" class="form-control"
                    pattern="[0-9]{9}" title="Please Enter A Valid Phone Number" />
            </div>
            <textarea name="strMessage" id="message" placeholder="Please Enter A Message"
                class="form-control"></textarea>

            <input type="submit" name="submit" value="Submit" id="btn-login" class="btn btn-primary btn-lg btn-block" />
            <input type=reset value="Clear Form" id="btn-login" class="btn btn-primary btn-lg btn-block" />
        </form>
    </div>


</div>

<?php include "includes/footer.php";?>

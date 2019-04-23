<!DOCTYPE html>
<html>
<head>
    <title>BAUST Online</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>

<body>

    <?php $active_page = 'contact'; include('includes/header.php'); ?>

    <div class="container">
        <div class="login-box">
            <center><h1>Contact</h1></center>
            <form action="contact.php" method="post">
                <p>Name</p>
                <input type="text" name="name" placeholder="Enter Your name" required>
				<p>Email</p>
                <input type="email" name="email" placeholder="Enter Email Address" required>
				<p>Subject</p>
                <input type="text" name="subject" placeholder="Enter Subject" required>
				<p>Message</p>
                <textarea cols="30" rows="10" name="message" placeholder="Enter Your Message" required></textarea>
                <input type="submit" name="submit" value="Submit">
            </form>

        </div>
    </div>

    <?php include('includes/footer.php'); ?>

</body>

</html>

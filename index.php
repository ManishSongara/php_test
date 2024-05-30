<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
</head>

<body>
    <!-- HTML form with the following fields:

        - Full Name
        - Phone Number
        - Email
        - Subject
        - Message -->
    <form id="contactForm" action="process.php" method="post">
        <input type="hidden" name="token" value="<?php echo bin2hex(random_bytes(32)); ?>">
        <div>
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name"
                value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>">
        </div>
        <div>
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone"
                value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        </div>
        <div>
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject"
                value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
        </div>
        <div>
            <label for="message">Message:</label>
            <textarea id="message"
                name="message"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>

</html>
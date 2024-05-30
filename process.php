<?php 
    //php db connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "php_test";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("connection failed");
    }

    //variables
    $errors = [];
    $full_name = $phone_number = $email = $subject = $message = "";
    // $token = $_POST['token'];

    //validate from input
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST['full_name'])){
            $errors['full_name'] = "full name is required";
        }else{
            $full_name = htmlspecialchars($_POST['full_name']);
        }

        if(empty($_POST['phone'])){
            $errors['phone'] = "phone no is required";
        }elseif(!is_numeric($_POST['phone'])){
            $errors['phone'] = "phone no must be number";
        }else{
            $phone_number = htmlspecialchars($_POST['phone']);
        }

        if(empty($_POST['email'])){
            $errors = "email must be required";
        }elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));
        else{
            $email = htmlspecialchars($_POST['email']);
        }

        if(empty($_POST['subject'])){
            $errors['subject'] = "subject is required";
        }else{
            $subject = htmlspecialchars($_POST['subject']);
        }

        if(empty($_POST['message'])){
            $errors['message'] = "subject is required";
        }else{
            $subject = htmlspecialchars($_POST['message']);
        }

        //check token duplicate
        // if(!empty($token)){
        //     echo "duplicate entry";
        //  }

         if(empty($errors)){
            //insert into database
            $sql = "INSERT INTO contact (full_name,phone_number,email,subject,message) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $full_name, $phone_number, $email, $subject, $message);  
            $stmt->execute();
            $stmt->close();
            
            //send mail notifiations
            $to = "example@example.com";
            $subject = "New Contact Form Submission";
            $message = "Name: $full_name\nPhone: $phone_number\nEmail: $email\nSubject: $subject\nsubject: $subject";
            $headers = "From: $email";
            mail($to, $subject, $message, $headers);

            echo "message sent";

        
        }else{
            //display errors
            foreach($errors as $err){
                echo $err."</br>";
            }
        }
        
    }

    $conn->close();
?>
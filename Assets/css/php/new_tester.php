<?php

//ThIS is the actual sending of the data to the email this is the final
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;             
        $mail->isSMTP();                            
        $mail->Host       = 'smtp.gmail.com';     
        $mail->SMTPAuth   = true;
        //Makuha nis email para verify sa constant if ever lain na email            
        $mail->Username   = 'rodrigomarcelo643@gmail.com';
        $mail->Password   = 'uxgzaaedssmrraug';   
        $mail->SMTPSecure = 'tls';                
        $mail->Port       = 587;                   

        // constant email na gigamit
        $mail->addAddress('rodrigomarcelo643@gmail.com', 'Marcelo'); 
        $sender_email = $_POST["school_email"];
        $sender_name = $_POST["name"];

     
        if (filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
            $mail->setFrom($sender_email, $sender_name);
        } else {
            throw new Exception("Invalid email address provided.");
        }

        $mail->isHTML(true);  
        $mail->Subject = 'New Response Sent';  

        
        $mail->Body = '
        <html>
        <head>
        <style>
            
            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                color: #333;
                margin: 0;
                padding: 0;
            }

            .container {
                width: 80%;
                margin: 50px auto;
                background-color: #ffffff;
                border-radius: 15px;
                box-shadow: 0 8px 10px rgba(0, 0, 0, 0.2);
                padding: 30px;
            }

            h2 {
                color: #8b0000; 
                margin-bottom: 20px;
                text-align: center;
                font-size: 40px;
                text-transform: uppercase;
            }

            .info {
                margin-bottom: 20px;
            }

            .info label {
                font-weight: bold;
                display: block;
                font-size: 15px;
                text-transform: uppercase;
                margin-bottom: 5px;
                color: black;
            }

            input,
            textarea {
                border: none;
                border-radius: 25px;
                padding: 20px 100px;
                border: 5px solid #ae0d0db3;
                font-size: 14px;
                color: black;
                cursor: pointer;
                font-weight: bold;
                justify-content: left; 
                text-align: left; 
            }

            .input-box {
                border: 1px solid #8b0000; 
                border-radius: 15px;
                padding: 20px 30px;
                background-color: #ffffff; 
                font-size: 14px;
                color: #333; /* Text color */
                cursor: pointer;
                font-weight: bold;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            }
            .input-box input[type="email"]{
                width:100%;
            }
            .input-box input[type="text"],
            .input-box input[type="email"],
            .input-box textarea {
                width: 50%;
                border: none;
                background-color: rgb(192, 192, 192);
                font-size: 14px;
                color: black; /* Text color */
                font-weight: bold;
                display: flex;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            }

            .input-box input[type="text"]:hover,
            .input-box textarea:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 10px rgba(0, 0, 0, 0.2);
                transition: 0.5s;
            }
        </style>
        </head>
        <body>
        <div class="container">
            <img src="https://www.ssg-website.com/Assets/logo.png" style="text-align:center;display:flex;justify-content:center;">
            <h2>Response Details</h2>
            <div class="info">
                <label>Name:</label>
                <div class="input-box">
                    <input type="text" value="' . $_POST['name'] . '" readonly>
                </div>
            </div>
            <div class="info">
                <label>ID Number:</label>
                <div class="input-box">
                    <input type="text" value="' . $_POST['id_number'] . '" readonly>
                </div>
            </div>
            <div class="info">
                <label>Contact Number:</label>
                <div class="input-box">
                    <input type="text" value="' . $_POST['contact_number'] . '" readonly>
                </div>
            </div>
            <div class="info">
                <label>School Email:</label>
                <div class="input-box">
                    <a href="mailto:' . $_POST['school_email'] . '">' . $_POST['school_email'] . '</a>
                </div>
            </div>

            <div class="info">
                <label>Program/Year Level:</label>
                <div class="input-box">
                <input type="text" value="' . $_POST['program'] . '" readonly>
                <input type="text" value="' . $_POST['year_level'] . '" readonly>
                </div>
            </div>
            <div class="info">
                <label>Type of Concern:</label>
                <div class="input-box">
                    <input type="text" value="' . $_POST['type_of_concern'] . '" readonly>
                </div>
            </div>
            <div class="info">
                <label>Details of Concern/Other Concerns:</label>
                <div class="input-box">
                    <textarea readonly>' . $_POST['concern_details'] . '</textarea>
                </div>
            </div>
            <div class="info">
                <label>Suggested Solution:</label>
                <div class="input-box">
                    <textarea readonly>' . $_POST['solution_message'] . '</textarea>
                </div>
            </div>
        </div>
        </body>
        </html>
        ';  

        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
            $file_tmp_name = $_FILES['attachment']['tmp_name'];
            $file_name = $_FILES['attachment']['name'];
            $mail->addAttachment($file_tmp_name, $file_name);
        }
        // response para ma send sa email
        $mail->send();

        
    echo "<script>
    Swal.fire({
        title: 'Success!',

        text: 'Message has been sent. Click <a href=\"mailto:rodrigomarcelo643@gmail.com\">here</a> to compose an email.',
        icon: 'success',
        timer: 3000, // 3 seconds
        timerProgressBar: true,
        showConfirmButton: false,
        allowEscapeKey: false,
        allowOutsideClick: false,
        showCloseButton: true,
        showCancelButton: false,
        showDenyButton: false,
        showLoaderOnConfirm: false
    }).then(function() {
        window.location.href = 'sample.php'; // Redirect to sample.php after the SweetAlert is closed
    });
    </script>";

        } catch (Exception $e) {
            echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Message could not be sent. Mailer Error: {$mail->ErrorInfo}',
                        icon: 'error'
                    });
                </script>";
        }
    }
    ?>

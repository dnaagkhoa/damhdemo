<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$conn = mysqli_connect('localhost','root','','contact_db') or die('connection failed');

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);  
    $number = $_POST['number'];
    $date=$_POST['date'];   

    $insert = mysqli_query($conn, "INSERT INTO contact_form (name, email, number, date)
    VALUES ('$name', '$email', '$number', '$date')") or die('query failed');

    if($insert){
        $message[]='appointment made successfully!';
    }else{
        $message[]='appointment failed';
    }
    if ($insert) {
        // Gửi email xác nhận
        $mail = new PHPMailer(true);

        try {
            // Cấu hình máy chủ SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Sử dụng máy chủ SMTP của Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'dnagkhoa2266@gmail.com'; // Thay bằng email của bạn
            $mail->Password = 'mlll ctwq obip zfzu'; // Thay bằng mật khẩu email của bạn
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 587;
            

            // Người gửi và người nhận
            $mail->setFrom('dnagkhoa2266@gmail.com', 'Naoe Dental Care'); // Địa chỉ email của bạn
            $mail->addAddress($email, $name); // Gửi email đến khách hàng

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'Xác nhận lịch hẹn Naoe Dental Care';
            $mail->Body = "
                <h1>Xin chào $name,</h1>
                <p>Chúng tôi đã nhận được yêu cầu đặt lịch hẹn của bạn. Thông tin lịch hẹn như sau:</p>
                <ul>
                    <li><strong>Tên:</strong> $name</li>
                    <li><strong>Email:</strong> $email</li>
                    <li><strong>Số điện thoại:</strong> $number</li>
                    <li><strong>Ngày hẹn:</strong> $date</li>
                </ul>
                <p>Chúng tôi sẽ liên lạc với bạn để xác nhận thời gian cụ thể. Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>";

            // Gửi email
            $mail->send();
            $message[] = 'appointment made successfully! A confirmation email has been sent to you.';
        } catch (Exception $e) {
            $message[] = "Appointment made but email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $message[] = 'appointment failed';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naoe Dental Care </title>
    <!-- font google -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- normalize file  -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- main style  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- ico -->
    <link rel="icon" type="image/png" src="images/icon.png" sizes="16x16">
</head>

<body>

    <!-- header section starts  -->
    <header class="header">

        <div class="container">

            <div class="row">
                <a href="#home" class="logo">Naoe<span>Care.</span></a>

                <nav class="nav">
                    <a href="#home" class="active">home</a>
                    <a href="#about">about</a>
                    <a href="#services">services</a>
                    <a href="#reviews">reviews</a>
                    <a href="#contact">contact</a>
                </nav>

                <a href="#contact" class="link-btn">make appointment</a>

                <div id="menu-btn" class="fas fa-bars"></div>
            </div>
        </div>
    </header>
    <!-- header section ends  -->

    <!-- home section starts  -->
    <section class="home" id="home">

        <div class="container">

            <div class="row">

                <div class="content">
                    <h3>let us brighten your smile</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur eum consequatur repellat
                        officiis laboriosam suscipit.</p>
                    <a href="#contact" class="link-btn">appointment now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- home section ends  -->

    <!-- about section starts  -->
    <section class="about" id="about">

        <div class="container">

            <div class="row">

                <div class="images">
                    <img src="images/about1.jpg" alt="">
                </div>

                <div class="content">
                    <span>about us</span>
                    <h3>true healthcare for your family</h3>
                    <p>At Naoe Dental Care , we specialize in providing top-quality dental care for healthy,
                        beautiful smiles. Our experienced team offers personalized services using the latest technology
                        to ensure your comfort and confidence.
                    </p>
                    <a href="#contact" class="link-btn">make appointment</a>
                </div>
            </div>
        </div>
    </section>
    <!-- about section ends  -->

    <!-- services section starts  -->
    <section class="services" id="services">

        <h1 class="heading">our services</h1>

        <div class="box-container container">

            <div class="box">
                <img src="images/icon-1.svg" alt="">
                <h3>Alignment specialist</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, earum!</p>
            </div>

            <div class="box">
                <img src="images/icon-2.svg" alt="">
                <h3>Cosmetic dentistry</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, earum!</p>
            </div>

            <div class="box">
                <img src="images/icon-3.svg" alt="">
                <h3>Oral hygiene experts</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, earum!</p>
            </div>

            <div class="box">
                <img src="images/icon-4.svg" alt="">
                <h3>Root canal specialist</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, earum!</p>
            </div>

            <div class="box">
                <img src="images/icon-5.svg" alt="">
                <h3>Live Dental Advisory</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, earum!</p>
            </div>

            <div class="box">
                <img src="images/icon-6.svg" alt="">
                <h3>Cavity inspection</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, earum!</p>
            </div>

        </div>

    </section>
    <!-- services section ends  -->

    <!-- process section starts  -->
    <section class="process">
        <h1 class="heading"> work process</h1>

        <div class="box-container container">

            <div class="box">
                <img src="images/process-1.png" alt="">
                <h3>Cosmetic Dentistry</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Unde, esse.</p>
            </div>

            <div class="box">
                <img src="images/process-2.png" alt="">
                <h3>Pediatric Dentistry</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Unde, esse.</p>
            </div>

            <div class="box">
                <img src="images/process-3.png" alt="">
                <h3>Dental Implants</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Unde, esse.</p>
            </div>

        </div>
    </section>
    <!-- process section ends  -->

    <!-- review section starts  -->
    <section class="review" id="review">

        <h1 class="heading"> satisfied clients</h1>

        <div class="box-container container">

            <div class="box">
                <img src="images/pic-1.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis, rem iste culpa quibusdam facere
                    non dolores adipisci debitis placeat inventore.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h1>john deo</h1>
                <span> satisfied clients</span>
            </div>

            <div class="box">
                <img src="images/pic-2.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis, rem iste culpa quibusdam facere
                    non dolores adipisci debitis placeat inventore.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h1>john deo</h1>
                <span> satisfied clients</span>
            </div>

            <div class="box">
                <img src="images/pic-3.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis, rem iste culpa quibusdam facere
                    non dolores adipisci debitis placeat inventore.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h1>john deo</h1>
                <span> satisfied clients</span>
            </div>
        </div>
    </section>
    <!-- review section ends  -->

    <!-- contact section starts  -->
    <section class="contact" id="contact">

        <h1 class="heading">make appointment</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php
        if(isset($message)){
            foreach($message as $message){
                echo '<p class="message">'.$message. '</p>';
            }
        }
    ?>
    <span>your name :</span>
    <input type="text" name="name" placeholder="enter your name" class="box"> <!-- Thêm name="name" -->
    
    <span>your email :</span>
    <input type="email" name="email" placeholder="enter your email" class="box"> <!-- Thêm name="email" -->
    
    <span>your number :</span>
    <input type="number" name="number" placeholder="enter your number" class="box"> <!-- Thêm name="number" -->
    
    <span>appointment date :</span>
    <input type="datetime-local" name="date" class="box"> <!-- Thêm name="date" -->
    
    <input type="submit" value="make appointment" name="submit" class="link-btn"> <!-- Giữ name="submit" -->
</form>

    </section>
    <!-- contact section ends  -->

    <!-- footer section starts  -->
    <section class="footer">

        <div class="box-container container">

            <div class="box">
                <i class="fas fa-phone"></i>
                <h3>phone number</h3>
                <p>+123-456-7890</p>
                <p>+111-222-7890</p>
            </div>

            <div class="box">
                <i class="fas fa-map-marker-alt"></i>
                <h3>address</h3>
                <p>amman, jordan</p>
            </div>

            <div class="box">
                <i class="fas fa-clock"></i>
                <h3>working time</h3>
                <p>8:00am to 5:00pm</p>
            </div>

            <div class="box">
                <i class="fas fa-envelope"></i>
                <h3>email address</h3>
                <p>example@gmail.com</p>
                <p></p>
            </div>
        </div>
      
    </section>
    <!-- footer section ends  -->








    <!-- js file  -->
    <script src="js/app.js"></script>
</body>

</html>
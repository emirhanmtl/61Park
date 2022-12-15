<?php
//config dosyasını dahil etme
require_once "config.php";
 
// değişkenleri tanımla
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Username doğrulama
    if(empty(trim($_POST["username"]))){
        $username_err = "Kullanıcı adı giriniz.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Kullanıcı adı yalnızca harf, sayı ve alt çizgiden oluşabilir.";
    } else{
        //DB Select sorgusu
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            
            $param_username = trim($_POST["username"]);
            
            
            if(mysqli_stmt_execute($stmt)){
               
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Bu kullanıcı adı daha önce alınmış.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Bir hata oluştu. Lütfen tekrar deneyiniz.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    // Parola doğrulama
    if(empty(trim($_POST["password"]))){
        $password_err = "Parola giriniz.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Parola en az 6 karakterden oluşmalıdır.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Parola doğrula doğrulama
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Lütfen parolayı doğrulayınız.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Parolalar uyuşmuyor.";
        }
    }
    
    // Error kontrolü
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            
            if(mysqli_stmt_execute($stmt)){
                // login sayfasına yönlendir
                header("location: login.php");
            } else{
                echo "Bir hata oluştu. Lütfen tekrar deneyiniz.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Kayıt</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Kullanıcı adı</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Parola</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Parola tekrar</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Kayıt ol">
            </div>
            <p>Hesabınız var mı? <a href="login.php">Giriş Yap</a>.</p>
        </form>
    </div>    
</body>
</html>
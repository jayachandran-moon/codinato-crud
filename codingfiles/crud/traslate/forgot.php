        <?php
    function generateOTP($length = 6) {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= mt_rand(0, 9);
        }
        return $otp;
    }

    $user_id = 123; // Example user ID
    $otp = generateOTP();
    $expiration_time = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP valid for 10 minutes

    // Store in database (example using PDO)
    // $stmt = $pdo->prepare("INSERT INTO otp_codes (user_id, otp_code, expires_at) VALUES (?, ?, ?)");
    // $stmt->execute([$user_id, $otp, $expiration_time]);
    ?>
    <?php
    if (isset($_POST['verify_otp'])) {
        $submitted_otp = $_POST['otp_input'];
        $user_id = 123; // Example user ID

        // Retrieve OTP from database (example using PDO)
        // $stmt = $pdo->prepare("SELECT otp_code, expires_at FROM otp_codes WHERE user_id = ? AND is_used = 0 ORDER BY expires_at DESC LIMIT 1");
        // $stmt->execute([$user_id]);
        // $stored_otp_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stored_otp_data && $submitted_otp === $stored_otp_data['otp_code'] && strtotime($stored_otp_data['expires_at']) > time()) {
            // OTP is valid and not expired
            // Mark OTP as used in the database
            // $stmt = $pdo->prepare("UPDATE otp_codes SET is_used = 1 WHERE user_id = ? AND otp_code = ?");
            // $stmt->execute([$user_id, $submitted_otp]);
            echo "OTP verified successfully!";
        } else {
            echo "Invalid or expired OTP.";
        }
    }
    ?>
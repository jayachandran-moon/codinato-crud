<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3a0ca3;
        --success-color: #4cc9f0;
        --light-bg: #f8f9fa;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .verification-container {
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 450px;
    }

    .verification-header {
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 25px 20px;
        text-align: center;
    }

    .verification-header h2 {
        margin: 0;
        font-weight: 600;
    }

    .verification-body {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #333;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 12px 15px;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
    }

    .btn-primary {
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        border: none;
        border-radius: 8px;
        padding: 12px 20px;
        font-weight: 600;
        transition: all 0.3s;
        width: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
    }

    .otp-inputs {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .otp-input {
        width: 50px;
        height: 50px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .otp-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
    }

    .timer {
        text-align: center;
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }

    .status-message {
        padding: 12px;
        border-radius: 8px;
        text-align: center;
        margin-top: 15px;
        font-weight: 500;
    }

    .success {
        background-color: rgba(76, 201, 240, 0.2);
        color: #0a6c74;
        border: 1px solid rgba(76, 201, 240, 0.5);
    }

    .error {
        background-color: rgba(255, 0, 0, 0.1);
        color: #d32f2f;
        border: 1px solid rgba(255, 0, 0, 0.2);
    }

    .info {
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        border: 1px solid rgba(67, 97, 238, 0.2);
    }

    .resend-option {
        text-align: center;
        margin-top: 20px;
    }

    .resend-option a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        cursor: pointer;
    }

    .resend-option a:hover {
        text-decoration: underline;
    }

    .hidden {
        display: none;
    }

    .step-indicator {
        display: flex;
        justify-content: center;
        margin-bottom: 25px;
    }

    .step {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 10px;
        font-weight: 600;
        color: #6c757d;
    }

    .step.active {
        background-color: var(--primary-color);
        color: white;
    }

    .step-line {
        width: 40px;
        height: 2px;
        background-color: #e9ecef;
        margin: 0 5px;
        align-self: center;
    }

    .step-line.active {
        background-color: var(--primary-color);
    }

    .phone-input-group {
        position: relative;
    }

    .country-code {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-weight: 500;
    }

    .phone-input {
        padding-left: 55px;
    }
    </style>
</head>

<body>
    <div class="verification-container">
        <div class="verification-header">
            <h2>Secure OTP Verification</h2>
            <p class="mb-0">Verify your phone number to continue</p>
        </div>

        <div class="step-indicator">
            <div class="step active">1</div>
            <div class="step-line active"></div>
            <div class="step">2</div>
            <div class="step-line"></div>
            <div class="step">3</div>
        </div>

        <div class="verification-body">
            <!-- Step 1: Enter Phone Number -->
            <div id="step1">
                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number</label>
                    <div class="phone-input-group">
                        <span class="country-code">+91</span>
                        <input type="tel" id="phone" class="form-control phone-input"
                            placeholder="Enter your phone number" required>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" onclick="sendOTP()">Send OTP</button>

                <div class="mt-3">
                    <p class="text-muted small">By continuing, you agree to our <a href="#">Terms of Service</a> and <a
                            href="#">Privacy Policy</a>.</p>
                </div>
            </div>

            <!-- Step 2: Enter OTP -->
            <div id="step2" class="hidden">
                <p class="text-center">We've sent a 6-digit verification code to <strong id="phone-display"></strong>
                </p>

                <div class="form-group">
                    <label class="form-label">Enter OTP Code</label>
                    <div class="otp-inputs">
                        <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 1)">
                        <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 2)">
                        <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 3)">
                        <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 4)">
                        <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 5)">
                        <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 6)">
                    </div>
                </div>

                <div class="timer" id="timer">Resend OTP in 02:00</div>

                <button type="button" class="btn btn-primary" onclick="verifyOTP()">Verify OTP</button>

                <div class="resend-option">
                    <p>Didn't receive the code? <a id="resend-link" onclick="resendOTP()">Resend OTP</a></p>
                </div>
            </div>

            <!-- Step 3: Success -->
            <div id="step3" class="hidden">
                <div class="text-center">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"
                            fill="#4cc9f0" />
                    </svg>
                    <h3 class="mt-3">Verification Successful!</h3>
                    <p class="text-muted">Your phone number has been verified successfully.</p>
                    <button type="button" class="btn btn-primary mt-3" onclick="resetForm()">Verify Another
                        Number</button>
                </div>
            </div>

            <div id="status" class="status-message hidden"></div>
        </div>
    </div>

    <script>
    let generatedOTP = "";
    let countdown;
    let timeLeft = 120; // 2 minutes in seconds

    function sendOTP() {
        const phone = document.getElementById('phone').value;

        // Validate phone number
        if (!phone || phone.length !== 10 || isNaN(phone)) {
            showStatus("Please enter a valid 10-digit phone number", "error");
            return;
        }

        // Generate a random 6-digit OTP
        generatedOTP = Math.floor(100000 + Math.random() * 900000).toString();

        // In a real application, you would send this OTP to the user's phone
        // For demo purposes, we'll show it in the status message
        showStatus(`OTP sent to +91${phone}. For demo purposes, your OTP is: ${generatedOTP}`, "info");

        // Update the displayed phone number
        document.getElementById('phone-display').textContent = `+91${phone}`;

        // Show step 2 and hide step 1
        document.getElementById('step1').classList.add('hidden');
        document.getElementById('step2').classList.remove('hidden');

        // Update step indicator
        updateStepIndicator(2);

        // Start the countdown timer
        startTimer();
    }

    function verifyOTP() {
        // Get the entered OTP from the input fields
        const otpInputs = document.querySelectorAll('.otp-input');
        let enteredOTP = "";

        for (let i = 0; i < otpInputs.length; i++) {
            enteredOTP += otpInputs[i].value;
        }

        // Validate OTP
        if (enteredOTP.length !== 6) {
            showStatus("Please enter the complete 6-digit OTP", "error");
            return;
        }

        // Check if OTP matches
        if (enteredOTP === generatedOTP) {
            // Success
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step3').classList.remove('hidden');
            updateStepIndicator(3);
            clearInterval(countdown);
        } else {
            showStatus("Invalid OTP. Please try again.", "error");
        }
    }

    function resendOTP() {
        // Check if the timer has expired
        if (timeLeft > 0) {
            showStatus(`Please wait ${timeLeft} seconds before requesting a new OTP`, "error");
            return;
        }

        // Generate a new OTP
        generatedOTP = Math.floor(100000 + Math.random() * 900000).toString();

        // In a real application, you would send this OTP to the user's phone
        // For demo purposes, we'll show it in the status message
        showStatus(`New OTP sent. For demo purposes, your OTP is: ${generatedOTP}`, "info");

        // Reset the timer
        timeLeft = 120;
        startTimer();

        // Clear the OTP input fields
        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach(input => input.value = "");
        otpInputs[0].focus();
    }

    function startTimer() {
        clearInterval(countdown);

        // Update the timer display immediately
        updateTimerDisplay();

        // Start the countdown
        countdown = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
                clearInterval(countdown);
                document.getElementById('resend-link').style.pointerEvents = 'auto';
                document.getElementById('resend-link').style.color = 'var(--primary-color)';
            }
        }, 1000);

        // Disable resend link initially
        document.getElementById('resend-link').style.pointerEvents = 'none';
        document.getElementById('resend-link').style.color = '#aaa';
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        document.getElementById('timer').textContent =
            `Resend OTP in ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    function moveToNext(current, nextIndex) {
        // If a digit is entered, move to the next input
        if (current.value.length === 1) {
            if (nextIndex <= 6) {
                document.querySelectorAll('.otp-input')[nextIndex - 1].focus();
            }
        }
    }

    function updateStepIndicator(step) {
        const steps = document.querySelectorAll('.step');
        const stepLines = document.querySelectorAll('.step-line');

        // Reset all steps
        steps.forEach(step => step.classList.remove('active'));
        stepLines.forEach(line => line.classList.remove('active'));

        // Activate steps up to the current one
        for (let i = 0; i < step; i++) {
            steps[i].classList.add('active');
            if (i < step - 1) {
                stepLines[i].classList.add('active');
            }
        }
    }

    function resetForm() {
        // Reset all fields
        document.getElementById('phone').value = '';

        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach(input => input.value = '');

        // Reset steps
        document.getElementById('step3').classList.add('hidden');
        document.getElementById('step1').classList.remove('hidden');

        // Reset step indicator
        updateStepIndicator(1);

        // Clear status message
        document.getElementById('status').classList.add('hidden');

        // Reset timer
        clearInterval(countdown);
        timeLeft = 120;
    }

    function showStatus(message, type) {
        const statusElement = document.getElementById('status');
        statusElement.textContent = message;
        statusElement.className = 'status-message ' + type;
        statusElement.classList.remove('hidden');

        // Auto-hide success messages after 5 seconds
        if (type === 'success') {
            setTimeout(() => {
                statusElement.classList.add('hidden');
            }, 5000);
        }
    }

    // Initialize the form
    document.addEventListener('DOMContentLoaded', function() {
        updateStepIndicator(1);
    });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="verification-container">
        <div class="verification-header">
            <h2>Secure OTP Verification</h2>
            <p class="mb-0">Verify your phone number to continue</p>
        </div>

        <div class="step-indicator">
            <div class="step active">1</div>
            <div class="step-line active"></div>
            <div class="step">2</div>
            <div class="step-line"></div>
            <div class="step">3</div>
        </div>

        <div class="verification-body">
            <!-- Step 1: Enter Phone Number -->
            <div id="step1">
                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number</label>
                    <div class="phone-input-group">
                        <span class="country-code">+91</span>
                        <input type="tel" id="phone" class="form-control phone-input"
                            placeholder="Enter your phone number" required>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" onclick="sendOTP()">Send OTP</button>

                <div class="mt-3">
                    <p class="text-muted small">By continuing, you agree to our <a href="#">Terms of Service</a> and <a
                            href="#">Privacy Policy</a>.</p>
                </div>
            </div>

            <!-- Step 2: Enter OTP -->
            <div id="step2" class="hidden">
                <p class="text-center">We've sent a 6-digit verification code to <strong id="phone-display"></strong>
                </p>

                <div class="form-group">
                    <label class="form-label">Enter OTP Code</label>
                    <div class="otp-inputs">
                        <input type="text" class="otp-input" maxlength="6" oninput="moveToNext()">
                    </div>
                </div>

                <div class="timer" id="timer">Resend OTP in 02:00</div>

                <button type="button" class="btn btn-primary" onclick="verifyOTP()">Verify OTP</button>

                <div class="resend-option">
                    <p>Didn't receive the code? <a id="resend-link" onclick="resendOTP()">Resend OTP</a></p>
                </div>
            </div>

            <!-- Step 3: Success -->
            <div id="step3" class="hidden">
                <div class="text-center">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"
                            fill="#4cc9f0" />
                    </svg>
                    <h3 class="mt-3">Verification Successful!</h3>
                    <p class="text-muted">Your phone number has been verified successfully.</p>
                    <button type="button" class="btn btn-primary mt-3" onclick="resetForm()">Verify Another
                        Number</button>
                </div>
            </div>

            <div id="status" class="status-message hidden"></div>
        </div>
    </div>

    <script>
    let generatedOTP = "";
    let countdown;
    let timeLeft = 120; // 2 minutes in seconds

    function sendOTP() {
        const phone = document.getElementById('phone').value;

        // Validate phone number
        if (!phone || phone.length !== 10 || isNaN(phone)) {
            showStatus("Please enter a valid 10-digit phone number", "error");
            return;
        }

        // Generate a random 6-digit OTP
        generatedOTP = Math.floor(100000 + Math.random() * 900000).toString();

        // In a real application, you would send this OTP to the user's phone
        // For demo purposes, we'll show it in the status message
        showStatus(`OTP sent to +91${phone}. For demo purposes, your OTP is: ${generatedOTP}`, "info");

        // Update the displayed phone number
        document.getElementById('phone-display').textContent = `+91${phone}`;

        // Show step 2 and hide step 1
        document.getElementById('step1').classList.add('hidden');
        document.getElementById('step2').classList.remove('hidden');

        // Update step indicator
        updateStepIndicator(2);

        // Start the countdown timer
        startTimer();
    }

    function verifyOTP() {
        // Get the entered OTP from the input fields
        const otpInputs = document.querySelectorAll('.otp-input');
        let enteredOTP = "";

        for (let i = 0; i < otpInputs.length; i++) {
            enteredOTP += otpInputs[i].value;
        }

        // Validate OTP
        if (enteredOTP.length !== 6) {
            showStatus("Please enter the complete 6-digit OTP", "error");
            return;
        }

        // Check if OTP matches
        if (enteredOTP === generatedOTP) {
            // Success
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step3').classList.remove('hidden');
            updateStepIndicator(3);
            clearInterval(countdown);
        } else {
            showStatus("Invalid OTP. Please try again.", "error");
        }
    }

    function resendOTP() {
        // Check if the timer has expired
        if (timeLeft > 0) {
            showStatus(`Please wait ${timeLeft} seconds before requesting a new OTP`, "error");
            return;
        }

        // Generate a new OTP
        generatedOTP = Math.floor(100000 + Math.random() * 900000).toString();

        // In a real application, you would send this OTP to the user's phone
        // For demo purposes, we'll show it in the status message
        showStatus(`New OTP sent. For demo purposes, your OTP is: ${generatedOTP}`, "info");

        // Reset the timer
        timeLeft = 120;
        startTimer();

        // Clear the OTP input fields
        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach(input => input.value = "");
        otpInputs[0].focus();
    }

    function startTimer() {
        clearInterval(countdown);

        // Update the timer display immediately
        updateTimerDisplay();

        // Start the countdown
        countdown = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();

            if (timeLeft <= 0) {
                clearInterval(countdown);
                document.getElementById('resend-link').style.pointerEvents = 'auto';
                document.getElementById('resend-link').style.color = 'var(--primary-color)';
            }
        }, 1000);

        // Disable resend link initially
        document.getElementById('resend-link').style.pointerEvents = 'none';
        document.getElementById('resend-link').style.color = '#aaa';
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        document.getElementById('timer').textContent =
            `Resend OTP in ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    function moveToNext(current, nextIndex) {
        // If a digit is entered, move to the next input
        if (current.value.length === 1) {
            if (nextIndex <= 6) {
                document.querySelectorAll('.otp-input')[nextIndex - 1].focus();
            }
        }
    }

    function updateStepIndicator(step) {
        const steps = document.querySelectorAll('.step');
        const stepLines = document.querySelectorAll('.step-line');

        // Reset all steps
        steps.forEach(step => step.classList.remove('active'));
        stepLines.forEach(line => line.classList.remove('active'));

        // Activate steps up to the current one
        for (let i = 0; i < step; i++) {
            steps[i].classList.add('active');
            if (i < step - 1) {
                stepLines[i].classList.add('active');
            }
        }
    }

    function resetForm() {
        // Reset all fields
        document.getElementById('phone').value = '';

        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach(input => input.value = '');

        // Reset steps
        document.getElementById('step3').classList.add('hidden');
        document.getElementById('step1').classList.remove('hidden');

        // Reset step indicator
        updateStepIndicator(1);

        // Clear status message
        document.getElementById('status').classList.add('hidden');

        // Reset timer
        clearInterval(countdown);
        timeLeft = 120;
    }

    function showStatus(message, type) {
        const statusElement = document.getElementById('status');
        statusElement.textContent = message;
        statusElement.className = 'status-message ' + type;
        statusElement.classList.remove('hidden');

        // Auto-hide success messages after 5 seconds
        if (type === 'success') {
            setTimeout(() => {
                statusElement.classList.add('hidden');
            }, 5000);
        }
    }

    // Initialize the form
    document.addEventListener('DOMContentLoaded', function() {
        updateStepIndicator(1);
    });
    </script>
</body>

</html>
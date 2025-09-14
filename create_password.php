<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Password - VibeScape</title>
  <style>
    body.vs-password-body {
  background-color: #000;
  color: white;
  font-family: 'Montserrat', sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}

.vs-password-container {
  width: 100%;
  max-width: 400px;
  padding: 30px 20px;
  background: #121212;
  border-radius: 8px;
  box-sizing: border-box;
}

.vs-progress-bar {
  height: 3px;
  background: #333;
  margin-bottom: 20px;
  border-radius: 10px;
  overflow: hidden;
}

.vs-progress-filled {
  width: 33%;
  height: 100%;
  background-color: #1ed760;
}

.vs-step-text {
  font-size: 0.85rem;
  color: #aaa;
  margin-bottom: 5px;
}

.vs-password-title {
  font-size: 1.4rem;
  font-weight: bold;
  margin-bottom: 25px;
}

.vs-password-label {
  display: block;
  font-size: 0.9rem;
  margin-bottom: 6px;
}

.vs-password-input-wrap {
  position: relative;
  margin-bottom: 20px;
}

.vs-password-input {
  width: 100%;
  padding: 12px 40px 12px 15px;
  background-color: #1e1e1e;
  border: none;
  border-radius: 4px;
  color: white;
  font-size: 1rem;
  box-sizing: border-box;
}

.vs-password-toggle {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 1.2rem;
  color: #888;
}

.vs-password-note {
  font-weight: bold;
  font-size: 0.9rem;
  margin-bottom: 10px;
}

.vs-password-rules {
  list-style: none;
  padding-left: 0;
  margin-bottom: 25px;
}

.vs-password-rules li {
  margin-bottom: 8px;
  font-size: 0.9rem;
  color: #ccc;
}

.vs-next-btn {
  display: block;
  text-align: center;
  background-color: #1ed760;
  color: black;
  padding: 12px;
  text-decoration: none;
  border-radius: 25px;
  font-weight: bold;
}

  </style>
</head>
<body class="vs-password-body">

  <div class="vs-password-container">

    <div class="vs-progress-bar">
      <div class="vs-progress-filled"></div>
    </div>

    <p class="vs-step-text">Step 1 of 3</p>
    <h2 class="vs-password-title">Create a password</h2>

    <label for="password" class="vs-password-label">Password</label>
    <div class="vs-password-input-wrap">
      <input type="password" id="password" class="vs-password-input" placeholder="Enter password" />
      <span class="vs-password-toggle" onclick="togglePassword()">👁️</span>
    </div>

    <p class="vs-password-note">Your password must contain at least</p>
    <ul class="vs-password-rules">
      <li>1 letter</li>
      <li>1 number or special character (example: # ? ! &)</li>
      <li>10 characters</li>
    </ul>

    <a href="./tell_about.php" class="vs-next-btn">Next</a>
  </div>

  <script>
    function togglePassword() {
      const input = document.getElementById("password");
      input.type = input.type === "password" ? "text" : "password";
    }
  </script>

</body>
</html>

<?php
http_response_code(500);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>500 Internal Server Error</title>
<style>
body {
  font-family: Arial, sans-serif;
  background: #fafafa;
  color: #333;
  text-align: center;
  padding: 80px;
}
h1 {
  font-size: 2em;
  margin-bottom: 20px;
}
p {
  font-size: 1.1em;
  color: #555;
}
a {
  color: #0073aa;
  text-decoration: none;
}
a:hover {
  text-decoration: underline;
}
</style>
</head>
<body>
  <h1>500 – Internal Server Error</h1>
  <p>Something went wrong on our side.<br>Please try again later.</p>
  <p><a href="/">Return to homepage</a></p>


  <p>
    <?php if (!empty($error_message)): ?>
      <h1>Error message:</h1>
      <p style="color:#777; font-size:0.9em;">
          <em><?= $error_message ?></em>
      </p>
    <?php endif; ?></p>
</body>
</html>

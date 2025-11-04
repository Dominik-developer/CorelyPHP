<?php
  http_response_code(503);
  $reason = isset($reason) ? trim($reason) : NULL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Maintenance Mode</title>

	<link rel="stylesheet" type="text/css" href="/admin/CSS/panel.css">

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
</style>
</head>
<body>

  <h1>503 – Service Unavailable</h1>
  <p><?= htmlspecialchars($reason ?: 'The website is temporarily down for maintenance.') ?></p>
  <br>
  <p><a href="/admin/dashboard">Go back to the dashboard</a></p>
  <br>
  <p>We’ll be back soon!</p>

</body>
</html>

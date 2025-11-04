<?php
  http_response_code(403);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>403 Forbidden</title>

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
    <nav>
        <div class="logo">
            <i class="bx bx-menu menu-icon topbar"></i>
            <span class="logo-name topbar"> Admin Panel</span>
        </div>
    </nav>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
    <h1>403 – Access Denied</h1>
    <p>You don’t have permission to access this page.</p>
    <p><a href="/admin/dashboard">Go back to the dashboard</a></p>
</body>
</html>

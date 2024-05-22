
<!DOCTYPE html>
<html>
<head>
  <title>сортер</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>сортер</h1>
  <?php 
  session_start();
  if (!isset($_SESSION['user_id'])): ?>
    <form action="login.php" method="post">
      <label for="email">Почта:</label>
      <input type="email" name="email" required><br>
      <label for="password">Пароль:</label>
      <input type="password" name="password" required><br>
      <button type="submit">Зайти</button>
    </form>
  <?php else: ?>
    <p>Welcome, <?= $_SESSION['name'] ?>!</p>
    <a href="messages.php">Посмотреть сообщение</a>
    <a href="logout.php">Logout</a>
  <?php endif; ?>
</body>
</html>
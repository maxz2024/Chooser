<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<head>
  <title>Выбиралка</title>
  <meta charset='utf-8'>
</head>

<body>
  <div class=header><h2>Рандомайзер</h2></div>
  <div class='text'>
    <?php
    $list = '';
    $total_lines = 0;
    $student = '';
    // Обработчик HTML-формы
    if (!empty($_POST['list'])) {
      $list = nl2br($_POST['list']);
      $students = explode("<br />\r\n", $list);//array('Вася','Петя','Иван');
      //echo "<pre>";
      //print_r($students);
      //echo "</pre>";
      preg_match_all("/(\n)/", $_POST['list'], $matches);
      $total_lines = count($matches[0]) + 1;
      $id_student = array_rand($students);
      $student = $students[$id_student];
      $info_student = explode(' ',$student);
      unset($students[$id_student]);
      $list = implode('</br>',$students);
      // echo "Студент: $student <br>";
      // exit();
    }
    if (isset($info_student) and count($info_student) > 1) {
      $student = $info_student[0];
      }
    if (empty($_POST['list'])) {
      $total_lines = 0;
    }
    // HTML-форма
    ?>
    <!-- <!-- <h2>Студент: </h2> -->
    <p class=student><?php echo $student ?></p>
    
    <p class=students><?php echo "Студентов - $total_lines: <br>";
    echo $list, '<br>'?></p>
    <!-- <p>Введите список участников<p> -->
    <form method='post'>
      <textarea class=textarea cols='50' rows='10' name='list' placeholder="Введите список студентов"><?php 
      if(isset($students)) { 
        echo htmlentities(implode("\n",$students));} ?></textarea><br>
      <?php //if(isset($_POST['list'])) { 
      // echo htmlentities ($_POST['list']);} ?>
      <!-- <p>Имя: <input type="text" name="list" /></p>   -->
      <input type='submit' value='Отправить' />
    </form>
  </div>
</html>
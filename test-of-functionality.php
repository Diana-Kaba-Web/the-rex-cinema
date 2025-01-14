<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кінотеатр</title>
</head>
<body>
    <h1>Кінотеатр</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" name="sort">
    <label for="sort">Оберіть сортування: </label>
    <select name="sort">
            <option value="cmp_director" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "cmp_director") echo "selected"; ?>>Режисер</option>
            <option value="cmp_year" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "cmp_year") echo "selected"; ?>>Дата випуску</option>
            <option value="cmp_name" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "cmp_name") echo "selected"; ?>>Назва</option>
            <option value="cmp_genre" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "cmp_genre") echo "selected"; ?>>Жанр</option>
            <option value="cmp_rating" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "cmp_rating") echo "selected"; ?>>Рейтинг</option>
            <option value="cmp_studio" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "cmp_studio") echo "selected"; ?>>Кіностудія</option>
            <option value="cmp_sessions" <?php if (isset($_POST["sort"]) && $_POST["sort"] == "cmp_sessions") echo "selected"; ?>>Сеанси</option>
    </select>
    <input type="submit" value="Зберегти" name="sendingSort">
    </form>
    <?php
    include('db-movies.php');
    include('db-actions.php');

    echo '<h3>Зараз у кіно:</h3>';
    if (isset($_POST["sort"])) {
        $how_to_sort = $_POST["sort"];
        sorting($how_to_sort);
    }
    array_walk($movies, "show");
    echo "<p><i>$str</i></p>";
    ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" name="search">    
    <label for="inputData">Введіть запит: </label>
    <input type="text" name="inputData" required>
    <input type="submit" value="Зберегти" name="sendingSearch">
    </form>
    <?php
    if (isset($_POST['sendingSearch'])) {
        global $str;
        $data = $_POST["inputData"];
        $res = search($movies, $data);
        if (!$res) {
            echo "<p>На жаль, на Ваш запит інформація <b>відсутня</b>.</p>";
        }
        else {
            echo '<h3>Результат пошуку:</h3>';
            array_walk($res, "show");
        }
    }
    ?>
</body>
</html>
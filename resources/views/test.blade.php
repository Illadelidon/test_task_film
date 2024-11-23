<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Створення фільму</title>
</head>
<body>
<h1>Створити фільм</h1>

<form action="{{ url('/test-movie') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="title">Назва фільму:</label>
    <input type="text" name="title" id="title" required><br><br>

    <label for="poster">Постер:</label>
    <input type="file" name="poster" id="poster" accept="image/*" required><br><br>

    <label for="genre_ids">Жанри:</label>
    <select name="genre_ids[]" id="genre_ids" multiple>
        <option value="1">Жанр 1</option>
        <option value="2">Жанр 2</option>
        <option value="3">Жанр 3</option>
        <!-- Додайте реальні жанри тут -->
    </select><br><br>

    <button type="submit">Відправити</button>
</form>
</body>
</html>

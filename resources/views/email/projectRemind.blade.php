<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <h1>Есть проекты в которых небыло новых промежутков больше двух дней</h1>
    @foreach($projects as $project)
        <p>{{$project->title}} -- https://eva.3d-mitra.ru/project/{{$project->id}}</p>
    @endforeach
</body>
</html>

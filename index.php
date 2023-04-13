<!DOCTYPE html>
<html lang="en">
<head>
    <title>To-watch</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2 align="center">List of Things to watch or study</h2>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" aria-expanded="false" data-parent="#accordion" href="#collapse1">
                        <h3> Series </h3>
                    </a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php
                        $urlSeries = "http://localhost:8080/series";
                        $chSeries = curl_init($urlSeries);
                        curl_setopt($chSeries, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($chSeries, CURLOPT_SSL_VERIFYPEER, false);
                        $resultSeries = json_decode(curl_exec($chSeries));

                        $urlFilms = "http://localhost:8080/films";
                        $chFilms = curl_init($urlFilms);
                        curl_setopt($chFilms, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($chFilms, CURLOPT_SSL_VERIFYPEER, false);
                        $resultFilms = json_decode(curl_exec($chFilms));
?>
                    <table class="table table-dark">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                </svg>
                            </th>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Season</th>
                            <th scope="col">Episode</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($resultSeries as $rs){
                                ?>
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                        <?php if($rs->status == "ok"){
                                            echo "checked";
                                        } ?>>
                                </div></th>
                            <th><?= $rs->id ?></th>
                            <th><?= $rs->name ?></th>
                            <td><?= $rs->season ?></td>
                            <td><?= $rs->episode ?></td>
                            <td>
                                <a class="btn btn-primary" href="#" role="button">Edit</a>
                                <a class="btn btn-danger" href="#" role="button" onclick="confirmation()">Delete</a>
                            </td>
                        </tr>
                           <?php
                        }
                    ?>
                        </tbody>
                    </table>
                    <td>
                        <a class="btn btn-primary" href="#" role="button">Add</a>
                    </td>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                        <h3> Films </h3>
                    </a>
                </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table table-dark">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                </svg>
                            </th>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Director</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($resultFilms as $rf){
                                ?>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                                <?php if($rf->status == "ok"){
                                                    echo "checked";
                                                } ?>>
                                        </div>
                                    </th>
                                    <th scope="row"><?= $rf->id ?></th>
                                    <td><?= $rf->name ?></td>
                                    <td><?= $rf->director ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="#" role="button">Edit</a>
                                        <a class="btn btn-danger" href="#" role="button" onclick="confirmation()">Delete</a>
                                    </td>
                                </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <td>
                        <a class="btn btn-primary" href="#" role="button">Add</a>
                    </td>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                        <h3> Courses (study) </h3>
                    </a>
                </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table table-dark">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                </svg>
                            </th>
                            <th scope="col">Id</th>
                            <th scope="col">Coure Name</th>
                            <th scope="col">Course Link</th>
                            <th scope="col">Platform</th>
                            <th scope="col">Lesson</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $count = 0;
                        foreach ($result as $res){
                            if ($res->id != 3){
                                $count++;
                                ?>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        </div>
                                    </th>
                                    <th scope="row"><?= $res->id ?></th>
                                    <td><?= $res->id ?></td>
                                    <td><?= $res->descricao ?></td>
                                    <td><?= $res->descricao ?></td>
                                    <td><?= $res->descricao ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="#" role="button">Edit</a>
                                        <a class="btn btn-danger" href="#" role="button" onclick="confirmation()">Delete</a>
                                    </td>
                                </tr>
                            <?php }
                        }
                        ?>
                        </tbody>
                    </table>
                    <td>
                        <a class="btn btn-primary" href="#" role="button">Add</a>
                    </td>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                        <h3> Read (Books/comics) </h3>
                    </a>
                </h4>
            </div>
            <div id="collapse4" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table table-dark">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                </svg>
                            </th>
                            <th scope="col">Id</th>
                            <th scope="col">Type</th>
                            <th scope="col">Name</th>
                            <th scope="col">Number of pages</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $count = 0;
                        foreach ($result as $res){
                            if ($res->id != 3){
                                $count++;
                                ?>
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        </div>
                                    </th>
                                    <th><?= $res->id ?></th>
                                    <td><?= $res->id ?></td>
                                    <td><?= $res->descricao ?></td>
                                    <td><?= $res->descricao ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="#" role="button">Edit</a>
                                        <a class="btn btn-danger" href="#" role="button" onclick="confirmation()">Delete</a>
                                    </td>
                                </tr>
                            <?php }
                        }
                        ?>
                        </tbody>
                    </table>
                    <td>
                        <a class="btn btn-primary" href="#" role="button">Add</a>
                    </td>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmation(){
        confirm("Do you want delete?");
    }
</script>
</body>
</html>

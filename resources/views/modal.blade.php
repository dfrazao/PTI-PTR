@extends('layout.base')
@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 4 DatePicker</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        Criar projeto
    </button>

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Novo Projeto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Project Name" aria-label="ProjectName" aria-describedby="basic-addon1">
                    </div>
                    <div class="mt-4">
                        <h6 class="mb-2">Data de entrega</h6>
                        <input id="datepicker" width="276" />
                        <script>
                            $('#datepicker').datepicker({
                                uiLibrary: 'bootstrap4'
                            });
                        </script>
                    </div>

                    <div class="mt-4">
                        <h6 class="mb-2">Nº máximo de elementos por grupo</h6>
                        <div class="form-group" >
                            <select class="form-control" style="width: 15%">
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>

                    </div>



                    <div class="mt-4">
                        <h6 class="mb-2">Enunciado</h6>
                        <span class="btn btn-default btn-file bg-light ">
                            <input id="input-2" name="input2[]" type="file" class="file " multiple data-show-upload="true" data-show-caption="true">
                        </span>
                    </div>
                    <div class="mt-4">
                        <h6 class="mb-2">Recursos</h6>
                        <span class="btn btn-default btn-file bg-light ">
                            <input id="input-2" name="input2[]" type="file" class="file " multiple data-show-upload="true" data-show-caption="true">
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
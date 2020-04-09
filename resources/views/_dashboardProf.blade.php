@extends('layout.base')
@section('content')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    </head>
    <div class="container-xl">
        <div class="row mt-2" style="height: 90vh;">
            <div class="col-sm-4">
                <div class="container bg-light rounded h-100">
                    <button type="button" class="btn btn-default btn-lg" style="text-align: center;width: 100%;">
                        <span class="fas fa-chevron-up"></span>
                    </button>
                    <h3 style="text-align: center;">March 2020</h3>
                    <table class="table  table-sm" style="text-align: center;">
                        <thead>
                        <tr>
                            <th scope="col">Seg</th>
                            <th scope="col">Ter</th>
                            <th scope="col">Qua</th>
                            <th scope="col">Qui</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Sáb</th>
                            <th scope="col">Dom</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>26</td>
                            <td>27</td>
                        </tr>
                        <tr>
                            <td>28</td>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>

                    <h3 style="text-align: center;">March 2020</h3>
                    <table class="table  table-sm" style="text-align: center;width: 100%;">
                        <thead>
                        <tr>
                            <th scope="col">Seg</th>
                            <th scope="col">Ter</th>
                            <th scope="col">Qua</th>
                            <th scope="col">Qui</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Sáb</th>
                            <th scope="col">Dom</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>26</td>
                            <td>27</td>
                        </tr>
                        <tr>
                            <td>28</td>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-default btn-lg" style="text-align: center;width: 100%;">
                        <span class="fas fa-chevron-down"></span>
                    </button>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="overflow-auto bg-light rounded h-100">
                    <h3 class="pt-3 pl-3">Dashboard Docente</h3>
                    <div class="container overflow-auto mw-80" style="max-height: 75vh;">
                        <div class="container overflow-auto bg-white p-2 mt-3 rounded">
                            <h4 class="mt-2 pl-2 float-left">CSS</h4>
                            <button type="button" class="cadeira btn btn-default btn-lg float-right" id="css">
                                <span class="fas fa-plus"></span>
                            </button>
                        </div>
                        <div class="container overflow-hidden bg-secondary  rounded-bottom doff" id="css-groups" style="display: none;">
                            <p></p>
                            <p>Projeto 1</p>
                            <p>Projeto 2 - etapa 1</p>
                            <p>Projeto 2 - etapa 2</p>
                            <p>Projeto 2 - etapa 3</p>
                            <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#staticBackdrop">
                                Criar projeto
                            </button>
                        </div>
                        <div class="container overflow-auto bg-white p-2 mt-3 rounded">
                            <h4 class="mt-2 pl-2 float-left">PGP</h4>
                            <button type="button" class="cadeira btn btn-default btn-lg float-right" id="pgp">
                                <span class="fas fa-plus"></span>
                            </button>
                        </div>
                        <div class="container overflow-hidden bg-secondary rounded-bottom doff" id="pgp-groups" style="display: none;">
                            <p></p>
                            <p>Exemplo</p>
                            <p>Lalalala</p>
                            <p>Lalalala</p>
                            <p>Lalalala</p>
                            <p>Lalalala</p>
                            <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#staticBackdrop">
                                Criar projeto
                            </button>
                        </div>

                        <div class="container overflow-auto bg-white p-2 mt-3 rounded">
                            <h4 class="mt-2 pl-2 float-left">BD</h4>
                            <button type="button" class="cadeira btn btn-default btn-lg float-right" id="bd">
                                <span class="fas fa-plus"></span>
                            </button>
                        </div>

                        <div class="container overflow-hidden bg-secondary rounded-bottom doff" id="bd-groups" style="display: none;">
                            <p></p>
                            <p>Exemplo</p>
                            <p>Lalalala</p>
                            <p>Lalalala</p>
                            <p>Lalalala</p>
                            <p>Lalalala</p>
                            <button type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#staticBackdrop">
                                Criar projeto
                            </button>
                        </div>

                    </div>
                    <button type="button" class="p-2 btn btn-primary btn-lg float-right" style="background-color: #2c3fb1; border-color: #2c3fb1; position:absolute; right: 2rem; bottom: 1rem;">Cadeiras Antigas</button>
                </div>
            </div>
        </div>
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
    </div>
    <script>
        $(document).ready(function(){

            $(".cadeira").click(function(){
                id = $(this).attr('id');
                if ($("#" + id + "-groups").hasClass( "doff" )) {
                    $("#" + id + "-groups").removeClass( "doff" );
                    $("#" + id).children().addClass('fa-minus').removeClass('fa-plus');
                    $("#" + id + "-groups").slideDown(400);
                } else {
                    $("#" + id + "-groups").addClass( "doff" );
                    $("#" + id).children().addClass('fa-plus').removeClass('fa-minus');
                    $("#" + id + "-groups").slideUp(400);
                }
            });
        });


    </script>
@endsection


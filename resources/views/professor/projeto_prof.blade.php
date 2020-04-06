@extends('layout.base')
@section('content')
    <div class="mt-3 container-xl">
        <h3 class="pb-2">CSS - Projeto 1</h3>



        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="conteudo-tab" data-toggle="tab" href="#conteudo" role="tab" aria-controls="conteudo" aria-selected="true">Conteudo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="noticias-tab" data-toggle="tab" href="#noticias" role="tab" aria-controls="noticias" aria-selected="false">Noticias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="recursos-tab" data-toggle="tab" href="#recursos" role="tab" aria-controls="recursos" aria-selected="false">Recursos</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class=" container-xl tab-pane fade show active " id="conteudo" role="tabpanel" aria-labelledby="conteudo-tab">
                <div class="row rounded " style="background-color: #ededed; height: 75vh;">
                    <div class="col mt-3 ml-3 rounded center" style="background-color: #c6c6c6; height: 87%; position: relative;">
                        <div class="container overflow-auto mw-80" >
                            <div class="container  p-2  rounded">
                                <h5>Grupos </h5>
                            </div>
                            <div class="container overflow-auto bg-white p-2 mt-3 rounded">
                                <h4 class="mt-2 pl-2 float-left">001</h4>

                            </div>
                            <div class="container overflow-auto bg-white p-2 mt-3 rounded">
                                <h4 class="mt-2 pl-2 float-left">002</h4>

                            </div>
                            <div class="container overflow-auto bg-white p-2 mt-3 rounded">
                                <h4 class="mt-2 pl-2 float-left">003</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-7 mt-3 rounded" style="height: 87%;width: 100%;">
                        <div class="container-fluid rounded h-100 pt-3 pl-4" style="background-color: #c6c6c6;">
                            <h5>Ficheiros </h5>
                            <div class="container-fluid d-flex flex-row mt-3" >
                                <div class="container text-center"><i class="fas fa-folder fa-4x" style="color: #ffce52;"></i><br>Trabalho final 1</div>
                                <div class="container text-center"><i class="fas fa-folder fa-4x" style="color: #ffce52;"></i><br>Trabalho final 2</div>
                                <div class="container text-center"><i class="fas fa-folder fa-4x" style="color: #ffce52;"></i><br>Trabalho final 3</div>
                                <button type="submit" class="btn btn-sm mb-2 mr-2" style="background: #2c3fb1; color: white; position: absolute; bottom: 0px; right: 0px;">Submeter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 h-100">


                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="recursos" role="tabpanel" aria-labelledby="recursos-tab">

            <div class="row mt-2" style="height: 75vh;">

                <div class="col-sm-5">
                    <div class="container bg-light rounded h-100">
                        <h4>Últimos Anúncios</h4>
                        <h4>Frazão CAGÃO</h4>
                    </div>
                </div>

                <div class="col-sm-7">
                    <div class="overflow-auto bg-light rounded h-50" style="position: relative;">
                        <h3 class="pt-3 pl-3">Ficheiros</h3>
                        <p>Enunciado v1</p>
                        <p>Enunciado v2</p>
                        @if (count($data) > 0)
                            @foreach($data as $post)
                                <div>
                                    <h3>{{$post->Nome}}</h3>
                                </div>
                            @endforeach
                        @else
                            <p>No posts found</p>
                        @endif

                        <button type="button" class="p-2 btn btn-primary btn-lg float-right" style="background-color: #2c3fb1; border-color: #2c3fb1; position:absolute; right: 2rem; bottom: 1rem;">Upload Ficheiros</button>

                    </div>
                    <div class="overflow-auto bg-light rounded h-50 border-top">
                        <h3 class="pt-3 pl-3">Recursos</h3>
                        <p>Lista de Exercícios</p>
                        <p>Horários da disciplina</p>
                        <button type="button" class="p-2 btn btn-primary btn-lg float-right" style="background-color: #2c3fb1; border-color: #2c3fb1; position:absolute; right: 2rem; bottom: 1rem;">Upload Recursos</button>
                    </div>
                </div>
            </div>
            </div>

            <div class="tab-pane fade" id="noticias" role="tabpanel" aria-labelledby="noticias-tab">
                <div class="container mt-2 pb-3 rounded px-5 pt-3">
                    <div class="table-responsive">
                        <table class="table bg-white" style="text-align:center;">
                            <thead>
                            <tr>
                                <th>Tópico</th>
                                <th>Iniciado por</th>
                                <th>Respostas</th>
                                <th>Últimas mensagens</th>
                                <th>Criada</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Notas</td>
                                <td>Anna</td>
                                <td>0</td>
                                <td>xxx</td>
                                <td>yyy</td>
                            </tr>
                            <tr>
                                <td>exame</td>
                                <td>Alex vidal</td>
                                <td>1</td>
                                <td>ccc</td>
                                <td>bbb</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    </div>
@endsection

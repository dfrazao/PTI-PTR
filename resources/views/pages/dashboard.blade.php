@extends('layout.base')
@section('content')
<div class="container-xl">
    <div class="row mt-2" style="height: 90vh;">

        <div class="col-sm-4">
            <div class="container bg-light rounded h-100">
                <button type="button" class="previous btn btn-default btn-lg" style="text-align: center;width: 100%;">
                    <span class="fas fa-chevron-up"></span>
                </button>
                <h3 class="month1" style="text-align: center;"></h3>
                <div class="table-responsive-xl">
                    <table class="month1-cal table table-sm table-borderless" style="text-align: center;">
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
                        <tr class="week1">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        <tr class="week2">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        <tr class="week3">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        <tr class="week4">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        <tr class="week5">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        <tr class="week6">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <h3 class="month2" style="text-align: center;"></h3>
                <div class="table-responsive-xl">
                    <table class="month2-cal table table-sm table-borderless" style="text-align: center;wclassth: 100%;">
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
                        <tr class="week1">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        <tr class="week2">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        <tr class="week3">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        <tr class="week4">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        <tr class="week5">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        <tr class="week6">
                            <td class="1"></td>
                            <td class="2"></td>
                            <td class="3"></td>
                            <td class="4"></td>
                            <td class="5"></td>
                            <td class="6"></td>
                            <td class="7"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="next btn btn-default btn-lg" style="text-align: center;width: 100%;">
                    <span class="fas fa-chevron-down"></span>
                </button>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="overflow-auto bg-light rounded h-100">
                <h3 class="pt-3 pl-3">Dashboard</h3>
                <div class="container overflow-auto mw-80" style="max-height: 75vh;">

                    <div class="container overflow-auto bg-white p-2 mt-3 rounded">
                        <h4 class="mt-2 pl-2 float-left">CSS</h4>
                        <button type="button" class="cadeira btn btn-default btn-lg float-right" id="css">
                            <span class="fas fa-plus"></span>
                        </button>
                    </div>

                    <div class="container overflow-hidden bg-secondary  rounded-bottom doff" id="css-groups" style="display: none;">
                        <p></p>
                        <p>Exemplo</p>
                        <p>Lalalala</p>
                        <p>Lalalala</p>
                        <p>Lalalala</p>
                        <p>Lalalala</p>
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
                    </div>

                </div>
                <button type="button" class="p-2 btn btn-primary btn-lg float-right" style="background-color: #2c3fb1; border-color: #2c3fb1; position:absolute; right: 2rem; bottom: 1rem;">Cadeiras Antigas</button>
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

        class Calendar {

            constructor() {
                this.monthDiv = document.querySelector('.month1');
                this.nextMonthDiv = document.querySelector('.month2');
                this.prevDiv = document.querySelector('.previous');
                this.nextDiv = document.querySelector('.next');
            }

            init() {
                this.month = [];
                this.month.push(moment(), moment().add(1, 'months'));

                this.today = moment().startOf('day').format('YYYY-MM-DD');

                this.nextDiv.addEventListener('click', _ => {this.addMonth();});
                this.prevDiv.addEventListener('click', _ => {this.removeMonth();});

                this.update();
            }

            update() {
                this.monthString = this.month[0].clone().format('MMMM YYYY');
                this.nextMonthString = this.month[1].clone().format('MMMM YYYY');

                this.calendarDays = [];
                this.calendarDays.push({
                    first: this.month[0].clone().startOf('month'),
                    last: this.month[0].clone().endOf('month').date() },
                    {
                    first: this.month[1].clone().startOf('month'),
                    last: this.month[1].clone().endOf('month').date() });

                this.draw();
            }

            addMonth() {
                this.month[0].add(1, 'month');
                this.month[1].add(1, 'month');
                this.update();
            }

            removeMonth() {
                this.month[0].subtract(1, 'month');
                this.month[1].subtract(1, 'month');
                this.update();
            }

            draw() {
                $('table.month1-cal tr > td').empty()
                $('table.month2-cal tr > td').empty()
                $("table.month1-cal tr > td").removeClass("today");
                $("table.month2-cal tr > td").removeClass("today");
                this.monthDiv.innerText = this.monthString;
                this.nextMonthDiv.innerText = this.nextMonthString;

                for (let months = 0; months <= 1; months++) {
                    let week = 1;
                    let weekday = moment(this.calendarDays[months].first).isoWeekday();
                    let start = moment(this.calendarDays[months].first).format('YYYY-MM-DD');
                    for (let index = 1; index <= this.calendarDays[months].last; index++) {
                        if (weekday == 8) {
                            weekday = 1;
                            week++;
                        }
                        $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).text(index);
                        $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).attr('id',start);
                        if (start == this.today) {
                            $(".month"+[months+1]+"-cal .week"+week+" ."+weekday).addClass("today");
                        }
                        start = moment(start).add(1, 'day').format('YYYY-MM-DD');
                        weekday++;
                    }
                }
            }
        }

        const cal = new Calendar();
        cal.init();

    </script>
    <style>
        table {
            table-layout: fixed;
        }
        tr {
            line-height: 37px;
            min-height: 37px;
            height: 37px;
        }
        .today  {
            font-weight: 800;
            color: #2c3fb1;
        }

        .selected {
            background-color: #2196f3;
            box-shadow: 0 5px 10px -5px rgba(0, 0, 0, 0.75);
            border-radius: 50%;
            color: #111;
        }
    </style>
@endsection


<?php
@session_start();

$crud = new ReservaCrud();
$reservas = $crud->getReservasLocal($idlocal);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../assets/css/fullcalendar.min.css" rel="stylesheet" />
        <link href="../../assets/css/fullcalendar.print.min.css" rel="stylesheet" media="print" />
        <link href="../../assets/css/calendario.css" rel="stylesheet"/>
        <script src="../../assets/js/moment.min.js"></script>
        <script src="../../assets/js/moment.min.js"></script>
        <script src="../../assets/js/bootstrap.min.js"></script>
        <script src="../../assets/js/fullcalendar.min.js"></script>
        <script src="../../assets/locale/pt-br.js"></script>
        <script>

          $(document).ready(function() {

            $('#calendar').fullCalendar({
              header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
              },

              defaultDate: Date(),
              navLinks: true, // can click day/week names to navigate views
              editable: true,
              eventLimit: true, // allow "more" link when too many events
                 //default: '01:00:00', CASO NAO FOR DEFINIDO A DATA DE SAIDA, ATRIBUI UMA HORA DEPOIS DA ENTRADA



                eventClick: function(event) {

                    $("#info #id").text(event.id);
                    $("#info #id").val(event.id);
                    $("#info #nome").text(event.title);
                    $("#info #nome").val(event.title);
                    $("#info #entrada").text(event.start.format('DD/MM/YYYY HH:mm:ss'));
                    $("#info #entrada").val(event.start.format('DD/MM/YYYY HH:mm:ss'));
                    $("#info #saida").text(event.end.format('DD/MM/YYYY HH:mm:ss'));
                    $("#info #saida").val(event.end.format('DD/MM/YYYY HH:mm:ss'));
                    $("#info #color").val(event.color);
                    $("#info").modal("show");
                    // change the border color just for fun
                    $(this).css('border-color', 'blue');

                },

                selectable: true,
                selectHelper: true,
                select: function (start, end) {
                    $("#cadastrar #entrada").val(moment(start).format('DD/MM/YYYY HH:mm:ss'))
                    $("#cadastrar #saida").val(moment(end).format('DD/MM/YYYY HH:mm:ss'))
                    $("#cadastrar").modal("show");
              },

                events: [

                  <?php
                    foreach ($reservas as $reserva):
                        $iduser_reserva = $reserva->id_user;
                        $crudUser = new UsuarioCrud();
                        $user = $crudUser->getUsuarioId($iduser_reserva);
                        $nome = $user->getNome();
                  ?>
                  {
                      id: '<?php echo $reserva->id; ?>',
                      title: '<?php echo $nome; ?>',
                      start: '<?php echo $reserva->entrada; ?>',
                      end: '<?php echo $reserva->saida; ?>',
                      color : '<?php echo $reserva->cor; ?>'

                  },
                  <?php
                    endforeach;
                    ?>

              ],
                // businessHours: [ // specify an array instead
                //     {
                //         dow: [ 1, 2,3,4,5 ], // Monday, Tuesday, Wednesday
                //         start: '08:00', // 8am
                //         end: '18:00' // 6pm
                //     },
                //     {
                //         dow: [ 6,0 ], // Thursday, Friday
                //         start: '10:00', // 10am
                //         end: '16:00' // 4pm
                //     }
                //     ]
            });

          });
            //MASCARA PARA O CAMPO DATA E HORA
            function DataHora(evento, objeto) {
                var keypress=(window.event)?event.keyCode:evento.which;
                campo = eval (objeto);
                if (campo.value == '00/00/0000 00:00:00'){
                    campo.value=""
                }

                caracteres = '0123456789';
                separacao1 = '/';
                separacao2 = ' ';
                separacao3 = ':';
                conjunto1 = 2;
                conjunto2 = 5;
                conjunto3 = 10;
                conjunto4 = 13;
                conjunto5 = 16;
                if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
                    if (campo.value.length == conjunto1 )
                        campo.value = campo.value + separacao1;
                    else if (campo.value.length == conjunto2)
                        campo.value = campo.value + separacao1;
                    else if (campo.value.length == conjunto3)
                        campo.value = campo.value + separacao2;
                    else if (campo.value.length == conjunto4)
                        campo.value = campo.value + separacao3;
                    else if (campo.value.length == conjunto5)
                        campo.value = campo.value + separacao3;
                }else{
                    event.returnValue = false;
                }
            }
        </script>
    </head>
    <body>
    <div class="container">
        <div class="page-header">
            <h1>Agenda do(a) <?= $local->nome ?></h1>
        </div>
    <?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
          <div id='calendar'></div>

    </div>
          <div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title text-center" >Informação sobre a reserva</h4>
                      </div>
                      <div class="modal-body">
                          <div class="visualizar" style="display: block">
                              <dl class="dl-horizontal">
                                  <dt>Reservado por:</dt>
                                  <dd id="nome"></dd>
                                  <dt>Entrada</dt>
                                  <dd id="entrada"></dd>
                                  <dt>Saida</dt>
                                  <dd id="saida"></dd>
                              </dl>
                              <div style="text-align: center">
                              <button class="btn btn-canc-vis btn-warning">Editar</button>
                              <a class="btn btn-excluir btn-danger" >Excluir</a>
                              </div>
                          </div>

                          <!-- ----------------------------------------------EXCLUIR ---------------------------------------->

                          <div class="excluir">
                              <h4 class="modal-title text-center">Tem certeza que deseja excluir essa reserva?</h4>
                              <br>
                              <form method="post" action="ControlerReservas.php?acao=excluir">
                                  <input type="hidden" value="<?= $_SESSION['id'] ?>" name="iduser">
                                  <input type="hidden" value="<?= $idlocal ?>" name="idlocal">
                                  <input type="hidden" id="id" name="id">
                                  <div class="form-group">
                                      <div style="text-align: center">
                                          <button type="button" class="btn btn-nao btn-danger">Não</button>
                                          <button type="submit" class="btn btn-success">Sim</button>
                                      </div>
                                  </div>
                              </form>
                          </div>

                          <!-- ----------------------------------------------EDITAR ---------------------------------------->
                          <div class="form" style="display: none">
                              <form class="form-horizontal" method="post" action="ControlerReservas.php?acao=editar">
                                  <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-2 control-label">Cor</label>
                                      <div class="col-sm-10">
                                          <select name="cor" class="form-control" id="color">
                                              <option value="">Selecione</option>
                                              <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                              <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                              <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                              <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                                              <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                              <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                              <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                              <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                              <option style="color:#228B22;" value="#228B22">Verde</option>
                                              <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-2 control-label">Entrada</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" id="entrada" name="entrada" onKeyPress="DataHora(event, this)">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-2 control-label">Saída</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" id="saida" name="saida" onKeyPress="DataHora(event, this)">
                                      </div>
                                  </div>
                                  <input type="hidden" value="<?= $_SESSION['id'] ?>" name="iduser">
                                  <input type="hidden" value="<?= $idlocal ?>" name="idlocal">
                                  <input type="hidden" id="id" name="id">

                                  <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10">
                                          <button type="button" class="btn btn-canc-edit btn-primary">Cancelar</button>
                                          <button type="submit" class="btn btn-warning">Salvar Alterações</button>
                                      </div>
                                  </div>
                              </form>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
    <!-- ---------------------------------------------CADASTRAR ------------------------------------>
          <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title text-center" >Cadastrar reserva</h4>
                      </div>
                      <div class="modal-body">
                          <form class="form-horizontal" method="post" action="ControlerReservas.php?acao=cadastrar">
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Cor</label>
                                  <div class="col-sm-10">
                                      <select name="cor" class="form-control" id="color">
                                          <option value="">Selecione</option>
                                          <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                          <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                          <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                          <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                                          <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                          <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                          <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                          <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                          <option style="color:#228B22;" value="#228B22">Verde</option>
                                          <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Entrada</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="entrada" name="entrada" onKeyPress="DataHora(event, this)">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Saída</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="entrada" name="saida" onKeyPress="DataHora(event, this)">
                                  </div>
                              </div>
                              <input type="hidden" value="<?= $_SESSION['id'] ?>" name="iduser">
                              <input type="hidden" value="<?= $idlocal ?>" name="idlocal">
                              <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-success">Cadastrar</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>

    <script>

        $(document).ready(function () {
            $(".excluir").hide();
        });

         $(".btn-canc-vis").on("click", function () {
             $(".form").slideToggle();
             $(".visualizar").slideToggle();
         });

         $(".btn-canc-edit").on("click", function () {
             $(".visualizar").slideToggle();
             $(".form").slideToggle();
         });

         $(".btn-excluir").on("click", function () {
             $(".visualizar").slideToggle();
             $(".excluir").show();
         });

        $(".btn-nao").on("click", function () {
            $(".excluir").hide();
            $(".visualizar").slideToggle();
        });
    </script>



    </body>


</html>

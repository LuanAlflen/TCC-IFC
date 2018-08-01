<?php
$crud = new ReservaCrud();
$reservas = $crud->getReservasLocal($idlocal);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <link href="../../assets/css/fullcalendar.min.css" rel="stylesheet" />
        <link href="../../assets/css/fullcalendar.print.min.css" rel="stylesheet" media="print" />
        <link href="../../assets/css/calendario.css" rel="stylesheet" />
        <script src="../../assets/js/moment.min.js"></script>
        <script src="../../assets/js/jquery.min.js"></script>
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
              events: [

                  <?php
                    foreach ($reservas as $reserva):
                  ?>
                  {
                      id: '<?php echo $reserva->id; ?>',
                      title: '<?php echo $reserva->nome; ?>',
                      start: '<?php echo $reserva->entrada; ?>',
                      end: '<?php echo $reserva->saida; ?>',
                      color : '<?php echo $reserva->cor; ?>'
                  },
                  <?php
                    endforeach;
                    ?>

              ]
            });

          });

        </script>
    </head>
    <body>

      <div id='calendar' style="margin-top: 6%">

      </div>

    </body>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../assets/js/bootstrap.min.js"></script>

</html>

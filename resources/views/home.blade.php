@extends('adminlte::page')

@section('title', 'Inicio')

@section('css')
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop
@section('content_header')
    <h1>Inicio Administración</h1>
@stop

@section('content')
  <?php
    $doc_activo=0;
    $doc_archivado = 0;
    $doc_total =0;
    $doc_finalizado=0;


    foreach ($documento as $doc) {
        $doc_total++;
        if($doc->estado == '0'){
          $doc_activo++;
        }
        elseif ($doc->estado == '1') {
          $doc_finalizado++;
        }
        elseif ($doc->estado == '2') {
          $doc_archivado++;
        }
    }


?>
  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$doc_total}}</h3>

              <p>Total Documento</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$doc_activo}}</h3>

              <p>Activos</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$doc_archivado}}</h3>

              <p>Archivado</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$doc_finalizado}}</h3>

              <p>Finalizado</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">ESTADISTICAS</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px; width: 703px;" width="703" height="180"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Ultimos Registros</strong>
                  </p>

                      @foreach ($documento as $doc)
                        <div class="progress-group">
                          <span class="progress-text">{{$doc->codigo}}</span>
                          <span class="progress-number"><b>1</b>/{{$doc_total}}</span>

                          <div class="progress sm">
                            <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                          </div>
                        </div>
                      @endforeach
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header" style="margin-top: 33px;">{{$doc_total}}</h5>
                    <span class="description-text">TOTAL</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-left"></i>
                      @if ($doc_activo>0)
                        {{$doc_activo*100/$doc_total}}
                      @else
                        <?php echo "0"; ?>
                      @endif
                      %%</span>
                    <h5 class="description-header">{{$doc_activo}}</h5>
                    <span class="description-text">ACTIVOS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-up"></i>

                      @if ($doc_archivado>0)
                        {{$doc_archivado*100/$doc_total}}
                      @else
                        <?php echo "0"; ?>
                      @endif
                      %%</span>
                    <h5 class="description-header">{{$doc_archivado}}</h5>
                    <span class="description-text">ARCHIVADO</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>

                      @if ($doc_finalizado>0)
                        {{$doc_finalizado*100/$doc_total}}
                      @else
                        <?php echo "0"; ?>
                      @endif
                      %</span>
                    <h5 class="description-header">{{$doc_finalizado}}</h5>
                    <span class="description-text">FINALIZADO</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>

@stop

@section('js')
          <script src="{{ asset('js/Chart.js')}}"></script>
          <script src="{{ asset('js/demo.js')}}"></script>
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script>

    </script>
@stop

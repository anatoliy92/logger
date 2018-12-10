@extends('avl.default')

@section('js')
  <script src="/avl/js/jquery-ui/jquery-ui.min.js" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $( ".datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: "2000:",
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
      });
    });
  </script>
@endsection

@section('css')
  <link rel="stylesheet" href="/avl/js/jquery-ui/jquery-ui.min.css">
@endsection

@section('main')
  <div class="card">
    <div class="card-header">
      <i class="fa fa-align-justify"></i> Список логов

      <div class="card-actions">
        <a class="btn btn-primary pl-3 pr-3" style="width: 100px;" data-toggle="collapse" href="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter"><i class="fa fa-sliders"></i></a>
      </div>
    </div>
    <div class="card-body">

      <div class="collapse" id="collapseFilter">
        <div class="card">
          <div class="card-body">
            <form id="filter-form" action="{{ route('avllogger::index') }}" method="get">

              <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                  <div class="form-group">
                    {{ Form::label(null, 'After date:') }}
                    {{ Form::text('after', $request->input('after') ?? null, ['class' => 'form-control datepicker']) }}
                  </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                  <div class="form-group">
                    {{ Form::label(null, 'Before date:') }}
                    {{ Form::text('before', $request->input('before') ?? null, ['class' => 'form-control datepicker']) }}
                  </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-2">
                  <div class="form-group">
                    {{ Form::label(null, 'Event:') }}
                    {{ Form::select('event', ['creating' => 'creating', 'updating' => 'updating', 'deleting' => 'deleting'], $request->input('event') ?? null, ['class' => 'form-control', 'placeholder' => 'All']) }}
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="card-footer">
            <div class="btn-group pull-right" role="group" aria-label="Basic example">
              <a class="btn btn-sm btn-danger" href="{{ route('avllogger::index') }}" style="line-height: 24px;"><i class="fa fa-ban"></i> Reset</a>
              <button type="submit" form="filter-form" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Применить</button>
            </div>
          </div>
        </div>
      </div>

      @if ($logs->count() > 0)
        <div class="table-responsive">
          @php $iteration = config('avllogger.countPage') * ($logs->currentPage() - 1); @endphp
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th style="width: 80px;"></th>
                      <th>User</th>
                      <th>Model</th>
                      <th>Browser</th>
                      <th class="text-center" style="width: 100px;">Event</th>
                      <th class="text-center" style="width: 120px;">IP</th>
                      <th class="text-center" style="width: 200px;">Date</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($logs as $log)
                  <tr>
                    <td>{{ ++$iteration }}</td>
                    <td><a href="{{ route('avllogger::show', ['id' => $log->id]) }}">{{ !empty($log->user->fio) ? $log->user->fio : 'No name' }}</a></td>
                    <td>{{ $log->section->name_ru ?? array_get(config('avllogger.modelsNames'), $log->model) ?? $log->model }}</td>
                    <td>{!! getBrowser($log->headers['user-agent']) !!}</td>
                    <td class="text-center">{!! array_get(config('avllogger.events'), $log->event) !!}</td>
                    <td class="text-center">{{ $log->ip }}</td>
                    <td class="text-center">{{ $log->created_at }}</td>
                  </tr>
                @endforeach
              </tbody>
          </table>

          <div class="d-flex justify-content-end">
            {{ $logs->links('avl-logger::avl.pagination.bootstrap-4') }}
          </div>
        </div>
      @endif

    </div>
  </div>
@endsection

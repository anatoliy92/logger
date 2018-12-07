@extends('avl.default')

@section('main')
    <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Список логов
        </div>
        <div class="card-body">
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

@extends('avl.default')

@section('main')
    <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Просмотр записи лога

          <div class="card-actions">
            <a href="{{ route('avllogger::index') }}" class="w-100 pl-3 pr-3"><i class="fa fa-arrow-left"></i> Назад</a>
          </div>

        </div>
        <div class="card-body">

          <div class="row">

            <div class="col-12 col-md-6">
              <div class="row">

                <div class="col-12">
                  <div class="form-group">
                    <label><b>Пользователь</b></label>
                    <span class="form-control">{{ !empty($log->user->fio) ? $log->user->fio : 'No name' }}</span>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label><b>Сущнсть</b></label>
                    <span class="form-control">{{ $log->section->name_ru ?? array_get(config('avllogger.modelsNames'), $log->model) ?? $log->model }}</span>
                  </div>
                </div>

                @if ($log->section)
                  <div class="col-12">
                    <div class="form-group">
                      <label><b>Раздел</b></label>
                      <span class="form-control">{{ $log->section->name_ru }}</span>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label><b>Номер записи</b></label>
                      <span class="form-control">{{ $log->section_id }}</span>
                    </div>
                  </div>
                @endif

              </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="row">

                <div class="col-12">
                  <div class="form-group">
                    <label><b>Браузер</b></label>
                    <span class="form-control">{!! getBrowser($log->headers['user-agent']) !!}</span>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label><b>Referer</b></label>
                    <span class="form-control">{!! $log->headers['referer'][0] !!}</span>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label><b>IP</b></label>
                    <span class="form-control">{{ $log->ip }}</span>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-bookmark-o"></i> Change log
                  <div class="pull-right">
                    {!! array_get(config('avllogger.events'), $log->event) !!}
                  </div>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10%;"></th>
                          <th style="width: 45%;">Было</th>
                          <th style="width: 45%;">Стало</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if ($log->following)
                          @foreach ($log->following as $followKey => $followValue)
                            @if ($followValue != $log->previous[$followKey])
                              <tr>
                                <td>{{ $followKey }}</td>
                                <td>{!! $log->previous[$followKey] !!}</td>
                                <td>{!! $followValue !!}</td>
                              </tr>
                            @endif
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="card-footer">
                  <i class="fa fa-bookmark-o"></i> Change log
                  <div class="pull-right">
                    {{ $log->created_at }}
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
    </div>
@endsection

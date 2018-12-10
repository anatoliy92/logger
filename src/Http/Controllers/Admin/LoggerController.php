<?php namespace Avl\Logger\Http\Controllers\Admin;

use App\Http\Controllers\Avl\AvlController;
use Illuminate\Http\Request;
use Avl\Logger\Models\AvlLogs;

class LoggerController extends AvlController
{

    /**
     * Вывод списка логов
     * @param  Request $request
     * @return view
     */
    public function index (Request $request)
    {
        $logs = new AvlLogs;

        $logs = $this->getQuery($logs, $request);

        return view('avl-logger::avl.logger.index', [
          'logs' => $logs->orderBy('created_at', 'DESC')->paginate(config('avllogger.countPage')),
          'request' => $request
        ]);
    }

    /**
     * Отображение детальной информации лога
     * @param  integer  $id     номер записи
     * @param  Request $request
     * @return view
     */
    public function show ($id, Request $request)
    {
      $log = AvlLogs::findOrFail($id);

      return view('avl-logger::avl.logger.show', [
        'log' => $log
      ]);
    }

    /**
     * Формирование запроса при применении фильтра
     * @param  query $logs
     * @param  Request $request
     * @return query
     */
    protected function getQuery ($logs, $request)
    {
      if ($request->input('event')) {
        $logs = $logs->whereEvent($request->input('event'));
      }

      if ($request->input('after')) {
        $logs = $logs->where('created_at', '>=', $request->input('after'));
      }

      if ($request->input('before')) {
        $logs = $logs->where('created_at', '<=', $request->input('before'));
      }

      return $logs;
    }
}

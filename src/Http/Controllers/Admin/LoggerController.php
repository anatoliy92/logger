<?php namespace Avl\Logger\Http\Controllers\Admin;

use App\Http\Controllers\Avl\AvlController;
use Illuminate\Http\Request;
use Avl\Logger\Models\AvlLogs;

class LoggerController extends AvlController
{

    public function index (Request $request)
    {
        $logs = new AvlLogs;

        $logs = $this->getQuery($logs, $request);

        return view('avl-logger::avl.logger.index', [
          'logs' => $logs->orderBy('created_at', 'DESC')->paginate(config('avllogger.countPage'))
        ]);
    }

    public function show ($id, Request $request)
    {
      $log = AvlLogs::findOrFail($id);

      return view('avl-logger::avl.logger.show', [
        'log' => $log
      ]);
    }

    protected function getQuery ($logs, $request)
    {
      // Формирование запроса для фильтраа

      return $logs;
    }
}

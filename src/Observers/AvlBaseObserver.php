<?php namespace Avl\Logger\Observers;

use Avl\Logger\Models\AvlLogs;
use Illuminate\Http\Request;
use ReflectionClass;
use Auth;

class AvlBaseObserver
{
    /**
     * Authorized user
     * @var eloquent object
     */
    protected $user = null;

    /**
     * Browser header data
     * @var array
     */
    protected $headers = null;

    /**
     * User ip address
     * @var string
     */
    protected $ip = null;

    /**
     * Initialization
     * @param Request $request
     */
    public function __construct (Request $request)
    {
      $this->user = Auth::user();

      $this->headers = $request->headers->all();

      $this->ip = $request->ip();
    }

    /**
     * We write to the log when a new record is added by any user.
     * @param  Eloquent $model  instance
     * @return model instance
     */
    public function creating ($model)
    {
      return AvlLogs::create([
        'user_id'     => $this->user->id ?? NULL,
        'event'       => 'creating',
        'section_id'  => $model->getAttributes()['section_id'] ?? NULL,
        'model'       => $this->__getModelName($model),
        'model_id'    => NULL,
        'previous'    => NULL,
        'following'   => $model->getAttributes() ?? NULL,
        'headers'     => $this->headers ?? NULL,
        'ip'          => $this->ip ?? NULL
      ]);
    }

    /**
     * Write to the log when an existing record is updated by any user.
     * @param  Eloquent $model  instance
     * @return model instance
     */
    public function updating ($model)
    {
      return AvlLogs::create([
        'user_id'     => $this->user->id ?? NULL,
        'event'       => 'updating',
        'section_id'  => $model->getAttributes()['section_id'] ?? NULL,
        'model'       => $this->__getModelName($model),
        'model_id'    => $model->id ?? NULL,
        'previous'    => $model->getOriginal() ?? NULL,
        'following'   => $model->getAttributes() ?? NULL,
        'headers'     => $this->headers ?? NULL,
        'ip'          => $this->ip ?? NULL
      ]);
    }

    /**
     * We write to the log when a user deletes an existing entry.
     * @param  Eloquent $model  instance
     * @return model instance
     */
    public function deleting ($model)
    {
      return AvlLogs::create([
        'user_id'     => $this->user->id ?? NULL,
        'event'       => 'deleting',
        'section_id'  => $model->getAttributes()['section_id'] ?? NULL,
        'model'       => $this->__getModelName($model),
        'model_id'    => $model->id ?? NULL,
        'previous'    => $model->getOriginal() ?? NULL,
        'following'   => NULL,
        'headers'     => $this->headers ?? NULL,
        'ip'          => $this->ip ?? NULL
      ]);
    }

    /**
     * Get model class name
     * @param  Eloquent $model
     * @return class name
     */
    private function __getModelName ($model)
    {
      $getModelName = new ReflectionClass($model);

      return $getModelName->getName() ?? NULL;
    }
}

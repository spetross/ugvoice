<?php namespace App\Presenters;

use Exception;
use Illuminate\Contracts\Auth\Guard;
use Laracasts\Presenter\Presenter;

/**
 * Class RevisionPresenter
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package App\Presenters
 */
class RevisionPresenter extends Presenter
{

    use AuthorPresenterTrait;

    /**
     * The credentials instance.
     *
     * @var Guard
     */
    protected $credentials;

    /**
     * The differ instance.
     *
     * @var \SebastianBergmann\Diff\Differ
     */
    protected $differ;

    /**
     * Create a new instance.
     *
     * @param Guard $auth
     * @param \SebastianBergmann\Diff\Differ $differ
     * @param \App\Contracts\Revision\RevisionInterface $resource
     *
     */
    public function __construct(Guard $auth, Differ $differ, $resource)
    {
        $this->credentials = $auth;
        $this->differ = $differ;

        parent::__construct($resource);
    }

    /**
     * Get the change title.
     *
     * @return string
     */
    public function title()
    {
        $class = $this->getDisplayerClass();

        return with(new $class($this))->title();
    }

    /**
     * Get the change description.
     *
     * @return string
     */
    public function description()
    {
        $class = $this->getDisplayerClass();

        return with(new $class($this))->description();
    }

    /**
     * Get the relevant displayer class.
     *
     * @throws \Exception
     *
     * @return string
     */
    protected function getDisplayerClass()
    {
        $class = $this->wrappedObject->revisionable_type;

        do {
            if (class_exists($displayer = $this->generateDisplayerName($class))) {
                return $displayer;
            }
        } while ($class = get_parent_class($class));

        throw new Exception('No displayers could be found');
    }

    /**
     * Generate a possible displayer class name.
     *
     * @param $class
     * @return string
     */
    protected function generateDisplayerName($class)
    {
        $shortArray = explode('\\', $class);
        $short = end($shortArray);
        $field = studly_case($this->field());

        $temp = str_replace($short, 'RevisionDisplayers\\' . $short . '\\' . $field . 'Displayer', $class);

        return str_replace('Model', 'Presenter', $temp);
    }

    /**
     * Get the change field.
     *
     * @return string
     */
    public function field()
    {
        if (strpos($this->wrappedObject->key, '_id')) {
            return str_replace('_id', '', $this->wrappedObject->key);
        }

        return $this->wrappedObject->key;
    }

    /**
     * Get diff.
     *
     * @return string
     */
    public function diff()
    {
        return $this->differ->diff($this->wrappedObject->old_value, $this->wrappedObject->new_value);
    }

    /**
     * Was the event invoked by the current user?
     *
     * @return bool
     */
    public function wasByCurrentUser()
    {
        return ($this->credentials->check() && $this->credentials->user()->id == $this->wrappedObject->user_id);
    }

    /**
     * Get credentials instance.
     *
     * @return Guard
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Get the differ instance.
     *
     * @return \SebastianBergmann\Diff\Differ
     */
    public function getDiffer()
    {
        return $this->differ;
    }

}
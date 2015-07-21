<?php namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

abstract class AppController extends BaseController
{

    use DispatchesCommands,
        ValidatesRequests;

    protected $layout = 'default';

    public function __construct()
    {
        $this->action = null;
        $this->params = null;
        $this->request = $this->getRouter()->getCurrentRequest();
        $this->title = ucfirst(last($this->request->segments()));
        $this->theme = \Theme::theme(config('site.theme', 'semui'))
            ->layout($this->layout);
    }


    /**
     * Execute an action on the controller.
     *
     * @param string $method
     * @param array $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        $this->action = $method;
        $this->params = $parameters;

        if ($ajaxResponse = $this->ajaxAction())
            return $ajaxResponse;

        $response = call_user_func_array(array($this, $method), $parameters);

        return $response;
    }

    /**
     * @return \Teepluss\Theme\Asset|\Teepluss\Theme\AssetContainer
     */
    protected function asset()
    {
        return $this->theme->asset();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function ajaxAction()
    {
        if ($this->request->header('X-Remote') && $this->request->wantsJson()) {
            try {
                $responseContents = [];
                $result = call_user_func_array([$this, $this->action], $this->params);
                $responseContents['success'] = true;
                if (is_array($result)) {
                    $responseContents = array_merge($responseContents, $result);
                } elseif (is_string($result)) {
                    $responseContents['result'] = $result;
                }

                if ($result instanceof RedirectResponse) {
                    $responseContents['REDIRECT'] = $result->getTargetUrl();
                } elseif (\Flash::check()) {
                    $types = ['success', 'info', 'error', 'warning'];
                    foreach (\Flash::all() as $type => $message) {

                    }
                    if (\Flash::get('success'))
                        $responseContents['FLASH']['success'] = \Flash::first('success');
                    if (\Flash::get('info'))
                        $responseContents['FLASH']['info'] = \Flash::first('info');
                    if (\Flash::get('error'))
                        $responseContents['FLASH']['danger'] = \Flash::first('error');
                    if (\Flash::get('warning'))
                        $responseContents['FLASH']['warning'] = \Flash::first('warning');

                }
                return response()->make()->setContent($responseContents);
            } catch (ValidationException $ex) {
                \Flash::error($ex->getMessage());
                $responseContents = [];
                $responseContents['success'] = false;
                $responseContents['FLASH']['danger'] = \Flash::first('error');
                $responseContents['ERROR_FIELDS'] = $ex->getFields();
                return response()->make()->setContent($responseContents);
            }
        }
    }

    /**
     * Render the view
     * @param $view
     * @return \Response
     */
    protected function render($view, $data = array())
    {
        if ($this->request->ajax()) $this->setlayout('ajax');
        return $this->theme
            ->of($view, $data)->render();
    }

    protected function setlayout($layout = 'default', $bodyClass = null)
    {
        $this->theme->layout($layout)->set('bodyClass', $bodyClass);
    }

    protected function setTitle($title)
    {
        $this->theme->set('title', $title);
    }

    /**
     * Throw the failed validation exception.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @throws HttpResponseException
     * @throws ValidationException
     */
    protected function throwValidationException(Request $request, $validator)
    {
        if ($request->ajax() || $request->wantsJson()) {
            throw new ValidationException($validator);
        }
        throw new HttpResponseException($this->buildFailedValidationResponse(
            $request, $this->formatValidationErrors($validator)
        ));
    }
}

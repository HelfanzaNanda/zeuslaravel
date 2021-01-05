<?php

use Illuminate\Container\Container;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Cookie\Factory as CookieFactory;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Foundation\Mix;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Queue\CallQueuedClosure;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\HtmlString;
use Symfony\Component\HttpFoundation\Response;

if (!function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($abstract, $parameters);
    }
}

if (!function_exists('view_container')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null  $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array  $data
     * @param  array  $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function view_container($view = null, $data = [], $mergeData = [])
    {
        $factory = app(ViewFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data, $mergeData);
    }
}

if (!function_exists('view')) {
    function view($view = '', $header_config = [], $data = [], $merge_data = [],$backend=true)
    {
        if($backend==true)
        {
            $header = array('title' => meta_read('app_name'));
            if (!empty($header_config)) {
                $header = $header_config;
            }
            $content = 'zeus::layout.nocontent';
            if (!empty($view)) {
                $content = $view;
            }
            $merge_core = array_merge(['content' => $content], $data, ['header' => $header]);
            return view_container('zeus::layout.master', $merge_core, $merge_data);
        }else{
            return view_container($view, $data, $merge_data);
        }
    }
}

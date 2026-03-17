<?php 

class Controller
{
    
    public function __construct(HTTPRequest $http_request, Config $config)
    {
        $view = $this->buildView($http_request, $config);
        $model = $this->buildModel($http_request, $config);
        if ($view && $model) {
            $model->connectSQL($config);
            $model->composeSQL($config);
            $view->buildContent($http_request, $config, $model);
            $view->renderTemplate();
        } elseif ($view && $model === false) {
            $view->buildContent($http_request, $config);
            $view->renderTemplate();
        } else {
            $view = new View($http_request, $config);
            $view->buildContent($http_request, $config);
            $view->renderTemplate();
        }
    }
    
    private function buildView($http_request, $config)
    {
        $view_class = 'View' . $http_request->getKEV('verb');
        if (class_exists($view_class)) {
            return new $view_class($http_request, $config);
        }
        
        return false;
    }
    
    private function buildModel($http_request, $config)
    {
        $model_class = 'Model' . $http_request->getKEV('verb');
        if (class_exists($model_class)) {
            return new $model_class($http_request, $config);
        }
        
        return false;
    }
}

<?php
declare(strict_types = 1);

final class FlowWidgetClass
{
    private $widget_load_src = "https://customerwidget.joinflow.com/tvx-customer-widget-app.js";
    private $script;
    private $widget_id;

    public function __construct($script)
    {
        $this->script = $script;

        if(is_array($this->script)) {
            $temp_script = "";
            foreach ($this->script as $array_value){
                $temp_script = $temp_script . $array_value;
            }
            $this->script = $temp_script;
        }

        // Get values of ?widgetId= and/or data-widget-id= from the script
        preg_match('/\?widgetId=([^&"]+)|data-widget-id="([[:alnum:]-]+)/', $this->script, $matches);

        for($i = 1; $i < count($matches); $i++){
            if(!empty($matches[$i])) {
                $this->widget_id = $matches[$i];
            }
        }
    }

    public function getScript()
    {
        return $this->script;
    }

    public function getWidgetId()
    {
        return $this->widget_id;
    }

    public function getWidgetURI()
    {
        if($this->widget_id == null) {
            throw new Exception('No Widget Id was set!');
        }
        return $this->widget_load_src . "?widgetId=" . $this->widget_id;
    }
}

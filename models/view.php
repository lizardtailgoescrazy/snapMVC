<?php
/**
 * Handles the view functionality of our MVC framework
 */
class View_Model
{
    /**
     * Holds variables assigned to template
     */
    private $data = array();

    /**
     * Holds render status of view.
     */
    private $render = FALSE;

    /**
     * Accept a template to load
     */
    public function __construct($template)
    {
        //compose file name
        $file = VIEWS.DS.strtolower($template).'.php';
    
        if (file_exists($file))
        {
            /**
             * trigger render to include file when this model is destroyed
             * if we render it now, we wouldn't be able to assign variables
             * to the view!
             */
            $this->render = $file;
        }
    }

    /**
     * Receives assignments from controller and stores in local data array
     * 
     * @param $variable
     * @param $value
     */
    public function passVars($variable , $value)
    {
        $this->data[$variable] = $value;
    }

    public function __destruct()
    {
        //parse data variables into local variables, so that they render to the view
        $data = $this->data;
    
        //render view
        if($this->render != ""){
            include($this->render);
        }
        else{
            print("No view for this exists.");
        }
    }
}

?>
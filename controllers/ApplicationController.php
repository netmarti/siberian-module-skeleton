<?php

class Job_ApplicationController extends Application_Controller_Default {

    /**
     * Save options
     */
    public function editoptionspostAction() {
        $values = $this->getRequest()->getPost();

        $form = new Job_Form_Options();
        if($form->isValid($values)) {

            $this->getCurrentOptionValue();

            $job = new Job_Model_Job();
            $job->find($this->getCurrentOptionValue()->getId(), "value_id");

            if(isset($values["display_search"])) {
                $job->setDisplaySearch($values["display_search"]);
            }

            if(isset($values["display_place_icon"])) {
                $job->setDisplayPlaceIcon($values["display_place_icon"]);
            }

            if(isset($values["display_income"])) {
                $job->setDisplayIncome($values["display_income"]);
            }

            if(isset($values["display_contact"])) {
                $job->setDisplayContact($values["display_contact"]);
            }

            if(isset($values["title_company"])) {
                $job->setTitleCompany($values["title_company"]);
            }

            if(isset($values["title_place"])) {
                $job->setTitlePlace($values["title_place"]);
            }

            $job->save();

            $html = array(
                "success" => 1,
                "message" => __("Success."),
            );
        } else {
            /** Do whatever you need when form is not valid */
            $html = array(
                "error" => 1,
                "message" => $form->getTextErrors(),
                "errors" => $form->getTextErrors(true)
            );
        }

        $this->_sendHtml($html);
    }

}
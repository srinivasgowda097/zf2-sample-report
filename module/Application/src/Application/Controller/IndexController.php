<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Zend\View\Model\ConsoleModel;
use Application\Model\Merchant;

class IndexController extends AbstractActionController
{

    /**
     * @var \Application\Service\ReportService
     */
    protected $reportService;

    /**
     * Report action
     * 
     * @return ConsoleModel
     * @throws \RuntimeException
     */
    public function indexAction()
    {
        // Request object
        $request = $this->getRequest();

        // Make sure that we are running in a console
        if (!$request instanceof ConsoleRequest) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        // Get Merchant id from request
        $id = (int) $request->getParam('id');

        // Get the report from the report service
        $report = $this->getReportService()->getTransactionsReport($id);

        // Setup console view model
        $consoleModel = new ConsoleModel(array(
            ConsoleModel::RESULT => $report->toText(),
        ));

        return $consoleModel;
    }

    /**
     * Get report service
     * 
     * @return \Application\Service\ReportService
     */
    public function getReportService()
    {
        if (null === $this->reportService) {
            $this->reportService = $this->getServiceLocator()
                    ->get('ReportService');
        }
        return $this->reportService;
    }

}

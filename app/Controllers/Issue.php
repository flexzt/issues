<?php

namespace App\Controllers;

use App\Models\Entities\Issue as IssueEntity;
use App\System\base\Controller;
use App\System\Services\AuthService;

/**
 * Class Issue
 *
 * @package App\Controllers
 */
class Issue extends Controller
{
    /**
     * List all tasks including sorting
     *
     * @return bool
     */
    public function list()
    {
        $this->templateData = [
            'issues' => $this->model->getAll(),
        ];

        return true;
    }

    /**
     * Add issue action
     *
     * @return bool
     */
    public function create()
    {
        $this->templateData['issue'] = new IssueEntity;
        if ($this->request->getMethod() === 'POST' && $this->request->request->has('submit_add_issue')) {
            try {
                $issueId                             = $this->model->addIssue($this->request);
                $this->templateData['issueCreated']  = true;
                $this->templateData['disableFields'] = true;
                $this->templateData['issueId']       = $issueId;
                $this->templateData['issue']         = $this->model->getIssue($issueId);
            } catch (\Throwable $error) {
                $this->templateData['errors'][] = $error->getMessage();
            }
        }

        return true;
    }

    /**
     * Edit task action
     *
     * @param string $issueId Id of the to edit task
     */
    public function edit($issueId)
    {
        if (AuthService::isLoggedIn()) {
            $this->templateData['issue'] = new IssueEntity;
            if ($this->request->getMethod() === 'POST' && $this->request->request->has('submit_edit_issue')) {

                try {
                    $this->model->editIssue($issueId, $this->request);
                    $this->templateData['issueCreated'] = true;
                    $this->templateData['issueId']      = $issueId;
                    $this->templateData['issue']        = $this->model->getIssue($issueId);
                } catch (\Throwable $error) {
                    $this->templateData['errors'][] = $error->getMessage();
                }
            }

            $this->templateData = [
                'issue'        => $this->model->getIssue($issueId),
                'issueId'      => $issueId,
                'issueCreated' => true,
            ];
        } else {
            header('location: ' . '/');
        }
    }

    /**
     * @param $issueId
     */
    public function show($issueId)
    {
        $this->templateData = [
            'issue'         => $this->model->getIssue($issueId),
            'disableFields' => true,
            'issueCreated'  => true,
        ];
    }
}

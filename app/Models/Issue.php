<?php

namespace App\Models;

use App\System\base\Request;
use App\System\base\SystemModel;
use App\System\Context;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Issue
 *
 * @package App\Models
 */
class Issue extends SystemModel
{
    /**
     * Get all tasks
     */
    public function getAll()
    {
        $query = $this->db->prepare('SELECT * FROM issue');
        $query->execute();

        return $this->makeCollection($query->fetchAll());
    }

    /**
     * Get a task from database
     *
     * @param integer $issueId
     *
     * @return object $db
     */
    public function getIssue($issueId)
    {
        $query = $this->db->prepare('SELECT * FROM issue WHERE id = :id LIMIT 1');
        $query->execute([':id' => $issueId]);

        return $this->makeSingle($query->fetch());
    }

    /**
     * Add a issue to database
     *
     * @param Request $request
     *
     * @return string
     */
    public function addIssue(Request $request)
    {
        $this->db
            ->prepare(
                'INSERT INTO issue (username, email, comments) 
                        VALUES (:userName, :email, :comments)'
            )
            ->execute([
                ':userName' => $request->request->get('username'),
                ':email'    => $request->request->get('email'),
                ':comments' => $request->request->get('comments'),
            ]);
        $issueId = $this->db->lastInsertId();

        if ($request->files->get('image')) {
            $this->uploadImage(
                $request->files->get('image'),
                $issueId
            );
        }

        return $issueId;
    }

    /**
     * @param UploadedFile $file
     * @param integer      $issueId
     * @param string       $targetFileName
     */
    public function uploadImage(UploadedFile $file, $issueId, string $targetFileName = null)
    {
        if ($target = $file->move(
            Context::App()->config->basePath . '/public/img/issue',
            $targetFileName ?? $file->getClientOriginalName()
        )) {
            $this->db
                ->prepare(
                    'UPDATE `issue` SET image = :image WHERE id = :id'
                )->execute([
                    ':id'    => $issueId,
                    ':image' => '/img/issue/' . $target->getBasename(),
                ]);
        }
    }

    /**
     * Update a task in database
     *
     * @param Request $request
     */
    public function editIssue($issueId, Request $request)
    {
        $status = $request->request->get('status');

        if ($this->getIssue($issueId)->comments != $request->request->get('comments')
            && $request->request->get('comments') < 2
        ) {
            $status += 2;
        }

        $this->db
            ->prepare('UPDATE issue 
                                    SET email = :email, 
                                        username = :username, 
                                        status = :status, 
                                        comments = :comments
                                    WHERE id = :id;'
            )
            ->execute([
                ':id'       => $issueId,
                ':email'    => $request->request->get('email'),
                ':username' => $request->request->get('username'),
                ':status'   => $status,
                ':comments' => $request->request->get('comments'),
            ]);

        if ($request->files->get('image')) {
            $this->uploadImage(
                $request->files->get('image'),
                $issueId
            );
        }
    }
}

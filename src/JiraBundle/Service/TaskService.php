<?php

namespace JiraBundle\Service;

use JiraBundle\Entity\Document;

class TaskService {
    /**
     * @param Document[] $documents
     * @param array $languages
     * @return array
     */
    public function sortDocumentsByLanguage(array $documents, array $languages) {
        $sortedDocuments = [];
        foreach ($languages as $language) {
            $sortedDocuments[$language] = $documents;
        }
        return $sortedDocuments;
    }
}

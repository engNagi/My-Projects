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
            $sortedDocuments[$language] = [];
            $pattern = '/(^|[^a-z])' . $language . '[^a-z]/i';
            foreach ($documents as $document) {
                if(preg_match($pattern,$document->getFilename())){
                    $sortedDocuments[$language][] = $document;
                }
            }
        }
        return $sortedDocuments;
    }
}

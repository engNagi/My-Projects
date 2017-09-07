<?php

namespace JiraBundle\Service;

use JiraBundle\Entity\Document;

class TaskService
{
    /**
     * @param Document[] $documents
     * @param array $languages
     * @return array
     */
    public function sortDocumentsByRequestedLanguage(array $documents, array $languages)
    {
        $sortedDocuments = array_combine($languages, array_pad([], count($languages), []));
        foreach ($documents as $document)
        {
            foreach ($languages as $language)
            {
                $pattern = '/(^|[^a-z])' . $language . '[^a-z]/i';

                if(preg_match($pattern,$document->getFilename()))
                {
                    $sortedDocuments[$language][] = $document;
                    continue 2;
                }
            }
            $sortedDocuments['--'][] = $document;
        }
        return $sortedDocuments;
    }

    /**
     * @param array $documents
     * @return array
     */
    public function sortDocumentsByIsoCode(array $documents)
    {
        $matchedDocuments = [
            '--' => []
        ];
        $pattern = '/(^|[^a-z])([a-z]{2})[^a-z]/i';
        foreach ($documents as $document) {
            if(preg_match($pattern, $document->getFilename(), $matches))
            {
                if ($matches[2] == 'US' || $matches[2] == 'UK')
                {
                    $matchedDocuments['--'][] = $document;
                    continue;
                }
                $matchedDocuments[$matches[2]][] = $document;
            }
        }
        return $matchedDocuments;
    }

    /**
     * @param array $documents
     * @return array
     */
    public function sortDocumentsMock(array $documents)
    {
        $matchedDocuments = [
            '--' => []
        ];

        foreach ($documents as $document) {
            $filename = strtolower($document->getFilename());

            if (strpos($filename, 'russia') !== false) {
                $matchedDocuments['RU'][] = $document;
            } else {
                $matchedDocuments['--'][] = $document;
            }
        }

        return $matchedDocuments;
    }
}

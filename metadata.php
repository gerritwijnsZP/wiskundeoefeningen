<?php
$baseDir = 'src/pages/';

function generateMetadataFiles($baseDir) {
    $chapterFolders = glob($baseDir . '*', GLOB_ONLYDIR);

    foreach ($chapterFolders as $chapterFolder) {
        $chapterMetadata = array(
            'title' => basename($chapterFolder), // Chapter name
            'description' => 'This is the metadata for the chapter ' . basename($chapterFolder),
            'sections' => array()
        );

        $sectionFolders = glob($chapterFolder . '/*', GLOB_ONLYDIR);

        foreach ($sectionFolders as $sectionFolder) {
            $sectionMetadata = array(
                'title' => basename($sectionFolder), // Section name
                'description' => 'This is the metadata for the section ' . basename($sectionFolder)
            );

            $chapterMetadata['sections'][] = $sectionMetadata;
        }

        $jsonMetadata = json_encode($chapterMetadata, JSON_PRETTY_PRINT);

        $chapterMetadataFilePath = $chapterFolder . '/metadata.json';

        file_put_contents($chapterMetadataFilePath, $jsonMetadata);
    }
}

generateMetadataFiles($baseDir);

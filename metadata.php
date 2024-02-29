<?php

// Define the base directory
$baseDir = 'src/pages/';

// Function to generate metadata files for chapters and sections
function generateMetadataFiles($baseDir) {
    // Get list of chapter folders
    $chapterFolders = glob($baseDir . '*', GLOB_ONLYDIR);

    // Loop through chapter folders
    foreach ($chapterFolders as $chapterFolder) {
        // Create metadata array for the chapter
        $chapterMetadata = array(
            'title' => basename($chapterFolder), // Chapter name
            'description' => 'This is the metadata for the chapter ' . basename($chapterFolder),
            'sections' => array()
            // Add more chapter metadata fields as needed
        );

        // Get list of section folders within the chapter
        $sectionFolders = glob($chapterFolder . '/*', GLOB_ONLYDIR);

        // Loop through section folders
        foreach ($sectionFolders as $sectionFolder) {
            // Create metadata array for the section
            $sectionMetadata = array(
                'title' => basename($sectionFolder), // Section name
                'description' => 'This is the metadata for the section ' . basename($sectionFolder)
                // Add more section metadata fields as needed
            );

            // Add section metadata to chapter metadata
            $chapterMetadata['sections'][] = $sectionMetadata;
        }

        // Convert chapter metadata to JSON format
        $jsonMetadata = json_encode($chapterMetadata, JSON_PRETTY_PRINT);

        // Define metadata file path for chapter
        $chapterMetadataFilePath = $chapterFolder . '/metadata.json';

        // Write chapter metadata to file
        file_put_contents($chapterMetadataFilePath, $jsonMetadata);
    }
}

// Generate metadata files
generateMetadataFiles($baseDir);

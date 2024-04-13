<?php

function parseMetadata($path)
{
  $metadata = [];
  if (is_dir($path)) {
    $metadataFile = $path . '/metadata.json';
    if (file_exists($metadataFile)) {
      $metadataContent = file_get_contents($metadataFile);
      $metadata = json_decode($metadataContent, true);
    }
  }

  return $metadata;
}

function generateChapterArray()
{
  $chapters = [];

  $orderFile = $_SERVER['DOCUMENT_ROOT'] . '/src/pages/metadata.json';
  if (!file_exists($orderFile)) {
    return $chapters;
  }

  $orderContent = file_get_contents($orderFile);
  $order = json_decode($orderContent, true)['order'];

  foreach ($order as $chapterName => $chapterSections) {
    $chapterPath = $_SERVER['DOCUMENT_ROOT'] . '/src/pages/' . $chapterName;
    $chapterMetadata = parseMetadata($chapterPath);

    if (empty($chapterMetadata)) {
      continue;
    }

    $chaptersArray = [
      'title' => $chapterMetadata['title'],
      'description' => $chapterMetadata['description'],
      'sections' => []
    ];

    foreach ($chapterSections as $sectionName => $sectionExercises) {
      $chaptersArray['sections'][] = [
        'title' => $chapterMetadata['sections'][$sectionName]['title'],
        'description' => $chapterMetadata['sections'][$sectionName]['description'],
        'exercises' => array_map(function ($exerciseFile) use ($chapterMetadata, $sectionName) {
          $exerciseMetadata = $chapterMetadata['sections'][$sectionName]['exercises'][$exerciseFile];
          return [
            'title' => $exerciseMetadata['title'],
            'description' => $exerciseMetadata['description'],
            'file' => $exerciseFile
          ];
        }, $sectionExercises)
      ];
    }

    $chapters[] = $chaptersArray;
  }

  return $chapters;
}

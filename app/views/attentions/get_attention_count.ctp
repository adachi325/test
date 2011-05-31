<?php
$csv->addRow(array("hugahuga"));
$csv->setFilename($filename);
echo $csv->render(); // 文字化けする場合は、『echo $csv->render(true, 'sjis', 'utf-8');』
?>

<?php
foreach($dtResults as $result) {
    $this->dtResponse['aaData'][] = array(
        $result['User']['id'],
        $result['User']['start'],
        'actions',
    );
}
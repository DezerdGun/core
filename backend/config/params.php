<?php

use kartik\mpdf\Pdf;

return [
    'adminEmail' => 'admin@example.com',
    'components' => [
        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
        ]
    ]
];

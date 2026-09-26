<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class ReportController extends Controller
{
    public function inspection(Inspection $inspection)
    {
        /*
        |--------------------------------------------------------------------------
        | Increase PCRE limits
        |--------------------------------------------------------------------------
        |
        | Report menggunakan gambar Base64 sehingga HTML menjadi cukup besar.
        |
        */

        ini_set(
            'pcre.backtrack_limit',
            '10000000'
        );

        ini_set(
            'pcre.recursion_limit',
            '10000000'
        );

        /*
        |--------------------------------------------------------------------------
        | Load inspection data
        |--------------------------------------------------------------------------
        */

        $inspection->load([
            'tower.site',
            'template',
            'inspector',
            'results.checklistItem',
            'photos',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Load findings
        |--------------------------------------------------------------------------
        */

        $findings = $inspection->findings()
            ->with([
                'inspectionResult.checklistItem',
                'assignee',
                'photos',
                'workOrders.assignee',
                'workOrders.maintenanceRecords.asset',
                'workOrders.maintenanceRecords.technician',
            ])
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Render Blade
        |--------------------------------------------------------------------------
        */

        $html = view(
            'reports.inspection',
            compact(
                'inspection',
                'findings'
            )
        )->render();

        /*
        |--------------------------------------------------------------------------
        | mPDF temporary directory
        |--------------------------------------------------------------------------
        */

        $tempDir = storage_path(
            'app/mpdf-temp'
        );

        if (!is_dir($tempDir)) {
            mkdir(
                $tempDir,
                0777,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create mPDF
        |--------------------------------------------------------------------------
        */

        $mpdf = new Mpdf([
            'format' => 'A4',

            'orientation' => 'P',

            'margin_left' => 24,

            'margin_right' => 24,

            'margin_top' => 24,

            'margin_bottom' => 28,

            'tempDir' => $tempDir,

            'default_font' => 'dejavusans',

            'showImageErrors' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Write HTML
        |--------------------------------------------------------------------------
        */

        $mpdf->WriteHTML(
            $html
        );

        /*
        |--------------------------------------------------------------------------
        | PDF filename
        |--------------------------------------------------------------------------
        */

        $fileName =
            $inspection->inspection_number .
            '.pdf';

        /*
        |--------------------------------------------------------------------------
        | Output PDF
        |--------------------------------------------------------------------------
        */

        return response(
            $mpdf->Output(
                $fileName,
                Destination::STRING_RETURN
            ),
            200,
            [
                'Content-Type' =>
                    'application/pdf',

                'Content-Disposition' =>
                    'inline; filename="' .
                    $fileName .
                    '"',

                'Cache-Control' =>
                    'no-store, no-cache, must-revalidate',

                'Pragma' =>
                    'no-cache',
            ]
        );
    }
}
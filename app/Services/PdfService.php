<?php
namespace App\Services;

use TCPDF;

class PdfService
{
    protected $tcpdf;

    public function __construct()
    {
        $this->tcpdf = new TCPDF('P', 'mm', 'A5', true, 'UTF-8', false);
        // Configurer TCPDF selon vos besoins
        $this->tcpdf->SetCreator(PDF_CREATOR);
        $this->tcpdf->SetAuthor('Yassine');
        $this->tcpdf->SetTitle('Recu d\'ordonnance');
        $this->tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $this->tcpdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $this->tcpdf->SetMargins(10, 10);
        $this->tcpdf->SetFont('times', 'I', 17);
    }

    public function createPdf($view, $data, $filename)
    {
        $content = view($view, $data)->render();
        $this->tcpdf->AddPage('L');
        $this->tcpdf->writeHTML($content, true, false, true, false, '');
        $this->tcpdf->Output(storage_path('app/pdf/' . $filename), 'F');
    }
}


?>
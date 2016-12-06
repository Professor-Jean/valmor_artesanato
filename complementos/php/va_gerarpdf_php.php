<?php
//include once
  include_once ('../plugin/mpdf/mpdf.php');

  $pdfheader = '
  <hr>
  <table class="pdf" width="100%">
    <tr>
      <td><img width="100px" height="100px" src="../../visual/imagens/logo.png"></td>
      <td  width="70%" align="left" class="festival_name">Valmor Artesanato</td>
    </tr>
  </table>
  <hr>
  ';

  $pdfbody = '<div id="content">';
  $pdfbody .= $_POST['dadospdf'];
  $pdfbody .= '</div>';

  $pdffooter = '
  <hr>
  <table class="pdf" width="100%">
    <tr>
      <td width="33%">© Valmor Artesanato</td>
      <td width="33%" align="center" >{PAGENO}/{nbpg}</td>
      <td width="33%" align="right" >{DATE j/m/Y}</td>
    </tr>
  </table>
  ';

  $mpdf = new mPDF('c', 'A4', '', '', 20, 15, 48, 25, 10, 10);

    $mpdf->SetHTMLHeader($pdfheader);
    $mpdf->setHTMLFooter($pdffooter);

    $stylesheet = file_get_contents('../../visual/css/va_pdf_css.css');

    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->WriteHTML($pdfbody,2);
    $mpdf->output();


?>

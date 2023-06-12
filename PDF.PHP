<?php

namespace core\classes;

use Mpdf\Mpdf;

class PDF
{
    private $pdf;
    private $html;

    private $x, $y; //left, top
    private $width, $height;
    private $text_align;

    private $foreground_color;
    private $background_color;

    private $font_size;
    private $font_family;
    private $font_weight;

    private $show_contour_box;

    public function __construct(bool $show_contour_box = false, string $format = 'A4', string $orientation = 'P', string $mode = 'utf-8')
    {
        //criar a instancia da classe mpdf
        $this->pdf = new Mpdf([
            'format' => $format,
            'orientation' => $orientation,
            'mode' => $mode
        ]);

        //iniciar o html
        $this->start_html();

        $this->show_contour_box = $show_contour_box;
    }

    public function start_html()
    {
        $this->html = '';
    }

    public function output_pdf()
    {
        $this->pdf->WriteHTML($this->html);
        $this->pdf->Output();
    }

    public function set_template($template)
    {
        $this->pdf->SetDocTemplate($template);
    }

    public function save_pdf($pdf_name)
    {
        $this->pdf->WriteHTML($this->html);
        $this->pdf->Output(TEMP_FOLDER_PATH . $pdf_name);
    }

    //==========================================================================

    public function set_x(float $x)
    {
        $this->x = $x;
    }

    public function set_y(float $y)
    {
        $this->x = $y;
    }

    public function set_width(float $width)
    {
        $this->width = $width;
    }

    public function set_height(float $height)
    {
        $this->height = $height;
    }

    public function set_pdf_permissions(array $permissions = [], string $password = null)
    {
        $this->pdf->SetProtection($permissions, $password);
    }

    public function position(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function size(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function position_and_size(float $x, float $y, float $width, float $height)
    {
        $this->position($x, $y);
        $this->size($width, $height);
    }

    public function foreground_color(string $color)
    {
        $this->foreground_color = $color;
    }

    public function background_color(string $color)
    {
        $this->background_color = $color;
    }

    public function text_align(string $text_align)
    {
        $this->text_align = $text_align;
    }

    public function font_family(string $font_family)
    {
        $font_family_list = ['Arial', 'Times New Roman', 'Courier New', 'Lucida Sans Unicode'];

        !in_array($font_family, $font_family_list) ? $this->font_family = 'Arial' : $this->font_family = $font_family;
    }

    public function font_size(string $font_size)
    {
        $this->font_size = $font_size;
    }

    public function font_weight(string $font_weight)
    {
        $this->font_weight = $font_weight;
    }

    public function write_text(string $text)
    {
        $this->html .= '<div style="';

        //position and size
        $this->html .= 'position: absolute;';
        $this->html .= 'left: ' . $this->x . 'px;';
        $this->html .= 'top: ' . $this->y . 'px;';
        $this->html .= 'width: ' . $this->width . 'px;';
        $this->html .= 'height: ' . $this->height . 'px;';
        $this->html .= 'text-align: ' . $this->text_align . ';';

        ////font
        $this->html .= 'font-family: ' . $this->font_family . ';';
        $this->html .= 'font-size: ' . $this->font_size . ';';
        $this->html .= 'font-weight: ' . $this->font_weight . ';';

        ////color
        $this->html .= 'color: ' . $this->foreground_color . ';';
        $this->html .= 'background-color: ' . $this->background_color . ';';

        //show contour box
        if ($this->show_contour_box) {
            $this->html .= 'box-shadow: inset 0px 0px 0px 1px red';
        }

        $this->html .= '">' . $text . '</div>';
    }
}

<?php

namespace App\Models;

class InterventionText
{
    public $position_x;
    public $position_y;
    public $text;
    public $font_path;
    public $font_size;
    public $color;
    public $h_align;
    public $v_align;
    public $wrap;

    public function __construct($position_x, $position_y, $text, $font_path, $font_size, $color, $h_align = 'center', $v_align = 'top', $wrap = null)
    {
        $this->position_x = $position_x;
        $this->position_y = $position_y;
        $this->text = $text;
        $this->font_path = $font_path;
        $this->font_size = $font_size;
        $this->color = $color;
        $this->h_align = $h_align;
        $this->v_align = $v_align;
        $this->wrap = $wrap;
    }

    public function applyTextToImage($image)
    {
        $image->text($this->text, $this->position_x, $this->position_y, function($font) {
            $font->file($this->font_path);
            $font->size($this->font_size);
            $font->color($this->color);
            $font->align($this->h_align);
            $font->valign($this->v_align);
            if($this->wrap) {
                $font->wrap($this->wrap);
            }
        });
    }
}

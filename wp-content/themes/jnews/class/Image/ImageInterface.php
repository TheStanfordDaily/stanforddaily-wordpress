<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Image;

interface ImageInterface
{
    public function single_image_unwrap($id, $size);
    public function image_thumbnail_unwrap($id, $size);
    public function image_thumbnail($id, $size);
    public function owl_single_image($id, $size);
    public function owl_lazy_single_image($id, $size);
    public function owl_lazy_image($id, $size);
    public function single_image($img_src, $img_title, $img_size);
}
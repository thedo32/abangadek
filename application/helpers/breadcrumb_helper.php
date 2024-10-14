<?php
if (!function_exists('generate_breadcrumb')) {
    function generate_breadcrumb() {
        $ci = &get_instance();
        $segment_array = $ci->uri->segment_array();
        $base_url = base_url();
        $breadcrumb = '<ul class="breadcrumb">';
        $breadcrumb .= '<li><a href="' . $base_url . '">Home</a></li>';

        $total_segments = count($segment_array);
        $segment_path = '';

        for ($i = 1; $i <= $total_segments; $i++) {
            $segment_path .= '/' . $segment_array[$i];

            if ($i == $total_segments) {
                // Last segment (current page) should not be a clickable link
                $breadcrumb .= '<li class="active">' . ucfirst($segment_array[$i]) . '</li>';
            } else {
                $breadcrumb .= '<li><a href="' . $base_url . $segment_path . '">' . ucfirst($segment_array[$i]) . '</a></li>';
            }
        }

        $breadcrumb .= '</ul>';
        return $breadcrumb;
    }
}

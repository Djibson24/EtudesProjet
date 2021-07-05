<?php defined( 'ABSPATH' ) or die( '-1' );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$box_classes = array(
    'cms-work-process-border',
    'cms-work-process-number',
    'cms-work-process-color-' . $atts['color_scheme']
);

$box_classes = implode( ' ', $box_classes );

$class_to_filter = vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] ) . $this->getCSSAnimation( $atts['css_animation'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$icon_html = $step_html = $content_html = '';

switch ( $atts['add_icon'] ) {

    // Icon font as icon
    case 'symbol':
        $icon_class = 'fa fa-adjust';
        if ( isset( $atts[ "i_icon_" . $atts['i_type'] ] ) ) {
            $icon_class = $atts[ "i_icon_" . esc_attr( $atts['i_type'] ) ];
        }
        $icon_html = '<i class="work-process-icon-symbol ' . esc_attr( $icon_class ) . '"></i>';
        break;

    // Image as icon
    case 'image':
        $img_data = vc_map_integrate_parse_atts( $this->shortcode, 'vc_single_image', $atts, 'img_' );
        if ( $img_data ) {
            $fancybox_image = visual_composer()->getShortCode( 'vc_single_image' );
            if ( is_object( $fancybox_image ) ) {
                $fancybox_image = $fancybox_image->render( array_filter( $img_data ) );
            }
        }
        if ( '' !== $fancybox_image ) {
            $icon_html = $fancybox_image;
        }
        break;

    // Text as icon
    case 'text':
        $icon_html = esc_html( $atts['text_icon'] );
        break;

    // Default to none
    default:
        break;
}

if ( '' != $icon_html ) {
    vc_icon_element_fonts_enqueue( $atts['i_type'] );
}

if ( ! empty( $atts['step'] ) ) {
    $step_html .= '<span class="work-process-step">' . esc_html( $atts['step'] ) . '</span>';
}

$content_html = empty( $atts['description'] ) ? '' : esc_html( $atts['description'] );
?>
<div class="cms-work-process-wrapper<?php echo esc_attr( $css_class ); ?>">
    <div class="cms-work-process<?php echo empty( $box_classes ) ? '' : ' ' . esc_attr( $box_classes ); ?>">
        <div class="work-process-body">
            <div class="work-process-icon">
                <?php echo $step_html; ?>
            </div>
            <div class="work-process-content">
                <?php echo $content_html; ?>
            </div>
        </div>
    </div>
</div>
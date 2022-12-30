<?php
namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class Elementor_Image_Hover_Effects_EIHE extends Widget_Base {

	public function get_name() {
		return 'e_image_hover_effects';
	}

	public function get_title() {
		return esc_html__('Image Hover Effects', 'eihe-lang');
	}

	public function get_icon() {
		return 'eicon-image-rollover';
	}

	protected function register_controls() {

		$this->start_controls_section(
			'eihe_content',
			[
				'label' => esc_html__('Image Hover Effects', 'eihe-lang'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eihe_effect',
			[
				'label'       	=> esc_html__('Effect', 'eihe-lang'),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'eihe-fade'						=> esc_html__('Fade', 'eihe-lang'),
					'eihe-fade-in-up'				=> esc_html__('Fade In Up', 'eihe-lang'),
					'eihe-fade-in-down'				=> esc_html__('Fade In Down', 'eihe-lang'),
					'eihe-fade-in-left'				=> esc_html__('Fade In Left', 'eihe-lang'),
					'eihe-fade-in-right'			=> esc_html__('Fade In Right', 'eihe-lang'),
					'eihe-slide-up'					=> esc_html__('Slide Up', 'eihe-lang'),
					'eihe-slide-down'				=> esc_html__('Slide Down', 'eihe-lang'),
					'eihe-slide-left'				=> esc_html__('Slide Left', 'eihe-lang'),
					'eihe-slide-right'				=> esc_html__('Slide Right', 'eihe-lang'),
					'eihe-reveal-up'				=> esc_html__('Reveal Up', 'eihe-lang'),
					'eihe-reveal-down'				=> esc_html__('Reveal Down', 'eihe-lang'),
					'eihe-reveal-left'				=> esc_html__('Reveal Left', 'eihe-lang'),
					'eihe-reveal-right'				=> esc_html__('Reveal Right', 'eihe-lang'),
					'eihe-push-up'					=> esc_html__('Push Up', 'eihe-lang'),
					'eihe-push-down'				=> esc_html__('Push Down', 'eihe-lang'),
					'eihe-push-left'				=> esc_html__('Push Left', 'eihe-lang'),
					'eihe-push-right'				=> esc_html__('Push Right', 'eihe-lang'),
					'eihe-hinge-up'					=> esc_html__('Hinge Up', 'eihe-lang'),
					'eihe-hinge-down'				=> esc_html__('Hinge Down', 'eihe-lang'),
					'eihe-hinge-left'				=> esc_html__('Hinge Left', 'eihe-lang'),
					'eihe-hinge-right'				=> esc_html__('Hinge Right', 'eihe-lang'),
					'eihe-flip-horiz'				=> esc_html__('Flip Horizontal', 'eihe-lang'),
					'eihe-flip-vert'				=> esc_html__('Flip Vertical', 'eihe-lang'),
					'eihe-flip-diag-1'				=> esc_html__('Flip Crosss 1', 'eihe-lang'),
					'eihe-flip-diag-2'				=> esc_html__('Flip Crosss 2', 'eihe-lang'),
					'eihe-shutter-out-horiz'		=> esc_html__('Shutter Out Horizontal', 'eihe-lang'),
					'eihe-shutter-out-vert'			=> esc_html__('Shutter Out Vertical', 'eihe-lang'),
					'eihe-shutter-out-diag-1'		=> esc_html__('Shutter Out Crosss 1', 'eihe-lang'),
					'eihe-shutter-out-diag-2'		=> esc_html__('Shutter Out Crosss 2', 'eihe-lang'),
					'eihe-shutter-in-horiz'			=> esc_html__('Shutter In Horizontal', 'eihe-lang'),
					'eihe-shutter-in-vert'			=> esc_html__('Shutter In Vertical', 'eihe-lang'),
					'eihe-shutter-in-out-horiz'		=> esc_html__('Shutter In Out Horizontal', 'eihe-lang'),
					'eihe-shutter-in-out-vert'		=> esc_html__('Shutter In Out Vertical', 'eihe-lang'),
					'eihe-shutter-in-out-diag-1'	=> esc_html__('Shutter In Out Crosss 1', 'eihe-lang'),
					'eihe-shutter-in-out-diag-2'	=> esc_html__('Shutter In Out Crosss 2', 'eihe-lang'),
					'eihe-fold-up'					=> esc_html__('Fold Up', 'eihe-lang'),
					'eihe-fold-down'				=> esc_html__('Fold Down', 'eihe-lang'),
					'eihe-fold-left'				=> esc_html__('Fold Left', 'eihe-lang'),
					'eihe-fold-right'				=> esc_html__('Fold Right', 'eihe-lang'),
					'eihe-zoom-in'					=> esc_html__('Zoom In', 'eihe-lang'),
					'eihe-zoom-out'					=> esc_html__('Zoom Out', 'eihe-lang'),
					'eihe-zoom-out-up'				=> esc_html__('Zoom Out Up', 'eihe-lang'),
					'eihe-zoom-out-down'			=> esc_html__('Zoom Out Down', 'eihe-lang'),
					'eihe-zoom-out-left'			=> esc_html__('Zoom Out Left', 'eihe-lang'),
					'eihe-zoom-out-right'			=> esc_html__('Zoom Out Right', 'eihe-lang'),
					'eihe-zoom-out-flip-vert'		=> esc_html__('Zoom Out Flip Vertical', 'eihe-lang'),
					'eihe-zoom-out-flip-horiz'		=> esc_html__('Zoom Out Flip Horizontal', 'eihe-lang'),
					'eihe-blur'						=> esc_html__('Blur', 'eihe-lang'),
				],
				'default' 		=> 'eihe-fade-in-up',
			]
		);

		$this->add_control(
			'eihe_image',
			[
				'label' => esc_html__('Choose Image', 'eihe-lang'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],				
				'dynamic' => [ 'active' => true],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 	  => 'eihe_thumbnail',
				'exclude' => ['custom'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'eihe_title',
			[
				'label' 	  => __('Title', 'eihe-lang'),
				'type' 		  => Controls_Manager::TEXT,
				'default' 	  => __('Title', 'eihe-lang'),
				'placeholder' => __('Type your title here', 'eihe-lang'),
				'separator'   => 'before',
				'label_block' => true ,
				'dynamic' => [ 'active' => true]
			]
		);

		$this->add_control(
			'eihe_tag',
			[
				'label'     => esc_html__('Title Tag', 'eihe-lang'),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1'	=> esc_html__('H1', 'eihe-lang'),
					'h2'	=> esc_html__('H2', 'eihe-lang'),
					'h3'	=> esc_html__('H3', 'eihe-lang'),
					'h4'	=> esc_html__('H4', 'eihe-lang'),
					'h5'	=> esc_html__('H5', 'eihe-lang'),
					'h6'	=> esc_html__('H6', 'eihe-lang'),
					'p'		=> esc_html__('Paragraph', 'eihe-lang'),
					'span'	=> esc_html__('Span', 'eihe-lang'),
				],
				'default' 	=> 'h3',
			]
		);

		$this->add_control(
			'eihe_description',
			[
				'label' 	  => __('Description', 'eihe-lang'),
				'type' 		  => Controls_Manager::TEXTAREA,
				'rows'	 	  => 5,
				'default' 	  => __('Description', 'eihe-lang'),
				'placeholder' => __('Type your description here', 'eihe-lang'),
				'show_label'  => true,
				'separator' => 'before',
				'dynamic' => [ 'active' => true]
			]
		);

		$this->add_control(
			'icon',
			[
				'label'       => __( 'Icon', 'eihe-lang'),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_order',
			[
			'label'       	    => esc_html__('Icon Position', 'eihe-lang'),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'before' 	=> esc_html__('Before', 'eihe-lang'),
					'after' 	=> esc_html__('After', 'eihe-lang'),
				],
				'default' 		=> 'after',
			]
		);

		$this->add_control(
			'eihe_link',
			[
				'label' 			=> __('Link To', 'eihe-lang'),
				'type' 				=> Controls_Manager::URL,
				'placeholder' 	    => __('https://your-link.com', 'eihe-lang'),
				'show_external'     => true,
				'separator' => 'before',
				'default' 		    => [
					'url' 		    => '',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'dynamic' => [ 'active' => true],
			]
		);
		
		$this->end_controls_section();
		$this->start_controls_section(
			'eihe_pro',
			[
				'label' => esc_html__('PRO Features', 'eihe-lang'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eihe_pro_html',
			[
				'label' => __( ' ', 'eihe-lang'),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'content_classes' => 'eihe-pro-prepare',
				'raw' => __( '<br/><div>Meet Our Pro Effects</div><br/>Thank you for installing our plugin, you can also try our premium version which includes 150+ Creative Hover effects<br/><br/><a target="_blank" href="https://tiny.cc/eihe-pro">Emage Hover Effects</a>', 'eihe-lang'),
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'eihe_content_style', 
			[
				'label'         => esc_html__('Style', 'eihe-lang'),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eihe_background_color',
			[
				'label'         => esc_html__('Background', 'eihe-lang'),
				'type'          => Controls_Manager::COLOR,
				'default' 		=> '#000',
				'selectors'     => [
					"{{WRAPPER}} .eihe-box,
					{{WRAPPER}} .eihe-box .eihe-caption,
					{{WRAPPER}} .eihe-box[class^='eihe-shutter-in-']:after,
					{{WRAPPER}} .eihe-box[class^='eihe-shutter-in-']:before,
					{{WRAPPER}} .eihe-box[class*=' eihe-shutter-in-']:after,
					{{WRAPPER}} .eihe-box[class*=' eihe-shutter-in-']:before,
					{{WRAPPER}} .eihe-box[class^='eihe-shutter-out-']:before,
					{{WRAPPER}} .eihe-box[class*=' eihe-shutter-out-']:before,
					{{WRAPPER}} .eihe-box[class^='eihe-reveal-']:before,
					{{WRAPPER}} .eihe-box[class*=' eihe-reveal-']:before"  => "background-color: {{VALUE}};",
					"{{WRAPPER}} .eihe-box[class*=' eihe-reveal-'] .eihe-caption"  => "background: none;",
					"{{WRAPPER}} .eihe-box[class*=' eihe-shutter-in-'] .eihe-caption"  => "background: none;",
					"{{WRAPPER}} .eihe-box[class*=' eihe-shutter-out-'] .eihe-caption"  => "background: none;",
				]
			]
		);

		$this->add_responsive_control(
			'eihe_align',
			[
				'label'   => esc_html__('Horizontal Alignment', 'eihe-lang'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start'=> [
						'title' => esc_html__('Left', 'eihe-lang'),
						'icon'  => 'fa fa-align-left',
					],
					'center'    => [
						'title' => esc_html__('Center', 'eihe-lang'),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end'  => [
						'title' => esc_html__('Right', 'eihe-lang'),
						'icon'  => 'fa fa-align-right',
					]
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .eihe-box .eihe-caption' => 'align-items: {{VALUE}}',
				]
			]
		);

		$this->add_responsive_control(
			'eihe_vertical_align',
			[
				'label'   => esc_html__('Vertical Alignment', 'eihe-lang'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start'=> [
						'title' => esc_html__('Top', 'eihe-lang'),
						'icon'  => 'eicon-v-align-top',
					],
					'center'    => [
						'title' => esc_html__('Middle', 'eihe-lang'),
						'icon'  => 'eicon-v-align-middle',
					],
					'flex-end'  => [
						'title' => esc_html__('Bottom', 'eihe-lang'),
						'icon'  => 'eicon-v-align-bottom',
					]
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .eihe-box .eihe-caption' => 'justify-content: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'eihe_padding',
			[
				'label'     => esc_html__('Padding', 'eihe-lang'),
				'type'      => Controls_Manager::DIMENSIONS,
				'size_units'=> ['px', '%'],
				'default'   => [
					'top'   => 30,
					'right' => 30,
					'bottom'=> 30,
					'left'  => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .eihe-box .eihe-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
				]
			]
		);

		$this->add_control(
			'eihe_image_border_radius',
			[
				'label'      	=> esc_html__('Border Radius', 'eihe-lang'),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> ['px', '%'],
				'selectors' 	=> [
					'{{WRAPPER}} .eihe-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
				]
			]
		);

		$this->add_control(
			'eihe_title_heading',
			[
				'label'     => __('Title', 'eihe-lang'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'eihe_title_color',
			[
				'label'     => __('Color', 'eihe-lang'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eihe-box .eihe-caption .eihe-title-cover .eihe-title' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'eihe_title_typography',
				'label' 	=> __('Typography', 'eihe-lang'),
				'selector' 	=> '{{WRAPPER}} .eihe-box .eihe-caption .eihe-title-cover .eihe-title'
			]
		);

		$this->add_control(
			'eihe_description_heading',
			[
				'label'     => __('Description', 'eihe-lang'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'eihe_description_color',
			[
				'label'     => __('Color', 'eihe-lang'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eihe-box .eihe-caption p' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'eihe_description_typography',
				'label' 	=> __('Typography', 'eihe-lang'),
				'selector' 	=> '{{WRAPPER}} .eihe-box .eihe-caption p'
			]
		);

		$this->add_control(
			'icon_heading',
			[
				'label'     => __('Icon', 'eihe-lang'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'eihe-lang'),
				'type' => Controls_Manager::COLOR,
				'default' => '#dddddd',
				'selectors' => [
					'{{WRAPPER}} .eihe-box .eihe-caption .eihe-title-cover .eihe-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __('Icon Size', 'eihe-lang'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 30
				],
				'selectors' => [
					'{{WRAPPER}} .eihe-box .eihe-caption .eihe-title-cover .eihe-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_space',
			[
				'label' => __('Icon Space', 'eihe-lang'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'default' => [
					'size' => 15
				],
				'selectors' => [
					'{{WRAPPER}} .eihe-box .eihe-caption .eihe-title-cover .eihe-ileft' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eihe-box .eihe-caption .eihe-title-cover .eihe-iright' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	public static function validate_html_tag($tag)
	{
		if(method_exists('Elementor\Utils', 'validate_html_tag'))
		{
			return Utils::validate_html_tag($tag);
		} else {
			$allowed_tags = ['h1','h2','h3','h4','h5','h6','p','span'];
			return in_array(strtolower($tag), $allowed_tags) ? $tag : 'div';
		}
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$eihe_tag = $this->validate_html_tag($settings['eihe_tag']);
		$icon = $settings['icon'];
		$icon_order = $settings['icon_order'];
		$eihe_align = $settings['eihe_align'];

		$target = $settings['eihe_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['eihe_link']['nofollow'] ? ' rel="nofollow"' : '';

		$title 			= wp_kses_post($settings['eihe_title']);
		$desc 			= wp_kses_post($settings['eihe_description']);
		$eihe_effect	= esc_attr($settings['eihe_effect']);
		$eihe_link 		= esc_url($settings['eihe_link']['url']);

		if (strlen($eihe_link) > 0) { ?>
			<a href="<?php echo $eihe_link; ?>"<?php echo $target.$nofollow; ?>>
		<?php } ?>
			<div class="eihe-box <?php echo $eihe_effect . ' eihe_' . $eihe_align; ?>">
				<?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'eihe_thumbnail', 'eihe_image'); ?>
				<div class="eihe-caption">
					<div class="eihe-title-cover">
						<?php if($icon_order == 'before' && !empty($icon) && !empty($icon['value'])) { ?><div class="eihe-ileft eihe-icon"><?php Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?> </div> <?php } ?>
						<<?php echo $eihe_tag;?> class="eihe-title"><?php echo $title; ?></<?php echo $eihe_tag; ?>>
						<?php if($icon_order == 'after' && !empty($icon) && !empty($icon['value'])) { ?><div class="eihe-iright eihe-icon"><?php Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );  ?> </div> <?php } ?>
					</div>
					<p><?php echo $desc; ?></p>
				</div>
			</div>
		<?php if (strlen($eihe_link) > 0) { ?>
			</a>
		<?php }
	}

	protected function content_template()
	{
		?>
		<#

		var image = {
			id: settings.eihe_image.id,
			url: settings.eihe_image.url,
			size: settings.eihe_thumbnail_size,
			dimension: settings.eihe_thumbnail_custom_dimension,
			model: view.getEditModel()
		};
		var image_url = elementor.imagesManager.getImageUrl(image);
		var icon = settings.icon;
		var icon_order = settings.icon_order;
		var iconHTML = '';

		var target = settings.eihe_link.is_external ? ' target="_blank"' : '';
		var nofollow = settings.eihe_link.nofollow ? ' rel="nofollow"' : '';

		var allowed_tags = ['h1','h2','h3','h4','h5','h6','p','span'];
		
		var eihe_tag = settings.eihe_tag;

		if ( typeof elementor.helpers.validateHTMLTag === "function" ) { 
			eihe_tag = elementor.helpers.validateHTMLTag(eihe_tag);
		} else {
			eihe_tag = allowed_tags.indexOf(eihe_tag) > -1 ? eihe_tag : 'div';
		}

		var eihe_title = settings.eihe_title;
		var eihe_description = settings.eihe_description;
		var eihe_link = settings.eihe_link.url;

		if (eihe_link.length > 0) { #>
			<a href="{{{ eihe_link }}}"{{ target }}{{ nofollow }}>
		<# } #>
			<div class="eihe-box {{{ settings.eihe_effect }}} eihe_{{{ settings.eihe_align }}}">
				<img src="{{{ image_url }}}" />
				<div class="eihe-caption">
					<div class="eihe-title-cover">
						<# if(icon && settings.icon.value && icon_order == 'before'){ 
							iconHTML = elementor.helpers.renderIcon(view, settings.icon, { 'aria-hidden': true }, 'i', 'object' ); #>
							<div class="eihe-ileft eihe-icon">{{{ iconHTML.value }}}</div>
						<# } #>
						<{{{eihe_tag}}} class="eihe-title">{{{ eihe_title }}}</{{{eihe_tag}}}>
						<# if(icon && settings.icon.value && icon_order == 'after'){ 
							iconHTML = elementor.helpers.renderIcon(view, settings.icon, { 'aria-hidden': true }, 'i', 'object' ); #>
							<div class="eihe-iright eihe-icon">{{{ iconHTML.value }}}</div>
						<# } #>
					</div>
					<p>{{{ eihe_description }}}</p>
				</div>
			</div>
		<# if (eihe_link.length > 0) { #>
			</a>
		<# } #>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type(new Elementor_Image_Hover_Effects_EIHE());
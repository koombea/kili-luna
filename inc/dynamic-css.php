<?php
function get_base_styles() {
	return '@media only screen and (max-width: 480px) {
		.{{acf_fc_layout}}_{{block_position}}_{{page_id}} {
			background-image: url("{{background_image_mobile_url}}");
		}
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} {
		background-attachment: {{background_attachment}};
		background-color: {{background_color}};
		background-image: url("{{background_image_url}}");
		border: {{border_width}}px solid {{border_color}};
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} h2 {
		color: {{title_color}};
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} .hero__subtitle {
		color: {{title_color}};
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} h2 .dash {
		background-color: {{title_color}};
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} .cta {
		color: {{cta_text_color}};
		background-color: {{cta_background_color}};
		border-color: {{cta_background_color}};
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} .normal-link {
		color: {{links_color}};
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} .button-link {
		background-color: {{buttons_background_color}};
		border-color: {{buttons_background_color}};
		color: {{buttons_text_color}};
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} .normal-button-link {
		background-color: {{button_link_background_color}};
		border-color: {{button_link_background_color}};
		color: {{button_link_text_color}};
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} .normal-link-text {
		color: {{normal_link_color}};
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} .cta-button-link {
		background-color: {{cta_background_color}};
		border-color: {{cta_border_color}};
		color: {{cta_text_color}};
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} .hero__overlay {
		background-color: {{opacity_color}};
		filter: alpha(opacity={{opacity_transparency}});
		opacity: calc({{opacity_transparency}}/100);
		background-image: linear-gradient(-180deg, rgba(0,0,0,0.00) 0%, rgba(0,0,0,0.52) 97%);
	}
	.{{acf_fc_layout}}_{{block_position}}_{{page_id}} .split-background--full {
		background-image: url("{{featured_image_url}}");
		background-size: {{featured_image_size}};
	}';
}

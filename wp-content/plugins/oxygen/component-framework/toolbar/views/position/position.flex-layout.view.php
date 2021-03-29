<div class="oxygen-icon-button-list oxygen-icon-button-list-big oxygen-icon-button-list-equal">
									
	<label class='oxygen-icon-button-list-option'
		ng-class="{'oxygen-icon-button-list-option-active':iframeScope.getOption('<?php echo esc_attr($param['param_name'])?>')=='column','oxygen-icon-button-list-button-default':iframeScope.isInherited(iframeScope.component.active.id,'<?php echo esc_attr($param['param_name'])?>','column')==true}">
		<div class='oxygen-icon-button-list-option-icon-wrapper'>
			<img src='<?php echo CT_FW_URI; ?>/toolbar/UI/oxygen-icons/flex/stack_vertically_icon.svg' />
			<input type="radio" name="<?php echo esc_attr($param['param_name'])?>" value="column"
				ng-model="iframeScope.component.options[iframeScope.component.active.id]['model']['<?php echo esc_attr($param['param_name'])?>']"
				ng-model-options="{ debounce: 10 }"
				ng-change="iframeScope.setOption(iframeScope.component.active.id,'<?php echo $tag; ?>','<?php echo esc_attr($param['param_name'])?>');"
				ng-click="radioButtonClick(iframeScope.component.active.name, '<?php echo esc_attr($param['param_name'])?>', 'column'); iframeScope.setTextAlign()"/>
				<img src='<?php echo CT_FW_URI; ?>/toolbar/UI/oxygen-icons/flex/stack_vertically_icon--active.svg' />
		</div>
		<div class='oxygen-icon-button-list-option-label'>
			<?php if (!isset($param['vertical_text']) || !$param['vertical_text']) { 
				_e("Stack Child Elements Vertically");
			} else {
				echo $param['vertical_text'];
			} ?>
		</div>
	</label>

	<label class='oxygen-icon-button-list-option'
		ng-class="{'oxygen-icon-button-list-option-active':iframeScope.getOption('<?php echo esc_attr($param['param_name'])?>')=='row','oxygen-icon-button-list-button-default':iframeScope.isInherited(iframeScope.component.active.id,'<?php echo esc_attr($param['param_name'])?>','row')==true}">
			<div class='oxygen-icon-button-list-option-icon-wrapper'>
				<img src='<?php echo CT_FW_URI; ?>/toolbar/UI/oxygen-icons/flex/stack_horizontally_icon.svg' />
				<input type="radio" name="<?php echo esc_attr($param['param_name'])?>" value="row"
					ng-model="iframeScope.component.options[iframeScope.component.active.id]['model']['<?php echo esc_attr($param['param_name'])?>']"
					ng-model-options="{ debounce: 10 }" 
					ng-change="iframeScope.setOption(iframeScope.component.active.id,'<?php echo $tag; ?>','<?php echo esc_attr($param['param_name'])?>');"
					ng-click="radioButtonClick(iframeScope.component.active.name, '<?php echo esc_attr($param['param_name'])?>', 'row'); iframeScope.setTextAlign()"/>
				<img src='<?php echo CT_FW_URI; ?>/toolbar/UI/oxygen-icons/flex/stack_horizontally_icon--active.svg' />
			</div>
			<div class='oxygen-icon-button-list-option-label'>
				<?php if (!isset($param['horizontal_text']) || !$param['horizontal_text']) { 
					_e("Stack Child Elements Horizontally");
				} else {
					echo $param['horizontal_text'];
				} ?>
			</div>
	</label>
									
</div>
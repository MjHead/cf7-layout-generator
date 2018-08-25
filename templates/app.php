<grid-layout class="cf7-canvas"
	:layout="layout"
	:col-num="12"
	:row-height="36"
	:margin="[5, 5]"
	:is-draggable="true"
	:is-resizable="true"
	:vertical-compact="true"
	:use-css-transforms="true"
	:style="{ margin: '0 -5px' }"
	@layout-updated="updateLayout"
>
	<grid-item class="cf7-canvas__field"
		v-for="( item, index ) in layout" 
		:key="item.i"
		:x="item.x"
		:y="item.y"
		:w="item.w"
		:h="item.h"
		:i="item.i"
		:max-h="1"
	>
		<div class="cf7-canvas__field-content">
			<div class="cf7-canvas__field-label">CF7 Field: {{ currentWidth( item.w ) }}</div>
			<div class="cf7-canvas__field-remove" @click="removeField( item, index )">&times;</div>
		</div>
	</grid-item>
</grid-layout>
<button type="button" @click="addField">Add Field</button>
<div class="cf7-result">
	<div class="cf7-result__html">
		<pre>{{ resultHTML }}</pre>
	</div>
</div>
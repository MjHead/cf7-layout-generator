<grid-layout class="cf7-canvas"
	:layout="layout"
	:col-num="12"
	:row-height="48"
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
			<div class="cf7-canvas__field-remove" @click="removeField( item, index )"></div>
			<div class="cf7-canvas__field-label">CF7 Field: <b>{{ currentWidth( item.w ) }}</b></div>
		</div>
	</grid-item>
</grid-layout>
<button type="button" class="cf7-canvas__add" @click="addField">
	<i class="nc-icon-glyph ui-2_small-add"></i>Add Field
</button>
<div class="cf7-result">
	<div class="cf7-result__heading">
		<div class="cf7-result__tabs">
			<div
				:class="[ 'cf7-result__tabs-item', { 'item-active': visibleResult === 'html' } ]"
				@click="visibleResult = 'html'"
			>HTML</div>
			<div
				:class="[ 'cf7-result__tabs-item', { 'item-active': visibleResult === 'css' } ]"
				@click="visibleResult = 'css'"
			>CSS</div>
		</div>
		<div class="cf7-settings">
			<div class="cf7-settings__field">
				Gutter (px):
				<input type="number" v-model="gutter">
			</div>
			<div class="cf7-settings__field">
				Mobile breakpoint (px):
				<input type="number" v-model="mobileBreakpoint">
			</div>
		</div>
		<div class="cf7-actions">
			<transition name="slide-top-in-out">
				<div class="cf7-actions__result cf7-actions__result-success" v-if="showCopySuccess">
					Copied!
				</div>
			</transition>
			<transition name="slide-top-in-out">
				<div class="cf7-actions__result cf7-actions__result-error" v-if="showCopyError">
					Unable to copy. Please, select and copy manually.
				</div>
			</transition>
			<button
				v-if="'css' === visibleResult"
				v-clipboard:copy="resultCSS"
				v-clipboard:success="copySuccess"
				v-clipboard:error="copyError"
				type="button"
			>Copy CSS to Clipboard</button>
			<button
				v-if="'html' === visibleResult"
				v-clipboard:copy="resultHTML"
				v-clipboard:success="copySuccess"
				v-clipboard:error="copyError"
				type="button"
			>Copy HTML to Clipboard</button>
		</div>
	</div>
	<div class="cf7-result__html" v-if="'html' === visibleResult">
		<pre>{{ resultHTML }}</pre>
	</div>
	<div class="cf7-result__css" v-if="'css' === visibleResult">
		<pre>{{ resultCSS }}</pre>
	</div>
</div>
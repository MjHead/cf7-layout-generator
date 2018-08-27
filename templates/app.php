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
<div class="cf7-settings">
	<div class="cf7-settings__title">
		Settings:
	</div>
	<div class="cf7-settings__field">
		Gutter (px):
		<input type="number" v-model="gutter">
	</div>
	<div class="cf7-settings__field">
		Mobile breakpoint (px):
		<input type="number" v-model="mobileBreakpoint">
	</div>
</div>
<div class="cf7-result">
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
	<div class="cf7-result__html" v-if="'html' === visibleResult">
		<pre>{{ resultHTML }}</pre>
	</div>
	<div class="cf7-result__css" v-if="'css' === visibleResult">
		<pre>
.cf-container {
	display: -ms-flexbox;
	display: flex;
	-ms-flex-wrap: wrap;
	flex-wrap: wrap;
	margin-right: -{{ gutter }}px;
	margin-left: -{{ gutter }}px;
}
.cf-col-1, .cf-col-2, .cf-col-3, .cf-col-4, .cf-col-5, .cf-col-6, .cf-col-7, .cf-col-8, .cf-col-9, .cf-col-10, .cf-col-11, .cf-col-12 {
	position: relative;
	width: 100%;
	min-height: 1px;
	padding-right: {{ gutter }}px;
	padding-left: {{ gutter }}px;
}
@media ( min-width: {{ mobileBreakpoint }}px ) {
	.cf-col-1 {
	  -ms-flex: 0 0 8.333333%;
	  flex: 0 0 8.333333%;
	  max-width: 8.333333%;
	}
	.cf-col-2 {
	  -ms-flex: 0 0 16.666667%;
	  flex: 0 0 16.666667%;
	  max-width: 16.666667%;
	}
	.cf-col-3 {
	  -ms-flex: 0 0 25%;
	  flex: 0 0 25%;
	  max-width: 25%;
	}
	.cf-col-4 {
	  -ms-flex: 0 0 33.333333%;
	  flex: 0 0 33.333333%;
	  max-width: 33.333333%;
	}
	.cf-col-5 {
	  -ms-flex: 0 0 41.666667%;
	  flex: 0 0 41.666667%;
	  max-width: 41.666667%;
	}
	.cf-col-6 {
	  -ms-flex: 0 0 50%;
	  flex: 0 0 50%;
	  max-width: 50%;
	}
	.cf-col-7 {
	  -ms-flex: 0 0 58.333333%;
	  flex: 0 0 58.333333%;
	  max-width: 58.333333%;
	}
	.cf-col-8 {
	  -ms-flex: 0 0 66.666667%;
	  flex: 0 0 66.666667%;
	  max-width: 66.666667%;
	}
	.cf-col-9 {
	  -ms-flex: 0 0 75%;
	  flex: 0 0 75%;
	  max-width: 75%;
	}
	.cf-col-10 {
	  -ms-flex: 0 0 83.333333%;
	  flex: 0 0 83.333333%;
	  max-width: 83.333333%;
	}
	.cf-col-11 {
	  -ms-flex: 0 0 91.666667%;
	  flex: 0 0 91.666667%;
	  max-width: 91.666667%;
	}
	.cf-col-12 {
	  -ms-flex: 0 0 100%;
	  flex: 0 0 100%;
	  max-width: 100%;
	}
	.cf-push-1 { margin-left: 8.333333%; }
	.cf-push-2 { margin-left: 16.666667%; }
	.cf-push-3 { margin-left: 25%; }
	.cf-push-4 { margin-left: 33.333333%; }
	.cf-push-5 { margin-left: 41.666667%; }
	.cf-push-6 { margin-left: 50%; }
	.cf-push-7 { margin-left: 58.333333%; }
	.cf-push-8 { margin-left: 66.666667%; }
	.cf-push-9 { margin-left: 75%; }
	.cf-push-10 { margin-left: 83.333333%; }
	.cf-push-11 { margin-left: 91.666667%; }
}
		</pre>
	</div>
</div>
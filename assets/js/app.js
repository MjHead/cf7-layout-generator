var GridLayout = VueGridLayout.GridLayout;
var GridItem = VueGridLayout.GridItem;
var CFLG = new Vue({
	el: '#cf7_layout_generator',
	components: {
        GridLayout,
        GridItem,
    },
	data: {
		layout: [
			{"x":0,"y":0,"w":6,"h":1,"i":"0"},
			{"x":6,"y":0,"w":6,"h":1,"i":"1"},
		],
		result: [
			{"x":0,"y":0,"w":6,"h":1,"i":"0"},
			{"x":6,"y":0,"w":6,"h":1,"i":"1"},
		],
		index: 1
	},
	computed: {
		resultHTML: function() {
			var result = '';
			
			result += '<div class="cf-container">\r\n';

			for ( var i = 0; i < this.result.length; i++ ) {
				result += '\t<div class="cf-col-' + this.result[ i ].w + '">CF7 field here</div>\r\n';
			};

			result += '</div>';

			return result;
		}
	},
	methods: {
		currentWidth: function( width ) {
			switch( width ) {
				
				case 2: 
					return '1/6';

				case 3: 
					return '1/4';

				case 4: 
					return '1/3';

				case 4: 
					return '1/3';

				case 6: 
					return '1/2';

				case 8: 
					return '2/3';

				case 9: 
					return '3/4';

				case 10: 
					return '5/6';

				case 12: 
					return 'Fullwidth';

				default:
					return width + '/12';
			}
		},
		addField: function() {
			var maxY    = 0,
				currY   = 0,
				newItem = {};

			for ( var i = 0; i < this.result.length; i++ ) {
				currY = this.result[ i ].y;
				if ( currY > maxY ) {
					maxY = currY;
				}
			};

			maxY++;
			this.index++;

			newItem = {
				"x": 0,
				"y": maxY,
				"w": 12,
				"h": 1,
				"i": this.index
			}

			this.layout.push( newItem );
			this.result.push( newItem );
		},
		updateLayout: function( newLayout ) {
			this.result.splice( 0, this.result.length );
			for ( var i = 0; i <= newLayout.length - 1; i++ ) {
				this.result.push( newLayout[ i ] );
			};
			console.log( this.result );
		},
		removeField: function( item, index ) {

			this.layout.splice( index, 1 );

			for ( var i = 0; i < this.result.length; i++ ) {
				if ( this.result[ i ].i == item.i ) {
					this.result.splice( i, 1 );
					return;
				}
			};

		}
	}
});
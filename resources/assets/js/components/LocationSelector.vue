<template>

	<div class="form-group" :class="extraClasses[format].parentDivClasses">



		<!-- location accepted by user -->

		<label v-if="show == 'confirmed'" for="location-selectorCCCC" :class="extraClasses[format].labelClasses">Location</label>

        <div v-if="show == 'confirmed'" :class="extraClasses[format].nonLabelClasses" id="location-selectorCCCC">
        	<div class="border border-success p-3 text-center">
	        	<div class="">
	        		<span>{{ acceptedAddress }}</span>
	        	</div>
	        	<div class="mt-2">
	        		<input type="hidden" name="accepted_lat" :value="acceptedLat">
	        		<input type="hidden" name="accepted_lon" :value="acceptedLon">
			    	<button type="button" class="btn btn-sm btn-secondary ml-2" v-on:click="rejectLocation">Undo</button>
			    </div>
			</div>
        </div>


        <!-- asking user to accept or reject google's suggestion -->

		<label v-if="show == 'unconfirmed'" for="location-selectorAAAA" :class="extraClasses[format].labelClasses">Location</label>

        <div v-if="show == 'unconfirmed'" :class="extraClasses[format].nonLabelClasses" id="location-selectorAAAA">
        	<div class="border border-success p-3 text-center">
	        	<div class="">
	        		<span>{{ formattedAddress }}</span>
	        	</div>
	        	<div class="mt-2">
			    	<button type="button" class="btn btn-sm btn-success" v-on:click="acceptLocation">Accept Location</button>
			    	<button type="button" class="btn btn-sm btn-secondary ml-2" v-on:click="rejectLocation">Cancel</button>
			    </div>
			    <div class="mt-1">
			    	<span class="text-black-50 small"><em>Location will not be saved unless you accept it!</em></span>
			    </div>
			</div>
        </div>



        <!-- prompting user for input -->

		<label v-if="show == 'input'" for="location-selectorBBBB" :class="extraClasses[format].labelClasses">Location</label>

        <div v-if="show == 'input'" :class="extraClasses[format].nonLabelClasses">
            <input v-on:keydown.enter.prevent='processAddress' id="location-selectorBBBB" type="text" class="form-control" name="location-selector" v-model="locationFragment">
        </div>





    </div>

</template>

<script>

export default {
	
	props: ['format', 'lat', 'lon'],

	data: () => ({

        addressAlreadyConfirmed: false,
		show: 'input',
		locationFragment: '',
        apiRequest: null,
        response: null,
        formattedAddress: '',
        acceptedAddress: '',
        acceptedLat: '',
        acceptedLon: '',

        extraClasses: {

        	horizontal: {

        		parentDivClasses: 'row',
        		labelClasses: 'col-md-4 col-form-label text-md-right',
        		nonLabelClasses: 'col-md-6'

        	},

        	vertical: {

        		parentDivClasses: '',
        		labelClasses: '',
        		nonLabelClasses: ''

        	}

        }

    }),

    mounted() {

        // check lat and lon
        // if we have BOTH, then
        // call google api with lat and lon params
        // process results to get address fragment
        // set show to 'confirmed'

        console.log("lat and lon:");
        console.log(this.lat);
        console.log(typeof this.lat);
        console.log(this.lon);
        console.log(typeof this.lon);

        // both lat and lon are defined and not empty
        if ( this.coordIsValid(this.lat) && this.coordIsValid(this.lon) ) {

            // Run some code to consult the Google oracle
            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + this.lat + ',' + this.lon;

            this.addressAlreadyConfirmed = true;

            this.sendToApi(url);

        }

    },

    methods: {

    	processAddress: function() {

    		// Run some code to consult the Google oracle
            var url = "https://maps.googleapis.com/maps/api/geocode/json?address=<addr>";
            url = url.replace("<addr>", this.locationFragment);

            this.sendToApi(url);

        },

        sendToApi: function(url, isConfirmed) {

            // Code that fetches data from the API URL and stores it in results.
            this.apiRequest = new XMLHttpRequest();
            this.apiRequest.onload = this.onApiResponse;
            this.apiRequest.onerror = this.onApiError;
            this.apiRequest.open('get', url, true);
            this.apiRequest.send();

    	},

    	onApiError: function() {

    		console.log('error accessing API!');

    	},

    	onApiResponse: function() {

			if (this.apiRequest.status == "200") {

                this.response = JSON.parse(this.apiRequest.response);

                console.log(this.response);

                if (this.response['error_message']) {

                	alert("We got back an error.");
                	console.log(this.response['error_message']);

	        		this.show = 'input';

                }
                else if (this.response['results']) {

                    if (this.addressAlreadyConfirmed) {

                        this.acceptLocation();
                        this.addressAlreadyAccepted = false;

                    }
                    else {
                        this.formattedAddress = this.response.results[0].formatted_address;
                        this.show = 'unconfirmed';
                    }

                }
                else {

                	console.log("We didn't get anything we expected.");

        			this.show = 'input';

        		}

            }
            else {
                
            	console.log('response was not OK');

                console.log(this.apiRequest);
            }

    	},


    	acceptLocation: function() {

    		// Do other code to change form if needed?

    		this.acceptedAddress = this.response.results[0].formatted_address;
    		this.acceptedLat = this.response.results[0].geometry.location.lat;
    		this.acceptedLon = this.response.results[0].geometry.location.lng;

    		this.show = 'confirmed';
    	},

    	rejectLocation: function() {

    		// Remove previously accepted lat and lon and 
    		// display input form again

    		this.acceptedLat = '';
    		this.acceptedLon = '';
    		this.show = 'input';

            this.addressAlreadyConfirmed = false;

    	},

        coordIsValid: function(coord) {

            return ( typeof coord != 'undefined' && coord != null && coord != '' );

        }


    }
}

</script>

<style>

</style>
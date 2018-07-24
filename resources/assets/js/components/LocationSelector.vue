<template>

	<div class="form-group row">



		<!-- location accepted by user -->

		<label v-if="show == 'confirmed'" for="location-selectorCCCC" class="col-md-4 col-form-label text-md-right">Location (accepted by user)</label>

        <div v-if="show == 'confirmed'" class="col-md-6" id="location-selectorCCCC">
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

		<label v-if="show == 'unconfirmed'" for="location-selectorAAAA" class="col-md-4 col-form-label text-md-right">Location (suggested by Google)</label>

        <div v-if="show == 'unconfirmed'" class="col-md-6" id="location-selectorAAAA">
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

		<label v-if="show == 'input'" for="location-selectorBBBB" class="col-md-4 col-form-label text-md-right">Location</label>

        <div v-if="show == 'input'" class="col-md-6">
            <input v-on:keydown.enter.prevent='sendToApi' id="location-selectorBBBB" type="text" class="form-control" name="location-selector" v-model="locationFragment">
        </div>





    </div>

</template>

<script>

export default {
	
	props: ['format'],

	data: () => ({

		show: 'input',
		locationFragment: '',
        apiRequest: null,
        response: null,
        formattedAddress: '',
        acceptedAddress: '',
        acceptedLat: '',
        acceptedLon: ''

    }),

    methods: {

    	sendToApi: function() {

    		// Run some code to consult the Google oracle
            var url = "https://maps.googleapis.com/maps/api/geocode/json?address=<addr>";
            url = url.replace("<addr>", this.locationFragment);

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

	                this.formattedAddress = this.response.results[0].formatted_address;

	                this.show = 'unconfirmed';
                }
                else {

                	console.log("We didn't get anything we expected.");

        			this.show = 'input';

        		}

            }
            else {
                
            	console.log('response was not OK');

                console.log(this.apiRequest.statusText);
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

    	}



    }
}

</script>

<style>

</style>
<template>

	<div class="form-group row">



		<!-- location accepted by user -->

		<label v-if="show == 'confirmed'" for="location-selectorCCCC" class="col-md-4 col-form-label text-md-right">Location (accepted by user)</label>

        <div v-if="show == 'confirmed'" class="col-md-6" id="location-selectorCCCC">
        	<div class="border border-success p-3 text-center">
	        	<div class="">
	        		<span>181 Sherman Ave, Lexington, KY 40502, USA</span>
	        	</div>
	        	<div class="mt-2">
			    	<button type="button" class="btn btn-sm btn-secondary ml-2" v-on:click="rejectLocation">Cancel</button>
			    </div>
			</div>
        </div>


        <!-- asking user to accept or reject google's suggestion -->

		<label v-if="show == 'unconfirmed'" for="location-selectorAAAA" class="col-md-4 col-form-label text-md-right">Location (suggested by Google)</label>

        <div v-if="show == 'unconfirmed'" class="col-md-6" id="location-selectorAAAA">
        	<div class="border border-success p-3 text-center">
	        	<div class="">
	        		<span>181 Sherman Ave, Lexington, KY 40502, USA</span>
	        	</div>
	        	<div class="mt-2">
			    	<button type="button" class="btn btn-sm btn-success" v-on:click="acceptLocation">Accept Location</button>
			    	<button type="button" class="btn btn-sm btn-secondary ml-2" v-on:click="rejectLocation">Cancel</button>
			    </div>
			</div>
        </div>



        <!-- prompting user for input -->

		<label v-if="show == 'input'" for="location-selectorBBBB" class="col-md-4 col-form-label text-md-right">Location</label>

        <div v-if="show == 'input'" class="col-md-6">
            <input v-on:keydown.enter.prevent='sendToApi' id="location-selectorBBBB" type="text" class="form-control" name="location-selector" v-model="locationFragment" required>
        </div>





    </div>

</template>

<script>

export default {
	
	data: () => ({

		show: 'input',
		locationFragment: ''

    }),

    methods: {

    	sendToApi: function() {

    		// Run some code to consult the Google oracle

    		this.show = 'unconfirmed';
    	},

    	acceptLocation: function() {

    		// Do other code to change form if needed?

    		this.show = 'confirmed';
    	},

    	rejectLocation: function() {

    		// Remove previously accepted location, if there was one, and 
    		// display input form again

    		this.show = 'input';

    	}



    }
}

</script>

<style>

</style>
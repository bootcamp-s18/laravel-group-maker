<template>

	<div class="form-group row">

		<label v-if="showResults" for="location-selectorAAAA" class="col-md-4 col-form-label text-md-right">Location (From Google)</label>

        <div v-if="showResults" class="col-md-6">
        	<div class="border border-success p-3 text-center">
	        	<div class="">
	        		<span>181 Sherman Ave, Lexington, KY 40502, USA</span>
	        	</div>
	        	<div class="mt-2">
			    	<button type="button" class="btn btn-sm btn-success" v-on:click="swapDisplay">Confirm Location</button>
			    	<button type="button" class="btn btn-sm btn-secondary ml-2" v-on:click="swapDisplay">Cancel</button>
			    </div>
			</div>
        </div>

		<label v-if="!showResults" for="location-selectorBBBB" class="col-md-4 col-form-label text-md-right">Location</label>

        <div v-if="!showResults" class="col-md-6">
            <input v-on:keydown.enter.prevent='swapDisplay' id="location-selectorBBBB" type="text" class="form-control" name="location-selector" v-model="locationFragment" required>
        </div>

    </div>

</template>

<script>

export default {
	
	data: () => ({

		showResults: false,
		locationFragment: 'cheese'

    }),

    methods: {

    	swapDisplay: function() {
    		this.showResults = !this.showResults;
    		console.log("Swapping...");

    	}


    }
}

</script>

<style>

</style>
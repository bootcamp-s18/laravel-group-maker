<template>
    <div>

        <input type="text" v-model="searchString" placeholder="Enter your search terms" />

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th># Groups</th>
                    <th># Participants</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="activity in filteredActivities">
                    <td>{{ activity.name }}</td>
                    <td>{{ activity.numberOfGroups }}</td>
                    <td>{{ activity.numberOfParticipants }}</td>
                    <td>
                        <div class="row">
                            <div class="col-xs-auto">
                                <button class="btn btn-sm"><a :href="'/activities/' + activity.id + '/edit'"><i class="fas fa-pencil-alt text-info"></i></a></button>
                            </div>
                            <div class="col-xs-auto">
                                <form method="post" :action="'/activities/' + activity.id">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button v-if="activity.numberOfGroups > 0" class="btn btn-sm" type="button"><i class="far fa-trash-alt text-medium" disabled></i></button>
                                    <button v-else class="btn btn-sm" type="submit"><i class="far fa-trash-alt text-danger"></i></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {

        props: ['activitiesData'],

        data: () => ({
            searchString: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }),      

        mounted() {
            console.log('Component mounted.')
        },

        computed: {

            filteredActivities: function() {

                var activities_array = this.activitiesData;
                var search_string = this.searchString.toLowerCase();

                if (!search_string) {
                    return activities_array;
                }

                activities_array = activities_array.filter(function(item) {
                    if(item.name.toLowerCase().indexOf(search_string) !== -1) {
                        return item;
                    }
                });

                return activities_array;

            }

        }
    }
</script>


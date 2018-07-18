<template>
    <div>

        <div class="form-group">
            <label for="searchBox" class="font-weight-bold">Filter Groups:</label>
            <input id="searchBox" class="form-control" type="text" v-model="searchString" placeholder="Enter your search terms" />
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Creator</th>
                    <th>Activity</th>
                    <th># Participants</th>
                    <th>Max Participants</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="group in filteredGroups">
                    <td>{{ group.name }}</td>
                    <td>{{ group.creator_name }}</td>
                    <td>{{ group.activity_name }}</td>
                    <td>{{ group.number_of_members }}</td>
                    <td>{{ group.max_members}}</td>
                    <td>
                        <div class="row">
                            <div class="col-xs-auto">
                                <button class="btn btn-sm"><a :href="'/groups/' + group.id + '/edit'"><i class="fas fa-pencil-alt text-info"></i></a></button>
                            </div>
                            <div class="col-xs-auto">
                                <form method="post" :action="'/groups/' + group.id">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button v-if="group.name == 'Cheese'" class="btn btn-sm" type="button"><i class="far fa-trash-alt text-medium" disabled></i></button>
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

        props: ['groupsData'],

        data: () => ({
            searchString: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }),      

        mounted() {
            console.log('Component mounted.')
        },

        computed: {

            filteredGroups: function() {

                var groups_array = this.groupsData;
                var search_string = this.searchString.toLowerCase();

                if (!search_string) {
                    return groups_array;
                }

                groups_array = groups_array.filter(function(item) {
                    if(item.name.toLowerCase().indexOf(search_string) !== -1) {
                        return item;
                    }
                });

                return group_array;

            }

        }
    }
</script>


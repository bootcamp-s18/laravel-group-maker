<template>
    <div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="searchBox" class="font-weight-bold">Filter Groups by Name:</label>
                    <input id="searchBox" class="form-control" type="text" v-model="searchString" placeholder="Enter your search terms" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="distanceBox" class="font-weight-bold">Show Nearby Groups:</label>
                    <input id="distanceBox" class="form-control" type="text" v-model="searchDistance" placeholder="Search distance in miles" />
                </div>
                
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Creator</th>
                    <th>Activity</th>
                    <th>Distance From Me</th>
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
                    <td>{{ group.distance_from_me }}
                    <td>{{ group.number_of_members }}</td>
                    <td>{{ group.max_members}}</td>
                    <td v-if="purpose === 'manage'">
                        <div class="row">
                            <div class="col-xs-auto">
                                <button class="btn btn-sm" v-if="group.creator_id == currentUserId"><a :href="'/groups/' + group.id + '/edit'"><i class="fas fa-pencil-alt text-info"></i></a></button>
                                <button class="btn btn-sm" v-else disabled><i class="fas fa-pencil-alt"></i></button>
                            </div>
                            <div class="col-xs-auto">
                                <form method="post" :action="'/groups/' + group.id">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-sm" type="submit"><i class="far fa-trash-alt text-danger"></i></button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td v-else-if="purpose === 'join'">
                        <div class="row justify-content-center">
                            <div class="col-auto justify-content-center">

                                <form v-if="currentUsersGroups.includes(group.id)" method="post" :action="'/memberships/' + group.id">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-sm" type="submit"><i class="fas fa-sign-out-alt text-danger"></i></button>
                                </form>

                                <form v-else method="post" :action="'/memberships/' + group.id">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <button class="btn btn-sm" type="submit"><i class="fas fa-sign-in-alt text-success"></i></button>
                                </form>

                            </div>
                        </div>
                    </td>
                    <td v-else>
                        <div class="row"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {

        props: ['groupsData', 'currentUserId', 'purpose', 'currentUsersGroups'],

        data: () => ({
            searchString: '',
            searchDistance: '',
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

                return groups_array;

            }

        }
    }
</script>


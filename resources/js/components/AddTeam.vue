<template>
    <div class="modal fade"
         id="addTeamModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add New Team
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Team Name</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Team name"
                               v-model="formData.name"
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click.prevent="save()">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import api from './mixins/api';
    import { EventBus } from '../utils/event-bus.js';

    export default {
        name: 'add-team',

        mixins: [
            api,
        ],

        data() {
            return {
                formData: {
                    name: '',
                },
                saving: false,
            };
        },

        methods: {
            reset() {
                this.formData.name = '';
            },

            save() {
                this.storeTeam(this.formData)
                    .then(data => {
                        this.close();
                        this.reset();
                        EventBus.$emit('team-created', data);
                    })
            },

            close() {
                $('#addTeamModal').modal('hide');
            },
        },
    }
</script>